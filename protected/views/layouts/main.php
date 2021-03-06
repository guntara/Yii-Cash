<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/gridview/styles.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
	<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse', // null or 'inverse'
	'brand'=>'SAP',
	'brandUrl'=>'#',
	'collapse'=>true, // requires bootstrap-responsive.css
	'items'=>array(
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'items'=>array(
				array('label'=>'Home', 'icon'=>'home', 'url'=>array('/site/index')),
				array('label'=>'Bank Receipt', 'icon'=>'book', 'url'=>array('/bankReceipt/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Sales Report', 'icon'=>'book', 'url'=>array('/salesReport/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Report', 'icon'=>'book', 'url'=>array('/bankReceipt/cash'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Tools', 'icon'=>'cog', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>'Accessibility', 'url'=>array('/accessibility/admin'), 'visible'=>Yii::app()->getModule('user')->isAdmin()),
					array('label'=>"Profile", 'url'=>Yii::app()->getModule('user')->profileUrl, 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'CSV Importer', 'url'=>array('/importcsv'), 'visible'=>Yii::app()->getModule('user')->isAdmin()),
					)),
				array('label'=>'Login', 'icon'=>'cog', 'url'=>Yii::app()->User->loginUrl, 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				),
			),
		),
	));

		/*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'User', 'url'=>array('/user'), 'visible'=>Yii::app()->getModule('user')->isAdmin()),
				array('label'=>'CSV Importer', 'url'=>array('/importcsv'), 'visible'=>Yii::app()->getModule('user')->isAdmin()),
				array('label'=>'Bank Receipt', 'url'=>array('/bankReceipt/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Sales Report', 'url'=>array('/salesReport/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Report', 'url'=>array('/bankReceipt/cash'), 'visible'=>!Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
			),
		));*/ ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
