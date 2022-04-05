
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


    if(idrol == 1){
        var respuesta = confirm("Los usuarios administradores no pueden ser eliminados");
        return false;
    }else{
        var respuesta = confirm("Estas seguro que deseas eliminar al usuario ?");

        if(respuesta == true){
            return true;
        }else{
            return false;
        }
    }
    
}

