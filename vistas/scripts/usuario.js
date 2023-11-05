 var table;
 //funcion que se ejecuta al inicio
 function init(){
    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);
    })
    //mostramos los permiso
    $.post("../ajax/usuario.php?accion=permisos&id=", function(r){
        $("#permisos").html(r);
    })

 }

 init();