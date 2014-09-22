<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\taxonomy\models\TaxonomySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Taxonomies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxonomy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Taxonomy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type',
            'name',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn',
'buttons'=>['view'=>function ($url, $model) {
  return Html::tag('li',Html::a('<span class="fa fa-eye fa-lg"></span> '.Yii::t('yii', 'View'), ['term/index','TaxonomyTermSearch[type]'=>$model->type], [
    'title' => Yii::t('yii', 'View'),
    'data-pjax' => '0',
    ]));
}
]
],
        ],
    ]); ?>

</div>
