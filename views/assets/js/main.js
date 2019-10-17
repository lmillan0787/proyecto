$('.FormularioAjax').submit(function(e) {
    e.preventDefault();

    var form = $(this);

    var tipo = form.attr('data-form');
    var accion = form.attr('action');
    var metodo = form.attr('method');
    var respuesta = form.children('.RespuestaAjax');

    var msjError = "<script>swal.fire('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
    var formdata = new FormData(this);


    var textoAlerta;
    if (tipo === "guardar") {
        textoAlerta = "Los datos que enviaras quedaran almacenados en el sistema";
    } else if (tipo === "borrar") {
        textoAlerta = "Los datos serán eliminados completamente del sistema";
    } else if (tipo === "actualizar") {
        textoAlerta = "Los datos del sistema serán actualizados";
    } else {
        textoAlerta = "Quieres realizar la operación solicitada";
    }


    Swal.fire({
        title: "¿Estás seguro?",
        text: textoAlerta,
        type: "question",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
    }).then((result) => 
    {if (result.value) {
        $.ajax({
            type: metodo,
            url: accion,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,            
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if (percentComplete < 100) {
                            respuesta.html('<p class="text-center">Procesado... (' + percentComplete + '%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: ' + percentComplete + '%;"></div></div>');
                        } else {
                            respuesta.html('<p class="text-center"></p>');
                        }
                    }
                }, false);
                return xhr;
            },
            success: function(data) {
                respuesta.html(data);
            },
            error: function() {
                respuesta.html(msjError);
            }
        });  
    }
  })
    
    
});
// Tablas

$(document).ready(function() {
    $('#tabla').DataTable({
        searching: true,
        ordering: true,
        paging: true,
        language: idioma,
        deferRender: true,
        scroller: false,
        responsive: true,


    });

    $('.dataTables_length').addClass('bs-select');

});
var idioma = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}