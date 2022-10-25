<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//prueba local
$BdNombre = 'db_siadpe';
//Produccion
//$BdNombre = 'bnmgyrcrc1muus4oltqk';



// Recepción de los datos enviados mediante POST desde el JS   
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$contraseña = (isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';
$cuadrilla = (isset($_POST['cuadrilla'])) ? $_POST['cuadrilla'] : '';




$Pass_md5 = md5($contraseña);


        $consulta = "INSERT INTO `$BdNombre`.`usuarios` (`usuario`, `password`, `idRol`, `nombre`, `habilitado`) VALUES ('$usuario', '$Pass_md5', 2, '$nombre ', '1')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        //Saco id de la ultima tarea
        $consulta ="SELECT MAX(id) as maxid FROM `usuarios`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $idusuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $idusuario = $idusuarios[0]['maxid'];
                


        $consulta = "INSERT INTO `$BdNombre`.`empleados` ( `id_cuadrilla`, `id_usuario`) VALUES ('$cuadrilla', '$idusuario')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


    $consulta ="SELECT nombre FROM `usuarios` WHERE `nombre` = '$nombre'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
