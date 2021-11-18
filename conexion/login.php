<?php
session_start();
$sesion_actual=session_id();
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
if (isset($usuario) && isset($pass)) {
include 'conexion.php';
$sqlusuario = "SELECT
			tb_usuarios.id_usuario AS id_usuario,
			tb_usuarios.nombre AS usuario,
			tb_usuarios.data_base AS basedatos,
			tb_usuarios.tipo_user AS tipo_user,
			tb_usuarios.estado AS estado
			FROM
			tb_usuarios
			WHERE
            tb_usuarios.nombre = '$usuario' AND
            tb_usuarios.pass = '$pass'";
$rsusuario = mysqli_query($conexion, $sqlusuario);            
if (mysqli_num_rows($rsusuario) > 0) {
$sql_usuario = mysqli_fetch_array($rsusuario);
$tipo_user= $sql_usuario['tipo_user'];
$basedatos= $sql_usuario['basedatos'];
$usuario= $sql_usuario['usuario'];
$id_usuario= $sql_usuario['id_usuario'];
$sesion_anterior= $sql_usuario['estado'];

 //Obtiene la IP del cliente
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


$impresora = get_client_ip();

switch ($impresora) {
	case '192.168.1.102':
		$_SESSION['puesto']="192.168.1.104";
		break;
	case '192.168.1.103':
		$_SESSION['puesto']="192.168.1.105";
		break;
	default:
		$_SESSION['puesto']="192.168.1.105";
		break;
}

$_SESSION['ipcliente']=$impresora;
$_SESSION['usuario']=$usuario;
$_SESSION['tipo_user']=$tipo_user;
$_SESSION['basedatos']=$basedatos;
$_SESSION['id_usuario']=$id_usuario;
$_SESSION['autoriza']='18072019';

if (session_id()) {
    session_commit();
}

// 2. store current session id
session_start();
$current_session_id = session_id();
session_commit();

// 3. hijack then destroy session specified.
session_id($sesion_anterior);
session_start();
session_destroy();
session_commit();

// 4. restore current session id. If don't restore it, your current session will refer to the session you just destroyed!
session_id($current_session_id);
session_start();
session_commit();

mysqli_select_db($conexion,'$basedatos');
$sql = "UPDATE tb_usuarios 
SET estado = '$sesion_actual'
WHERE tb_usuarios.id_usuario = '$id_usuario'";
mysqli_query($conexion,$sql);    

header("Location: ../index2.php");
}
else{header("Location: ../indexerror.php");}
}
?>