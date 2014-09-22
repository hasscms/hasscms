<?php
namespace hasscms\user\controllers;

use Yii;
use yii\web\Response;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends \amnah\yii2\user\controllers\AdminController
{

  public function actionMy()
  {
    $user = Yii::$app->user->identity;
    $profile = $user->profile;
    
    $profilePost = $profile->load(Yii::$app->request->post());
    $accountPost = $user->load(Yii::$app->request->post());
    
    // validate for normal request
    if ($profilePost && $profile->validate() && Yii::$app->request->isAjax) {
      $profile->save(false);
      Yii::$app->response->format = Response::FORMAT_JSON;
      return [
        "error" => 0,
        "message" => "Profile updated"
      ];
    }
    
    if ($accountPost && $user->validate() && Yii::$app->request->isAjax) {
      Yii::$app->response->format = Response::FORMAT_JSON;
      $user->save(false);
      return [
        "error" => 0,
        "message" => "account updated"
      ];
    }
    
    return $this->render("my", [
      'user' => $user
    ]);
  }
}
