<?php
$this->breadcrumbs=array(
	'Accessibilities',
);

$this->menu=array(
	array('label'=>'Create Accessibility','url'=>array('create')),
	array('label'=>'Manage Accessibility','url'=>array('admin')),
);
?>

<h1>Accessibilities</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
