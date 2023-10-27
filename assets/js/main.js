// Autocompletado de libros
$(document).ready(function() {
    id_libros = []; // Arreglo que almacena los id´s de los libros prestados
  
    $('#key').on('keyup', function() {
      var key = $(this).val();		
      var dataString = 'key='+key;
  
      $.ajax({
        type: "POST",
        url: "modules/prestamos/ajax.php",
        data: dataString,
        success: function(response) {
          //Escribimos las sugerencias que nos manda la consulta
          $('#suggestions').fadeIn(1000).html(response);
          $('.suggest-element').on('click', function(){
            var id = $(this).attr('id');
            var titulo = $(this).attr('titulo');
            id_libros.push(id);
  
            let libros_seleccionados = $('#libros-prestamo').html();
            $('#libros-prestamo').html(libros_seleccionados + `<p id-libro='${id}'><i class='fa fa-sm btn-danger btn-remove-book' style='border: 1px; padding: 4px;'>x</i> <i class='fa fa-sm fa-book'></i> ${titulo}</p>`);
            $('#suggestions').fadeOut(1000);
            $("#key").val("");
            return false;
        });
      }
      });
    });
  }); 

// Se previene el redireccionamiento que produce el envío de un formulario.
$("#form").submit(function(e){
    e.preventDefault();
});

/*
Función para visualizar las imágenes de portada de los libros (solo se
puede visualizar cuando se haya subido alguna imagen al server). 
*/
$(document).on('click', '.btn-view', function() {
    var image_name = $(this).attr("image-name");
    $("#image-form").attr("src", "dist/portadas/" + image_name);
});

// ----------------------------------------------------------------------------------------------

/*
A continuación se presentan las funciones que limpian los formularios después de
realizar una inserción y/o modificiación.
*/
// Función limpiar para el formulario de préstamos.
function reset_transaction_data() {
    $("#label_nombre_alumno").text("");
    $("#label_nombre_usuario").text("");
    $("#label_fecha_prestamo").text("");
    $("#label_fecha_entrega").text("");

    $("#lista-libros").html("");    
}

// Función limpiar para el formulario de libros.
function reset_book_data() {
    $("#id_libro").val("");
    $("#titulo_libro").val("");
    $("#id_editorial").val("0").trigger("change");
    $("#id_categoria").val("0").trigger("change");
    $("#unidades_totales").val("");
    $("#image-view").attr("src", "dist/portadas/portada_default.png");
    $(".image-field").attr("hidden", true);
    $("#descripcion").val("");
    $("#estado_libro").val("Activo");
    $("#estado_libro").attr("disabled", true);
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
}

// Función limpiar para el formulario de libros.
function reset_student_data() {    
    $("#id_alumno").val("");
    $("#matricula").val("");
    $("#nombre_alumno").val("");
    $("#semestre").val("1");
    $("#estado_alumno").val("Activo");
    $("#estado_alumno").attr("disabled", true);
    $("#estado_alumno").attr("disabled", true);
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
}

// Función limpiar para el formulario de usuarios.
function reset_user_data() {
    $("#id_usuario").val("");
    $("#rol_usuario").val("Usuario");
    $("#usuario").val("");
    $("#contrasenia").val("");
    $("#nombre_usuario").val("");
    $("#telefono_usuario").val("");
    $("#correo_usuario").val("");
    $("#estado_usuario").val("Activo");
    $("#estado_usuario").attr("disabled", true);
    $("#contrasenia").attr("required", true);
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
}
// ----------------------------------------------------------------------------------------------

/* 
Cuando se presiona el boton .btn-next se captura el módulo (mod) a donde se enviara el registro, 
también se captura la accion (action) para cambiar el tipo de registro entre insercion y/o 
actualización. Mediante el switch se condiciona que datos recolectar del formulario y se hace
una peticion ajax con dichos valores (almacenados en un objeto 'values'), en caso de un 
response exitoso se muestra un sweetalert2 y se refresca la tabla en cuestion.
*/

$(document).on('click', '.btn-next', function() {
    let module = $(this).attr("mod");
    let action = $(this).attr("action");

    let form = document.getElementById("form");
    let formData = new FormData(form);
    formData.append('action', action);
    formData.append('id_libros', id_libros);

    $.ajax({
        url: "modules/" + module + "/model.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response == "") return
            Swal.fire({
                icon: "success",
                title: response,
                showConfirmButton: false,
                timer: 2000
            });
        },
        complete: function() {
            // form.reset();
            table.ajax.reload();
        }
    });
});
// ----------------------------------------------------------------------------------------------

/*
A continuación se presentan las funciones que colocan/remueven los datos de los formularios al 
momento de realizar una edición.
*/
// Función setter para formulario préstamos.
function set_transaction_data(response) {
    let data = JSON.parse(response);

    $("#label_nombre_alumno").text(data.transaccion_data[0].nombre_alumno);
    $("#label_nombre_usuario").text(data.transaccion_data[0].nombre_usuario);
    $("#label_fecha_prestamo").text(data.transaccion_data[0].fecha_prestamo);
    $("#label_fecha_entrega").text(data.transaccion_data[0].fecha_entrega);
    
    var librosData = data.libros_data;
    var listaLibros = $('#lista-libros');
    
    $.each(librosData, function(index, libro) {
        var li = $('<li class="d-inline-flex m-1" style="list-style: none !important;"><span class="bg-warning p-2 rounded"><i class="fa fa-sm fa-book"></i> ' + libro.titulo_libro + '</span></li>');
        listaLibros.append(li);
    });
}

// Función setter para formulario libros.
function set_book_data(response) {
    let data = JSON.parse(response);

    $("#id_libro").val(data[0].id_libro);
    $("#titulo_libro").val(data[0].titulo_libro);
    $("#id_editorial").val(data[0].id_editorial).trigger("change");
    $("#id_categoria").val(data[0].id_categoria).trigger("change");
    $("#unidades_totales").val(data[0].unidades_totales);
    $("#image-view").attr("src", "dist/portadas/" + data[0].imagen_portada);
    $(".image-field").removeAttr("hidden");
    $("#descripcion").val(data[0].descripcion);
    $("#estado_libro").val(data[0].estado_libro);
    $(".btn-next").attr("action", "update");
    $(".btn-next").attr("action", "update");
    $(".btn-next").text("Actualizar");
    $("#estado_libro").removeAttr("disabled");
}

// Función setter para formulario alumnos.
function set_student_data(response) {
    let data = JSON.parse(response);

    $("#id_alumno").val(data[0].id_alumno);
    $("#matricula").val(data[0].matricula);
    $("#nombre_alumno").val(data[0].nombre_alumno);
    $("#semestre").val(data[0].semestre);
    $("#estado_alumno").val(data[0].estado_alumno);
    $(".btn-next").attr("action", "update");
    $(".btn-next").text("Actualizar");
    $("#estado_alumno").removeAttr("disabled");
}

// Función setter para el formulario de usuarios.
function set_user_data(response) {
    let data = JSON.parse(response);
    
    $("#id_usuario").val(data[0].id_usuario);
    $("#rol_usuario").val(data[0].rol_usuario);
    $("#usuario").val(data[0].usuario);
    $("#nombre_usuario").val(data[0].nombre_usuario);
    $("#telefono_usuario").val(data[0].telefono_usuario);
    $("#correo_usuario").val(data[0].correo_usuario);
    $("#estado_usuario").removeAttr("disabled");
    $("#estado_usuario").val(data[0].estado_usuario);
    $("#contrasenia").removeAttr("required");
    $(".btn-next").attr("action", "update");
    $(".btn-next").text("Actualizar");
}

/* 
Cuando se presiona el boton .btn-edit se captura el id del elemento a editar al igual que el
modulo (mod) para saber que tipo de registro se esta editando, posteriormente se hace una
petición ajax al modulo en cuestión donde se espera como response los datos obtenidos del 
id seleccionado, dicho response se envia a una función encargada de colocar los valores en
su respectivo campo de modificación. 
*/
$(document).on('click', '.btn-edit', function() {
    var edit_id = $(this).attr("id");
    var module = $(this).attr("mod");

    $.ajax({
        url: "modules/" + module + "/model.php",
        method: "POST",
        data: {
            edit_id
        },
        success: function(response) {
            switch(module) {
                case 'prestamos':
                    set_transaction_data(response);
                    break;
                case 'libros':
                    set_book_data(response);
                    break;
                case 'alumnos':
                    set_student_data(response);
                    break;
                case 'usuarios':
                    set_user_data(response);
                    break;
            }
        }
    });
});
// ----------------------------------------------------------------------------------------------

/* 
Cuando se presiona el boton .btn-delete se captura el id del elemento a eliminar al igual que el
modulo (mod) para saber que tipo de registro se esta eliminando, posteriormente mediante una
ventana sweetalert2 se solicita confirmación para la baja, en caso positivo se hace una peticion
ajax con los datos obtenidos (id y mod), en caso de que la peticion se realice de forma exitosa
se refresca la tabla y se muestra un mensaje de exito.
*/
$(document).on('click', '.btn-delete', function() {
    var delete_id = $(this).attr("id");
    var module = $(this).attr("mod");

    Swal.fire({
        title: `Esta seguro de eliminar el registro ${delete_id}?`,
        text: 'Esto no se puede revertir!',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "modules/" + module + "/model.php",
                method: "POST",
                data: {
                    delete_id
                },
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: response,
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                complete: function() {
                    table.ajax.reload();
                }
            });
        }
    });
});
// ----------------------------------------------------------------------------------------------

/* 
Cuando se presiona el alguno de los botones .btn-change-grade se captura un id con valor de 1 ó 2
para saber si se desea decrementar o incrementar los semestres respectivamente, posteriormente se
hace una petición ajax para saber si existen registros de 1ero y/o 6to y de ser así cuantos en
total, esto para notificarle al usuario que dichos registros se darán de baja por si desea continuar.
Si continua se vuelve a hacer una petición ajax con el tipo de cambio a efectual (incremento o
decremento). Después se refresca la tabla en cuestión y se muestra una alerta por pantalla.  
*/
$(document).on('click', '.btn-change-grade', function() {
    var action_id = $(this).attr("id");

    $.ajax({
        url: "modules/alumnos/model.php",
        method: "POST",
        data: {
            action_id: action_id
        },
        success: function(response) {
            let data = JSON.parse(response);
            let action_change_semester = data.action;
            let msg = data.msg;

            Swal.fire({
                title: msg,
                text: 'Este cambio se puede revertir únicamente de forma manual!',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "modules/alumnos/model.php",
                        method: "POST",
                        data: {
                            action_change_semester
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: response,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        },
                        complete: function() {
                            table.ajax.reload();
                        }
                    });
                }
            });
        }
    });
});
// ----------------------------------------------------------------------------------------------
