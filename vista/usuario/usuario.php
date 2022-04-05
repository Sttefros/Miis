<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
            
                 <!-- validacion si existe la sesion error login  -->
                 <?php if(isset($_SESSION['error_registro'])): ?>
                        <div class="alerta alerta-registrar">
				            <b><?=$_SESSION['error_registro'];?></b>
			            </div>
		        <?php endif; ?>
<!-- CAJA PRINCIPAL -->
<div class="container"> 
    <h1 ><?php echo $data["titulo"]?></h1>
   

            <div class="table-responsive table-primary ">
                <table cellpadding="0" cellspacing="0"  border="0" class="table table-bordered table-responsive table-hover table-hover" id="table_user">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>correo</th>
                            <th>rut</th>
                            <th> telefono </th>
                            <th>rol</th>
                            <?php 
                                    if(isset($_SESSION['administrador'])){
                                ?>
                                    <th >acciones</th>
                            <?php
                                    }
                                ?>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            if(isset($data["usuario"])){
                            foreach ($data["usuario"] as $dato){
                            ?>
                            <tr id="tr">
                                <td> <?php echo $dato['id_usuario'];?> </td>
                                <td> <?php echo $dato['correo'];?> </td>
                                <td> <?php echo $dato['rut'];?> </td>
                                <td> <?php echo $dato['telefono'];?> </td>
                                <td> <?php echo $dato['rol'];?> </td>
                                <?php 
                                    if(isset($_SESSION['administrador'])){
                                ?>
                                    <td>
                                        <a   href='index.php?c=usuario&a=modificar&id=<?php echo $dato["id_usuario"]?>' ><button class='btn-edit' ><i class='bx bx-edit'></i> </button> </a> 
                                        <a  href='index.php?c=usuario&a=eliminar&id=<?php echo $dato["id_usuario"]?>' ><button class='btn-delete' onClick='return alerta_eliminar_usuario(<?php echo $dato["id_rol"]?>)'> <i class='bx bx-trash'></i></button> </a>
                                    </td>
                            
                                <?php
                                    }
                                ?>
                            </tr>
                            <?php
                            }}else{
                                echo "";
                            }
                            ?>
                        </tbody>
                </table>
            </div>

</div>
        
<script>
    $(document).ready(function() {
        $('#table_user').DataTable();
            });

    var a = $('#table_user').dataTable({
        "scrollY":        "265px",
        "scrollCollapse": true,
        // "paging":         false,
            "language": {
                "sProcessing": "Procesando...",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de MAX registros)",
                "sInfoPostFix": "",
                "sSearch": "",
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
            },
            "dom": 'lBfrtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        // text:      '<FONT SIZE=6><i class="bx bxs-file-doc"></i></font>',
                        text:      '<img src="vista/assets/img/001-sobresalir.png" >',
                        header: true,
                        footer: true,
                        title: "Usuarios del sistema",
                        titleAttr: "Exportar a Excel",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        // text:      '<FONT SIZE=6><i class="bx bxs-file-pdf"></i></font>',
                        text:      '<img src="vista/assets/img/002-pdf.png" >',
                        header: true,
                        footer: true,
                        title: "Usuarios del sistema",
                        titleAttr: "Exportar a PDF",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4]
                        }
                    },
                    {
                        // text: '<FONT SIZE=6><i class="bx bx-book-add"></i></font>',
                        text: '<img src="vista/assets/img/003-mas.png" >',
                        titleAttr: "Crear nuevo registro",
                        action: function ( e, dt, button, config ) {
                            <?php
                            if(isset($_SESSION['administrador'])){?>
                                window.location = 'index.php?c=usuario&a=nuevo';
                            <?php }else{ ?>
                                alert( "Accion valida solo para el administrador");
                            <?php } ?>
                        }         
                    }
                ]
        });
        $('#table_user_wrapper .table-caption').text('Usuarios');
        $('#table_user_wrapper .dataTables_filter input').attr('placeholder', 'Buscar...');
</script>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php'?>
