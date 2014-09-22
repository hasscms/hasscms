<?php
namespace hasscms\file\controllers;

use yii\web\Controller;
use hasscms\file\models\Setting;

class SettingController extends Controller
{
    public function actionIndex()
    {
        $model = new Setting();
        
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            return $this->redirect(["setting/index"]);
        }
        return $this->render('index',['model'=>$model]);
    }
    
}

?>