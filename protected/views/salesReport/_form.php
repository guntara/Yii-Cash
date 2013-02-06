<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_SO'); ?>
		<?php echo $form->textField($model,'id_SO',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_SO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_DO'); ?>
		<?php echo $form->textField($model,'id_DO',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_DO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_invoice'); ?>
		<?php echo $form->textField($model,'id_invoice',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'id_invoice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'posting_date'); ?>
		<?php echo $form->textField($model,'posting_date'); ?>
		<?php echo $form->error($model,'posting_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'due_date'); ?>
		<?php echo $form->textField($model,'due_date'); ?>
		<?php echo $form->error($model,'due_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer'); ?>
		<?php echo $form->textField($model,'customer',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'customer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uom'); ?>
		<?php echo $form->textField($model,'uom',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'uom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'territory'); ?>
		<?php echo $form->textField($model,'territory',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'territory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sales_term'); ?>
		<?php echo $form->textField($model,'sales_term',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sales_term'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment_date'); ?>
		<?php echo $form->textField($model,'payment_date'); ?>
		<?php echo $form->error($model,'payment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
		<?php echo $form->error($model,'create_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_at'); ?>
		<?php echo $form->textField($model,'update_at'); ?>
		<?php echo $form->error($model,'update_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->