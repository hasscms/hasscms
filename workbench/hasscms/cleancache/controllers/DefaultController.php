<?php
namespace hasscms\cleancache\controllers;


use hasscms\cleancache\models\CleanCache;
use hasscms\cleancache\Config;
class DefaultController extends \Yii\web\Controller
{

  public function actionIndex()
  {
    $data = \Yii::$app->request->post();

    if(isset($data['cache']))
    {
     foreach ($data['cache'] as $key =>$value)
     {
       \Yii::$app->get("cache")->delete($key);
     }
      return $this->render('clearCache');
    }

    return $this->render('index',['model'=> new CleanCache(Config::$items)]);
  }

  public function actionFlush(){
    \Yii::$app->get('cache')-> flush();
    return $this->render('clearCache');
  }

}

?>