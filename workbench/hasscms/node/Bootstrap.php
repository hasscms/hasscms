<?php
namespace hasscms\node;

use yii\base\BootstrapInterface;

use Yii;
use hasscms\field\fields\BaseField;
use hasscms\field\Config;

class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {
        /**
         * 想字段组件...注册node中拥有的字段
         */
     Config::setWidgets([
            "textWithSummary"=>[
                "class"=>'\hasscms\node\fields\TextWithSummary',
                "widgetName"=>"长文本和摘要",
                "widgetType"=>BaseField::WIDGET_TYPE_MODEL,
                "hasMany"=>false,
                "attachModelClass"=>'\hasscms\node\models\NodeBody'
            ]

        ]);

    }
}
