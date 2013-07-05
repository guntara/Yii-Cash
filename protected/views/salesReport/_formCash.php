<div style="border-top:1px solid silver; border-bottom:1px solid silver; background: #EEEEEE; padding:10px;">
<?php
if ($data = SalesReport::model()->totalCashin($month)) {
	echo '<table>
		<tr>
		<th>Full Allocate Invoce</th>
		<th>Total Invoce</th>
		<th>Expected Cash In</th>
		<th>Actual Cash In</th>
		</tr>';
	echo '<tr>
		<td>'. $data[1] .'</td>
		<td>'. $data[2] .'</td>
		<td>'. number_format($data[3], 2) .'</td>
		<td>'. number_format($data[4], 2) .'</td>
		</tr>
	</table>';
}
?>
</div>

<?php
$aaa = 'cashin'. $month .'-status-grid';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>$aaa,
	'dataProvider'=>SalesReport::model()->cashin($month),
	//'filter'=>$model,
	'rowCssClassExpression'=>'($data->status==0)?"normal":"green"',
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
			'headerHtmlOptions'=>array('width'=>'15px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'name'=>'id_invoice',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),

		),
		array(
			'name'=>'posting_date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
		array(
			'name'=>'due_date',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'80px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),
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
		/*array(
			'name'=>'status',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'60px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),

		),*/
		array(
			'name'=>'total',
			'type'=>'text',
			'value'=>function($data){ return number_format($data->total, 2); },
			'headerHtmlOptions'=>array('width'=>'90px'),
			'htmlOptions'=>array('style'=>'text-align: right;'),

		),
	),
));
?>
