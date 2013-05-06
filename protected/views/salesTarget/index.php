<?php
$this->breadcrumbs=array(
	'Sales Targets',
);

$this->menu=array(
	array('label'=>'Create SalesTarget','url'=>array('create')),
	array('label'=>'Manage SalesTarget','url'=>array('admin')),
);
?>

<h1>Sales Targets</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
