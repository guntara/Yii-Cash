<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'Payment Status'=>array("paymentstatus","id"=>1),
	'Manage',
);

$this->menu=array(
	array('label'=>'Manage SalesReport', 'url'=>array('admin')),
	array('label'=>'Late Payment (>7 Days)', 'url'=>array("paymentstatus","id"=>1)),
	array('label'=>'Late Payment (<7 Days)', 'url'=>array("paymentstatus","id"=>2)),
	array('label'=>'Upcoming Payment (7 Days)', 'url'=>array("paymentstatus","id"=>3)),
);

$id = $_GET['id'];
$htmlColor = '';
if($id==1) { $htmlColor = '#ff0000'; }
if($id==2) { $htmlColor = '#dc2cac'; }
if($id==3) { $htmlColor = '#0000ff'; }
?>

<h1>Manage Payment Status Reports</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-status-grid',
	'dataProvider'=>SalesReport::model()->paymentstatus($id),
	'columns'=>array(
		array(
			'name'=>'id_SO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'65px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'id_DO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'65px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'id_invoice',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'65px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'due_date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'75px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name' => 'temp',
			'header'=>'Payment',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'value'=> array($this,'agetime'),
			'htmlOptions'=>array('style'=>'text-align: center; color:'.$htmlColor),
		),
		'customer',
		array(
			'name'=>'quantity',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'60px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'uom',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'40px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'territory',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'90px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'total',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'90px'),
			'htmlOptions'=>array('style'=>'text-align: right;'),

		),
	),
)); ?>
