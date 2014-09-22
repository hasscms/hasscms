<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\Spinner;

/* @var $this yii\web\View */
/* @var $model hasscms\menu\models\MenuLink */
/* @var $form yii\bootstrap\ActiveForm */
$tree = new \hasscms\base\helper\TreeList([
  'data' => $model->getLinksByMenuSlug(),
  'key' => "mlid",
  'valueKey' => "label"
]);
?>

<div class="menu-link-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">基本设置</h3>
				</div>
				<div class="panel-body">
                    <?= $form->field($model, 'label')->textInput(['maxlength' => 255])?>
                    <?= $form->field($model, 'url')->textInput(['maxlength' => 255])?>
                    <?= $form->field($model, 'route_name')->textInput(['maxlength' => 255])?>
                    <?= $form->field($model, 'route_parameters')->textarea(['rows' => 6])?>
                    <?= $form->field($model, 'pid')->dropDownList($tree->run())?>
                    <?= $form->field($model, 'type',['options'=>['class'=>"hide"]])->hiddenInput(['maxlength' => 32])?>
                    <?= $form->field($model, 'data')->textarea(['rows' => 6])?>
                </div>
              	</div>
              </div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">样式设置</h3>
				</div>
				<div class="panel-body">
                  <?= $form->field($model, 'encode')->dropDownList([0=>"否",1=>"是"])?>
                  <?= $form->field($model, 'visible')->dropDownList([0=>"否",1=>"是"])?><?=$form->field($model, 'weight', ['inputTemplate' => "<div>" . Spinner::widget(['model' => $model,'attribute' => 'weight','clientOptions' => ['step' => 1]]) . "</div>"])?>
                  <?= $form->field($model, 'active_with_others')->textInput()?>
                  <?= $form->field($model, 'active_with_parent')->dropDownList([0=>"否",1=>"是"])?>
                  <?= $form->field($model, 'options')->textInput()?>
                  <?= $form->field($model, 'linkOptions')->textInput()?>

            </div>
        		</div>
        	</div>
        </div>

	<div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
</div>

<?php ActiveForm::end(); ?>

</div>
