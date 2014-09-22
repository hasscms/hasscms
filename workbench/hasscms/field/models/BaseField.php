<?php

namespace hasscms\field\models;

use yii\base\Model;

/**
 * 保存前序列化此类。。作为data之段使用
 * @author zhepama
 *
 */
class BaseField extends Model implements \Serializable {
	public $label; //显示标签

	public $fieldRules;

	public $widgetName;

	public $widgetOptions;

	public $widgetConfig;//挂件其他配置
	public $defaultValue;

	public function init(){

	}

	public function serialize()
	{
		return serialize( [
			"widget"=>array_merge($this->widgetConfig,[
					"name"=>$this->widgetName,
					"options"=>$this->widgetOptions,
					"defaultValue"=>$this->defaultValue
			]),
			"rules"=>[

			],
			"label"=>$this->label
		]);
	}

	public function unserialize($data)
	{
		unserialize($data);
	}
}

?>