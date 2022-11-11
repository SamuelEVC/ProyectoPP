<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$tareaID = (isset($_POST['tareaID'])) ? $_POST['tareaID'] : '';
$opci = (isset($_POST['opci'])) ? $_POST['opci'] : '';


switch($opci){
    case 1: //all
        $consultaCuad = "SELECT t.descripcion as Descripcion, ti.descripcion as Tipologia, est.estado as Estados, cua.nombre as Cuadrilla, t.resolucion as Resolucion, t.fecha_inicio as Fecha_Ini, t.fecha_finalizacion as Fecha_Fin, usu.nombre as Nombre_Jefe, ar.nombre as Area from tareas as t

        inner join tipologias as ti 
        on t.id_tipologia = ti.id
        inner join estados as est
        on t.id_estado = est.id
        inner join tareas_empleados as tem
        on t.id = tem.id_tarea
        inner join cuadrillas as cua
        on tem.id_cuadrilla = cua.id
        inner join jefes as je
        on t.id_jefe = je.id
        inner join usuarios as usu
        on je.id_usuario = usu.id
        inner join areas as ar
        on je.id_area = ar.id
        
        where t.id = $tareaID
        group by  t.descripcion, ti.descripcion, est.estado, cua.nombre, t.resolucion, t.fecha_inicio, t.fecha_finalizacion, usu.nombre, ar.nombre
        order by t.id";

        $resultadoCuad = $conexion->prepare($consultaCuad);
        $resultadoCuad->execute();
        $data=$resultadoCuad->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //empleados
        //$consultaCuad = "SELECT usu.nombre from empleadosinner join tareas_empleados as taEm on empleados.id_cuadrilla = taEm.id_cuadrilla inner join usuarios as usu on empleados.id_usuario = usu.id where taEm.id_tarea = $tareaID and usu.habilitado = 1 group by usu.nombre";

        $consultaCuad = "SELECT te.id_empleado, usu.nombre 
        FROM tareas_empleados AS te 
        
        INNER JOIN empleados AS e 
        ON te.id_empleado = e.id
        
        INNER JOIN usuarios AS usu
        ON e.id_usuario = usu.id
        WHERE te.id_tarea = $tareaID ";//and usu.habilitado = 1


        $resultadoCuad = $conexion->prepare($consultaCuad);
        $resultadoCuad->execute();
        $data=$resultadoCuad->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
