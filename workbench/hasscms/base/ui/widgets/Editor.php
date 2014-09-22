<?php
namespace hasscms\base\ui\widgets;

use yii\base\Widget;

class Editor extends Widget
{
    
    const EDITOR_TYPE_TEXTAREA = "textarea";
    
    /**
     * 
     * @var \yii\widgets\ActiveForm
     */
    public $form;
    
    public $editorType;
    
    public $model;
    
    public $attribute;
    
    public $options = [];
    
    public $config;
    
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        
        $field = $this->form->field($this->model, $this->attribute,$this->options);
        if (empty($this->editorType)||$this->editorType == static::EDITOR_TYPE_TEXTAREA)
        {
            echo $field->textarea($this->config);
            return;
        }
        
        echo $field->widget($this->editorType,$this->config);
        
    }
    
}

?>