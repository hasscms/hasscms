<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->type], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->type], [
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
            'type',
            'name',
            'description:ntext',
        ],
    ]) ?>

</div>
