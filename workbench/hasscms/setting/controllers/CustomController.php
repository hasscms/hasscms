<?php
namespace hasscms\setting\controllers;

class CustomController extends \yii\web\Controller
{
  
  public function actionIndex(){
    return $this->render('index');
  }
  
  public function actionFields(){
    return $this->render('fields');
  }
  
  
  public function actionCreate(){
    return $this->render('create');
  }
  
  public function actionUpate(){
    return $this->render('update');
  }
}

?>