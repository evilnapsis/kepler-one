<?php

?>
<section class="container">
<div class="row">
	<div class="col-md-12">
	<h1>Reportes</h1>

						<form>
<div class="row">
<div class="col-md-3">
<select name="product_id" required class="form-control">
	<option value="">-- SELECCIONE --</option>
	<?php foreach(ProductData::getAll() as $product):?>
	<option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
	<?php endforeach; ?>
</select>
</div>

<div class="col-md-3">
<input type="date" name="sd" required value="<?php if(isset($_GET["sd"])){ echo $_GET["sd"]; }?>" class="form-control">
</div>
<div class="col-md-3">
<input type="date" name="ed" required value="<?php if(isset($_GET["ed"])){ echo $_GET["ed"]; }?>" class="form-control">
</div>

<div class="col-md-3">
<input type="hidden" name="view" value="reports">
<input type="submit" class="btn btn-success btn-block" value="Procesar">
</div>

</div>
</form>

	</div>
	</div>
<br><!--- -->
<div class="row">
	
	<div class="col-md-12">
		<?php if(isset($_GET["product_id"])&& isset($_GET["sd"]) && isset($_GET["ed"]) ):?>

<?php 

$sd = strtotime($_GET["sd"]);
$ed = strtotime($_GET["ed"]);



if($sd!=""&&$ed!=""):
?>
<div class="panel panel-default">
<div class="panel-heading">Grafica</div>
<div id="graph" class="animate" data-animate="fadeInUp" ></div>
</div>
<script>

<?php 
echo "var c=0;";
echo "var dates=Array();";
echo "var data=Array();";
echo "var total=Array();";
for($i=$sd;$i<=$ed;$i+=(60*60*24)){

$in = OperationData::sumByPKD($_GET["product_id"],1,date("Y-m-d",$i));
$out = OperationData::sumByPKD($_GET["product_id"],2,date("Y-m-d",$i));
//echo $in->s-$out->s;

//  $operations = OperationData::getSumByKindDate(date("Y-m-d",$i),1);
//  $res = OperationData::getSumByKindDate(date("Y-m-d",$i),2);
//  echo $operations[0]->t;
//  $sr = $res[0]->t!=null?$res[0]->t:0;
//  $sl = $operations[0]->t!=null?$operations[0]->t:0;
  echo "dates[c]=\"".date("Y-m-d",$i)."\";";
  echo "data[c]=".($in->s-($out->s)).";";
  echo "total[c]={x: dates[c],y: data[c]};";
  echo "c++;";
}
?>
// Use Morris.Area instead of Morris.Line
Morris.Area({
  element: 'graph',
  data: total,
  xkey: 'x',
  ykeys: ['y',],
  labels: ['Y']
}).on('click', function(i, row){
  console.log(i, row);
});
</script>


<div class="box box-primary">
<table class="table table-bordered">
	<thead>
		<th>Fecha</th>
		<th>Enttadas</th>
		<th>Salidas</th>
		<th>Diferencia</th>
	</thead>
			<?php 
$intotal=0;
$outtotal = 0;
$spendtotal = 0;
for($i=$sd;$i<=$ed;$i+=(60*60*24)):
$in = OperationData::sumByPKD($_GET["product_id"],1,date("Y-m-d",$i));
$out = OperationData::sumByPKD($_GET["product_id"],2,date("Y-m-d",$i));
			 ?>
			 <?php if(true):?>
			 	<?php  ?>
<?php // foreach($operations as $operation):?>
	<tr>
		<td><?php echo date("Y-m-d",$i); ?></td>
		<td><?php echo $in->s; ?></td>
		<td><?php echo $out->s; ?></td>
		<td><?php echo $in->s-$out->s; ?></td>
	</tr>
<?php
$intotal+= ($in->s);
$outtotal+= ($out->s);
// endforeach; ?>
			 <?php else:
			 ?>
<div class="jumbotron">
	<h2>No hay operaciones</h2>
	<p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
</div>
			 <?php endif; ?>
			<?php endfor;?>
	<tr>
		<td>Total</td>
		<td><?php echo number_format($outtotal,2,'.',','); ?></td>
		<td><?php echo number_format($intotal,2,'.',','); ?></td>
		<td><?php echo number_format($intotal-($outtotal),2,'.',','); ?></td>
	</tr>
</table>
</div>
<?php else:?>
<div class="jumbotron">
	<h2>Fecha Incorrectas</h2>
	<p>Puede ser que no selecciono un rango de fechas, o el rango seleccionado es incorrecto.</p>
</div>
<?php 
endif;
else:
	?>
<p class="alert alert-warning">Seleccione producto, fecha de inicio y fecha de fin</p>
<?php
endif;

?>



	</div>
</div>

<br><br><br><br>
</section>