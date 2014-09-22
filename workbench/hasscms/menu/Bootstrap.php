<?php
namespace hasscms\menu;
use yii\base\BootstrapInterface;
use hasscms\cleancache\Config;
/**
 * 可以继承该引导.进行相关属性的修改
 * 注意key必须与menu组件中的cachekey一样
 * @author zhepama
 *
 */
class Bootstrap implements BootstrapInterface
{


    public $cacheItem = ["menu"=>["key"=>"hasscms.menu","label"=>"菜单缓存"]];

    public function bootstrap($app) {
    	Config::setItems($this->cacheItem);
    }
}
