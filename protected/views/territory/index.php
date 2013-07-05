<?php
/* @var $this TerritoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Territories',
);

$this->menu=array(
	array('label'=>'Create Territory', 'url'=>array('create')),
	array('label'=>'Manage Territory', 'url'=>array('admin')),
);
?>

<h1>Territories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
