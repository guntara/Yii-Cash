<?php
/* @var $this AllocateController */
/* @var $data Allocate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bankReceipt')); ?>:</b>
	<?php echo CHtml::encode($data->id_bankReceipt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_salesReport')); ?>:</b>
	<?php echo CHtml::encode($data->id_salesReport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_allocate')); ?>:</b>
	<?php echo CHtml::encode($data->user_allocate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remarks')); ?>:</b>
	<?php echo CHtml::encode($data->remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_modify')); ?>:</b>
	<?php echo CHtml::encode($data->last_modify); ?>
	<br />

	*/ ?>

</div>