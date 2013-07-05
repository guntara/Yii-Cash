<?php
/* @var $this TerritoryController */
/* @var $model Territory */

$this->breadcrumbs=array(
	'Territories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Territory', 'url'=>array('index')),
	array('label'=>'Create Territory', 'url'=>array('create')),
	array('label'=>'View Territory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Territory', 'url'=>array('admin')),
);
?>

<h1>Update Territory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>