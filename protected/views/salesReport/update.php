<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'Sales Reports'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SalesReport', 'url'=>array('index')),
	array('label'=>'Create SalesReport', 'url'=>array('create')),
	array('label'=>'View SalesReport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SalesReport', 'url'=>array('admin')),
);
?>

<h1>Update SalesReport <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>