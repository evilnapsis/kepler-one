<?php
$products =  ProductData::getAll();
?>
<section class="container">
<div class="row">
	<div class="col-md-12">
	<h1>Bienvenido a Kepler One</h1>
	<a href="./?view=products&opt=new" class="btn btn-default"><i class="fa fa-asterisk"></i> Nuevo Producto</a>
	<br><br>
<?php if(count($products)>0):?>
	<table class="table table-bordered">
	<thead>
		<th>Codigo</th>
		<th>Producto</th>
		<th>Precio</th>
		<th>Existencias</th>
		<th></th>
	</thead>
	<?php foreach($products as $product):?>
		<tr>
			
		<td><?php echo $product->code; ?></td>
		<td><?php echo $product->name; ?></td>
		<td>$ <?php echo $product->price; ?></td>
		<td>
<?php
$in = OperationData::sumByPK($product->id,1);
$out = OperationData::sumByPK($product->id,2);
echo $in->s-$out->s;
?>
		</td>
		<td>
			<a data-toggle="modal" data-target="#plusModal<?php echo $product->id; ?>" class="btn btn-info btn-xs"><i class="fa fa-plus"></i></a>
			<a data-toggle="modal" data-target="#minusModal<?php echo $product->id; ?>" class="btn btn-info btn-xs"><i class="fa fa-minus"></i></a>

<!-- Modal -->
<div class="modal fade" id="plusModal<?php echo $product->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Existencias</h4>
      </div>
      <div class="modal-body">
<form method="post" action="./?action=products&opt=addin">
<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad</label>
    <input type="text" name="q" required class="form-control" placeholder="Cantidad" >
  </div>
  <button type="submit" class="btn btn-primary">Agregar Existencias</button>
</form>

      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="minusModal<?php echo $product->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Restar Existencias</h4>
      </div>
      <div class="modal-body">
<form method="post" action="./?action=products&opt=addout">
<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Cantidad</label>
    <input type="text" name="q" required class="form-control" placeholder="Cantidad" >
  </div>
  <button type="submit" class="btn btn-primary">Restar Existencias</button>
</form>

      </div>

    </div>
  </div>
</div>
			<a href="./?view=products&opt=edit&id=<?php echo $product->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

			<a href="./?action=products&opt=del&id=<?php echo $product->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-cut"></i></a>

		</td>
		</tr>
	<?php endforeach;?>
	</table>
<?php else:?>
	<p class="alert alert-warning">No hay productos</p>
<?php endif;?>


</div>
</div>
</section>