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
                <table cellpadding="0" cellspacing="0"  border="0" class="table table-bordered table-responsive table-hover table-hover" id="table_historial">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>FECHA</th>
                            <th>USUARIO</th>
                            <th>INSUMO </th>
                            <th>CATEGORIA</th>
                            <th>CENTRO</th>
                            <th>DEPARTAMENTO</th>
                            <th>BOX</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            if(isset($data["historial"])){
                            foreach ($data["historial"] as $dato){
                            ?>
                            <tr id="tr">
                                <td> <?php echo $dato['id_historial'];?> </td>
                                <td> <?php echo $dato['fecha_accion'];?> </td>
                                <td> <?php echo $dato['usuario'];?> </td>
                                <td> <?php echo $dato['id_insumo'];?> </td>
                                <td> <?php echo $dato['categoria'];?> </td>
                                
                                    <?php if($dato['centro'] == '0'){ ?>
                                        <td> 
                                            de baja
                                        </td>
                                    <?php } ?>
                                        <td> 
                                            <?php echo $dato['centro'];?>    
                                        </td>

                                <td> <?php echo $dato['departamento'];?> </td>
                                <td> <?php echo $dato['box'];?> </td>
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
        $('#table_historial').DataTable();
            });


      


    var a = $('#table_historial').dataTable({
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
                        title: "Reporte historial de movimientos",
                        titleAttr: "Exportar a Excel",
                        exportOptions: {
                            columns: [  1, 2, 3 ,4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        // text:      '<FONT SIZE=6><i class="bx bxs-file-pdf"></i></font>',
                        text:      '<img src="vista/assets/img/002-pdf.png" >',
                        header: true,
                        footer: true,
                        title: "Reporte historial de movimientos",
                        titleAttr: "Exportar a PDF",
                        exportOptions: {
                            columns: [  1, 2, 3 ,4, 5, 6, 7]
                        }
                    }
                ]
        });
        $('#table_historial_wrapper .table-caption').text('Usuarios');
        $('#table_historial_wrapper .dataTables_filter input').attr('placeholder', 'Buscar...');
</script>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php'?>
