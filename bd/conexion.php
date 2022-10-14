<?php
 class Conexion{
        
        /** 
         * AMBIENTE DE PRODUCCION
         * COMIENZO!
        **/
        /*
        private $hostname = 'bnmgyrcrc1muus4oltqk-mysql.services.clever-cloud.com';

        private $database = 'bnmgyrcrc1muus4oltqk';

        private $username = 'ueorvctm3zzjaewx';

        private $password = 'sDnNzAVnK32Cv1zlL4UN';

        private $charset = 'utf8';

        function Conectar(){

            try{
                $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset;
                $opciones = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];
    
    
                $conexion = new PDO($conexion, $this->username, $this->password, $opciones);             
                return $conexion; 
            }catch (PDOException $e){
                die("El error de Conexión es :".$e->getMessage());
                exit;
            }         
        }   */
         /** 
         * AMBIENTE DE PRODUCCION
         * FINAL!
        **/

        ///////////////////////////////////////////////////////////////////////////////////////


        /** 
         * AMBIENTE DE PRUEBA
         * COMIENZO!
        **/
    function Conectar(){
        define('servidor','localhost');
        define('nombre_bd','db_siadpe');
        define('usuario','root');
        define('password','');         
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        
        try{
            $conexion = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password, $opciones);             
            return $conexion; 
        }catch (Exception $e){
            die("El error de Conexión es :".$e->getMessage());
        }         
    }
}

    /** 
     * AMBIENTE DE PRUEBA
     * FINAL!
    **/
?>