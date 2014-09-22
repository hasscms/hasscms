<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentStatistics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-statistics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entity_id')->textInput() ?>

    <?= $form->field($model, 'entity_type')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'last_comment_id')->textInput() ?>

    <?= $form->field($model, 'last_comment_timestamp')->textInput() ?>

    <?= $form->field($model, 'last_comment_name')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'last_comment_uid')->textInput() ?>

    <?= $form->field($model, 'comment_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
