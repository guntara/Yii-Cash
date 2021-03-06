<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */

$this->breadcrumbs=array(
	'Bank Receipts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Manage BankReceipt', 'url'=>array('admin')),
);
?>

<h1>View BankReceipt #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tanggal',
		'keterangan',
		'jumlah',
		'bank',
		'cabang',
		'create_at',
	),
)); ?>
