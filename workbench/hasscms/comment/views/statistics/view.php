<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentStatistics */

$this->title = $model->entity_id;
$this->params['breadcrumbs'][] = ['label' => 'Comment Statistics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-statistics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'entity_id' => $model->entity_id, 'entity_type' => $model->entity_type, 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'entity_id' => $model->entity_id, 'entity_type' => $model->entity_type, 'slug' => $model->slug], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'entity_id',
            'entity_type',
            'slug',
            'last_comment_id',
            'last_comment_timestamp:datetime',
            'last_comment_name',
            'last_comment_uid',
            'comment_count',
        ],
    ]) ?>

</div>
