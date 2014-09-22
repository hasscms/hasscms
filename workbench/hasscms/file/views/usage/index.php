<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\file\models\FileUsageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'File Usages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-usage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create File Usage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fid',
            'type',
            'id',
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
