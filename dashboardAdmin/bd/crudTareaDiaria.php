<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$tipologia = (isset($_POST['tipologia'])) ? $_POST['tipologia'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$cuadrilla = (isset($_POST['cuadrilla'])) ? $_POST['cuadrilla'] : '';
$opci = (isset($_POST['opci'])) ? $_POST['opci'] : '';
//$tareaID = (isset($_POST['tareaID'])) ? $_POST['tareaID'] : '';

$date = date("yyyy-mm-dd", strtotime(now)); 

//$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opci){
    case 1: //alta
        //incert a tabla tarea
        $consulta = "INSERT INTO `db_siadpe`.`tareas` ( `descripcion`, `resolucion`, `fecha_inicio`, `fecha_finalizacion`, `id_jefe`, `id_estado`, `id_tipologia`) VALUES ( '$descripcion', '', '$date', '2022-09-29', '$_SESSION["s_idUsuario"]', '1', '$tipologia')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        //incert a tabla tarea_empleado
        /*
        $consulta = "INSERT INTO `db_siadpe`.`tareas_empleados` ( `id_empleado`, `id_cuadrilla`, `id_tarea`) VALUES ('2', '$cuadrilla', '3')";		//CAMBIAR TODO ESTO	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        */

        //Actualiza el ultimo resultado
        $consulta = "SELECT  Tareas.id AS tarea_ID, Tipologias.id AS tipologia_ID, Tipologias.descripcion AS tipologia, Cuadrillas.id AS cuadrilla_ID, Cuadrillas.nombre AS cuadrilla, Estados.id AS estado_id, Estados.estado, Tareas.descripcion, Tareas.fecha_inicio AS fecha_Ini FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id ORDER BY tarea_ID DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personas SET nombre='$nombre', pais='$pais', edad='$edad' WHERE id='$id' ";		//CAMBIAR TODO ESTO	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, pais, edad FROM personas WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM personas WHERE id='$id' ";		                        //CAMBIAR TODO ESTO, NO ELIMINAR
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
