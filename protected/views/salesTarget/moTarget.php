<?php
$this->breadcrumbs=array(
	'Sales Targets'=>array('admin'),
	'Monthly Target',
);

$months = array('--- Select Periode ---','January','February','March','April','May','June','July ','August','September','October','November','December',);
if (isset($_POST['prd'])){
	if ($_POST['prd'] < 10){ $mo = '0'.$_POST['prd']; }else{ $mo = $_POST['prd']; }
	$periode = date('Y') . '-' . $mo;
} else $periode = date('Y'). '-' .date('m');
?>

<center><h1>Sales Monthly Target </h1>
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
	<th id="yw121_c1">Sales Person</th>
	<th id="yw121_c2">Target (Ton)</th>
	<th id="yw121_c3">Realization (Ton)</th>
	<th id="yw121_c4">Percent</th>
   </tr>
</thead>
<tbody>
	<?php
	$i=1;
	$totalTarget = 0; $totalReal = 0;
	$arrSM = Users::model()->getAllSales();
	foreach($arrSM as $key => $value) {
		$id = User::model()->findAllByAttributes(array('username'=>$value));
		$data = Profiles::model()->findByPK($id[0]['id']);
		$mytarget = SalesTarget::getMyTarget($id[0]['id'], $periode);
		$rltarget = SalesTarget::getSakTarget($id[0]['id'], $periode) + SalesTarget::getKgTarget($id[0]['id'], $periode);
	?>
	<tr>
		<td style="width: 60px"><?php echo $i; ?></td>
		<td><?php if ($data->user_id==1) echo "Others"; else echo $data->firstname . ' ' . $data->lastname; ?></td>
		<td style="text-align:right;padding-right:50px;"><?php print_r (number_format($mytarget, 2)); ?></td>
		<td style="text-align:right;padding-right:50px;"><?php print_r (number_format($rltarget, 2)); ?></td>
		<td style="text-align:center;"><?php if (number_format($mytarget, 2)==='0.00') { print_r ('100%');} else {print_r (number_format($rltarget/$mytarget*100, 2).'%');} ?></td>
	</tr>
	<?php $i++; $totalTarget += $mytarget;  $totalReal += $rltarget; } ?>
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

