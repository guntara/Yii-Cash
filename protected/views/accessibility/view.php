<?php
$this->breadcrumbs=array(
	'Accessibilities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Accessibility','url'=>array('index')),
	array('label'=>'Create Accessibility','url'=>array('create')),
	array('label'=>'Update Accessibility','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Accessibility','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Accessibility','url'=>array('admin')),
);
?>

<h1>View Accessibility #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'ip',
		'multiple_ip',
		'ip_range1',
		'ip_range2',
	),
)); ?>
