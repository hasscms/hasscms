<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\file\models\FileManagedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'File Manageds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-managed-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create File Managed', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fid',
            'uid',
            'filename',
            'uri',
            'filemime',
            // 'filesize',
            // 'status',
            // 'created',
            // 'changed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
