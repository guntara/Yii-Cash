<?php
/* @var $this AllocateController */
/* @var $model Allocate */

$this->breadcrumbs=array(
	'Allocates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Bank Receipt', 'url'=>array('bankReceipt/admin')),
);

$found = BankReceipt::model()->findAll('id = :id', array(':id' => $_GET['id']));
?>

<h1>Create Allocate For Bank Receipt #<?php echo $_GET['id']; ?></h1>

<?php foreach ($found as $data) : ?>
<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('/bankReceipt/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank')); ?>:</b>
	<?php echo CHtml::encode($data->bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cabang')); ?>:</b>
	<?php echo CHtml::encode($data->cabang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />
</div>
<?php endforeach ?>
<div class="view">
	<?php echo $this->renderPartial('_form', array('model'=>$model, 'id_bankReceipt'=>$_GET['id'])); ?>
</div>
