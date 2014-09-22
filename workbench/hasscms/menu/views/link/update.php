<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hasscms\menu\models\MenuLink */

$this->title = 'Update Menu Link: ' . ' ' . $model->mlid;
$this->params['breadcrumbs'][] = ['label' => 'Menu Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mlid, 'url' => ['view', 'id' => $model->mlid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
