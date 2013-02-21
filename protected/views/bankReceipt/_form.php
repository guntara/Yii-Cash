<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bank-receipt-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal'); ?>
		<?php echo $form->textField($model,'tanggal',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textArea($model,'keterangan',array ('maxlength' => 300, 'rows' => 3, 'cols' => 60,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah'); ?>
		<?php echo $form->textField($model,'jumlah',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'jumlah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bank'); ?>
		<?php echo $form->textField($model,'bank',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cabang'); ?>
		<?php echo $form->textField($model,'cabang',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'cabang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'create_at'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<br /><br />

<h2>Mapping Allocate for Bank Receipt #<?php echo $model->id; ?></h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'allocate-grid',
	'dataProvider'=>Allocate::model()->getAllocate($id_bR),
	'columns'=>array(
		array(
			'name'=>'id_salesReport',
			'header'=>'Allocated to',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		'remarks',
		array(
			'name'=>'salesTotal',
			'header'=>'Due Payment',
			'type'=>'raw',
			'headerHtmlOptions'=>array('width'=>'85px'),
			'htmlOptions'=>array('style'=>'text-align: right;'),
			'value'=>array($this, 'getAmount'),
		),
		array(
			'name'=>'amount',
			'header'=>'Total Payed',
			'type'=>'raw',
			'value'=>function($data){ return number_format($data->amount, 2); },
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: right;'),
		),
		array(
			'name'=>'user_allocate',
			'header'=>'Allocated by',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'header'=>'Action',
			'headerHtmlOptions'=>array('width'=>'20px'),
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array
			(
				'delete' => array
				(
					'label'=>'Delete this Allocate',
					'url'=>'Yii::app()->createUrl("allocate/delete", array("id"=>$data->id))',
				),
			),
		),
	),
)); ?>

<br>
<div style="border-top:1px solid silver; border-bottom:1px solid silver; background: #EEEEEE; padding:10px;">
<?php
if ($data = explode('_', $model->getSumPay($id_bR))) {
	echo '<table border=0>';
	//echo '<tr><td width=150>Number of Invoice Payed</td><td width=5>:</td><td><b>'.$data[1].'</b></td></tr>';
	echo '<tr><td width=150>Total of Amount Payed  </td><td width=5>:</td><td><b>'.number_format($data[0],2).'</b></td></tr>';
	echo '<tr><td width=150>Total of Un-Allocated  </td><td width=5>:</td><td><b>'.number_format(($model->jumlah - $data[0]),2).'</b></td></tr>';
	echo '</table>';
}
?>
</div>
