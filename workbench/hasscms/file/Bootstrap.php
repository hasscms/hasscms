<?php
namespace hasscms\file;

use yii\base\BootstrapInterface;

use Yii;
class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {
      //注册配置文件的页面
        /* @var  $app \yii\web\Application */
       $setting = $app->getModule("setting");
       
       /* @var  $setting \hasscms\setting\Module */
       $setting->registerSystemMenus([
        'label' => '上传配置',
        'url' => [
          '/file/setting/index'
        ],
        'activeWithParent'=>false
      ]);
    }
}
