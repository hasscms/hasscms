<?php

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 */
$this->title = Yii::t('user', 'Update {modelClass}: ', [
  'modelClass' => 'User'
]) . ' ' . $user->id;
$this->params['breadcrumbs'][] = [
  'label' => Yii::t('user', 'Users'),
  'url' => [
    'index'
  ]
];
$this->params['breadcrumbs'][] = [
  'label' => $user->id,
  'url' => [
    'view',
    'id' => $user->id
  ]
];
$this->params['breadcrumbs'][] = Yii::t('user', 'Update');

echo $this->render('_form', [
  'user' => $user,
  'profile' => $profile
], $this->context);

