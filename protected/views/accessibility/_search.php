<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ip',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'multiple_ip',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'ip_range1',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'ip_range2',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
