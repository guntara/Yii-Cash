<?php
$this->Widget('ext.highcharts.HighchartsWidget', array(
	'options'=>array(
		'title' => array('text' => 'Sales Periode'),
		'credits' => array('enabled' => false),
		//'exporting' => array('enabled' => false),
		'chart' => array(
			'type' => 'column',
		),
		'xAxis' => array(
  			'categories' => array('January', 'February', 'March', 'April', 'May')
		),
		'yAxis' => array(
			'title' => array('text' => 'Sales Order (Ton)')
		),
		'series' => array(
			array('name' => 'Edward Sirait', 'data' => array(1600.00, 2420.00, 2500.00, 2775.00, 3456.86)),
			array('name' => 'Abdul Kadir', 'data' => array(3350.00, 2738.00, 2485.00, 2969.87, 3120.00)),
			array('name' => 'Masran Harefa', 'data' => array(706.98, 840.00, 700.00, 1015.00, 1017.00)),
			array('name' => 'Parisal Dalimunthe', 'data' => array(940.00, 1040.00, 1005.00, 1035.00, 1090.00)),
		)
	)
));
?>
