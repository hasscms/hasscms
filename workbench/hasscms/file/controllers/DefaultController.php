<?php

namespace hasscms\file\controllers;

use Yii;
use hasscms\file\models\FileManaged;
use hasscms\file\models\FileManagedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use hasscms\file\actions\UnlinkAction;

use hasscms\file\actions\UploadAction;

use hasscms\file\actions\ConfigAction;
use hasscms\file\actions\FinderAction;

/**
 * DefaultController implements the CRUD actions for FileManaged model.
 */
class DefaultController extends Controller
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
     * @return array
     */
    public function actions()
    {
        return [
            'fileconfig' => [
                'class' => ConfigAction::className()
            ],
            'fileupload' => [
                'class' => UploadAction::className()
                        ],
            'fileunlink' => [
                'class' => UnlinkAction::className()
            ],
            'filefinder' => [
                'class' => FinderAction::className()
            ]
        ];
    }
    
    /**
     * 为了兼容百度编辑器使用action作为动作参数..注意动作名和上面保持一致
     * @see \yii\base\Controller::createAction()
     */
    public function createAction($id)
    {
        if(\Yii::$app->getRequest()->get("action"))
        {
            $id = "file".\Yii::$app->getRequest()->get("action");
        }

        return parent::createAction($id);
    }

    /**
     * Lists all FileManaged models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileManagedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FileManaged model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FileManaged model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileManaged();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->fid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FileManaged model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->fid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FileManaged model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FileManaged model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileManaged the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileManaged::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
