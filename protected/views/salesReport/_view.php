<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_SO')); ?>:</b>
	<?php echo CHtml::encode($data->id_SO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_DO')); ?>:</b>
	<?php echo CHtml::encode($data->id_DO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_invoice')); ?>:</b>
	<?php echo CHtml::encode($data->id_invoice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posting_date')); ?>:</b>
	<?php echo CHtml::encode($data->posting_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('due_date')); ?>:</b>
	<?php echo CHtml::encode($data->due_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer')); ?>:</b>
	<?php echo CHtml::encode($data->customer); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uom')); ?>:</b>
	<?php echo CHtml::encode($data->uom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('territory')); ?>:</b>
	<?php echo CHtml::encode($data->territory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_term')); ?>:</b>
	<?php echo CHtml::encode($data->sales_term); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_date')); ?>:</b>
	<?php echo CHtml::encode($data->payment_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_at')); ?>:</b>
	<?php echo CHtml::encode($data->update_at); ?>
	<br />

	*/ ?>

</div>