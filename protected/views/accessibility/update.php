<?php
$this->breadcrumbs=array(
	'Accessibilities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Accessibility','url'=>array('index')),
	array('label'=>'Create Accessibility','url'=>array('create')),
	array('label'=>'View Accessibility','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Accessibility','url'=>array('admin')),
);
?>

<h1>Update Accessibility <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>