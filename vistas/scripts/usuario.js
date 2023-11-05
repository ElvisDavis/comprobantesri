var table;
//funcion que se ejecuta al inicio
function init() {
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })
    //mostramos los permiso
    $.post("../ajax/usuario.php?accion=permisos&id=", function (r) {
        $("#permisos").html(r);
    })

}

//implementamos una funcion para lipiar el formulrio

function limpiar() {
    $("#nombre").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#clave").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#idusuario").val("");

}

//funcion para mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
    }
}

//Funcion cancelarform
function cancelarform() {
    limpiar();
   

}

//funcion listar
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
                url: '../ajax/usuario.php?accion=listar',
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
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuario.php?accion=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}
function mostrar(idusuario) {
    $.post("../ajax/usuario.php?op=mostrar", { idusuario: idusuario }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#nombre").val(data.nombre);
        $("#telefono").val(data.telefono);
        $("#direccion").val(data.direccion);
        $("#email").val(data.email);
        $("#clave").val(data.clave);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/usuarios/" + data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#idusuario").val(data.idusuario);

    });
    $.post("../ajax/usuario.php?accion=permisos&id=" + idusuario, function (r) {
        $("#permisos").html(r);
    });
}

//Función para desactivar registros
function desactivar(idusuario) {
    bootbox.confirm("¿Está Seguro de desactivar el usuario?", function (result) {
        if (result) {
            $.post("../ajax/usuario.php?acccion=desactivar", { idusuario: idusuario }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idusuario) {
    bootbox.confirm("¿Está Seguro de activar el Usuario?", function (result) {
        if (result) {
            $.post("../ajax/usuario.php?accion=activar", { idusuario: idusuario }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();