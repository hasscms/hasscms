<?php
namespace hasscms\cleancache\models;

use yii\base\DynamicModel;
use yii\base\Model;


class CleanCache extends DynamicModel
{
    private $_attributeLabels;
    public function __construct(array $attributes = [], $config = [])
    {
    	foreach ($attributes as $attribute =>  $item) {
    		$this->setAttribute($attribute,$item["key"],$item["lable"]);
    	}
    	Model::__construct($config);
    }

    public function  setAttribute($name,$value,$label)
    {
        $this->defineAttribute($name,$value);
        $this->_attributeLabels[$name] = $label;
    }

    public function attributeLabels()
    {
        return $this->_attributeLabels;
    }



}