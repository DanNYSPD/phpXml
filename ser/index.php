<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
</head>
<body>
	<form action="registar.php" method="POST" >
		<p>Cliente</p>
		
		<label for="nombre">Ingresa Nombre del cliente</label>
		<input type="text"  name="nombre" class="form-control"/><br>
		<p>Producto 1</p>
		<label for="producto1_precio">Ingresa el precio del Producto 1</label>
		<input type="text"  name="producto1_precio" class="form-control"/>
		<label for="producto1_importe">Ingresa el importe del producto 1</label>
		<input type="text" name="producto1_importe" class="form-control">
		<br>
		<p>Producto 1</p>
		<label for="producto2_precio">Ingresa el precio del Producto 2</label>
		<input type="text"  name="producto2_precio" class="form-control"/>
		<label for="producto2_importe">Ingresa el importe del producto 2</label>
		<input type="number" name="producto2_importe" class="form-control">
		<button type="submit" >Enviar</button>
	</form>

</body>
</html>