<?php
$this->breadcrumbs=array(
	'Accessibilities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Accessibility','url'=>array('index')),
	array('label'=>'Manage Accessibility','url'=>array('admin')),
);
?>

<h1>Create Accessibility</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>