<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'Sales Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SalesReport', 'url'=>array('index')),
	array('label'=>'Manage SalesReport', 'url'=>array('admin')),
);
?>

<h1>Create SalesReport</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>