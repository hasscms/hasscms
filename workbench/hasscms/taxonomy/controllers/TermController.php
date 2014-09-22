<?php

namespace hasscms\taxonomy\Controllers;

use Yii;
use hasscms\taxonomy\models\TaxonomyTerm;
use hasscms\taxonomy\models\TaxonomyTermSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * TermController implements the CRUD actions for TaxonomyTerm model.
 */
class TermController extends Controller
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
     * Lists all TaxonomyTerm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaxonomyTermSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * ajax 请求远程数据
     * @param unknown $id     */
    public function actionAjax($taxonomy,$id)
    {
      
      Yii::$app->response->format = Response::FORMAT_JSON;
      // validate for ajax request
      if (Yii::$app->request->isAjax) {

        $data = Yii::$app->get("taxonomy")->getTaxonomy($taxonomy);

        if(isset($data[$id]))
        {
          $result = ['error'=>0,'data'=>$data[$id]];
        }
        else{
          $result = ['error'=>1,'data'=>null];
        }
      }else{
        $result = ['error'=>1,'data'=>null];
      }
      
      return $result;
    }
    /**
     * Displays a single TaxonomyTerm model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaxonomyTerm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($taxonomy)
    {
        $model = new TaxonomyTerm(['type'=>$taxonomy,'weight'=>0]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaxonomyTerm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaxonomyTerm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaxonomyTerm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TaxonomyTerm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaxonomyTerm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
