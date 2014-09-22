<?php

use yii\helpers\Html;
use hasscms\base\ui\widgets\ActiveForm;
use hasscms\base\ui\widgets\Editor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $baseModel hasscms\comment\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">
    <?php $form = ActiveForm::begin([
        'id' => 'comment-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [

            'labelOptions' => ["action"=>Url::toRoute("comment/comment/create")],
        ],
    ]); ?>

    <?= $form->field($baseModel, 'comment_type_slug',['options'=>['class'=>"hide"]])->hiddenInput() ?>

    <?= $form->field($baseModel, 'pid',['options'=>['class'=>"hide"]])->hiddenInput() ?>

    <?= $form->field($baseModel, 'entity_id',['options'=>['class'=>"hide"]])->hiddenInput() ?>

    <?= $form->field($baseModel, 'entity_type',['options'=>['class'=>"hide"]])->hiddenInput() ?>

    <?= $form->field($baseModel, 'slug',['options'=>['class'=>"hide"]])->hiddenInput() ?>

   <?= $form->field($baseModel, 'name')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($baseModel, 'mail')->textInput(['maxlength' => 254]) ?>

    <?= $form->field($baseModel, 'homepage')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($baseModel, 'hostname')->textInput(['maxlength' => 128]) ?>
    
    <?php
    if ($this->context->showSubject == true)
    {
        echo $form->field($baseModel, 'subject')->textInput(['maxlength' => 64]);
    }
    else 
    {
        echo $form->field($baseModel, 'subject')->hiddenInput();
    }
    ?>

    <?php 
    echo Editor::widget([
        "form"=>$form,
        "model"=>$baseModel,
        "attribute"=>"comment_body",
        "config"=>$this->context->editor['config'],
        "editorType"=>$this->context->editor['type'],
        "options"=>$this->context->editor['options'],
    ])
    ?>

    <div class="form-group">
        <?= Html::submitButton($baseModel->isNewRecord ? 'Create' : 'Update', ['class' => $baseModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>