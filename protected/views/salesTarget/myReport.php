<?php
$this->breadcrumbs=array(
	'Sales Targets'=>array('admin'),
	'My Report',
);

$months = array('January','February','March','April','May','June','July ','August','September','October','November','December',);
?>

<center><h1>My Sales Target</h1>
<h3>Period : <?php echo date('Y'); ?></h3>
</center>

<div class="form">
<table class="items table table-striped">
<thead>
   <tr>
	<th id="yw121_c0">#</th>
	<th id="yw121_c1">Periode</th>
	<th id="yw121_c2">Target (Ton)</th>
	<th id="yw121_c3">Realization (Ton)</th>
	<th id="yw121_c4">Percent</th>
   </tr>
</thead>
<tbody>
<?php for ($i=1; $i<=12; $i++) {
   if($i<10) $j='0'.$i; else $j=$i;
   $periode = date('Y') . '-' . $j;
   $userid = Yii::app()->user->id;
   $mytarget = SalesTarget::getMyTarget($userid, $periode);
   $rltarget = SalesTarget::getSakTarget($userid, $periode) + SalesTarget::getKgTarget($userid, $periode);?>

   <tr>
	<td style="width: 60px"><?php echo $j; ?></td>
	<td><?php echo $months[$i-1]; ?></td>
	<td><?php print_r (number_format($mytarget, 2)); ?></td>
	<td><?php print_r ($rltarget); ?></td>
	<td><?php if (number_format($mytarget, 2)==='0.00') { print_r ('100%');} else {print_r (number_format($rltarget/$mytarget*100, 2).'%');} ?></td>
   </tr>
<?php } ?>
</tbody>
</table>
</div>
