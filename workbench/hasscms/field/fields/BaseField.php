<?php

namespace hasscms\field\fields;

use yii\widgets\InputWidget;

class BaseField extends InputWidget {
	const WIDGET_TYPE_FIELD = "field";
	const WIDGET_TYPE_MODEL = "model";
	public $defaultValue;
	public $widgetName;
	public $widgetType;
	public $behaviors;
	
	public function init() {
		parent::init ();
		
		if (! $this->defaultValue) {
			$this->defaultValue = "";
		}
	}
}

?>