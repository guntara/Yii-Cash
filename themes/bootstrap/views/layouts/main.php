<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/gridview/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php //Yii::app()->bootstrap->register(); ?>
</head>

<body>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse', // null or 'inverse'
	'brand'=>'GPB',
	'brandUrl'=>'#',
	'collapse'=>true, // requires bootstrap-responsive.css
	'items'=>array(
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'items'=>array(
				array('label'=>'Home', 'icon'=>'home', 'url'=>array('/site/index')),
				array('label'=>'Bank', 'icon'=>'book', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>'Bank Receipt', 'url'=>array('/bankReceipt/admin'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Bank Report', 'url'=>array('/bankReceipt/cash'), 'visible'=>!Yii::app()->user->isGuest),
					)),
				array('label'=>'Sales', 'icon'=>'book', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>'My Sales Report', 'url'=>array('/salesTarget/myreport'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Sales Monthly Target', 'url'=>array('/salesTarget/motarget'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Sales Target', 'url'=>array('/salesTarget/admin'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Sales Report', 'url'=>array('/salesReport/admin'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Manage Territory', 'url'=>array('/territory/admin'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Territory Target', 'url'=>array('/territoryTarget/admin'), 'visible'=>!Yii::app()->user->isGuest),
					)),
				array('label'=>'Report', 'icon'=>'book', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>'Bank Report'),
					array('label'=>'Bank Receipt', 'url'=>array('/bankReceipt/cash'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Cash In', 'url'=>array('/salesReport/cashin'), 'visible'=>!Yii::app()->user->isGuest),
					'---',
					array('label'=>'AR Report'),
					array('label'=>'Daily Report', 'url'=>array('/salesReport/dailyar'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Weekly Report', 'url'=>array('/salesReport/weeklyar'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'DN Weekly Report', 'url'=>array('/salesReport/weeklydn'), 'visible'=>!Yii::app()->user->isGuest),
					'---',
					array('label'=>'Sales Report'),
					array('label'=>'Daily Sales Report', 'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Territory Sales Report', 'url'=>array('/territoryTarget/motarget'), 'visible'=>!Yii::app()->user->isGuest),
					)),
				array('label'=>'Tools', 'icon'=>'cog', 'url'=>'#', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
					array('label'=>"Profile", 'url'=>Yii::app()->getModule('user')->profileUrl, 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Accessibility', 'url'=>array('/accessibility/admin'), 'visible'=>Yii::app()->getModule('user')->isAdmin()),
					array('label'=>'CSV Importer', 'url'=>array('/importcsv'), 'visible'=>Yii::app()->getModule('user')->isAdmin()),
					)),
				array('label'=>'Login', 'icon'=>'cog', 'url'=>Yii::app()->User->loginUrl, 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				),
			),
		),
	));
?>
<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<br/>
		Copyright &copy; <?php echo date('Y'); ?>
		Design and Customize by Mr. Jagiring.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
