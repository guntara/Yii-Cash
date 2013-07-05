<?php
$this->breadcrumbs=array(
	'Territory Targets'=>array('admin'),
	'Monthly Target',
);

$months = array('--- Select Periode ---','January','February','March','April','May','June','July ','August','September','October','November','December',);
if (isset($_POST['prd'])){
	if ($_POST['prd'] < 10){ $mo = '0'.$_POST['prd']; }else{ $mo = $_POST['prd']; }
	$periode = date('Y') . '-' . $mo;
} else $periode = date('Y'). '-' .date('m');
?>

<center><h1>Territory Monthly Target </h1>
<h3>Period : <?php if (isset($_POST['prd'])){echo $months[$_POST['prd']]. ' ' .date('Y');} else echo date('M'). ' ' .date('Y'); ?></h3>

<?php echo CHtml::form(); ?>
        <?php echo CHtml::dropDownList('prd', '', $months, array('submit' => '')) ?>
<?php echo CHtml::endForm(); ?>
</center>

<div class="form">
<table class="items table table-striped">
<thead>
   <tr>
	<th id="yw121_c0">#</th>
	<th id="yw121_c1">Territory</th>
	<th id="yw121_c2">Target (Ton)</th>
	<th id="yw121_c3">Realization (Ton)</th>
	<th id="yw121_c4">Percent</th>
   </tr>
</thead>
<tbody>
	<?php
	$i=1;
	$totalTarget = 0; $totalReal = 0;
	$arTrt = Territory::model()->findAll();
	foreach($arTrt as $data) {
		$trtarget = TerritoryTarget::getTrTarget($data->id, $periode);
		$rltarget = TerritoryTarget::getSakTarget($data->name, $periode) + SalesTarget::getKgTarget($data->name, $periode);
	?>
	<tr>
		<td style="width: 60px"><?php echo $i; ?></td>
		<td><?php echo $data->name . ' - ' . $data->detail; ?></td>
		<td style="text-align:right;padding-right:50px;"><?php print_r (number_format($trtarget, 2)); ?></td>
		<td style="text-align:right;padding-right:50px;"><?php print_r (number_format($rltarget, 2)); ?></td>
		<td style="text-align:center;"><?php if (number_format($trtarget, 2)==='0.00') { print_r ('100%');} else {print_r (number_format($rltarget/$trtarget*100, 2).'%');} ?></td>
	</tr>
	<?php $i++; $totalTarget += $trtarget;  $totalReal += $rltarget; } ?>
	<tr>
		<td></td>
		<td style="text-align:right;">Total : </td>
		<td style="text-align:right;padding-right:50px;"><?php print_r (number_format($totalTarget, 2)); ?></td>
		<td style="text-align:right;padding-right:50px;"><?php print_r (number_format($totalReal, 2)); ?></td>
		<td style="text-align:center;"><?php if ($totalTarget==0) print_r ('100%'); else print_r (number_format($totalReal/$totalTarget*100, 2).'%'); ?></td>
	</tr>
</tbody>
</table>
</div>

