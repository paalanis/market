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
	//date_default_timezone_set("America/Argentina/Mendoza");
	//$id_global = date("YmdHis");	

	$nombre=utf8_encode($_REQUEST['dato_nombre']);
	$cuit=$_REQUEST['dato_cuit'];
	$direccion=$_REQUEST['dato_direccion'];
	$provincia=$_REQUEST['dato_provincia'];
	$localidad=$_REQUEST['dato_localidad'];
	$telefono=$_REQUEST['dato_telefono'];
	$mail=$_REQUEST['dato_mail'];
		
	mysqli_select_db($conexion,'$basedatos');
	$sql = "INSERT INTO tb_proveedores (nombre, cuit, direccion, provincia, localidad, telefono, mail)
	VALUES ('$nombre', '$cuit', '$direccion', '$provincia', '$localidad', '$telefono', '$mail')";
	mysqli_query($conexion,$sql);    

	$array=array('success'=>'true');
	echo json_encode($array);
		
} //fin else conexion
?>