<?php
namespace hasscms\file\actions;

use yii\base\Action;
use yii\helpers\Html;
use yii\web\UploadedFile;
use hasscms\base\helper\AppHelper;
use yii\db\IntegrityException;

use yii\helpers\FileHelper;
use hasscms\file\models\FileManaged;


class UploadAction extends Action
{
    public $model;

    public $attribute;

    public $fieldName = 'file'; // 文件字段参数...

    public $uploadSource = "field"; // 上传来源..编辑器ck,或者其他

    public $storageType = 'local';

    public $fileStorage; // 存储方式

    public $storageDir;

    public $stroageDirType;

    public $stroageDirParams;

    public $disableCsrf = false;
    
    public $uploadOnlyImage = true;
    
    private $_validator = 'image';
    public $validatorOptions = [];
    
    public function init()
    {
        if ($this->disableCsrf) {
            \Yii::$app->request->enableCsrfValidation = false;
        }
        
        if ($this->uploadOnlyImage !== true) {
            $this->_validator = 'file';
        }
        
        // fieldName
        if (\Yii::$app->request->get('fieldName')) {
            $this->fieldName = \Yii::$app->request->get('fieldName');
        }
        if ($this->model && $this->attribute) {
            $this->fieldName = Html::getInputName($this->model, $this->attribute); // file[aaaa]
        }
        
        // storagedir
        if (! $this->storageDir) {
            if (\Yii::$app->request->get('stroageDirType')) {
                $this->stroageDirType = \Yii::$app->request->get('stroageDirType');
            } else {
                throw new IntegrityException("目录类型不存在");
            }
            
            $this->stroageDirParams = \Yii::$app->request->get('stroageDirParams');
            $this->storageDir = $this->getFileStorageDir();
        }
        // storagetype
        if (\Yii::$app->request->get('storageType')) {
            $this->storageType = \Yii::$app->request->get('storageType');
        }
        $this->fileStorage = \Yii::$app->get("file")->get($this->storageType);
        
        // uploadsource
        if (\Yii::$app->request->get('uploadSource')) {
            $this->uploadSource = \Yii::$app->request->get('uploadSource');
        }
    }

    public function getFileStorageDir()
    {
        $dirs = [];
        
        if (AppHelper::isBackendApp()) {
            $dirs = [
                "module" => "site/{module}/{yyyy}{mm}{dd}/",
                "node" => "site/node/{yyyy}{mm}{dd}/",
                "common" => "site/common/{yyyy}{mm}{dd}/"
            ];
        } else {
            $dirs = [
                "comment" => "user/{uid}/comment/{yyyy}{mm}{dd}/",
                "node" => "user/{uid}/node/{yyyy}{mm}{dd}/",
                "user" => "user/{uid}/profile/",
                "album"=>"user/{uid}/album/{id}"
            ];
        }
        
        if (! isset($dirs[$this->stroageDirType])) {
            throw new IntegrityException("目录类型不存在");
        }
        
        $params = $this->stroageDirParams;
        $params['uid'] = \Yii::$app->getUser()->getId() ? \Yii::$app->getUser()->getId() : "guest";
        $params['yyyy'] = date("Y");
        $params['mm'] = date("m");
        $params['dd'] = date("d");
        $dir = preg_replace_callback('/{(\w+)}/', function ($matches) use($params)
        {
            return $params[$matches[1]];
        }, $dirs[$this->stroageDirType]);
        
        return FileHelper::normalizePath($dir) . DIRECTORY_SEPARATOR;
    }

    public function run()
    {
        $result = [];
        $file = UploadedFile::getInstanceByName($this->fieldName);

        $uploadedModel = new \hasscms\file\models\UploadedFile([],compact('file'));

        $uploadedModel->addRule('file', $this->_validator, $this->validatorOptions);
        
        if($uploadedModel->validate())
        {
            // 存储类进行存储
             $this->fileStorage->save($uploadedModel, $this->storageDir);
            // 从存储类中获取存储的文件信息,实例化file模型并存储
            $fileManager = new FileManaged();
            
            $fileManager->uid = \Yii::$app->getUser()->getId();
            $fileManager->filename = $uploadedModel->file->name;
            $fileManager->uri = $uploadedModel->storageUrl;
            $fileManager->filemime = $uploadedModel->getMimeType();
            $fileManager->filesize = $uploadedModel->file->size;
            $fileManager->status = 0;
            
            $fileManager->save();
            
            //print_r($fileManager->errors);
            // 根据上传wiget类型(field,editor),返回不同的响应
            return ActionResponse::getUploadResponse($this->uploadSource, $uploadedModel);
        }

        return ActionResponse::getUploadError($this->uploadSource,$uploadedModel);
    }
}

?>