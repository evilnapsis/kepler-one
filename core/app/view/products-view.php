<?php if(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Nueva entrada</h1>
<div class="row">
<div class="col-md-8">
<form method="post" action="./?action=products&opt=add">
  <div class="form-group">
    <label for="exampleInputEmail1">Codigo</label>
    <input type="text" name="code" required class="form-control" placeholder="Codigo" >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" required class="form-control"  placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Descripcion</label>
    <textarea class="form-control" name="description" placeholder="Descripcion"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Precio</label>
<div class="input-group">
  <span class="input-group-addon">$</span>
  <input type="text" class="form-control"  placeholder="Precio $" name="price">
</div>
  </div>
  <button type="submit" class="btn btn-primary">Agregar Producto</button>
</form>
</div>
</div>

</div>
</div>
</div>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$x = ProductData::getById($_GET["id"]);
?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Editar Producto</h1>
<div class="row">
<div class="col-md-8">
<form method="post" action="./?action=products&opt=update">
  <div class="form-group">
    <label for="exampleInputEmail1">Codigo</label>
    <input type="text" name="code" value="<?php echo $x->code;?>" placeholder="Codigo" required class="form-control"  >
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" required  value="<?php echo $x->name;?>"  class="form-control"  placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Descripcion</label>
    <textarea class="form-control" name="description" placeholder="Descripcion"><?php echo $x->description;?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Precio</label>
<div class="input-group">
  <span class="input-group-addon">$</span>
  <input type="text" class="form-control" value="<?php echo $x->price;?>"  placeholder="Precio $" name="price">
</div>
  </div>
  <input type="hidden" name="id" value="<?php echo $x->id; ?>">
  <button type="submit" class="btn btn-success">Actualizar Producto</button>
</form>
</div>
</div>

</div>
</div>
</div>

<?php endif;?>




