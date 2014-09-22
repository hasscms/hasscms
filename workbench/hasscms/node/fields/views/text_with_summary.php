  <?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $form \yii\bootstrap\ActiveForm */
?>
<?php
echo $form->field($model, 'body_value')->widget(\dosamigos\ckeditor\CKEditor::className(), [
    'options' => [
        'rows' => 6
    ],
    "clientOptions" => [
        "filebrowserUploadUrl" => Url::to([
            '/file/default/fileupload',
            "uploadSource" => "ckeditor",
            "fieldName" => 'upload',
            "stroageDirType" => "node"
        ])
    ]
]);
?>
<?= $form->field($model, 'body_summary')->textarea(['rows' => 3])?>

<?= $form->field($model, 'body_format')->dropDownList($model::getFormatList(),['maxlength' => 255])?>

<?php echo  Html::activeHiddenInput($model, 'field_name')?>