<?php
namespace hasscms\setting;
use yii\base\BootstrapInterface;
use hasscms\setting\models\SiteForm;
use hasscms\setting\models\MailForm;
use hasscms\cleancache\Config;

/**
 * 可以继承该引导.进行相关属性的修改
 * 注意key必须与setting组件中的cachekey一样
 * @author zhepama
 *
 */
class Bootstrap implements BootstrapInterface
{
    public $cacheItem = ["setting"=>["key"=>"hasscms.setting","label"=>"设置缓存"]];

    public function bootstrap($app) {

    	Config::setItems($this->cacheItem);

        //覆盖配置文件中的配置  邮箱。站点。语言。等
       $definitions =  $app->getComponents();
       $setting = $app->get("setting");
       /* @var  $setting \hasscms\setting\components\Setting */
       $app->name = $setting->get("siteName",SiteForm::COLLECTION);
       /**
        *邮箱设置
        */
       $mailConfig = $definitions["mailer"];
       $mailConfig["transport"]["host"] = $setting->get("mailServer",MailForm::COLLECTION);
       $mailConfig["transport"]["username"] = $setting->get("mailLogin",MailForm::COLLECTION);
       $mailConfig["transport"]["password"] = $setting->get("mailPass",MailForm::COLLECTION);
       $mailConfig["transport"]["port"] = $setting->get("mailPort",MailForm::COLLECTION);
       $app->set("mailer",$mailConfig);
    }
}
