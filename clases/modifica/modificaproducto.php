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

	$id=$_REQUEST['dato_id'];
	$iva=$_REQUEST['dato_iva'];
	$rubro=$_REQUEST['dato_rubro'];
	$nombre=utf8_encode($_REQUEST['dato_nombre']);
	$descripcion=utf8_encode($_REQUEST['dato_descripcion']);
	$costo=$_REQUEST['dato_costo'];
	$venta=$_REQUEST['dato_venta'];
	$codigo=$_REQUEST['dato_codigo'];
	$pesable=$_REQUEST['dato_pesable'];
			
	mysqli_select_db($conexion,'$basedatos');
	$sql = "UPDATE tb_productos 
			SET id_iva_condicion = '$iva',
			id_rubro = '$rubro',
			nombre = '$nombre',
			descripcion = '$descripcion',
			precio_costo = '$costo',
			precio_venta = '$venta',
			codigo = '$codigo',
			pesable = '$pesable'
			WHERE tb_productos.id_productos = '$id'";
	mysqli_query($conexion,$sql);    


	$array=array('success'=>'true', 'tipo'=>'ticket');
	echo json_encode($array);
		
} //fin else conexion
?>