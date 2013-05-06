<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('multiple_ip')); ?>:</b>
	<?php echo CHtml::encode($data->multiple_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_range1')); ?>:</b>
	<?php echo CHtml::encode($data->ip_range1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_range2')); ?>:</b>
	<?php echo CHtml::encode($data->ip_range2); ?>
	<br />


</div>