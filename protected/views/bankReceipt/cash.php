<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */

$this->breadcrumbs=array(
	'Bank Receipts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'AR Daily Report', 'url'=>array('/salesReport/dailyar')),
	array('label'=>'AR Weekly Report', 'url'=>array('/salesReport/weeklyar')),
	array('label'=>'DN Weekly Report', 'url'=>array('/salesReport/weeklydn')),
);
?>

<h1>Report Bank Receipts</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>true,
)); ?>
 
<b>From :</b>
<?php
$from_date = Yii::app()->request->cookies['from_date'];
$to_date = (isset(Yii::app()->request->cookies['to_date'])) ? Yii::app()->request->cookies['to_date']->value : '';
//CVarDumper::dump($from_date .' - '. $to_date);

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'name'=>'from_date',  // name of post parameter
	'value'=>$from_date,
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd',
	),
	'htmlOptions'=>array(
	'style'=>'height:20px;'
	),
));
?>

<b>To :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'name'=>'to_date',
	'value'=>$to_date,
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd',
	),
	'htmlOptions'=>array(
	'style'=>'height:20px;'
	),
));
?>
<?php echo CHtml::submitButton('Go'); ?>
<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cash-status-grid',
	'dataProvider'=>BankReceipt::model()->cashbydate($from_date, $to_date),
	'rowCssClassExpression'=>'$data->getColor($this->dataProvider->data[$row])',
	'columns'=>array(
		array(
			'name'=>'tanggal',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'50px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'keterangan',
			'type'=>'raw',
			'value'=>'Chtml::encode($data->keterangan)',
			'headerHtmlOptions'=>array('width'=>'420px'),

		),
		array(
			'name'=>'jumlah',
			'type'=>'raw',
			'value'=>function($data){ return number_format($data->jumlah, 2); },
			'headerHtmlOptions'=>array('width'=>'100px'),
			'htmlOptions'=>array('style'=>'text-align: right; padding-right: 0.5em'),

		),
		array(
			'name'=>'bank',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'50px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'cabang',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'50px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
	),
));
?>

<br>
<div style="border-top:1px solid silver; border-bottom:1px solid silver; background: #EEEEEE; padding:10px;">
<?php
if ($data = explode('_', BankReceipt::model()->getSumbyDate($from_date, $to_date))) {
	echo '<table border=0>';
	echo '<tr><td width=150>Total of Cash In  </td><td width=5>:</td><td><b>'.number_format($data[0],2).'</b></td></tr>';
	echo '</table>';
}
?>
</div>
