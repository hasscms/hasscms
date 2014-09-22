<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\node\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Node Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Node Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type',
            'name',
            'description:ntext',

            [
            		'class' => 'yii\grid\ActionColumn',
            		"buttons"=>[ 'view' => function ($url, $model) {
            return Html::tag('li',Html::a('<span class="fa fa-eye fa-lg"></span> 管理字段', Url::to(["/field/default/index","collection"=>"node","name"=>$model->type]), [
                    'title' => Yii::t('yii', '管理字段'),
                    'data-pjax' => '0',
                ]));
         }]
    ],
        ],
    ]); ?>

</div>
