<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
     
        <div class="container">
        <h1 ><?php echo $data["titulo"]?></h1>
       
            <div class="table-responsive table-primary">
                <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered  table-hover" id="table_insumo">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Serie</th>
                            <th>Descripcion</th>
                            <th>Centro</th>
                            <th>Departamento</th>
                            <th>Ubicacion</th>
                            <th>Categoria</th>
                            <?php 
                                    if(isset($_SESSION['encargado'])){
                                ?>
                                    <th>Acciones</th>
                            <?php
                                    }
                                ?>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            if(isset($data["insumo"])){
                            foreach ($data["insumo"] as $dato){
                            ?>
                            <tr>
                                <td> <?php echo $dato['id_insumo'];?> </td>
                                <td> <?php echo utf8_encode($dato['marca']);?> </td>
                                <td> <?php echo $dato['num_serie'];?> </td>
                                <td> <?php echo utf8_encode( $dato['descripcion']);?> </td>
                                <td> <?php echo utf8_encode( $dato['ubicacion']);?> </td>
                                <td> <?php echo $dato['departamento'];?> </td>
                                <td> <?php echo $dato['box'];?> </td>
                                <td> <?php echo $dato['categoria'];?> </td>

                                <td> <a  class='btn-edit' href='index.php?c=insumo&a=modificarEncargado&id=<?php echo $dato["id_insumo"]?>'><i class='bx bx-edit'></i> </td>
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
    $('#table_insumo').DataTable();
        } );

    var a = $('#table_insumo').dataTable({
        "scrollY":        "250px",
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
                        title: "Insumos informaticos San Joaquin",
                        titleAttr: "Exportar a Excel",
                        exportOptions: {
                            columns: [ 1, 2, 3 ,4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        // text:      '<FONT SIZE=6><i class="bx bxs-file-pdf"></i></font>',
                        text:      '<img src="vista/assets/img/002-pdf.png" >',
                        header: true,
                        footer: true,
                        title: "Insumos informaticos San Joaquin",
                        titleAttr: "Exportar a PDF",
                        exportOptions: {
                            columns: [ 1, 2, 3 ,4, 5, 6, 7]
                        }
                    },
                    {
                        // text: '<FONT SIZE=6><i class="bx bx-book-add"></i></font>',
                        text: '<img src="vista/assets/img/003-mas.png" >',
                        titleAttr: "Crear nuevo registro",
                        action: function ( e, dt, button, config ) {
                            <?php
                            if(isset($_SESSION['administrador'])){?>
                                window.location = 'index.php?c=insumo&a=nuevo';
                            <?php }else{ ?>
                                alert( "Accion valida solo para el administrador");
                            <?php } ?>
                        }         
                    }
                ]
        });
        $('#table_insumo_wrapper .table-caption').text('Usuarios');
        $('#table_insumo_wrapper .dataTables_filter input').attr('placeholder', 'Buscar...');
</script>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php'?>
