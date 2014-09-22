<?php
namespace hasscms\user;

use yii\base\BootstrapInterface;


class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {
        // set up i8n
        if (empty($app->i18n->translations['user'])) {
            $app->i18n->translations['user'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' =>  '@vendor/amnah/yii2-user/messages',
            //'forceTranslation' => true,
            ];
        }
    }
}
