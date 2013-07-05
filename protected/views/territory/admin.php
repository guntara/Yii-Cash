<?php
/* @var $this TerritoryController */
/* @var $model Territory */

$this->breadcrumbs=array(
	'Territories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Territory', 'url'=>array('index')),
	array('label'=>'Create Territory', 'url'=>array('create')),
);
?>

<h1>Manage Territories</h1>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{summary}{items}{pager}',
	'columns'=>array(
		array(
			'name'=>'id',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'30px'),
			'htmlOptions'=>array('style'=>'text-align: center;'),
		),
		array(
			'name'=>'name',
			'type'=>'text',
			'headerHtmlOptions'=>array('width'=>'250px'),
			'htmlOptions'=>array('style'=>'text-align: left;'),
		),
		array(
			'name'=>'detail',
			'type'=>'text',
			'htmlOptions'=>array('style'=>'text-align: left;'),
		),
		array(
			'header'=>'Action',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'text-align: center; width: 70px'),
		),
	),
)); ?>
