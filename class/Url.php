<?php
    class Url{
        protected $id; 
        protected $url; 
        protected $tourl;

        public function __construct($row){
            $this->id = $row["id"]; 
            $this->url = $row["url"];
            $this->tourl = $row["tourl"]; 
        }

        public function getId(){ return $this->id; }
        public function getUrl(){ return $this->url; }
        public function getTourl(){ return $this->tourl; }

        public static function dameAcortador($acortador){
            $sql = "SELECT *  FROM url where tourl = '".$acortador."'";
            $resultado = Conexion::ejecutaConsulta($sql); 
            $url = null; 
            if($resultado){
                $url = new Url($resultado->fetch()); 
            }
            return $url;  
        }

        public static function creaUrl($url,$tourl){
            $conexion = Conexion::conecta(); 
            $sql = $conexion->prepare("INSERT INTO url (url, tourl) VALUES (?,?)");
            $sql->bindParam(1,$url); 
            $sql->bindParam(2,$tourl);
            $sql->execute(); 
        }
        public static function eliminaUrl($id){
            $conexion = Conexion::conecta(); 
            $sql = $conexion->prepare("DELETE FROM url WHERE id = ?");
            $sql->bindParam(1,$id); 
            $sql->execute(); 
        }

        public static function creaCodigo($longitud = 5){
            $codigo = '';
            $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVXWYZ';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $codigo .= $pattern{mt_rand(0,$max)};
            return $codigo;
        }

        public static function dameCodigos(){
            $sql = "SELECT tourl FROM url";
            $resultado = Conexion::ejecutaConsulta($sql); 
            $codigos = null; 
            if($resultado){
                $row = $resultado->fetch(); 
                while($row != null){
                    $codigos[] = $row["tourl"];
                    $row = $resultado->fetch(); 
                }
            }
            return $codigos; 
        }

        // Comprueba si existe la URL
        public static function existeUrl( $url = NULL ) {
            if(empty($url)){    return false;}
         
            $options['http'] = array(
                'method' => "HEAD",
                'ignore_errors' => 1,
                'max_redirects' => 0
            );
         
            $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
            
            // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
            if(isset($http_response_header)){
                sscanf($http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode);
         
                // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
                $accepted_response = array(200, 301, 302);
                if(in_array($httpcode,$accepted_response)){
                    return true;
                }else{
                    return false;
                }
             }else{
                 return false;
             }
        }


    }
?>