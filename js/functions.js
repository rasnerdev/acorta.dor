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
                },
                success: function(data){
                    if(data.success){
                        $("input[name=recibida]").val("http://localhost/acortador/"+data.short);
                        $("#resultado").slideDown( "slow", function() {});
                    }else{
                        $("#formurl").effect("bounce", {times:3}, 300);
                    }
                }
            });
        }
    })
})
