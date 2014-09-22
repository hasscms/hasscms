<?php

namespace hasscms\file\controllers;

use Yii;
use hasscms\file\models\FileUsage;
use hasscms\file\models\FileUsageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsageController implements the CRUD actions for FileUsage model.
 */
class UsageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FileUsage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileUsageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FileUsage model.
     * @param integer $fid
     * @param string $type
     * @param string $id
     * @return mixed
     */
    public function actionView($fid, $type, $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($fid, $type, $id),
        ]);
    }

    /**
     * Creates a new FileUsage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileUsage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fid' => $model->fid, 'type' => $model->type, 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FileUsage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $fid
     * @param string $type
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($fid, $type, $id)
    {
        $model = $this->findModel($fid, $type, $id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fid' => $model->fid, 'type' => $model->type, 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FileUsage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $fid
     * @param string $type
     * @param string $id
     * @return mixed
     */
    public function actionDelete($fid, $type, $id)
    {
        $this->findModel($fid, $type, $id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FileUsage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $fid
     * @param string $type
     * @param string $id
     * @return FileUsage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fid, $type, $id)
    {
        if (($model = FileUsage::findOne(['fid' => $fid, 'type' => $type, 'id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
