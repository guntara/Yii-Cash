<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */

$this->breadcrumbs=array(
	'Bank Receipts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'View',
);

$this->menu=array(
	array('label'=>'Manage BankReceipt', 'url'=>array('admin')),
	array('label'=>'Allocate BankReceipt', 'url'=>array("allocate/create&id=$model->id")),
);
?>

<h1>View Bank Receipt #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'id_bR'=>$model->id)); ?>
