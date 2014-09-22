<?php
namespace hasscms\comment\widgets;

use yii\bootstrap\Widget;
use hasscms\comment\models\CommentExtend;
use hasscms\comment\models\Comment;
use yii\base\ErrorException;


class CommentWidget extends Widget
{   
    /**
     * baseModel特性
     * @var unknown
     */
    public $attributes = [];
    
    /**
     * 是否允许匿名评论
     * @var unknown
     */
    public $allowAnonymous = false;
    
    /**
     * 评论框编辑器
     * @var array
     */
    public $editor =[];
    
    /**
     * 基本模型
     * @var \hasscms\comment\models\Comment
     */
    public $baseModel;
    
    /**
     * 扩展模型
     * @var \hasscms\comment\models\CommentExtend
     */
    public $extendModel;
    
    /**
     * 布局
     * @var string
     */
    public $layout = "{summary}\n{items}\n{form}";
    
    public $showSubject = true;
    
    public function init()
    {
        parent::init();
        $this->initAttributes();
        $this->initModel();
        
        
        $this->editor = array_merge(["type"=>"","config"=>[],"options"=>[]],$this->editor);
    }
    
    public function initAttributes()
    {
       $this->attributes = array_merge([
           "comment_type_slug"=>"default",
           "entity_type"=>"",
           "entity_id"=>0,
           "slug"=>"",
           "pid"=>0,
           "subject"=>"",
       ],$this->attributes);
       
       if(empty($this->attributes["slug"]))
       {
           if(empty($this->attributes["entity_type"])||empty($this->attributes["entity_id"]))
           {
               throw new ErrorException("entity_type和entity_id或者slug必须有一个需要设置");
           }
           $this->attributes["slug"] = $this->attributes["entity_type"]."-".$this->attributes["entity_id"];
       }
       
    }
    
    public function initModel()
    {
        if ($this->attributes['comment_type_slug'] !== "default")
        {
            $this->extendModel = new CommentExtend();
        }
        
        $this->baseModel = new Comment();
        $this->baseModel->attributes = $this->attributes;
    }
    
    
    public function run()
    { 
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);
            return $content === false ? $matches[0] : $content;
        }, $this->layout);
        
        echo $content;
    }

    public function renderSection($name)
    {
        switch ($name) {
            case '{summary}':
                return $this->renderSummary();
            case '{items}':
                return $this->renderItems();
            case '{form}':
                return $this->renderForm();
            default:
                return false;
        }
    }
    
    public function renderSummary()
    {
        return "";
    }
    
    public function renderItems()
    {
        return "";
    }
    
    public function renderForm()
    {
        return $this->render("form",["baseModel"=>$this->baseModel,"extendModel"=>$this->extendModel]);
    }

}

?>