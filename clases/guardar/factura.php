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

	
	$cliente=$_REQUEST['dato_cliente'];
	$sucursal=$_REQUEST['dato_sucursal'];
	$factura=$_REQUEST['dato_factura'];
	$condicion=$_REQUEST['dato_condicion'];
	$cupon=$_REQUEST['dato_cupon'];
	
	$cierre = $_SESSION['cierre'];
			
	mysqli_select_db($conexion,'$basedatos');
	$sql = "INSERT IGNORE INTO tb_existencias(
       id_productos, 
       cantidad)
	SELECT
		tb_ventas.id_productos,
		tb_ventas.cantidad*-1
	FROM tb_ventas
	WHERE
	tb_ventas.id_sucursal = '$sucursal' AND tb_ventas.numero_factura = '$factura' AND tb_ventas.estado = '0' and tb_ventas.id_cierre = '$cierre'
	ON DUPLICATE KEY UPDATE tb_existencias.cantidad = tb_existencias.cantidad+(tb_ventas.cantidad*-1)";
	mysqli_query($conexion,$sql);    

	mysqli_select_db($conexion,'$basedatos');
	$sql = "UPDATE tb_ventas SET tb_ventas.estado = '1', tb_ventas.cupon = '$cupon', tb_ventas.id_condicion_venta = '$condicion' WHERE tb_ventas.estado = '0' AND tb_ventas.id_cierre = '$cierre' AND tb_ventas.id_sucursal = '$sucursal' AND tb_ventas.numero_factura = '$factura' AND tb_ventas.id_clientes = '$cliente'";
	mysqli_query($conexion,$sql); 

	$array=array('success'=>'true', 'tipo'=>'ticket');
	echo json_encode($array);
		
} //fin else conexion
?>