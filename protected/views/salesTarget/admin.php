<?php
$this->breadcrumbs=array(
	'Sales Targets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create SalesTarget','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sales-target-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sales Targets</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'sales-target-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'user_id',
			'type'=>'text',
			'value'=> array($this,'namaUser'),
		),
		'periode',
		'target',
		'create_at',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
