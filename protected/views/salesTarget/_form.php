<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'sales-target-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>
 
<fieldset>
	<?php if ($model->isNewRecord) echo '<legend>Create Sales Target</legend>'; else echo '<legend>Update Sales Target</legend>'; ?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model, 'user_id', Users::getListSales(), array('empty'=>'-- Select Sales Person --'));?>
	<?php echo $form->datepickerRow($model, 'periode',  array('append'=>'<i class="icon-calendar"></i>', 'options'=>array('format'=>'yyyy-mm'))); ?>
	<?php echo $form->textFieldRow($model, 'target', array('append'=>'Ton')); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Create' : 'Save',)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>
