<?php

namespace hasscms\field;

use yii\base\BootstrapInterface;
use Yii;
use hasscms\field\fields\BaseField;

class Bootstrap implements BootstrapInterface {
	public function bootstrap($app) {
		Config::setWidgets ([
				"text" => [
						"class" => '\hasscms\field\fields\Text',
						"widgetName" => "文本",
						"widgetType" => BaseField::WIDGET_TYPE_FIELD
				]
		]);
	}
}


