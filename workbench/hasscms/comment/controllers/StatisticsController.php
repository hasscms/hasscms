<?php

namespace hasscms\comment\controllers;

use Yii;
use hasscms\comment\models\CommentStatistics;
use hasscms\comment\models\CommentStatisticsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatisticsController implements the CRUD actions for CommentStatistics model.
 */
class StatisticsController extends Controller
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
     * Lists all CommentStatistics models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentStatisticsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CommentStatistics model.
     * @param integer $entity_id
     * @param string $entity_type
     * @param string $slug
     * @return mixed
     */
    public function actionView($entity_id, $entity_type, $slug)
    {
        return $this->render('view', [
            'model' => $this->findModel($entity_id, $entity_type, $slug),
        ]);
    }

    /**
     * Creates a new CommentStatistics model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CommentStatistics();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'entity_id' => $model->entity_id, 'entity_type' => $model->entity_type, 'slug' => $model->slug]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CommentStatistics model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $entity_id
     * @param string $entity_type
     * @param string $slug
     * @return mixed
     */
    public function actionUpdate($entity_id, $entity_type, $slug)
    {
        $model = $this->findModel($entity_id, $entity_type, $slug);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'entity_id' => $model->entity_id, 'entity_type' => $model->entity_type, 'slug' => $model->slug]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CommentStatistics model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $entity_id
     * @param string $entity_type
     * @param string $slug
     * @return mixed
     */
    public function actionDelete($entity_id, $entity_type, $slug)
    {
        $this->findModel($entity_id, $entity_type, $slug)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CommentStatistics model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $entity_id
     * @param string $entity_type
     * @param string $slug
     * @return CommentStatistics the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($entity_id, $entity_type, $slug)
    {
        if (($model = CommentStatistics::findOne(['entity_id' => $entity_id, 'entity_type' => $entity_type, 'slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
