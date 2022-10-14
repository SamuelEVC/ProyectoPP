<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

//prueba local
$BdNombre = 'db_siadpe';
//Produccion
//$BdNombre = 'bnmgyrcrc1muus4oltqk';


session_start();
$idUsuario = $_SESSION["s_idUsuario"];

$tipologia = (isset($_POST['tipologia'])) ? $_POST['tipologia'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$cuadrilla = (isset($_POST['cuadrilla'])) ? $_POST['cuadrilla'] : '';
$opci = (isset($_POST['opci'])) ? $_POST['opci'] : '';
$tareaID = (isset($_POST['tareaID'])) ? $_POST['tareaID'] : '';


$date = date('y-m-d'); 
//$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opci){
    case 1: //alta
        //Saca al Jefe
        $consulta ="SELECT Jefes.id  FROM  Jefes INNER JOIN Usuarios ON Jefes.id_usuario = Usuarios.id  WHERE Usuarios.id = '$idUsuario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $nombreUsers = $resultado->fetchAll(PDO::FETCH_ASSOC);

        /*
        foreach($nombreUsers as $dat12) {//si alguien que sabe de PHP ve esto, contratara al mejor sicario para acabar conmigo
            $UserID = $dat12['id'];
        }
        */
        $UserID = $nombreUsers[0]['id'];




        //Incert en tabla tareas
        $consulta = "INSERT INTO `$BdNombre`.`tareas` ( `descripcion`, `resolucion`, `fecha_inicio`,  `id_jefe`, `id_estado`, `id_tipologia`) VALUES ( '$descripcion', '', '$date', '$UserID', 1, '$tipologia')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        //Saco id de la ultima tarea
        $consulta ="SELECT MAX(id) as maxid FROM `tareas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $idtareas = $resultado->fetchAll(PDO::FETCH_ASSOC);

        /*
        foreach($idtareas as $dat123) {//si alguien que sabe de PHP ve esto, contratara al mejor sicario para acabar conmigo
            $idtarea = $dat123['maxid'];
        }*/

        $idtarea = $idtareas[0]['maxid'];



        //Busco los empleados la cuadrilla que paso por el metodo POST
        $nombresCuadr ="SELECT Empleados.id AS EmpleadoID FROM Cuadrillas INNER JOIN Empleados ON Cuadrillas.id = Empleados.id_cuadrilla INNER JOIN  Usuarios ON Empleados.id_usuario = Usuarios.id WHERE Cuadrillas.id = $cuadrilla";
        $resultado = $conexion->prepare($nombresCuadr);
        $resultado->execute();
        $nombresCuadrdia = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        

        //incert a tabla tarea_empleado
        foreach($nombresCuadrdia as $dat) {
            $idEmpleado = $dat['EmpleadoID'];
            

            $consulta = "INSERT INTO `$BdNombre`.`tareas_empleados` ( `id_empleado`, `id_cuadrilla`, `id_tarea`) VALUES ( '$idEmpleado','$cuadrilla', '$idtarea')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

        }
        
        //Actualiza el ultimo resultado  NO SE USA
        $consulta = "SELECT  Tareas.id AS tarea_ID, Tipologias.id AS tipologia_ID, Tipologias.descripcion AS tipologia, Cuadrillas.id AS cuadrilla_ID, Cuadrillas.nombre AS cuadrilla, Estados.id AS estado_id, Estados.estado, Tareas.descripcion, Tareas.fecha_inicio AS fecha_Ini FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id ORDER BY tarea_ID DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
       
    case 2: //modificación
        
        $consulta = "UPDATE `$BdNombre`.`tareas` SET `descripcion` = '$descripcion', `id_tipologia` = '$tipologia' WHERE `tareas`.`id` ='$tareaID' ;";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        

        
        //borro empleados viejos
        $consulta = "DELETE FROM `$BdNombre`.`tareas_empleados` WHERE `tareas_empleados`.`id_tarea` = $tareaID";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        //acomodo la autoincrementalidad
        $consulta = "ALTER TABLE `tareas_empleados` AUTO_INCREMENT=1";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        //empleados nuevos
        $nombresCuadr ="SELECT Empleados.id AS EmpleadoID FROM Cuadrillas INNER JOIN Empleados ON Cuadrillas.id = Empleados.id_cuadrilla INNER JOIN  Usuarios ON Empleados.id_usuario = Usuarios.id WHERE Cuadrillas.id = $cuadrilla";
        $resultado = $conexion->prepare($nombresCuadr);
        $resultado->execute();
        $nombresCuadrdia = $resultado->fetchAll(PDO::FETCH_ASSOC);
        

        //incert a tabla tarea_empleado
        foreach($nombresCuadrdia as $dat) {
            $idEmpleado = $dat['EmpleadoID'];
            

            $consulta = "INSERT INTO `$BdNombre`.`tareas_empleados` ( `id_empleado`, `id_cuadrilla`, `id_tarea`) VALUES ( '$idEmpleado','$cuadrilla', '$tareaID')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

        }



        $consulta ="SELECT MAX(id) as maxid FROM `tareas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
        break;       
    case 3://baja

        //borro de la tabla tareas epleados
        $consulta = "DELETE FROM `$BdNombre`.`tareas_empleados` WHERE `tareas_empleados`.`id_tarea` = $tareaID";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
         //seteo el numero de finalas en el correspondiente
        $consulta = "ALTER TABLE `tareas_empleados` AUTO_INCREMENT=1";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        //borro de la tabla tareas
        $consulta = "DELETE FROM `$BdNombre`.`tareas` WHERE `tareas`.`id` = $tareaID";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  

        //seteo el numero de finalas en el correspondiente
        $consulta = "ALTER TABLE `tareas` AUTO_INCREMENT=1";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;        
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
