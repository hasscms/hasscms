<?php
namespace hasscms\file\storage;

use yii\helpers\FileHelper;

class LocalStorage extends BaseStorage
{

    /**
     * Storage path
     * 
     * @var
     *
     */
    public $basePath = "@localStroage/upload";



    public function init()
    {
        parent::init();
        $this->basePath = FileHelper::normalizePath(\Yii::getAlias($this->basePath)) . DIRECTORY_SEPARATOR;
        
        if (! $this->baseUrl) {
            $this->baseUrl = \Yii::$app->getUrlManager()->getBaseUrl();
        }
    }

    /**
     *
     * @param \yii\web\UploadedFile $file            
     * @param bool $category            
     * @return File
     * @throws \Exception
     * @throws \yii\base\Exception
     */
    public function save($model, $storageDir)
    {
        $targetDir = $this->basePath . $storageDir;
        
        if (! file_exists($targetDir)) {
            FileHelper::createDirectory($targetDir);
        }
        
        $filename = static::getUniqidFileName($targetDir, $model->file->extension);
        
        $path = $targetDir . $filename;
        
        $model->file->saveAs($path);

        \Yii::configure($model, [
            'path' => $path,
            'url' => $this->getFileUrl($storageDir . $filename),
            "storageUrl"=>$this->getStorageUrl($storageDir . $filename),
            "name" => $filename
        ]);
        
        $this->afterSave($model, $storageDir);
        return $model;
    }

    /**
     *
     * @param \yii\web\UploadedFile $file            
     * @return bool
     */
    public function delete($file)
    {
        if (unlink($file->path)) {
            $this->afterDelete($file);
            return true;
        }
        ;
        return false;
    }

    /**
     * Reset storage
     */
    public function reset()
    {}

    public function getFileUrl($path)
    {
        return str_replace("\\", "/",$this->baseUrl . DIRECTORY_SEPARATOR . $path);
    }
    
    public function getStorageUrl($path)
    {
        $url = $this->getFileUrl($path);
        return parent::decodeFileUrl($url, $this->baseUrl, $this->scheme);
    }
}

?>