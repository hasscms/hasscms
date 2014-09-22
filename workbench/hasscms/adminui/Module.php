<?php
/*
 * To change this license header, choose License Headers in Project Properties. To change this template file, choose Tools | Templates and open the template in the editor.
 */
namespace hasscms\adminui;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\web\Controller;
use hasscms\base\helper\AppHelper;


class Module extends \yii\base\Module implements BootstrapInterface
{
  public function bootstrap($app)
  {
    // 添加adminui演示模块
    $app->setModule('adminuidemo', [
      'class' => 'yii\adminUi\module\Module',
      'layout' => "main",
      'layoutPath' => "@yii/adminUi/themes/layouts"
    ]);
    
    //自定义assets目录,去除了google字体,否则加载缓慢
    Yii::setAlias("@vendor/adminUi/assets", __DIR__."/assets");
    Yii::setAlias("@backend/themes/adminui",__DIR__."/views");
    
    //动作前
    Event::on(Controller::className(), Controller::EVENT_BEFORE_ACTION, function ($event)
    {
        if (AppHelper::isBackendApp() && $event->action->id == "login") {
            $event->sender->layout = '//blank';
        }
    });

    //adminui模块中把css设置为空,这里重置下
    \Yii::$app->get("assetManager")->bundles['backend\assets\AppAsset']['css'] = ['css/site.css'];
  }
}