<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'territory-target-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>
 
<fieldset>
	<?php if ($model->isNewRecord) echo '<legend>Create Territory Target</legend>'; else echo '<legend>Update Territory Target</legend>'; ?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model, 'territory_id', Territory::getListTeritori(), array('empty'=>'-- Select Territory --'));?>
	<?php echo $form->datepickerRow($model, 'periode',  array('append'=>'<i class="icon-calendar"></i>', 'options'=>array('format'=>'yyyy-mm'))); ?>
	<?php echo $form->textFieldRow($model, 'target', array('append'=>'Ton')); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Create' : 'Save',)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>
