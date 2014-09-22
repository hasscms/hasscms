<?php
namespace hasscms\file\behaviors;

use yii\behaviors\AttributeBehavior;
use Closure;
class EncodeFileBehavior extends AttributeBehavior
{
    
/**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     *
     * @param Event $event            
     */
    public function evaluateAttributes($event)
    {
        if (! empty($this->attributes[$event->name])) {
            $attributes = (array) $this->attributes[$event->name];
            
            foreach ($attributes as $attribute) {
                // ignore attribute names which are not string (e.g. when set by TimestampBehavior::updatedAtAttribute)
                if (is_string($attribute)) {
                    $this->owner->$attribute = $this->getValueByAttribute($attribute, $event);
                }
            }
        }
    }

    /**
     * 替换所有链接为存储url
     * @inheritdoc
     */
    protected function getValueByAttribute($attribute, $event)
    {
        if ($this->value instanceof Closure) {
            return call_user_func($this->value, [
                $attribute,
                $event
            ]);
        }
        
        $value = $this->owner->$attribute;
        
        // 首先正则查找出所有允许存储的附件url
        preg_match_all('#\b(([\w-]+://?|www[.])[^\s()<>]+\.(gif|jpg|png))#iS', $value, $matches);
        $oldUrls = array_unique($matches[0]); // 去重
        $urls = [];
        // 然后将urls替换成存储的urli
        foreach ($oldUrls as $url) {
            $urls[] = $this->encodeFileUrl($url);
        }
        $value = str_replace($oldUrls, $urls, $value);
        
        // 然后附加行为更新附件使用行为...行为再保存后执行
        // $this->owner->on(Controller::EVENT_AFTER_ACTION, [$this, 'afterFilter'], null, false);
        
        return $value;
    }

    /**
     * 根据真实地址获得存储的特殊uri
     *
     * @param unknown $uri            
     * @return unknown
     */
    public function encodeFileUrl($uri)
    {
        // 获取所有存储组件
        $definitions = \Yii::$app->get("file")->getComponents(true);
        $result = false;
        foreach ($definitions as $definition) {
            $class = $definition["class"];
            $baseUrl = isset($definition["baseUrl"])?$definition["baseUrl"]:"";
            
            $result = $class::encodeFileUrl($uri,$baseUrl, $definition["scheme"]);
            
            if ($result) {
                break;
            }
        }
        // 如果解析失败则返回原来的url
        if (! $result) {
            $result = $uri;
        }
        return $result;
    }
}

?>