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
	$cuit=$_REQUEST['dato_cuit'];
	$direccion=$_REQUEST['dato_direccion'];
	$provincia=$_REQUEST['dato_provincia'];
	$localidad=$_REQUEST['dato_localidad'];
	$telefono=$_REQUEST['dato_telefono'];
	$mail=$_REQUEST['dato_mail'];
	
			
	mysqli_select_db($conexion,'$basedatos');
	$sql = "UPDATE tb_proveedores 
			SET tb_proveedores.nombre = '$nombre',
			tb_proveedores.cuit = '$cuit',
			tb_proveedores.direccion = '$direccion',
			tb_proveedores.provincia = '$provincia',
			tb_proveedores.localidad = '$localidad',
			tb_proveedores.telefono = '$telefono',
			tb_proveedores.mail = '$mail'
			WHERE
			tb_proveedores.id_proveedores = '$id'";
	mysqli_query($conexion,$sql);    


	$array=array('success'=>'true');
	echo json_encode($array);
		
} //fin else conexion
?>