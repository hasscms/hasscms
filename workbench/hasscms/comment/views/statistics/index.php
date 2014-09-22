<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\comment\models\CommentStatisticsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comment Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-statistics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comment Statistics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'entity_id',
            'entity_type',
            'slug',
            'last_comment_id',
            'last_comment_timestamp:datetime',
            // 'last_comment_name',
            // 'last_comment_uid',
            // 'comment_count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
