<?php
namespace hasscms\node\fields;

use hasscms\field\fields\ModelField;

class TextWithSummary extends ModelField
{   
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo $this->render("text_with_summary",["model"=>$this->value,"form"=>$this->form]);
    }
}

?>