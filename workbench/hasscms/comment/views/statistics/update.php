<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentStatistics */

$this->title = 'Update Comment Statistics: ' . ' ' . $model->entity_id;
$this->params['breadcrumbs'][] = ['label' => 'Comment Statistics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->entity_id, 'url' => ['view', 'entity_id' => $model->entity_id, 'entity_type' => $model->entity_type, 'slug' => $model->slug]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comment-statistics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
