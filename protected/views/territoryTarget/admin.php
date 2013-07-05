<?php
$this->breadcrumbs=array(
	'Territory Targets'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create TerritoryTarget','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('territory-target-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Territory Targets</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'territory-target-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'periode',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'100px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'name'=>'territory_id',
			'type'=>'text',
			'value'=> array($this,'namaTeritori'),
			'filter'=> Territory::model()->getListTeritori(),
		),
		array(
			'name'=>'target',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'150px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
