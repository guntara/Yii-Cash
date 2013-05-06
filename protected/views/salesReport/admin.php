<?php
$this->breadcrumbs=array(
	'Sales Reports'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalesReport', 'url'=>array('admin')),
	array('label'=>'Manage Late Payment', 'url'=>array("paymentstatus","id"=>1)),
);
?>

<h1>Manage Sales Reports</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-report-grid',
	'dataProvider'=>$model->search(),
	'rowCssClassExpression'=>'($data->status==0)?"normal":"green"',
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id_SO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'100px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),
		),
		array(
			'name'=>'id_DO',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'100px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),
		),
		array(
			'name'=>'id_invoice',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'100px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),
		),
		array(
			'name'=>'posting_date',
			'header'=>'Post Date',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'class'=>'ext.EFilterDatePicker',
			'model'=>$model,
			'attribute'=>'posting_date',
			'options'=>array(
				'showAnim'=>'fade',
				'changeYear'=>true,
				'changeMonth'=>true,
				'dateFormat'=>'yy-mm-dd',
			),
		),
		/*array(
			'name'=>'posting_date',
			'header'=>'Post Date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),*/
		array(
			'name' => 'ageDays',
			'header'=>'Aging',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'headerHtmlOptions'=>array('width'=>'60px'),
			'value'=> array($this,'agetime'),
		),
		array(
			'name' => 'lateDays',
			'header'=>'Late Pay',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'headerHtmlOptions'=>array('width'=>'60px'),
			'value'=> array($this,'lateTime'),
		),
		'customer',
		array(
			'name'=>'user_id',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
			'value'=> array($this,'namaUser'),
			'filter'=> Users::model()->getListSales(),
		),
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
