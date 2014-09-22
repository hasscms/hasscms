<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cid')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'pid')->textInput() ?>

    <?= $form->field($model, 'entity_id')->textInput() ?>

    <?= $form->field($model, 'entity_type')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'field_name')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'comment_body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => 254]) ?>

    <?= $form->field($model, 'homepage')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'hostname')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'thread')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'changed')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
