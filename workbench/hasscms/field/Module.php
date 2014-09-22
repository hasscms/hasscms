<?php
namespace hasscms\field;
/**
 *1.复杂挂件字段重用...例如评论和摘要.图片.视频信息.音乐信息.下载 
 *2.一对多字段可重用...例如tag,node与分类关系
 *3.基本字段绑定在附加表中 
 *
 *hasscmscms的字段复用:
 *1.没有复用其他字段表的设置.字段含有是否可复用的默认值...即如果该字段类型是可复用字段类型..则引用该字段的值都存储再该字段指向的表中...
 *2.可重用字段的表必须都拥有field_name进行分区,其所代表的字段名..类似drupal的评论字段
 *
 *字段使用的模块和类型:
 *1.node,评论,node复合字段,基本类型字段.分类,tag
 *2.comment  基本类型字段,分类
 *3.setting  基本类型字段,分类
 *
 *drupal的字段复用:
 * 1.当前模型除了评论,不能复用自己的字段.
 * 2.当前模型复用了其他模型的字段后,不能再复用该字段.
 */
 class Module extends \yii\base\Module
{
    public $controllerNamespace = 'hasscms\field\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
