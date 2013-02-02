<?php
/* @var $this AllocateController */
/* @var $model Allocate */

$this->breadcrumbs=array(
	'Allocates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Allocate', 'url'=>array('index')),
	array('label'=>'Create Allocate', 'url'=>array('create')),
	array('label'=>'View Allocate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Allocate', 'url'=>array('admin')),
);
?>

<h1>Update Allocate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>