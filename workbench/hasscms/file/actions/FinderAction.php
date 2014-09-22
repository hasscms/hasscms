<?php
namespace hasscms\file\actions;

use yii\base\Action;
use Yii;
use yii\web\HttpException;
use yii\helpers\FileHelper;
use yii\helpers\Json;


/**
 * ckfinder 返回xml
 * Redactor 返回json
 * tinymce  返回jsonp
 * 且三者格式都不同
 *
 */
class FinderAction extends Action
{

    /**
     * @var string
     */
    public $imageList = '@webroot/uploads';
    
 /**
     * @var string Files directory
     */
    public $path;

    /**
     * @var string Files directory URL
     */
    public $url;

    /**
     * [\yii\helpers\FileHelper::findFiles()|FileHelper::findFiles()] options argument.
     * @var array Options
     */
    public $options;
    
    /**
     * @throws \yii\web\HttpException
     */
    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }
        if (parse_url(Yii::$app->request->referrer,PHP_URL_HOST) !== Yii::$app->request->serverName){
            throw new HttpException(403, 'This action allow only from ' . Yii::$app->request->serverName . ' server');
        };
        
        $this->options = array_merge(['recursive' => true, 'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']],$this->options);
    }
    
    
    public function run()
    {
        $files = FileHelper::findFiles($this->getPath(), $this->options);
    
        if (is_array($files) && count($files)) {
            $result = [];
            foreach ($files as $file) {
                $url = $this->getUrl($file);
                $result[] = ['thumb' => $url, 'image' => $url];
            }
            echo Json::encode($result);
        }
    }
    
    /**
     * @return string
     */
    protected function getPath()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::getAlias($this->sourcePath) . '/' . 'guest';
        } else {
            return Yii::getAlias($this->sourcePath) . '/' . Yii::$app->user->id;
        }
    }
    
    /**
     * @param $path
     * @return string
     */
    public function getUrl($path)
    {           
        return Yii::getAlias('@web').str_replace(Yii::getAlias('@webroot'), '', $path);
    }
}

?>