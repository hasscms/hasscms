<?php

namespace hasscms\field\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;
use hasscms\field\models\FieldForGrid;
use hasscms\field\models\Field;
class DefaultController extends Controller
{
  public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex($collection,$name)
    {
		//默认字段  需注册
    	$allModels[]=new FieldForGrid(["label"=>"标题","weight"=>5,"widget"=>"input","widgetConfig"=>"","enabled"=>true,"default"=>true]);

		//自定义字段
    	$data = Field::findFieldsByType($collection, $name);
		FieldForGrid::loadMultiple($allModels, $data);

    	$dataProvider = new ArrayDataProvider([
    			'allModels' => $allModels,
    	]);

      return $this->render('index',["dataProvider"=>$dataProvider]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionView()
    {
        return $this->render('view');
    }
}
