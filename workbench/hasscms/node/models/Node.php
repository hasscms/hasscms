<?php

namespace hasscms\node\models;

use hasscms\field\fields\BaseField;
use yii\db\Exception;
use hasscms\field\Config;

class Node extends BaseNode {

	/**
	 * 附件表规则
	 *
	 * @var unknown
	 */
	public $attachTableRules = [ ];

	/**
	 * 附件表名
	 *
	 * @var unknown
	 */
	public $attachTableName;

	/**
	 * 附件表标签
	 *
	 * @var unknown
	 */
	private $_attachAttributeLabels = [ ];

	/**
	 * 存储所有附加字段的键名和值
	 *
	 * @var unknown
	 */
	private $_attachFields = [ ];

	/**
	 * 字段显示的挂件类名和配置
	 *
	 * @var array
	 */
	public $fieldWidgets;

	/**
	 * 关联的模型配置
	 *
	 * @var unknown
	 */
	private $_relatedModelsConfig = [ ];

	/**
	 * 附加模型
	 *
	 * @var unknown
	 */
	private $_relatedModels;
	public function init() {
		parent::init ();
		$this->loadAttachFields ();
	}

	/**
	 * @inheritdoc
	 */
	public function __get($name) {
		if (array_key_exists ( $name, $this->_attachFields )) {
			return $this->_attachFields [$name];
		} else {
			return parent::__get ( $name );
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __set($name, $value) {
		if (array_key_exists ( $name, $this->_attachFields )) {
			$this->_attachFields [$name] = $value;
		} else {
			parent::__set ( $name, $value );
		}
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return array_merge ( [
				'nid' => 'The node ID.',
				'type' => 'The node type.',
				'langcode' => '语言',
				'title' => '标题',
				'uid' => '用户ID',
				'status' => '保存并发布',
				'created' => '创建日期',
				'changed' => '修改日期',
				'promote' => '推荐到首页',
				'sticky' => '置顶',
				'default_langcode' => '是否默认语言'
		], $this->_attachAttributeLabels );
	}

	/**
	 * 加载字段
	 */
	public function loadAttachFields() {
		// 附加表
		if ($this->type && \Yii::$app->getDb ()->getTableSchema ( "node_" . $this->type )) {
			$this->attachTableName = "node_" . $this->type;
			// 附件表
			$this->_relatedModelsConfig [$this->attachTableName] = [
					"attachModelClass" => NodeAttached::className (),
					"hasMany" => false
			];
		}

		$coreNodeTypes = $this->coreNodeTypes ();

		if (isset ( $coreNodeTypes [$this->type] )) {
			$fields = $coreNodeTypes [$this->type];
		} else { // 外部搜索
			$fields = [ ];
		}

		foreach ( $fields as $field ) {

			$name = $field ["name"];
			$this->defineAttachField ( $name );
			// 规则
			if (isset ( $field ["data"] ["rules"] )) {
				//这里应该循环一下
				foreach ( $field ["data"] ["rules"] as $rule)
				{
					$this->attachTableRules [serialize ($rule)] [] = $name;
				}

			}
			// attributeLabel
			if (isset ( $field ["data"] ["label"] )) {
				$this->_attachAttributeLabels [$name] = $field ["data"] ["label"];
			}

			// 挂件
			$config = array_merge ( Config::getWidget ( $field ["data"] ["widget"] ["name"] ), $field ["data"] ["widget"] );
			$class = $config ["class"];
			unset ( $config ["class"] );
			unset ( $config ["name"] );
			$this->fieldWidgets [$name] = [
					"class" => $class,
					"config" => $config
			];

			// 附件挂件中的模型表
			if ($config ["widgetType"] == BaseField::WIDGET_TYPE_MODEL) {
				$this->_relatedModelsConfig [$name] = $config;
			}
		}
	}
	public function coreNodeTypes() {
		return [
				"base" => [
						[
								"name" => "body",
								"data" => [
										"widget" => [
												"name" => "textWithSummary",
												"options" => [ ],
												"defaultValue" => ""
										]
								],
								"weight" => 10
						]
				],
				"counter" => [
						[
								"name" => "totalcount",
								"data" => [
										"widget" => [
												"name" => "text",
												"options" => [ ],
												"defaultValue" => ""
										],
										"rules" => [[
												"validator" => "string",
												"options" => [
														"max" => 255
												]]
										],
										"label" => "总计"
								],
								"weight" => 10
						],
						[
								"name" => "daycount",
								"data" => [
										"widget" => [
												"name" => "text",
												"options" => [ ],
												"defaultValue" => ""
										],
										"rules" => [[
												"validator" => "string",
												"options" => [
														"max" => 255
												]]
										],
										"label" => "日计"
								],
								"weight" => 10
						],
						[
								"name" => "timestamp",
								"data" => [
										"widget" => [
												"name" => "text",
												"options" => [ ],
												"defaultValue" => ""
										],
										"rules" => [[
												"validator" => "string",
												"options" => [
														"max" => 255
												]]
										],
										"label" => "日期"
								],
								"weight" => 10
						]
				]
		];
	}
	public function load($data, $formName = null) {
		if (! parent::load ( $data )) {
			return false;
		}

		$models = $this->getRelatedModels () ?  : [ ];
		foreach ( $models as $name => $model ) {
			if ($model instanceof NodeAttached) {
				$result = $model->load ( $data, $this->formName () );
			} else {
				$result = $model->load ( $data );
			}
			if (! $result) {
				return false;
			}
		}

		return true;
	}
	public function save($runValidation = true, $attributeNames = null) {
		$transaction1 = $this->getDb ()->beginTransaction ();
		try {
			if (parent::save ( $runValidation = true, $attributeNames = null ) == false) {
				throw new Exception ( self::getClassName () . "表保存错误" );
			}

			foreach ( $this->getRelatedModels () as $model ) {
				$model->nid = $this->nid;
				if ($model->save () == false) {
					throw new Exception ( $model::getClassName () . "表保存错误" );
				}
			}

			$transaction1->commit ();
			return true;
		} catch ( Exception $e ) {
			$transaction1->rollBack ();
			throw new Exception ( $e );

			return false;
		}
	}
	public function getErrors($attribute = null) {
		$errors = parent::getErrors ( $attribute );

		foreach ( $this->getRelatedRecords () as $model ) {
			$errors = array_merge ( $errors, $model->getErrors ( $attribute ) );
		}

		return $errors;
	}
	public function afterFind() {
		if ($this->nid) {
			$this->getRelatedModels ( $this->nid );
		}
		parent::afterFind ();
	}
	protected function getRelatedModels($nid = null) {
		if (! empty ( $this->_relatedModels )) {
			return $this->_relatedModels;
		}

		$this->loadAttachFields ();
		foreach ( $this->_relatedModelsConfig as $fieldName => $config ) {
			$class = $config ["attachModelClass"];
			$hasMany = $config ["hasMany"];

			if ($fieldName == $this->attachTableName) {
				$model = $this->findAttachModel ( $nid );
				$this->_relatedModels [$fieldName] = $model;
			} else {
				if ($hasMany == true) {
					// if(!Model::loadMultiple($models, $data))
					// {
					// return false;
					// }
				} else {
					if ($nid) {
						$model = $class::find ()->where ( [
								'nid' => $nid,
								'field_name' => $fieldName
						] )->one ();

						$this->$fieldName = $model;
					} else {
						$model = new $class ();
						$model->loadDefaultValues ();
					}

					$this->_relatedModels [$fieldName] = $model;
				}
			}
		}
		return $this->_relatedModels;
	}
	public function findAttachModel($id = null) {
		NodeAttached::$tableName = $this->attachTableName;
		if ($id) {
			$model = NodeAttached::find ()->where ( [
					'nid' => $id
			] )->one ();
			$this->setAttachFields ( $model->getAttributes () );
		} else {
			$model = new NodeAttached ();
		}

		foreach ( $this->attachTableRules as $data => $attributes ) {
			$data = unserialize ( $data );
			$model->addRule ( $attributes, $data ['validator'], $data ["options"] );
		}
		return $model;
	}

	/**
	 * 设置附件字段值
	 *
	 * @param unknown $data
	 */
	public function setAttachFields($data) {
		foreach ( $this->_attachFields as $key => $value ) {
			if (array_key_exists ( $key, $data )) {
				$this->$key = $data [$key];
			}
		}
	}
	public function defineAttachField($name, $value = null) {
		$this->_attachFields [$name] = $value;
	}
	public function attachFields() {
		return array_keys ( $this->_attachFields );
	}
}

?>