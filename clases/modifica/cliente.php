<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
header("Location: ../../index.php");
}
include '../../conexion/conexion.php';
if (mysqli_connect_errno()) {
	$array=array('success'=>'false');
	echo json_encode($array);
	exit();
}else{

	$id=utf8_encode($_REQUEST['dato_id']);
	$nombre=utf8_encode($_REQUEST['dato_nombre']);
	$apellido=$_REQUEST['dato_apellido'];
	$dni=$_REQUEST['dato_dni'];
	$telefono=$_REQUEST['dato_telefono'];
	$mail=$_REQUEST['dato_mail'];
	$calle=$_REQUEST['dato_calle'];
	$numero=$_REQUEST['dato_numero'];
	$localidad=$_REQUEST['dato_localidad'];
	$provincia=$_REQUEST['dato_provincia'];
	$codigopostal=$_REQUEST['dato_codigopostal'];

			
	mysqli_select_db($conexion,'$basedatos');
	$sql = "UPDATE tb_clientes 
			SET tb_clientes.nombre = '$nombre',
			tb_clientes.apellido = '$apellido',
			tb_clientes.dni = '$dni',
			tb_clientes.telefono = '$telefono',
			tb_clientes.mail = '$mail',
			tb_clientes.calle = '$calle',
			tb_clientes.numero = '$numero',
			tb_clientes.localidad = '$localidad',
			tb_clientes.provincia = '$provincia',
			tb_clientes.codigo_postal = '$codigopostal'
			WHERE
			tb_clientes.id_clientes = '$id'";
	mysqli_query($conexion,$sql);    


	$array=array('success'=>'true');
	echo json_encode($array);
		
} //fin else conexion
?>