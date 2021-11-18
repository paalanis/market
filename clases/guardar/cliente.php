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
	$apellido=utf8_encode($_REQUEST['dato_apellido']);
	$dni=utf8_encode($_REQUEST['dato_dni']);
	$mail=$_REQUEST['dato_mail'];
	$telefono=$_REQUEST['dato_telefono'];
	$calle=$_REQUEST['dato_calle'];
	$numero=$_REQUEST['dato_numero'];
	$localidad=$_REQUEST['dato_localidad'];
	$provincia=$_REQUEST['dato_provincia'];
	$codigo_postal=$_REQUEST['dato_codigopostal'];
		
	mysqli_select_db($conexion,'$basedatos');
	$sql = "INSERT INTO tb_clientes (nombre, apellido, dni, mail, telefono, calle, numero, localidad, provincia, codigo_postal)
	VALUES ('$nombre', '$apellido', '$dni', '$mail', '$telefono', '$calle', '$numero', '$localidad', '$provincia', '$codigo_postal')";
	mysqli_query($conexion,$sql);    

	$array=array('success'=>'true');
	echo json_encode($array);
		
} //fin else conexion
?>