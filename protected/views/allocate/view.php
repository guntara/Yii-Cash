<?php
/* @var $this AllocateController */
/* @var $model Allocate */

$this->breadcrumbs=array(
	'Allocates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Allocate', 'url'=>array('index')),
	array('label'=>'Create Allocate', 'url'=>array('create')),
	array('label'=>'Update Allocate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Allocate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Allocate', 'url'=>array('admin')),
);
?>

<h1>View Allocate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_bankReceipt',
		'id_salesReport',
		'user_allocate',
		'remarks',
		'status',
		'create_at',
		'last_modify',
	),
)); ?>
