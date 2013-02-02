<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */

$this->breadcrumbs=array(
	'Bank Receipts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BankReceipt', 'url'=>array('index')),
	array('label'=>'Manage BankReceipt', 'url'=>array('admin')),
);
?>

<h1>Create BankReceipt</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
