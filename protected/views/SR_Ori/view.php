<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'Sales Reports'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SalesReport', 'url'=>array('index')),
	array('label'=>'Create SalesReport', 'url'=>array('create')),
	array('label'=>'Update SalesReport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SalesReport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesReport', 'url'=>array('admin')),
);
?>

<h1>View SalesReport #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_SO',
		'id_DO',
		'id_invoice',
		'posting_date',
		'due_date',
		'customer',
		'quantity',
		'uom',
		'teritory',
		'sales_term',
		'total',
		'status',
		'create_at',
	),
)); ?>
