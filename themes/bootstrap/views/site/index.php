<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Selamat Datang di '.CHtml::encode(Yii::app()->name),
)); ?>

<?php $this->endWidget(); ?>
