<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'Cash In Report'=>array('cashin'),
	'Report',
);

$this->menu=array(
	array('label'=>'Cash Report', 'url'=>array('/bankReceipt/cash')),
	array('label'=>'Manage SalesReport', 'url'=>array('admin')),
);
?>

<h1>Actual Cash In Reports</h1>

<?php
$tabs = array(
array('id' => 'tab0', 'label' => date("F Y",strtotime("-2 Months")), 'content' => $this->renderPartial('_formCash', array('month' => '2', 'model' => $model), true)),
array('id' => 'tab1', 'label' => date("F Y",strtotime("-1 Months")), 'content' => $this->renderPartial('_formCash', array('month' => '1', 'model' => $model), true)),
array('id' => 'tab2', 'label' => date("F Y"), 'content' => $this->renderPartial('_formCash', array('month' => '0', 'model' => $model), true), 'active' => true),
array('id' => 'tab3', 'label' => date("F Y",strtotime("+1 Months")), 'content' => $this->renderPartial('_formCash', array('month' => '-1', 'model' => $model), true)),
array('id' => 'tab4', 'label' => date("F Y",strtotime("+2 Months")), 'content' => $this->renderPartial('_formCash', array('month' => '-2', 'model' => $model), true)),
);

$this->widget('bootstrap.widgets.TbTabs', array(
	'id' => 'mytabs',
	'type' => 'tabs',
	'tabs' => $tabs,
));
?>
