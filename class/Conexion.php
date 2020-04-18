<?php
    class Conexion {
        public static function conecta(){
           $con = ""; 
            $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $dsn = "mysql:host=localhost;dbname=acortador";
            $usuario = 'root';
            $contrasena = '';
            try{
                $con = new PDO($dsn, $usuario, $contrasena, $opc);
            }catch(PDOException $e){
                print $e->getMessage();
            }
            return $con;
        }
        
        public static function ejecutaConsulta($sql) {
	        $conexion=self::conecta();
            if(isset($conexion)){
                $resultado = $conexion->query($sql);
                $conexion = null; 
                return $resultado;
            }else{
                return false;
            }
        }
    }
?>