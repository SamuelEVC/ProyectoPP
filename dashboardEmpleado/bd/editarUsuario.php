<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//prueba local
$BdNombre = 'db_siadpe';
//Produccion
//$BdNombre = 'bnmgyrcrc1muus4oltqk';

session_start();
$UsuarioName = $_SESSION["s_usuario"];
$Usuarioid = $_SESSION["s_idUsuario"];

// Recepción de los datos enviados mediante POST desde el JS   
$OldPassword = (isset($_POST['OldPassword'])) ? $_POST['OldPassword'] : '';
$NewPassword = (isset($_POST['NewPassword'])) ? $_POST['NewPassword'] : '';


$oldPass_md5 = md5($OldPassword);
$newPass_md5 = md5($NewPassword);

$consulta = "SELECT usuarios.id AS idUsuario, usuarios.nombre AS nombreUsuario 
FROM 
usuarios 
WHERE usuario='$UsuarioName' AND password='$oldPass_md5' ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

if($resultado->rowCount() >= 1){
    $consulta = "UPDATE `$BdNombre`.`usuarios` SET `password` = '$newPass_md5' WHERE `usuarios`.`id` = '$Usuarioid' ;";		
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
}else{
    $data=null;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
