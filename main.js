
function listar_combo_departamento(idcentro){
    // alert(idcentro);
    $.ajax({
        type: "POST",
        data: {
            idcentro:idcentro
        },
        // url: "controlador/Departamentoselect.php"
        url: "Departamentoselect.php"
    }).done(function(r){
        $('#select2lista').html(r);
    })
}




function listar_combo_box(iddepartamento){
    // alert(iddepartamento);
    $.ajax({
        type: "POST",
        data: {
            iddepartamento:iddepartamento
        },
        // url: "controlador/Departamentoselect.php"
        url: "Boxselect.php"
    }).done(function(r){
        $('#select3lista').html(r);
    })
}


function alerta_eliminar_usuario(idrol){
    if(idrol == 1 ){
        var respuesta = alert("Los usuarios administradores no pueden ser eliminados");
        return false;
    }else if( idrol == 4){
        var respuesta = alert("El super usuario no puede ser eliminado");
        return false;
    }else{
        var respuesta = confirm("Estas seguro que deseas eliminar este usuario ?");

        if(respuesta == true){
            return true;
        }else{
            return false;
        }
    }
}

function alerta_editar_insumo(idinsumo,estado){
    if(estado == 0){
            return true;
    }else{
        var respuest = alert("Este insumo no se puede editar ya que esta dado de baja");
        return false;
    }
}
function alerta_eliminar_insumo(idinsumo,estado){
    if(estado == 0){
            return true;
    }else{
        var respuest = alert("Este insumo ya esta dado de baja");
        return false;
    }
}
function alerta_eliminar_centro(){
    var respuesta = confirm("Estas seguro que deseas eliminar este centro ?");
    if(respuesta == true){
        return true;
    }else{
        return false;
    }
}
function alerta_eliminar_departamento(){
    var respuesta = confirm("Estas seguro que deseas eliminar este departamento ?");
    if(respuesta == true){
        return true;
    }else{
        return false;
    }
}
function alerta_eliminar_box(){
    var respuesta = confirm("Estas seguro que deseas eliminar este box ?");
    if(respuesta == true){
        return true;
    }else{
        return false;
    }
}




