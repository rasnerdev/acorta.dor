<?php
// Clases necesarias.
require_once("./class/Url.php"); 
require_once("./class/Conexion.php"); 
    
//Controladores
    if(!empty($_GET["url"])){
        $acortador = $_GET["url"];
        Header("Location:".Url::dameAcortador($acortador)->getUrl());
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/acortador/css/estilo.css">
    <title>Acorta.dor</title>
</head>
<body>
    <?php
        require_once("./includes/header.php");
        require_once("./includes/home.php");
        require_once("./includes/footer.php");
    ?>
    <script>
        $(function(){

            $(".copy").click(function(){
                var copyText = document.getElementById("recibida");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                 $(".mensaje").slideDown( "fast", function() { });
            })
            $("form#acorta").submit(function(evt){
                evt.preventDefault();
                var url = $("input[name=url]").val(); 
                var msg = true;
                if(url.length < 0){
                    msg = "El campo no puede ir vacío";
                }
		        var parametros = {
			        "url" : url
		        };
                if(msg != ''){
                    $.ajax({
                        data: parametros, 
                        url:   '/acortador/process/valida.php',
                        type:  'POST', 
                        dataType : 'json',
                        beforeSend: function(){
                            // Antes de enviar..
                        },
                        success: function(data){
                            // enviado
                            if(data.success){
                                $("input[name=recibida]").val("http://localhost/acortador/"+data.short);
                            $( "#resultado" ).slideDown( "slow", function() {
                              });
                            }else{
                                $("#formurl").effect("bounce", {times:3}, 300);
                            }
    	                }
                    });
                }
            })
        })
    </script>
</body>
</html>