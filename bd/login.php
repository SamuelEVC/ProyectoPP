<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

/*
$consultaGeneral = "SELECT usuarios.id AS idUsuario, usuarios.idRol AS idRol, roles.descripcion AS rol, usuarios.nombre AS nombreUsuario, Areas.nombre
FROM 

usuarios JOIN roles ON usuarios.idRol = roles.id 


inner join jefes on usuarios.id = jefes.id_usuario
inner join areas  on jefes.id_area = areas.id

inner join empleados on usuarios.id = empleados.id_usuario
inner join cuadrillas on empleados.id_cuadrilla = cuadrillas.id
inner join areas  on cuadrillas.id_area = areas.id
";*/


/*
$ConsultaRol = "SELECT  roles.descripcion AS rol
FROM 
usuarios JOIN roles ON usuarios.idRol = roles.id 
WHERE usuarios.usuario='$usuario' AND usuarios.password='$pass' ";
$resultado = $conexion->prepare($ConsultaRol);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$rol=$data[0]["rol"];*/




$consulta = "SELECT usuarios.id AS idUsuario, usuarios.idRol AS idRol, roles.descripcion AS rol, usuarios.nombre AS nombreUsuario 
FROM 
usuarios JOIN roles ON usuarios.idRol = roles.id 
WHERE usuario='$usuario' AND password='$pass' ";
//$Consulta = "SELECT  roles.descripcion AS rol FROM usuarios JOIN roles ON usuarios.idRol = roles.id WHERE usuarios.usuario='$usuario' AND usuarios.password='$pass'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);





if($resultado->rowCount() >= 1){
    $rol = $data[0]["rol"];
    

    if($rol  == 'admin'){
        $consultaGeneral = "SELECT usuarios.id AS idUsuario, usuarios.idRol AS idRol, roles.descripcion AS rol, usuarios.nombre AS nombreUsuario, Areas.nombre As area
        FROM 
        usuarios JOIN roles ON usuarios.idRol = roles.id 

        inner join jefes on usuarios.id = jefes.id_usuario
        inner join areas  on jefes.id_area = areas.id
        WHERE usuario='$usuario' AND password='$pass' ";

        $resultado = $conexion->prepare($consultaGeneral);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        

        $_SESSION["s_idUsuario"] = $data[0]["idUsuario"];
        $_SESSION["s_usuario"] = $usuario;
        $_SESSION["s_nombre"] = $data[0]["nombreUsuario"];
        $_SESSION["s_idRol"] = $data[0]["idRol"];
        $_SESSION["s_rol_descripcion"] = $data[0]["rol"];
        $_SESSION["s_area"] = $data[0]["area"];
        
    }elseif($rol  == 'empleado'){
        $consultaGeneral = "SELECT usuarios.id AS idUsuario, usuarios.idRol AS idRol, roles.descripcion AS rol, usuarios.nombre AS nombreUsuario, Areas.nombre As area, Cuadrillas.id as idCuadrilla,  Cuadrillas.nombre as Cuadrilla
        FROM usuarios JOIN roles ON usuarios.idRol = roles.id 

        inner join empleados on usuarios.id = empleados.id_usuario
        inner join cuadrillas on empleados.id_cuadrilla = cuadrillas.id
        inner join areas  on cuadrillas.id_area = areas.id
        WHERE usuario='$usuario' AND password='$pass' ";

        $resultado = $conexion->prepare($consultaGeneral);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION["s_idUsuario"] = $data[0]["idUsuario"];
        $_SESSION["s_idCuadrilla"] = $data[0]["idCuadrilla"];
        $_SESSION["s_cuadrilla"] = $data[0]["Cuadrilla"];
        $_SESSION["s_usuario"] = $usuario;
        $_SESSION["s_nombre"] = $data[0]["nombreUsuario"];
        $_SESSION["s_idRol"] = $data[0]["idRol"];
        $_SESSION["s_rol_descripcion"] = $data[0]["rol"];
        $_SESSION["s_area"] = $data[0]["area"];
    }



}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}



print json_encode($data);
$conexion=null;

//usuarios de pruebaen la base de datos
//usuario:admin pass:12345
//usuario:demo pass:demo