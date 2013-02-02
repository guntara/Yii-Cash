<?php
/* @var $this BankReceiptController */
/* @var $model BankReceipt */

$this->breadcrumbs=array(
	'Bank Receipts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create BankReceipt', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bank-receipt-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bank Receipts</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bank-receipt-grid',
	'dataProvider'=>$model->search(),
	//'rowCssClassExpression'=>'($data->status==0)?"background-color:#00AA00;":"red"',
	'filter'=>$model,
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
		array(
			'header'=>'Action',
			'headerHtmlOptions'=>array('width'=>'40px'),
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'buttons'=>array
			(
				'update' => array
				(
					'label'=>'Allocate this Bank Receipt',
					'url'=>'Yii::app()->createUrl("allocate/create", array("id"=>$data->id))',
				),
			),
		),
	),
)); ?>
