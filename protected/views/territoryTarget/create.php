<?php
$this->breadcrumbs=array(
	'Territory Targets'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TerritoryTarget','url'=>array('index')),
	array('label'=>'Manage TerritoryTarget','url'=>array('admin')),
);
?>

<h1>Create TerritoryTarget</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
