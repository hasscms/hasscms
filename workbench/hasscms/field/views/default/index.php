<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\node\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理字段';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-fields-index">

    <p>
        <?= Html::a('添加字段', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'label',
            'weight',
            'widget',
        		"widgetConfig",
        		[
    'class'=>'kartik\grid\BooleanColumn',
    'attribute'=>'enabled',
    'vAlign'=>'middle',
],

            [
            		'class' => 'yii\grid\ActionColumn',

    ],
        ],
    ]); ?>
</div>