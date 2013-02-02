<?php
/* @var $this SalesReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sales Reports',
);

$this->menu=array(
	array('label'=>'Create SalesReport', 'url'=>array('create')),
	array('label'=>'Manage SalesReport', 'url'=>array('admin')),
);
?>

<h1>Sales Reports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
