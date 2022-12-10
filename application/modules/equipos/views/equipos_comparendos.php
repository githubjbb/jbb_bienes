<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalComparendos',
				data: {'idEquipo': oID, 'idComparendo': 'x'},
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
				url: base_url + 'equipos/cargarModalComparendos',
				data: {'idEquipo': '', 'idComparendo': oID},
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
					<i class="fa fa-legal"></i> <strong>COMPARENDOS CONDUCTORES</strong>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Comparendos Conductores
							</button>
							<a href="<?php echo base_url("reportes/comparendos/". $info[0]['id_equipo']); ?>" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Descargar Formato - Verificación Comparendos - FIS.PR.06.F.12 </a>
						</div>
					</div>
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
	if(!$listadoComparendos){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center"><small>Fecha Revisión</small></th>
								<th><small>Datos Conductor</small></th>
								<th><small>Verificación en RUNT</small></th>
								<th><small>Verificación en SIMIT</small></th>
								<th class="text-center"><small>Editar</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoComparendos as $lista):
									echo "<tr>";
									echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G",strtotime($lista['fecha_revision']))) . "</small></td>";
									echo "<td><small><b>Nombre: </b><br>" . $lista['name'] . "<br><b>Nro. Cédula:</b><br>". $lista['numero_cedula'] . "</small></td>";
									echo "<td><small>" . $lista['verificacion_runt'] . "</small></td>";
									echo "<td><small>" . $lista['verificacion_simit'] . "</small></td>";						
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_comparendo']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
						<?php
									echo "</td>";
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
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->

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