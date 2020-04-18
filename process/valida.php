<?php
    $requestStatus = true;
    require_once("../class/Url.php"); 
    require_once("../class/Conexion.php"); 

    // Validamos los datos recibidos
    if(empty($_POST)){
        $requestStatus = false;
    }else{
        if(!empty($_POST["url"])){
            $url_recibida = $_POST["url"];
            if(!Url::existeUrl($url_recibida)){
                $requestStatus = false; 
            }
        }else{
            $requestStatus = false; 
        }
    }

    // Tomamos una acción u otra dependiendo del estado
    if($requestStatus){
        // Creamos un código
        $codigos = Url::dameCodigos();
        $toUrl = ''; 

        $estado = false;
        // Creamos un código válido
        while($estado == false){
            $toUrl = Url::creaCodigo();
            if(!in_array($toUrl, $codigos)){
                $estado = true; 
            }
        }

        Url::creaUrl($url_recibida,$toUrl);
        // Devolvemos al usuario el código de la URL
        $json["short"] = $toUrl;
        $json["success"] = true;
    }else{
        $json["sucess"] = false; 
    }


    
    header('Content-Type: application/json');
    echo json_encode($json);

?>