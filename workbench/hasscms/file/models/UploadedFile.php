<?php
namespace hasscms\file\models;

use yii\helpers\FileHelper;
use yii\base\DynamicModel;


/**
 * 该模型验证上传的文件和图片数据.并保存返回值数据
 * @author zhepama
 *
 */
class UploadedFile extends DynamicModel
{
    private $_mimeType;
    private $_url;

    public $storageUrl;
    public $path;
    public $name;
   
    /**
     * 
     * @var \yii\web\UploadedFile
     */
    public $file;

    public function init()
    {
        parent::init();
    }
    
    public function getMimeType(){
        if(!$this->_mimeType){
            $this->_mimeType = FileHelper::getMimeType($this->path);
        }
        return $this->_mimeType;
    }
    
    public function setUrl($value)
    {
        $this->_url = $value;
    }

    public function getUrl()
    {
        return $this->_url;
    }

}