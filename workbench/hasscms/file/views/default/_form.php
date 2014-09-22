<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileManaged */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-managed-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'uri')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'filemime')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'filesize')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'changed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
