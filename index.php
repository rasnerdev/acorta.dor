<?php
    require_once("./class/Url.php"); 
    require_once("./class/Conexion.php"); 
    
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
    <link rel="stylesheet" href="/acorta.dor/css/estilo.css">
    <title>Acorta.dor</title>
</head>
<body>
    <?php
        require_once("./includes/header.php");
        require_once("./includes/home.php");
        require_once("./includes/footer.php");
    ?>
    <script type="text/javascript" src="/acorta.dor/js/functions.js"></script>
</body>
</html>
