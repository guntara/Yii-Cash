<?php
$this->breadcrumbs=array(
	'Territory Targets'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create TerritoryTarget','url'=>array('create')),
	array('label'=>'Update TerritoryTarget','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete TerritoryTarget','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TerritoryTarget','url'=>array('admin')),
);
?>

<h1>View TerritoryTarget #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'territory_id',
			'type'=>'text',
			'value'=> $this->namaTeritori($model),
		),
		'periode',
		'target',
		'create_at',
	),
)); ?>
