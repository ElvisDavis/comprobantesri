var tabla;
//funcion que se ejecuta al inicio
function init(){
    listar();
    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);
    })
}