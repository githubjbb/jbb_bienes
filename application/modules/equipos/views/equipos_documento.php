<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/documento.js"); ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalDocumento',
				data: {'idEquipo': oID, 'idDocumento': 'x'},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	

	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalDocumento',
				data: {'idEquipo': '', 'idDocumento': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>


<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<!-- Start of menu -->
		<?php
			$this->load->view('menu_equipos');
		?>
		<!-- End of menu -->
		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-book"></i> <strong>DOCUMENTOS DEL EQUIPO</strong>
					<?php if(!$deshabilitar){ ?>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Documento
							</button>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="panel-body">
				
<?php
	$retornoExito = $this->session->flashdata('retornoExito');
	if ($retornoExito) {
?>
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
<?php
	}
	$retornoError = $this->session->flashdata('retornoError');
	if ($retornoError) {
?>
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
<?php
	}
?> 

<?php 										
	if(!$listadoDocumentos){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
				<div class="row">
					<div class="col-lg-6">
						<div class="alert alert-danger">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Cuando la fila esta en rojo, es porque el <b>documento esta vencido.</b>
						</div>		
					</div>
					<div class="col-lg-6">
						<div class="alert alert-warning">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Cuando la fila esta en amarillo, es porque el <b>Documento tiene menos de 30 días para vencerse.</b>
						</div>		
					</div>
				</div>
					<table class="table table-hover small">
						<thead>
							<tr>
								<th>Tipo Documento</th>
								<th class="text-center">Fecha Inicio</th>
								<th class="text-center">Fecha Vencimiento</th>
								<th class="text-center">No. Documento</th>
								<th>Descripción</th>
								<th class="text-center">Usuario</th>
								<?php if(!$deshabilitar){ ?>
								<th class="text-center">Enlaces</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>							
						<?php
							$filtroFecha = strtotime(date('Y-m-d'));
							foreach ($listadoDocumentos as $lista):				
								$estilosFila = "";
								$fechaInicio = "N/A";
								$fechaVencimiento = "N/A";
								if($lista['aplica_fechas']){
									//semaforo de acuerdo a fecha de vencimiento
									$fechaVencimiento = strtotime($lista['fecha_vencimiento']);
									$diferencia = $fechaVencimiento - $filtroFecha;
									//2678400 --> equivalen a 30 dias
									//si la diferencia es mayor a 30 dias no hay problema
									if($diferencia > 2678400){
										$estilosFila = '';
									}elseif($diferencia <= 2678400 && $diferencia >= 0){
										//si la diferencia es entre 0 y 30 dias, entonces se va a vencer pronto
										$estilosFila = 'warning text-warning';
									}else{
										//si la diferencia es menor que 0 entonces esta vencida
										$estilosFila = 'danger text-danger';
									}
									$fechaInicio  = strftime("%B %d, %G",strtotime($lista['fecha_inicio']));
									$fechaVencimiento  = strftime("%B %d, %G",strtotime($lista['fecha_vencimiento']));
								}
								echo "<tr>";
								echo "<td>" . $lista['tipo_documento'] . "</td>";
								echo "<td >" . $fechaInicio . "</td>";
								echo "<td class=' $estilosFila'>" . $fechaVencimiento . "</td>";
								echo "<td class='text-center'>" . $lista['numero_documento'] . "</td>";
								echo "<td>" . $lista['descripcion'] . "</td>";
								echo "<td class='text-center'>" . $lista['name'] . "</td>";

								if(!$deshabilitar){
									echo "<td class='text-center'>";
									
									if($lista['url_documento']){
										$enlace = '../../files/equipos/' . $lista['url_documento'];
										echo "<a href='$enlace' target='_blank'>Ver Documento</a>";
										echo "<br><br>";
									}
						?>
									<a title="Editar" class="btn btn-info btn-xs" href="<?php echo base_url('equipos/documents_form/' . $lista['fk_id_equipo_d'] . '/' . $lista['id_equipo_documento']); ?>"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									</a>

									<a title="Ver Cambios" class="btn btn-default btn-xs" href="<?php echo base_url('equipos/historial_documentos/' . $lista['id_equipo_documento']); ?>"> <span class="fa fa-th-list" aria-hidden="true"></span>
									</a>

									<button type="button" id="<?php echo $lista['id_equipo_documento']; ?>" class='btn btn-danger btn-xs' title="Eliminar Documento">
											<i class="fa fa-trash-o"></i>
									</button>

						<?php
									echo "</td>";
								}
								echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
		
				
<!--INICIO Modal para adicionar POLIZA -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar POLIZA -->

<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true,
		 "ordering": false,
		 paging: false,
		"searching": false,
		"info": false
    });
});
</script>