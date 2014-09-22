<?php
namespace hasscms\field\fields;

use yii\helpers\Html;
class Text extends BaseField
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
       echo Html::activeTextInput($this->model, $this->attribute);
    }
}

?>