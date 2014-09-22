<?php
namespace hasscms\file\storage;

use yii\base\Component;
use Exception;

abstract class BaseStorage extends Component
{

    /**
     * Event triggered after delete
     */
    const EVENT_AFTER_DELETE = 'afterDelete';

    /**
     * Event triggered after save
     */
    const EVENT_AFTER_SAVE = 'afterSave';

    public $scheme;

    public $baseUrl;

    /**
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
    }

    /**
     * This method is called at the end saving a file.
     * Method creates a record about saved file to db
     * 
     * @param \yii\web\UploadedFile $file            
     * @param null $category            
     * @throws \Exception
     */
    public function afterSave($file, $stroageDir)
    {
        $this->trigger(self::EVENT_AFTER_SAVE);
    }

    /**
     *
     * @param \yii\web\UploadedFile $file            
     */
    public function afterDelete($file)
    {
        $this->trigger(self::EVENT_AFTER_DELETE);
    }

    /**
     *
     * @param \yii\web\UploadedFile $file            
     * @return mixed
     */
    public function delete($file)
    {
        $this->afterDelete($file);
    }

    /**
     *
     * @param \yii\web\UploadedFile $file            
     * @param
     *            $category
     * @return mixed
     */
    public function save($file, $storageDir)
    {
        $this->afterSave($file, $storageDir);
    }

    /**
     *
     * @return mixed
     */
    abstract public function reset();

    public static function getUniqidFileName($dir, $ext)
    {
        do {
            $filename = time() . uniqid() . '.' . $ext;
        } while (is_file($dir . $filename));
        
        return $filename;
    }

    public static function decodeFileUrl($uri, $baseUrl, $scheme)
    {
        if ($baseUrl && strpos($uri, $baseUrl) !== false) {
            return $scheme . "://" . ltrim(str_replace($baseUrl, "", $uri), "/");
        }
        
        return false;
    }

    public static function encodeFileUrl($uri, $baseUrl, $scheme)
    {
        if (strpos($uri, $scheme)!==false) {
            return $baseUrl . "/" . str_replace($scheme . "://", "", $uri);
        }
        
        return false;
    }
}

?>