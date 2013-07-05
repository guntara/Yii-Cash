<?php
/* @var $this TerritoryController */
/* @var $model Territory */

$this->breadcrumbs=array(
	'Territories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Territory', 'url'=>array('index')),
	array('label'=>'Manage Territory', 'url'=>array('admin')),
);
?>

<h1>Create Territory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>