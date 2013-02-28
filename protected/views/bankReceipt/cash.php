<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */
$model = new BankReceipt;
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
$model->from_date = (isset(Yii::app()->request->cookies['from_date'])) ? Yii::app()->request->cookies['from_date']->value : '';
$model->to_date = (isset(Yii::app()->request->cookies['to_date'])) ? Yii::app()->request->cookies['to_date']->value : '';
//CVarDumper::dump($model->from_date .' - '. $model->to_date);

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'name'=>'from_date',  // name of post parameter
	'value'=>$model->from_date,
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
	'value'=>$model->to_date,
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

<?php
$dataProvider = $model->cashbydate();
$dataProvider->pagination = array('pageSize' => 100);
$dataProvider->sort = array('defaultOrder' => 'tanggal ASC');

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cash-status-grid',
	'dataProvider'=>$dataProvider,
	'rowCssClassExpression'=>'$data->getColor($this->dataProvider->data[$row])',
	'enablePagination' => false,
	'template'=>'{items}',
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
<div align="right" style="border-top:1px solid silver; border-bottom:1px solid silver; background: #EEEEEE; padding:10px;">
<?php
if ($data = explode('_', BankReceipt::model()->getSumbyDate($model->from_date, $model->to_date))) {
	echo 'Total of Cash In  &nbsp; &nbsp; : &nbsp; <b>'.number_format($data[0],2).'</b>';
}
?>
</div>
