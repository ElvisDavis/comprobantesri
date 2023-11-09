var tabla;
//funcion que se ejecuta al inicio
function init() {
    listar();
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })
}

//creamos una funcion para limpiar
function limpiar() {
    $("#idcontribuyente").val("");
    $("#razonsocial").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#ruc").val("");
    $("#clave").val("");

    
}
//implementamos una fucion para listar las cuentas asociadas
function listar() {
    tabla = $('#tbllistado').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax":
            {
                url: '../ajax/contribuyente.php?accion=listar',
                type: "get",
                dataType: "json",
                error: function (e) {
                    console.log(e.responseText);
                }
            },
            "bDestroy": true,
            "iDisplayLength": 5,//Paginación
            "order": [[0, "desc"]]//Ordenar (columna,orden)
        }).DataTable();
}
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/contribuyente.php?accion=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          //mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}

init();