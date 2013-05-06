<?php	

/**
 * Description of EFilterDatePicker
 * 
 * @author Dida Nurwanda <dida_n@ymail.com>
 * @version 1.0
 *
 *
 * 	$this->widget('zii.widgets.grid.CGridView',array(
 *		'id'=>'absensi-grid',
 *		'dataProvider'=>$model->search(100),
 *		'filter'=>$model,
 *		'columns'=>array(
 *			'nip',
 *			'name',
 * 			array(
 *				'name'=>'tanggal',
 *
 *				// Lihat disini
 *				// pengaturan mirip dengan CJuiDatePicker
 *
 *				'class'=>'ext.EFilterDatePicker',
 *				'model'=>$model,
 *				'attribute'=>'tanggal',
 *				'options'=>array(
 *					'showAnim'=>'fade',
 *					'changeYear'=>true,
 *					'changeMonth'=>true,
 *					'dateFormat'=>'yy-mm-dd',
 *				),
 *			),
 *			'type',
 *			array(
 *				'class'=>'CButtonColumn',
 *			),
 *		),
 *	));
 *
 */

 
Yii::import('zii.widgets.jui.CJuiWidget');

class EFilterDatePicker extends CDataColumn
{
	public $options=array();
	public $model;
	public $attribute;	
	
	public function init()
	{
		$EFDP=new EFDatePicker($this->model,$this->attribute,$this->options);
	}
}

class EFDatePicker extends CJuiWidget
{
	
	private static $id_count=0;
	
	public function __construct($model,$attribute,$options)
	{
		parent::init();
		
		$name='input[name="'.get_class($model).'['.$attribute.']"]';
		$js="jQuery('{$name}').datepicker(".CJavaScript::encode($options).");";
		Yii::app()->getClientScript()->registerScript('EFilterDatePicker'.self::$id_count++,$js);
	}
}