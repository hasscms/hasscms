<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\menu\models\MenuLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Menu Link', ['create','menu'=>$searchModel->type], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type',
            'pid',
            'label',
            'encode',
            // 'options:ntext',
            // 'url:url',
            // 'route_name',
            // 'route_parameters:ntext',
            // 'linkOptions:ntext',
            // 'visible',
            // 'weight',
            // 'data:ntext',
            // 'active_with_others:ntext',
            // 'active_with_parent',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
