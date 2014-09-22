<?php
use yii\helpers\Html;
use hasscms\base\ui\widgets\ActiveForm;

/**
 *
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pad">

    <?php
    
$form = ActiveForm::begin([
      'id' => 'profile-form',
      'options' => [
        'class' => 'form-horizontal'
      ],
      'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => [
          'class' => 'col-lg-2 control-label'
        ]
      ]
    ]);
    ?>

    <?= $form->field($profile, 'full_name')?>

    <div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-primary'])?>
        </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>