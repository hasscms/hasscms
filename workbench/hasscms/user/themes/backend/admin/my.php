<?php
use  yii\bootstrap\Tabs;

$this->title = "我的账号";
$this->params['breadcrumbs'][] = [
  'label' => Yii::t('user', 'Users'),
  'url' => [
    'index'
  ]
];
$this->params['breadcrumbs'][] = $this->title;

echo Tabs::widget([
  'encodeLabels' => false,
  'options' => [
    //'class' => 'nav-tabs-custom',
    ],
  'items' => [
    [
      'label' => '基本信息',
      'content' => $this->render('/default/account',['user'=>$user]),
      'active' => true
      ],
    [
      'label' => '个人资料',
      'content' =>  $this->render('/default/profile',['profile'=>$user->profile]),
      'headerOptions' => [],
      'options' => ['id' => 'myveryownID'],
      ]
    ],
  ]);
?>