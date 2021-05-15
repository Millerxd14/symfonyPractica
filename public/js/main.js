console.log("Hay alguien aquí con vida?");

function buscarEstudiante(){
    $.ajax({
        type: 'POST',
        url:'/estudiantes/buscarestudiantes',
        data: {nombre: $('#form_nombre').val()},
        success: function(html){
            $('#lista_estudiantes').html(html);
        }
    });
}

function buscarMateria(){
    $.ajax({
        type: 'POST',
        url:'/materias/buscarmaterias',
        data: {nombre: $('#form_nombre').val()},
        success: function(html){
            $('#lista_materias').html(html);
        }
    });
}

function buscarCalificacion(){
    console.log("Hola mundo");
    $.ajax({
        type: 'POST',
        url:'/calificaciones/buscarcalificaciones',
        data: {nombre: $('#form_nombre').val()},
        success: function(html){
            $('#lista_calificaciones').html(html);
        }
    });
}


function eliminarEstudiante(id){
    console.log(id);
    $.ajax({
        type: 'POST',
        url:'/estudiantes/eliminar',
        data: {id: id},
        success: function(){
            location.reload();
        }
    });
}
function eliminarMateria(id){
    $.ajax({
        type: 'POST',
        url:'/materias/eliminar',
        data: {id: id},
        success: function(){
            location.reload();
        }
    });
}


function eliminarCalificacion(id){
    console.log(id);
    $.ajax({
        type: 'POST',
        url:'/calificaciones/eliminar',
        data: {id: id},
        success: function(){
            location.reload();
        }
    });
}



function seleccionarMateria(id){
    $('#estudiante_materia_materia').val(parseInt(id));
}

function seleccionarEstudiante(id){
    $('#estudiante_materia_estudiante').val(parseInt(id));
}

function vaciarCampos(){
    $('#estudiante_materia_estudiante').val("");
    $('#estudiante_materia_materia').val("");
}

function seleccionarEstudianteCalificacion(id, nombre){
    console.log(id,nombre);
    $('#calificaciones_registro_estudiante').val(id);
    $('#calificaciones_registro_nombreEstudiante').val(nombre);
}

function seleccionarMateriaCalificacion(id, nombre){
    console.log(id,nombre);
    $('#calificaciones_registro_materia').val(id);
    $('#calificaciones_registro_nombreMateria').val(nombre);
}