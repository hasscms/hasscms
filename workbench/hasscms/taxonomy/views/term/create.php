<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\taxonomy\models\TaxonomyTerm */

$this->title = 'Create Taxonomy Term';
$this->params['breadcrumbs'][] = ['label' => 'Taxonomy Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxonomy-term-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
