<?php
/* @var $this AllocateController */
/* @var $model Allocate */

$this->breadcrumbs=array(
	'Allocates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Allocate', 'url'=>array('index')),
	array('label'=>'Create Allocate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('allocate-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Allocates</h1>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'allocate-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_bankReceipt',
		'id_salesReport',
		'user_allocate',
		'amount',
		'remarks',
		/*
		'status',
		'create_at',
		'last_modify',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
