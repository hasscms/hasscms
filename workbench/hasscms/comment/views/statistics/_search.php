<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentStatisticsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-statistics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'entity_id') ?>

    <?= $form->field($model, 'entity_type') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'last_comment_id') ?>

    <?= $form->field($model, 'last_comment_timestamp') ?>

    <?php // echo $form->field($model, 'last_comment_name') ?>

    <?php // echo $form->field($model, 'last_comment_uid') ?>

    <?php // echo $form->field($model, 'comment_count') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
