<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\adminUi\widget\Collapse;
use kartik\widgets\SwitchInput;
use kartik\widgets\DateTimePicker;
use hasscms\field\fields\BaseField;

/* @var $this yii\web\View */
/* @var $model hasscms\node\models\NodeAttached */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="node-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
		<div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255])?>
            
            <?php
            foreach ($model->attachFields() as $field) {
                $class = $model->fieldWidgets[$field]["class"];
                $config = $model->fieldWidgets[$field]["config"];
                
                
                if ($config["widgetType"] == BaseField::WIDGET_TYPE_FIELD) {
                    echo $form->field($model, $field)->widget($class, $config);
                } else {
                    echo $class::widget(array_merge($config, [
                        "model" => $model,
                        "attribute" => $field,
                        "form"=>$form
                    ]));
                }
            }
            ?>
            
            <?php echo  Html::activeHiddenInput($model, 'type')?>
            <div class="form-group col-md-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
            </div>

		</div>
		<div class="col-md-4">
            <?php
            echo Collapse::widget([
                'items' => [
                    '编著信息' => [
                        'content' => $form->field($model, 'created')->widget(DateTimePicker::className(), [
                            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd hh:ii:ss'
                            ]
                        ]) . $form->field($model, 'status')->widget(SwitchInput::className(), [
                            'pluginOptions' => [
                                'onText' => '是',
                                'offText' => '否'
                            ],
                            'inlineLabel' => false
                        ]),
                        'contentOptions' => [
                            'class' => 'in'
                        ]
                    ],
                    '推荐信息' => [
                        'content' => $form->field($model, 'promote')->widget(SwitchInput::className(), [
                            'pluginOptions' => [
                                'onText' => '是',
                                'offText' => '否'
                            ],
                            'inlineLabel' => false
                        ]) . $form->field($model, 'sticky')->widget(SwitchInput::className(), [
                            'pluginOptions' => [
                                'onText' => '是',
                                'offText' => '否'
                            ],
                            'inlineLabel' => false
                        ])
                    ]
                ]
            ]);
            ?>

        </div>

	</div>

    <?php ActiveForm::end(); ?>

</div>
