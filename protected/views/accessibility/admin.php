<?php
$this->breadcrumbs=array(
	'Accessibilities'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Accessibility','url'=>array('index')),
	array('label'=>'Create Accessibility','url'=>array('create')),
);
?>

<h1>Manage Accessibilities</h1>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'accessibility-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		    'name'=>'user_id',
		    'headerHtmlOptions'=>array('style'=>'text-align: center;'),
		    'value'=> array($this,'getUserName'),
		),
		array(
		    'name'=>'ip',
		    'headerHtmlOptions'=>array('width'=>'120px', 'style'=>'text-align: center;'),
		    'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
		    'name'=>'multiple_ip',
		    'headerHtmlOptions'=>array('width'=>'250px', 'style'=>'text-align: left;'),
		    'htmlOptions'=>array('style'=>'text-align: right; padding-right: 0.5em'),
		),
		array(
		    'name'=>'ip_range1',
		    'headerHtmlOptions'=>array('width'=>'120px', 'style'=>'text-align: center;'),
		    'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
		    'name'=>'ip_range2',
		    'headerHtmlOptions'=>array('width'=>'120px', 'style'=>'text-align: center;'),
		    'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
