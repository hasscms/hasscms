<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 * @var $this \yii\web\View
 */
use hasscms\user\models\User;
use hasscms\system\helpers\SystemInfo;

$this->title = Yii::t('backend', 'System Information');
?>
<div id="system-information-index">
	<div class="row connectedSortable">

		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-hdd-o"></i>
					<h3 class="box-title"><?= Yii::t('backend', 'Operating System') ?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<dl class="dl-horizontal">
						<dt><?= Yii::t('backend', 'OS Type') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->osType ?></dd>
						<dt><?= Yii::t('backend', 'OS Name') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->osName ?></dd>
						<dt><?= Yii::t('backend', 'OS Version') ?></dt>
						<dd><?= SystemInfo::getOsVersion() ?></dd>
						<dt><?= Yii::t('backend', 'FileSystem Type') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->fileSystemType ?></dd>
						<dt><?= Yii::t('backend', 'Processor Architecture') ?></dt>
						<dd><?= SystemInfo::getArchitecture() ?></dd>

					</dl>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-hdd-o"></i>
					<h3 class="box-title"><?= Yii::t('backend', 'Network') ?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<dl class="dl-horizontal">
						<dt><?= Yii::t('backend', 'Hostname') ?></dt>
						<dd><?= SystemInfo::getHostname() ?></dd>

						<dt><?= Yii::t('backend', 'Internal IP') ?></dt>
						<dd><?= SystemInfo::getServerIP() ?></dd>

						<dt><?= Yii::t('backend', 'External IP') ?></dt>
						<dd><?= SystemInfo::getExternalIP() ?></dd>

						<dt><?= Yii::t('backend', 'Remote Port') ?></dt>
						<dd><?= $_SERVER['REMOTE_PORT'] ?></dd>

						<dt><?= Yii::t('backend', 'Server Port') ?></dt>
						<dd><?= $_SERVER['SERVER_PORT'] ?></dd>

					</dl>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
				<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-hdd-o"></i>
					<h3 class="box-title"><?= Yii::t('backend', 'PHPINFO') ?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<dl class="dl-horizontal">
						<dt><?= Yii::t('backend', 'max_execution_time') ?></dt>
						<dd><?= ini_get('max_execution_time') ?></dd>

						<dt><?= Yii::t('backend', 'memory_limit') ?></dt>
						<dd><?= ini_get('memory_limit') ?></dd>

						<dt><?= Yii::t('backend', 'upload_max_filesize') ?></dt>
						<dd><?= ini_get('upload_max_filesize') ?></dd>

						<dt><?= Yii::t('backend', 'post_max_size') ?></dt>
						<dd><?= ini_get('post_max_size') ?></dd>

						<dt><?= Yii::t('backend', 'max_file_uploads ') ?></dt>
						<dd><?=  ini_get('max_file_uploads') ?></dd>
					</dl>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-hdd-o"></i>
					<h3 class="box-title"><?= Yii::t('backend', 'Software') ?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<dl class="dl-horizontal">
						<dt><?= Yii::t('backend', 'Web Server') ?></dt>
						<dd><?= SystemInfo::getServerSoftware() ?></dd>

						<dt><?= Yii::t('backend', 'phpAccelerator') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->phpAccelerator->name ?></dd>


						<dt><?= Yii::t('backend', 'PHP Version') ?></dt>
						<dd><?= SystemInfo::getPhpVersion() ?></dd>

						<dt><?= Yii::t('backend', 'DB Type') ?></dt>
						<dd><?= SystemInfo::getDbType(Yii::$app->db->pdo) ?></dd>

						<dt><?= Yii::t('backend', 'DB Version') ?></dt>
						<dd><?= SystemInfo::getDbVersion(Yii::$app->db->pdo) ?></dd>

					</dl>
				</div>
				<!-- /.box-body -->
			</div>
		</div>

		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-hdd-o"></i>
					<h3 class="box-title"><?= Yii::t('backend', 'Other') ?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<dl class="dl-horizontal">
						<dt><?= Yii::t('backend', 'CPU Type') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->cpuType ?></dd>
						<dt><?= Yii::t('backend', 'CPU Count') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->cpuCount ?></dd>
						<dt><?= Yii::t('backend', 'CPU Speed') ?></dt>
						<dd><?= SystemInfo::getSystemInfo()->cpuSpeed ?></dd>
						<dt><?= Yii::t('backend', 'Total memory') ?></dt>
						<dd><?= Yii::$app->formatter->asSize(SystemInfo::getSystemInfo()->memorySize) ?></dd>
						<dt><?= Yii::t('backend', 'Load average') ?></dt>
						<dd><?=  SystemInfo::getLoadAverage(5) ?></dd>
					</dl>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>
                        <?= User::find()->count()?>
                    </h3>
					<p>
                        <?= Yii::t('backend', 'User Registrations')?>
                    </p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="<?= Yii::$app->urlManager->createUrl(['/user/index']) ?>"
					class="small-box-footer">
                    <?= Yii::t('backend', 'More info') ?> <i
						class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-6 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>1000</h3>
					<p>
                        <?= Yii::t('backend', 'Files in storage')?>
                    </p>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
				<a
					href="<?= Yii::$app->urlManager->createUrl(['/file/default/index']) ?>"
					class="small-box-footer">
                    <?= Yii::t('backend', 'More info') ?> <i
						class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<!-- ./col -->
	</div>

</div>