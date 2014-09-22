<?php
namespace hasscms\setting\controllers;

use hasscms\setting\models\SiteForm;
use hasscms\setting\models\MailForm;
class SystemController extends \yii\web\Controller
{
    
  public function actionSite()
  {
    $model = new SiteForm();
    
    
    if($model->load(\Yii::$app->request->post()) && $model->save()){
      return $this->redirect(["system/site"]);
    }
      
    
    return $this->render('site',['model'=>$model]);
  } 
  
  public function actionMail()
  {
    $model = new MailForm();
    if($model->load(\Yii::$app->request->post()) && $model->save()){
      return $this->redirect(["system/mail"]);
    }
    return $this->render('mail',['model'=>$model]);
  }
  

}

?>