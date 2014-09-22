<?php

namespace hasscms\field\models;

use yii\base\Model;

class FieldForGrid extends Model {
	public $label;
	public $weight;
	public $widget;
	public $widgetConfig;
	public $enabled;
	public $default;
	public function attributeLabels() {
		return [
				"label" => "字段名称",
				"weight" => "权重",
				"widget" => "挂件",
				"widgetConfig" => "挂件配置",
				"enabled" => "启用"
		];
	}
	/**
	 * 覆盖默认loadMultiple...$models 自动实例化
	 * @param unknown $models
	 * @param unknown $data
	 * @return boolean
	 */
		public static function loadMultiple(&$models, $data)
	{

		foreach ($data as $attributes)
		{
			$models[]= new static($attributes);
		}

		return  $models;
	}


}

?>