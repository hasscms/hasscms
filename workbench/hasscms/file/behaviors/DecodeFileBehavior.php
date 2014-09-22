<?php
namespace hasscms\file\behaviors;

use yii\behaviors\AttributeBehavior;
use Closure;
use yii\db\ActiveRecord;
use hasscms\file\models\FileManaged;
use hasscms\file\models\FileUsage;

class DecodeFileBehavior extends AttributeBehavior
{

    /**
     * 需要检查是否被使用的urls
     *
     * @var unknown
     */
    public $checkfileUrls;

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
        $this->checkfileUrls = [];
        // 然后将urls替换成存储的urli
        foreach ($oldUrls as $url) {
            $urls[] = $this->decodeFileUrl($url);
        }
        $value = str_replace($oldUrls, $urls, $value);
        
        // 计算统计值。。
        $countValue = array_count_values($matches[0]);
        $usageFileUrls = [];
        foreach ($this->checkfileUrls as $key => $url) {
            $usageFileUrls[$url] = $countValue[$key];
        }
        
        // 然后附加行为更新附件使用行为...行为再保存后执行
        if ($event->name == ActiveRecord::EVENT_BEFORE_INSERT) {
            $this->owner->on(ActiveRecord::EVENT_AFTER_INSERT, [
                $this,
                'updateFileUsage'
            ], $usageFileUrls, false);
        } else {
            $this->owner->on(ActiveRecord::EVENT_AFTER_UPDATE, [
                $this,
                'updateFileUsage'
            ], $usageFileUrls, false);
        }
        return $value;
    }

    /**
     * 根据真实地址获得存储的特殊uri
     *
     * @param unknown $uri            
     * @return unknown
     */
    public function decodeFileUrl($uri)
    {
     
        // 获取所有存储组件
        $definitions = \Yii::$app->get("file")->getComponents(true);
        $result = false;
        foreach ($definitions as $definition) {
            $class = $definition["class"];
            $baseUrl = isset($definition["baseUrl"]) ? $definition["baseUrl"] : "";
            $result = $class::decodeFileUrl($uri, $baseUrl, $definition["scheme"]);
            
            if ($result) {
                // 如果解析成功.则添加到属性checkfileUrls中,
                $this->checkfileUrls[$uri] = $result;
                break;
            }
        }
        // 如果解析失败则返回原来的url
        if (! $result) {
            $result = $uri;
        }
        return $result;
    }

    /**
     * 1.ajax上传后,file status为0
     * 2.当保存内容后,检查内容现有的附件uri得到所有使用的fid,和 该内容再Fileusage使用的文件进行对比
     * 3.如果文件没有使用,但是fileusage中存在,则删除Fileuage中的数据,然后查找该fid是否被其他内容使用,如果没有使用则将该fid的status设置为0
     * 4.如果文件使用,而且fileusage中存在,但是次数不对,则设置次数为正确次数
     * 5.如果文件使用,但是在fileusage中不存在,则首先将该使用添加到表fileusage中,然后设置所有使用的文件status为1
     *
     * @param unknown $event            
     */
    public function updateFileUsage($event)
    {
        $usageUrls = $event->data;
        $node = $event->sender;
        
        $usefids = [];
        array_walk($usageUrls, function ($count, $uri) use(&$usefids)
        {
            $model = FileManaged::findOne([
                "uri" => $uri
            ]);
            
            if ($model) {
                $usefids[$model->fid] = $count;
            } else { // 如果filemanager中不存在。。应该添加的
            }
        });
        
        /*@var $model \hasscms\node\models\NodeBody */
        $oldUsageFiles = FileUsage::findAll([
            "type" => "node",
            "id" => $node->nid
        ]);
        
        $oldFids = [];
        
        $connection = \Yii::$app->db;
        foreach ($oldUsageFiles as $usageFile) {
            // 文件使用了,而且fileusage中存在
            if (isset($usefids[$usageFile->fid])) { // 检查次数是否正确 第四种
                if ($usefids[$usageFile->fid] != $usageFile->count) {
                    $usageFile->count = $usefids[$usageFile->fid];
                    $usageFile->save();
                }
            } else { // 文件没有使用,但是fileusage中存在..第三个
                     // 删除
                $usageFile->delete();
                // 检查是否被其他文件使用，
                $usage = FileUsage::find()->where([
                    'fid' => $usageFile->fid
                ])->one();
                // 没有使用则设置status为0
                if (! $usage) {
                    $connection->createCommand()
                        ->update(FileManaged::tableName(), [
                        'status' => 0
                    ], 'fid=:fid', [
                        ":fid" => $usageFile->fid
                    ])
                        ->execute();
                }
            }
            $oldFids[$usageFile->fid] = $usageFile->count;
        }
        
        foreach ($usefids as $fid => $count) {
            // 第五种
            if (! isset($oldFids[$fid])) {
                $connection->createCommand()
                    ->update(FileManaged::tableName(), [
                    'status' => 1
                ], 'fid=:fid', [
                    ":fid" => $fid
                ])
                    ->execute();
                
                $connection->createCommand()
                    ->insert(FileUsage::tableName(), [
                    'fid' => $fid,
                    'type' => "node",
                    'id' => $node->nid,
                    "count" => $count
                ])
                    ->execute();
            }
        }
    }
}

?>