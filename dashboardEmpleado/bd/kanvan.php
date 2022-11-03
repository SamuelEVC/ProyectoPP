<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

//prueba local
$BdNombre = 'db_siadpe';
//Produccion
//$BdNombre = 'bnmgyrcrc1muus4oltqk';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['tareaID'])) ? $_POST['tareaID'] : '';
$Resolucion = (isset($_POST['Resolucion'])) ? $_POST['Resolucion'] : '';


$date = date('y-m-d'); 

$data=null;

switch($opcion){
    case 1: //Pendiente

        $consulta = "SELECT tareas.id_estado FROM `tareas` WHERE tareas.id = $id";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $idestado = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $estado = $idestado[0]['id_estado'];

        if($estado != 1){        
            $consulta = "UPDATE `tareas` SET `id_estado` = '1' WHERE `tareas`.`id` = $id";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        
            //SETEO EN BLANCO A FECHA FINAL Y A RESOLUCION 
            $consulta = "SELECT tareas.fecha_finalizacion FROM `tareas` WHERE tareas.id = $id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $fechaFinas = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $fechaFinal = $fechaFinas[0]['fecha_finalizacion'];

            if($fechaFinal != 'NULL'){ 


                $consulta = "UPDATE `tareas` SET `fecha_finalizacion` = NULL WHERE `tareas`.`id` = $id";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }

            $consulta = "SELECT tareas.resolucion as Res FROM `tareas` WHERE tareas.id = $id";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $resolus = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
                $res = $resolus[0]['Res'];
    
            if($res != ''){ 
    
    
                $consulta = "UPDATE `$BdNombre`.`tareas` SET `resolucion` = '' WHERE `tareas`.`id` = $id";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }
        }        


        break;

    case 2: //Proceso
        $consulta = "SELECT tareas.id_estado FROM `tareas` WHERE tareas.id = $id";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $idestado = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $estado = $idestado[0]['id_estado'];

        if($estado != 2){
            $consulta = "UPDATE `tareas` SET `id_estado` = '2' WHERE `tareas`.`id` = $id";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            
            //SETEO EN BLANCO A FECHA FINAL Y A RESOLUCION 
            $consulta = "SELECT tareas.fecha_finalizacion FROM `tareas` WHERE tareas.id = $id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $fechaFinas = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $fechaFinal = $fechaFinas[0]['fecha_finalizacion'];

            if($fechaFinal != 'NULL'){ 


                $consulta = "UPDATE `tareas` SET `fecha_finalizacion` = NULL WHERE `tareas`.`id` = $id";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }


            $consulta = "SELECT tareas.resolucion as Res FROM `tareas` WHERE tareas.id = $id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $resolus = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $res = $resolus[0]['Res'];

            if($res != ''){ 


                $consulta = "UPDATE `$BdNombre`.`tareas` SET `resolucion` = '' WHERE `tareas`.`id` = $id";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
            }


        }    
            
            
        break;      

    case 3://Finalizado
        $consulta = "SELECT tareas.id_estado FROM `tareas` WHERE tareas.id = $id";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $idestado = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $estado = $idestado[0]['id_estado'];

        if($estado != 3){ 
            $consulta = "UPDATE `tareas` SET `id_estado` = '3' WHERE `tareas`.`id` = $id";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();     

            
            $consulta = "SELECT tareas.fecha_finalizacion FROM `tareas` WHERE tareas.id = $id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $fechaFinas = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $fechaFinal = $fechaFinas[0]['fecha_finalizacion'];

            if($fechaFinal == NULL){ 


                $consulta = "UPDATE `tareas` SET `fecha_finalizacion` = '$date' WHERE `tareas`.`id` = $id";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();

            }

            $consulta = "UPDATE `$BdNombre`.`tareas` SET `resolucion` = '$Resolucion' WHERE `tareas`.`id` = $id";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            


        }
        break;         
    case 4://Editar

        $consulta = "UPDATE `$BdNombre`.`tareas` SET `resolucion` = '$Resolucion' WHERE `tareas`.`id` ='$id' ;";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();    
        
        break;         
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
