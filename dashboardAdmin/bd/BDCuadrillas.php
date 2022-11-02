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
$opci = (isset($_POST['opci'])) ? $_POST['opci'] : '';



session_start();
$idArea = $_SESSION["s_idArea"];

        
        		
switch ($opci) {
    case 1://ALTA
        $consulta = "INSERT INTO `$BdNombre`.`cuadrillas` (`nombre`, `id_area`) VALUES ('$nombreCuadrilla', $idArea)";		
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;
    
    case 2://Actualizacion
        $idcuad = (isset($_POST['idcuadrilla'])) ? $_POST['idcuadrilla'] : '';
        

        $consulta = "UPDATE `$BdNombre`.`cuadrillas` SET `nombre`= '$nombreCuadrilla' WHERE `id`='$idcuad'";		
        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}        


    // $consulta ="SELECT nombre FROM `usuarios` WHERE `nombre` = '$nombre'";
    // $resultado = $conexion->prepare($consulta);
    // $resultado->execute();
    // $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
