<?php
$this->breadcrumbs=array(
	'Sales Targets'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create SalesTarget','url'=>array('create')),
	array('label'=>'Update SalesTarget','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SalesTarget','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesTarget','url'=>array('admin')),
);
?>

<h1>View SalesTarget #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'user_id',
			'type'=>'text',
			'value'=> $this->namaUser($model),
		),
		'periode',
		'target',
		'create_at',
	),
)); ?>
