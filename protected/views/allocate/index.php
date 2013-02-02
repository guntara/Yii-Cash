<?php
/* @var $this AllocateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Allocates',
);

$this->menu=array(
	array('label'=>'Create Allocate', 'url'=>array('create')),
	array('label'=>'Manage Allocate', 'url'=>array('admin')),
);
?>

<h1>Allocates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
