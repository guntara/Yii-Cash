<?php
$this->breadcrumbs=array(
	'Territory Targets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TerritoryTarget','url'=>array('index')),
	array('label'=>'Create TerritoryTarget','url'=>array('create')),
	array('label'=>'View TerritoryTarget','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TerritoryTarget','url'=>array('admin')),
);
?>

<h1>Update TerritoryTarget <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>