<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hasscms\base\ui\widgets\Nav;

/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
$this->beginPage();

if (! isset($this->params['pagelabel'])) {
    $this->params['pagelabel'] = "";
}
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>" />
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<title><?= Html::encode($this->title) ?></title>
	<?= Html::csrfMetaTags()?>
    <?php $this->head()?>
</head>
<body class="skin-blue">
<?php
$this->beginBody();
Header::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'tag' => 'header',
        'class' => 'header'
    ]
]);

NavBar::begin([
    'options' => [
        'class' => 'navbar-static-top'
    ]
]);

$menuItems = [];
if (Yii::$app->user->isGuest) {
    $menuItems[] = [
        'content' => NavBarUser::Widget(),
        'options' => [
            'class' => ''
        ]
    ];
} else {
    $menuItems = [
        [
            'label' => '前台',
            'url' =>Yii::$app->get("urlManagerFrontend")->createUrl("site/index")
        ],
        [
            'label' => 'Demo',
            'url' => [
                '/adminuidemo'
            ],
            'linkOptions' => []
        ],
        [
            'label' => 'Demo2',
            'url' => 'http://127.0.0.1/hasscms/common/hasscms/adminui/assets/',
            'linkOptions' => [
                'traget' => "_blank"
            ]
        ],
        [
            'content' => NavBarUser::Widget(),
            'options' => [
                'class' => 'dropdown user user-menu'
            ]
        ]
    ];
}
;

echo Nav::widget([
    'options' => [
        'class' => 'nav navbar-nav'
    ],
    'items' => $menuItems
]);
NavBar::end();
Header::end();
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="left-side sidebar-offcanvas">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
                    <?php
                    echo NavBarUser::Widget([
                        'type' => 'sidebar'
                    ]);

                    $menuitems = [
                        [
                            'label' => '配置',
                            'linkOptions' => [
                                'class' => 'fa fa-cogs'
                            ],
                            'items' => [
                                [
                                    'label' => '系统配置',
                                    'url' => [
                                        '/setting/system/site'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],
                                [
                                'label' => '自定义配置',
                                'url' => [
                                    '/setting/custom/index'
                                ],
                                'linkOptions' => [
                                    'class' => 'fa fa-angle-double-right'
                                ]
                                ],
                                [
                                'label' => '多语言配置',
                                'url' => [
                                    '/translations/default/index'
                                ],
                                'linkOptions' => [
                                    'class' => 'fa fa-angle-double-right'
                                ]
                                ],
                            ]
                        ],
                        [
                            'label' => '用户',
                            'linkOptions' => [
                                'class' => 'fa fa-users'
                            ],
                            'activeWithOthers' => [
                                "/user/admin/*",
                                "/rbac/role/*",
                                "/rbac/permission/*",
                                "/rbac/route/*",
                                "/rbac/rule/*",
                                "/rbac/menu/*"
                            ],
                            'items' => [
                                [
                                    'label' => '用户管理',
                                    'url' => [
                                        '/user/admin/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ],
                                    'activeWithParent' => false
                                ],
                                [
                                    'label' => '我的账号',
                                    'url' => [
                                        '/user/admin/my'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ],
                                    'activeWithParent' => false
                                ],
                                [
                                    'label' => '权限管理',
                                    'url' => [
                                        '/rbac/assigment/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'label' => '内容',
                            'linkOptions' => [
                                'class' => 'fa fa-file'
                            ],
                            'activeWithOthers' => [],
                            'items' => [
                                [
                                    'label' => '内容',
                                    'url' => [
                                        '/node/default/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],
                                [
                                    'label' => '文件',
                                    'url' => [
                                        '/file/default/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],
                                [
                                    'label' => '评论',
                                    'url' => [
                                        '/comment/default/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ]
                            ]
                        ]
                        ,
                        [
                            'label' => '结构',
                            'linkOptions' => [
                                'class' => 'fa fa-sitemap'
                            ],
                            'activeWithOthers' => [
                                "/taxonomy/term/*",
                                "/menu/link/*"
                            ],
                            'items' => [
                                [
                                    'label' => '分类',
                                    'url' => [
                                        '/taxonomy/default/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],
                                [
                                    'label' => '菜单',
                                    'url' => [
                                        '/menu/default/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],
                                [
                                    'label' => '内容类型',
                                    'url' => [
                                        '/node/type/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],

                                [
                                    'label' => '评论类型',
                                    'url' => [
                                        '/comment/type/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'label' => '工具',
                            'linkOptions' => [
                                'class' => 'fa fa-gavel'
                            ],
                            'items' => [
                                [
                                    'label' => '清理缓存',
                                    'url' => [
                                        '/cleancache/default/index'
                                    ],
                                    'linkOptions' => [
                                        'class' => 'fa fa-angle-double-right'
                                    ]
                                ],
                                [
                                'label' => '系统信息',
                                'url' => [
                                    '/system/default/info'
                                ],
                                'linkOptions' => [
                                    'class' => 'fa fa-angle-double-right'
                                ]
                                ]
                            ]
                        ]
                    ];

                    if (isset($this->params['urls'])) {
                        $menuitems = $this->params['urls'];
                    }
                    echo Nav::widget([
                        'activateParents' => true,
                        'options' => [
                            'class' => 'sidebar-menu'
                        ],
                        'items' => $menuitems
                    ]);
                    ?>
                </section>
		</aside>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
                    <?php echo $this->title;?>
                    <small>
                        <?php
                        if ($this->params['pagelabel']) {
                            echo $this->params['pagelabel'];
                        } else {
                            ?>
                        Control panel
                        <?php } ?>
                    </small>
				</h1>
                <?php
                echo Breadcrumbs::widget([
                    'tag' => 'ol',
                    'options' => [
                        'class' => 'breadcrumb'
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                ])?>
            </section>

			<!-- Main content -->
			<section class="content">
              <?php
            echo $content;
            ?>
            </section>
			<!-- /.content -->
		</aside>
		<!-- /.right-side -->
	</div>
	<!-- ./wrapper -->

    <?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
