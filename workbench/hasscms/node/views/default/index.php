<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\node\models\NodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Node', ['createfromtype'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nid',
            'type',
            'title',
            'uid',
            'status',
            'created',
            'langcode',
            // 'changed',
           // 'promote',
            // 'sticky',
            // 'default_langcode',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
