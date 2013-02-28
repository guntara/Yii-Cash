<?php
/* @var $this SalesReportController */
/* @var $model SalesReport */

$this->breadcrumbs=array(
	'DN Weekly Report'=>array('weeklydn'),
	'Report',
);

$this->menu=array(
	array('label'=>'Cash Report', 'url'=>array('/bankReceipt/cash')),
	array('label'=>'AR Daily Report', 'url'=>array('dailyar')),
	array('label'=>'AR Weekly Report', 'url'=>array('weeklyar')),
);
?>

<h1>DN Weekly Status Reports</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-status-grid',
	'dataProvider'=>SalesReport::model()->weeklydn(),
	'rowCssClassExpression'=>'($data->status==0)?"normal":"green"',
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',//  row is zero based
			'headerHtmlOptions'=>array('width'=>'15px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'name'=>'posting_date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'75px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'due_date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'70px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'id_DO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'60px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

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
			'name'=>'quantity',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'40px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'uom',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'60px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'total',
			'type'=>'text',
			'value'=>function($data){ return number_format($data->total, 2); },
			'headerHtmlOptions'=>array('width'=>'90px'),
			'htmlOptions'=>array('style'=>'text-align: right;'),

		),
	),
)); ?>
