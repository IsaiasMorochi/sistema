var tabla;

//FUncion que se ejecuta al inicio
function init(){


}

function limpiar() {
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}

//Funcion mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);

    }else{
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }
}

//FUncion  cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);

}

//funcion listar
function listar() {
    tabla = $("#tbllistado").dataTable({
        "aProcessing" : true; //Activamos el procesamiento del datatable
        "aServerSide": true; // Paginaicon y filtrado realizados por el servidor
        dom : 'Bfrtip', //Definimos los elemnetos del control de tabla
        buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                ],
        "ajax":
            {
                    url: '../ajax/categoria.php?op=listar',
                    type : "get",
                    dataType : "json",
                    error: function (e) {
                    console.log(e.responseText);
                    }
             }
    }).DataTable();
}

init();