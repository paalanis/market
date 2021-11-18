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
	$descripcion=utf8_encode($_REQUEST['dato_descripcion']);
	$costo=$_REQUEST['dato_costo'];
	$venta=$_REQUEST['dato_venta'];
	$codigo=$_REQUEST['dato_codigo'];
	$rubro=$_REQUEST['dato_rubro'];
	$pesable=$_REQUEST['dato_pesable'];
	// $club=$_REQUEST['dato_club'];
	$iva=$_REQUEST['dato_iva'];
	// $talle=$_REQUEST['dato_talle'];
		
	mysqli_select_db($conexion,'$basedatos');
	$sql = "INSERT INTO tb_productos (id_iva_condicion, id_rubro, nombre, descripcion, precio_costo, precio_venta, codigo, pesable)
	VALUES ('$iva', '$rubro', '$nombre', '$descripcion', '$costo', '$venta', '$codigo', '$pesable')";
	mysqli_query($conexion,$sql);    

	$array=array('success'=>'true');
	echo json_encode($array);
		
} //fin else conexion
?>