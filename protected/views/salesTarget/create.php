<?php
$this->breadcrumbs=array(
	'Sales Targets'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage SalesTarget','url'=>array('admin')),
);
?>

<h1>Create SalesTarget</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
