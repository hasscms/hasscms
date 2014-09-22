<?php
namespace hasscms\field\fields;
use yii\helpers\Html;

class ModelField extends BaseField
{ 
    public $form;
    
    public $hasMany = false;
    
    public $attachModelClass;
    
    public function init()
    {
        parent::init();
        if ($this->hasModel()) {
            $this->value = $this->model[Html::getAttributeName($this->attribute)];
        }

        if(!($this->value instanceof $this->attachModelClass))
        {
            $class = $this->attachModelClass;
            /*@var  $class \yii\db\ActiveRecord */
            $this->value =$class::instantiate(null);
            $this->value->field_name = $this->attribute;
            $this->value->loadDefaultValues();
        }
    
    }
  
}

?>