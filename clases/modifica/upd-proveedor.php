<?php
session_start();
if (!isset($_SESSION['usuario'])) {
header("Location: ../../index.php");
}
include '../../conexion/conexion.php';
if (mysqli_connect_errno()) {
printf("La conexión con el servidor de base de datos falló comuniquese con su administrador: %s\n", mysqli_connect_error());
exit();
}
$id=$_REQUEST['id'];
$sqlproveedor = "SELECT
tb_proveedores.id_proveedores AS id_proveedor,
tb_proveedores.nombre AS nombre,
tb_proveedores.cuit AS cuit,
tb_proveedores.direccion AS direccion,
tb_proveedores.provincia AS provincia,
tb_proveedores.localidad AS localidad,
tb_proveedores.telefono AS telefono,
tb_proveedores.mail AS mail
FROM
tb_proveedores
WHERE
tb_proveedores.id_proveedores = '$id'
";
$rsproveedor = mysqli_query($conexion, $sqlproveedor);
while ($datos = mysqli_fetch_assoc($rsproveedor)){
$id_proveedor=utf8_encode($datos['id_proveedor']);
$nombre=utf8_decode($datos['nombre']);
$cuit=utf8_encode($datos['cuit']);
$direccion=utf8_encode($datos['direccion']);
$provincia=utf8_encode($datos['provincia']);
$localidad=utf8_encode($datos['localidad']);
$telefono=utf8_encode($datos['telefono']);
$mail=utf8_encode($datos['mail']);
}
?>
<form class="form-horizontal" role="form" id="formulario_nuevo" onsubmit="event.preventDefault(); modifica('proveedor')">

<div class="modal-header">
   <h4 class="modal-title">Modificar proveedor</h4>
</div>
<br>

 <div class="well bs-component">
 <div class="row">
 <div class="col-lg-6">
   <fieldset>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Nombre</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_nombre" value="<?php echo $nombre;?>" aria-describedby="basic-addon1" required>
          <input type="hidden" class="form-control" value="<?php echo $id_proveedor;?>" id="dato_id" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">CUIT</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_cuit" value="<?php echo $cuit;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Dirección</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_direccion" value="<?php echo $direccion;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label  class="col-lg-2 control-label">Provincia</label>
        <div class="col-lg-10">
          <select class="form-control" id="dato_provincia" required>
              <option value="<?php echo $provincia;?>"><?php echo $provincia;?></option>   
              <option value="Buenos Aires">Buenos Aires</option>
              <option value="Cordoba">Cordoba</option>
              <option value="Mendoza">Mendoza</option>
              <option value="San Luis">San Luis</option>
              <option value="San Juan">San Juan</option>
              <option value="Santa Fe">Santa Fe</option>
          </select>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Localidad</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_localidad" value="<?php echo $localidad;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Teléfono</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_telefono" value="<?php echo $telefono;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Mail</label>
        <div class="col-lg-10">
          <input type="mail" class="form-control" autocomplete="off" id="dato_mail" value="<?php echo $mail;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
   </fieldset>
 
 </div>
 <div class="col-lg-6">
 
   <fieldset>
      
   </fieldset>
  </div> 
 </div>  
 </div>

 <div class="modal-footer">
        <div class="form-group form-group-sm">
        <div class="col-lg-7">
          <div align="center" id="div_mensaje_general">
          </div>
        </div>
        <div class="col-lg-5">
          <div align="right">
          <button type="button" id="boton_salir" onclick="inicio()" class="btn btn-default">Salir</button>
          <button type="submit" id="boton_guardar" class="btn btn-primary">Guardar</button>  
          </div>
        </div>
      </div>  
  </div>

</form>
