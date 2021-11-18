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
$sqlcliente = "SELECT
tb_clientes.id_clientes AS id_cliente,
tb_clientes.nombre AS nombre,
tb_clientes.apellido AS apellido,
tb_clientes.dni AS dni,
tb_clientes.telefono AS tel,
tb_clientes.mail AS mail,
tb_clientes.calle AS calle,
tb_clientes.numero AS numero,
tb_clientes.localidad AS loc,
tb_clientes.provincia AS prov,
tb_clientes.codigo_postal AS cpostal
FROM
tb_clientes
WHERE
tb_clientes.id_clientes = '$id'
";
$rscliente = mysqli_query($conexion, $sqlcliente);
while ($datos = mysqli_fetch_assoc($rscliente)){
$id_cliente=utf8_encode($datos['id_cliente']);
$nombre=utf8_decode($datos['nombre']);
$apellido=utf8_encode($datos['apellido']);
$dni=utf8_encode($datos['dni']);
$tel=utf8_encode($datos['tel']);
$mail=utf8_encode($datos['mail']);
$calle=utf8_encode($datos['calle']);
$numero=utf8_encode($datos['numero']);
$loc=utf8_encode($datos['loc']);
$prov=utf8_encode($datos['prov']);
$cpostal=utf8_encode($datos['cpostal']);
}
?>
<form class="form-horizontal" role="form" id="formulario_nuevo" onsubmit="event.preventDefault(); modifica('cliente')">

<div class="modal-header">
   <h4 class="modal-title">Modificar Cliente</h4>
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
          <input type="hidden" class="form-control" value="<?php echo $id_cliente;?>" id="dato_id" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Apellido</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_apellido" value="<?php echo $apellido;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">DNI</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_dni" value="<?php echo $dni;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Mail</label>
        <div class="col-lg-10">
          <input type="mail" class="form-control" autocomplete="off" id="dato_mail" value="<?php echo $mail;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Teléfono</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_telefono" value="<?php echo $tel;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Calle</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_calle" value="<?php echo $calle;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Número</label>
        <div class="col-lg-10">
          <input type="number" class="form-control" autocomplete="off" id="dato_numero" value="<?php echo $numero;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label for="inputPassword" class="col-lg-2 control-label">Localidad</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_localidad" value="<?php echo $loc;?>" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="form-group form-group-sm">
        <label  class="col-lg-2 control-label">Provincia</label>
        <div class="col-lg-10">
          <select class="form-control" id="dato_provincia" required>
              <option value="<?php echo $prov;?>"><?php echo $prov;?></option>   
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
        <label for="inputPassword" class="col-lg-2 control-label">C.Postal</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" autocomplete="off" id="dato_codigopostal" value="<?php echo $cpostal;?>" aria-describedby="basic-addon1" required>
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
