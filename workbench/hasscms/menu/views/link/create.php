<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\menu\models\MenuLink */

$this->title = 'Create Menu Link';
$this->params['breadcrumbs'][] = ['label' => 'Menu Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
