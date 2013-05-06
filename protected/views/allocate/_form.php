<?php
/* @var $this AllocateController */
/* @var $model Allocate */
/* @var $form CActiveForm */

$dateBR = $this->getDate($id_bankReceipt);
?>

<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'allocate-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>
<?php echo $form->errorSummary($model); ?>

<fieldset>
	<?php echo $form->textFieldRow($model,'id_bankReceipt',array('size'=>10,'maxlength'=>10,'readOnly'=>'readOnly','value'=>$id_bankReceipt)); ?>
	<?php echo $form->textFieldRow($model,'tanggal',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly','value'=>$dateBR)); ?>

	<div class="control-group ">
		<label class="control-label required" for="Allocate_id_salesReport">ID Sales Report <span class="required">*</span></label>
		<div class="controls">
		<?php echo CHtml::dropDownList('allocate_id','', array(1=>'Sales Order', 2=>'Delivery Number', 3=>'Invoice',4=>'Others'),
			array(
			'prompt' => '--- Select Allocate Terms ---',
			'ajax' => array(
			'type'=>'POST',
			'url'=>CController::createUrl('listing'),
			'update'=>'#Allocate_id_salesReport',
		)));?>
		</div>
		<div class="controls">
		<?php echo CHtml::dropDownList('Allocate[id_salesReport]', '', array()); ?>
		</div>
	</div>

	<?php echo $form->textFieldRow($model, 'amount'); ?>
	<?php echo $form->textAreaRow($model, 'remarks', array('class'=>'span8', 'rows'=>3)); ?>

	<div class="form-actions"> 
		<?php $this->widget('bootstrap.widgets.TbButton', array( 
			'buttonType'=>'submit', 
			'type'=>'primary', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save', 
        )); ?>
    </div>

</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->
