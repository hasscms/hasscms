<?php

use yii\helpers\Html;
use hasscms\base\ui\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\User $user
 */

$this->title = Yii::t('user', 'Account');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pad">
    <?php $form = ActiveForm::begin([
        'id' => 'account-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($user, 'currentPassword')->passwordInput() ?>

    <hr/>

    <?php if (Yii::$app->getModule("user")->useEmail): ?>
        <?= $form->field($user, 'email') ?>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">

            <?php if ($user->new_email !== null): ?>

                <p class="small"><?= Yii::t('user', "Pending email confirmation: [ {newEmail} ]", ["newEmail" => $user->new_email]) ?></p>
                <p class="small">
                    <?= Html::a(Yii::t("user", "Resend"), ["/user/resend-change"]) ?> or <?= Html::a(Yii::t("user", "Cancel"), ["/user/cancel"]) ?>
                </p>

            <?php elseif (Yii::$app->getModule("user")->emailConfirmation): ?>

                <p class="small"><?= Yii::t('user', 'Changing your email requires email confirmation') ?></p>

            <?php endif; ?>

        </div>
    </div>

    <?php if (Yii::$app->getModule("user")->useUsername): ?>
        <?= $form->field($user, 'username') ?>
    <?php endif; ?>

    <?= $form->field($user, 'newPassword')->passwordInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>