<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'Sales Reports'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalesReport', 'url'=>array('admin')),
	array('label'=>'Manage Late Payment', 'url'=>array('paymentstatus&id=1')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sales-report-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sales Reports</h1>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-report-grid',
	'dataProvider'=>$model->search(),
	'rowCssClassExpression'=>'($data->status==0)?"normal":"green"',
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id_SO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'65px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'id_DO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'65px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'id_invoice',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'65px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'posting_date',
			'header'=>'Post Date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'70px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'due_date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'70px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name' => 'ageDays',
			'header'=>'Aging',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'headerHtmlOptions'=>array('width'=>'50px'),
			'value'=> array($this,'agetime'),
		),
		array(
			'name' => 'lateDays',
			'header'=>'Late Pay',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'headerHtmlOptions'=>array('width'=>'50px'),
			'value'=> array($this,'lateTime'),
		),
		'customer',
		array(
			'name'=>'total',
			'type'=>'text',
			'value'=>function($data){ return number_format($data->total, 2); },
			'headerHtmlOptions'=>array('width'=>'90px'),
			'htmlOptions'=>array('style'=>'text-align: right;'),

		),
		array(
			'name'=>'status',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'70px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'filter'=>array('1'=>'PAID','0'=>'UNPAID'),
			'value'=>'($data->status=="1")?("PAID"):("UNPAID")'
		),
		array(
			'header'=>'Action',
			'headerHtmlOptions'=>array('width'=>'40px'),
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
