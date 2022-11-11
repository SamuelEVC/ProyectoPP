<?php
session_start();
unset($_SESSION["s_usuario"]);
unset($_SESSION["Habilitado"]);
unset($_SESSION["s_idRol"]);
unset($_SESSION["s_rol_descripcion"]);
unset($_SESSION["s_idUsuario"]);
unset($_SESSION["s_nombre"]);
unset($_SESSION["s_area"]);
unset($_SESSION["s_idArea"]);
unset($_SESSION["s_idCuadrilla"]);
unset($_SESSION["s_cuadrilla"]);
session_destroy();
header("Location: ../index.php");
?>