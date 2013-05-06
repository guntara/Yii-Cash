<?php
$this->breadcrumbs=array(
	'Sales Targets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SalesTarget','url'=>array('index')),
	array('label'=>'Create SalesTarget','url'=>array('create')),
	array('label'=>'View SalesTarget','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SalesTarget','url'=>array('admin')),
);
?>

<h1>Update SalesTarget <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>