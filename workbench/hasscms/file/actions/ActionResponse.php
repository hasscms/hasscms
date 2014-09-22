<?php
namespace hasscms\file\actions;

use yii\web\Response;
use yii\helpers\Json;

class ActionResponse
{

    const REDACTOR = "redactor";

    const CKEDITOR = "ckeditor";

    const UEDITOR = "ueditor";

    const FIELD = "field";

    /**
     *
     * @param unknown $type            
     * @param \hasscms\file\models\UploadedFile $model            
     * @return string
     */
    public static function getUploadResponse($type, $model)
    {
        switch ($type) {
            case static::REDACTOR:
                
                // \Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                return Json::encode([
                    "filelink" => $model->url
                ]);
            case static::CKEDITOR:
                return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(1, "' . $model->url . '", "");</script>';
            case static::UEDITOR:
                return Json::encode([
                    "state" => "SUCCESS", // 上传状态，上传成功时必须返回"SUCCESS"
                    "url" => $model->url, // 返回的地址
                    "title" => $model->name, // 新文件名
                    "original" => $model->name, // 原始文件名
                    "type" => $model->file->type, // 文件类型
                    "size" => $model->file->size // 文件大小
                ]);
            case static::FIELD:
                return Json::encode([
                    "files" => [
                        [
                            "name" => $model->name,
                            "size" => $model->file->size,
                            "url" => $model->url,
                            "thumbnaiUrl" => $model->url,
                            "deleteUrl" => $model->url,
                            "deleteType" => "DELETE"
                        ]
                    ]
                ]);
                break;
        }
    }

    public static function getUploadError($type, $model)
    {
        \Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $result = [
            "error" => 1,
            "message" => $uploadedFile->error
        ];
        return $result;
    }
}

?>