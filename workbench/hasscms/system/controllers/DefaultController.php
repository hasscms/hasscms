<?php
namespace hasscms\system\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInfo()
    {
        $this->layout = "@backend/themes/adminui/layouts/nobox";
        return $this->render('info');
    }
}
