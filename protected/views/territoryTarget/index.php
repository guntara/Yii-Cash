<?php
$this->breadcrumbs=array(
	'Territory Targets',
);

$this->menu=array(
	array('label'=>'Create TerritoryTarget','url'=>array('create')),
	array('label'=>'Manage TerritoryTarget','url'=>array('admin')),
);
?>

<h1>Territory Targets</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
