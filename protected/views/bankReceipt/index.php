<?php
/* @var $this BankReceiptController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bank Receipts',
);

$this->menu=array(
	array('label'=>'Manage BankReceipt', 'url'=>array('admin')),
);
?>

<h1>Bank Receipts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
