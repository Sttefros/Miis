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
        
            <div class="table-responsive table-primary">
                <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered  table-hover" id="table_centro">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Encargado</th>
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
                            if(isset($data["centros"])){
                            foreach ($data["centros"] as $dato){
                            ?>
                            <tr>
                                <td> <?php echo $dato['id_centro'];?> </td>
                                <td> <?php echo utf8_encode($dato['nombre']);?> </td>
                                <td> <?php echo utf8_encode($dato['direccion']);?> </td>
                                <td> <?php echo utf8_encode($dato['encargado']);?> </td>
                                <?php 
                                    if(isset($_SESSION['administrador'])){
                                ?>
                                    <td>
                                         <a  class='btn-edit' href='index.php?c=centro&a=modificar&id=<?php echo $dato["id_centro"]?>'>
                                            <i class='bx bx-edit'></i>
                                         </a> 
                                         <a class='btn-delete' href='index.php?c=centro&a=eliminar&id=<?php echo $dato["id_centro"]?>' >
                                            <i class='bx bx-trash'></i>
                                         </a>
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
    $('#table_centro').DataTable();
        } );

    var a = $('#table_centro').dataTable({
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
                        title: "Reporte Centros San Joaquin",
                        titleAttr: "Exportar a Excel",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        // text:      '<FONT SIZE=6><i class="bx bxs-file-pdf"></i></font>',
                        text:      '<img src="vista/assets/img/002-pdf.png" >',
                        header: true,
                        footer: true,
                        title: "Reporte Centros San Joaquin",
                        titleAttr: "Exportar a PDF",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3]
                        }
                    },
                    {
                        // text: '<FONT SIZE=6><i class="bx bx-book-add"></i></font>',
                        text: '<img src="vista/assets/img/003-mas.png" >',
                        titleAttr: "Crear nuevo registro",
                        action: function ( e, dt, button, config ) {
                            <?php
                            if(isset($_SESSION['administrador'])){?>
                                window.location = 'index.php?c=centro&a=nuevo';
                            <?php }else{ ?>
                                alert( "Accion valida solo para el administrador");
                            <?php } ?>
                        }         
                    }
                ]
        });
        $('#table_centro_wrapper .table-caption').text('Usuarios');
        $('#table_centro_wrapper .dataTables_filter input').attr('placeholder', 'Buscar...');
</script>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php'?>
