<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//prueba local
$BdNombre = 'db_siadpe';
//Produccion
//$BdNombre = 'bnmgyrcrc1muus4oltqk';



// Recepción de los datos enviados mediante POST desde el JS   
$nombreCuadrilla = (isset($_POST['nombreCuadrilla'])) ? $_POST['nombreCuadrilla'] : '';



session_start();
$idArea = $_SESSION["s_idArea"];

        
        		
        
        $consulta = "INSERT INTO `$BdNombre`.`cuadrillas` (`nombre`, `id_area`) VALUES ('$nombreCuadrilla', $idArea)";		
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


    // $consulta ="SELECT nombre FROM `usuarios` WHERE `nombre` = '$nombre'";
    // $resultado = $conexion->prepare($consulta);
    // $resultado->execute();
    // $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
