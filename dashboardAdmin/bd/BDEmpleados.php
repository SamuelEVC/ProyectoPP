<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//prueba local
$BdNombre = 'db_siadpe';
//Produccion
//$BdNombre = 'bnmgyrcrc1muus4oltqk';


// Recepción de los datos enviados mediante POST desde el JS   
$opci = (isset($_POST['opci'])) ? $_POST['opci'] : '';



switch($opci){
    case 1://ALTA
        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
        $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
        $contraseña = (isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';
        $cuadrilla = (isset($_POST['cuadrilla'])) ? $_POST['cuadrilla'] : '';
        $Pass_md5 = md5($contraseña);
        
        //Insertar en tabla usuarios
        $consulta = "INSERT INTO `$BdNombre`.`usuarios` (`usuario`, `password`, `idRol`, `nombre`, `habilitado`) VALUES ('$usuario', '$Pass_md5', 2, '$nombre ', '1')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        //Saco id del ultimo usuario (el que creamos anteriormente)
        $consulta ="SELECT MAX(id) as maxid FROM `usuarios`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $idusuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $idusuario = $idusuarios[0]['maxid'];

        //Y se utiliza para agregarlo en la tabla de empleados
        $consulta = "INSERT INTO `$BdNombre`.`empleados` ( `id_cuadrilla`, `id_usuario`) VALUES ('$cuadrilla', '$idusuario')";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        //data para corroborar que todo esta OK
        $consulta ="SELECT nombre FROM `usuarios` WHERE `nombre` = '$nombre'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

    case 2://MODIFICACION/BAJA
        $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
        $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
        $idusuario = (isset($_POST['id_user'])) ? $_POST['id_user'] : '';
        $contraseña = (isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';
        $cuadrilla = (isset($_POST['cuadrilla'])) ? $_POST['cuadrilla'] : '';
        $chek = (isset($_POST['check'])) ? $_POST['check'] : '';

        if($contraseña==""){

            $consulta = "UPDATE `$BdNombre`.`usuarios`,`empleados` SET `usuarios`.`usuario`= '$usuario', `usuarios`.`nombre`= '$nombre', `usuarios`.`habilitado`= '$chek', `empleados`.`id_cuadrilla` = '$cuadrilla' WHERE `usuarios`.`id`='$idusuario' and `empleados`.`id_usuario`='$idusuario'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 


        }else{
            $Pass_md5 = md5($contraseña);

            $consulta = "UPDATE `$BdNombre`.`usuarios`,`empleados` SET `usuarios`.`usuario`= '$usuario', `usuarios`.`nombre`= '$nombre',`usuarios`.`password`='$Pass_md5', `usuarios`.`habilitado`= '$chek', `empleados`.`id_cuadrilla` = '$cuadrilla' WHERE `usuarios`.`id`='$idusuario' and `empleados`.`id_usuario`='$idusuario'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 


        }

            $consulta = "UPDATE `empleados` SET `empleados`.`id_cuadrilla`= '$cuadrilla' WHERE `empleados`.`id_usuario`= '$idusuario'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 


    case 3://SOLO CONSULTA
        $id = (isset($_POST['id'])) ? $_POST['id'] : '';

        $consulta="SELECT `usuarios`.`usuario`, `usuarios`.`nombre`, `usuarios`.`habilitado`, `empleados`.`id` AS `id_empleado`, `empleados`.`id_cuadrilla`, `usuarios`.`id` AS `id_usuario` FROM `usuarios` LEFT JOIN `empleados` ON `empleados`.`id_usuario` = `usuarios`.`id` WHERE `empleados`.`id` IS NOT NULL AND `usuarios`.`id`= $id";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
