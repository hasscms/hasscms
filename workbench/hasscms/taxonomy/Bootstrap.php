<?php
namespace hasscms\taxonomy;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use hasscms\cleancache\Config;
/**
 * 可以继承该引导.进行相关属性的修改
 * 注意key必须与taxonomy组件中的cachekey一样
 * @author zhepama
 *
 */
class Bootstrap implements BootstrapInterface
{
    public $cacheItem = ["taxonomy"=>["key"=>"hasscms.taxonomy","label"=>"分类缓存"]];

    /**
     *
     * @param \Yii\web\Application $app
     */
    public function bootstrap($app)
    {
 		Config::setItems($this->cacheItem);

        $groupUrlRule = new GroupUrlRule([
            'prefix' => 'taxonomy',
            'rules' => [
                'create' => 'default/create'
            ]
        ]);

        $app->getUrlManager()->addRules($groupUrlRule->rules);
    }
}
