<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \common\models\LoginForm $model
 */
$this->title = 'Sign In';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-box" id="login-box">
    <div class="header"><?= Html::encode($this->title) ?></div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="body bg-gray">
            <div class="form-group">
                <?= $form->field($model, 'username') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>          
            <div class="form-group">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
        </div>
        <div class="footer">                                                               
            <?= Html::submitButton('Sign me in', ['class' => 'btn bg-olive btn-block', 'name' => 'login-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
