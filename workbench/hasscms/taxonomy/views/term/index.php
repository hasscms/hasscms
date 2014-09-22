<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel hasscms\taxonomy\models\TaxonomyTermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Taxonomy Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxonomy-term-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Taxonomy Term', ['create','taxonomy'=>$searchModel->type], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type',
            'pid',
            'name',
            'description:ntext',
            // 'slug',
            // 'weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
