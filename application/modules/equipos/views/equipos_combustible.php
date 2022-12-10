<script>
$(function(){ 
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalCombustible',
				data: {'idEquipo': oID, 'idControlCombustible': 'x'},
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
				url: base_url + 'equipos/cargarModalCombustible',
				data: {'idEquipo': '', 'idControlCombustible': oID},
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
					<div class="row">
						<div class="col-lg-12">
							<i class="fa fa-tint"></i> <strong>SEGUIMIENTO DE OPERACIÓN DE EQUIPO</strong>
							<div class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Seguimiento de Operación
									</button>
									<br><br>
									<a href="<?php echo base_url("reportes/seguimientoOperacionPDF/". $info[0]['id_equipo']); ?>" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-file-pdf-o" aria-hidden="true" ></span> Descargar Formato - Seguimiento De Operación De Equipo, Maquinaria Y/o Vehiculos - FIS.PR.06.F.02</a>
								</div>
							</div>
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
	if(!$listadoControlCombustible){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center"><small>Fecha</small></th>
								<th class="text-center"><small>Horas o Kilometros Actuales</small></th>
								<th class="text-center"><small>Operador</small></th>
								<th class="text-center"><small>Tipo de Consumo</small></th>
								<th class="text-center"><small>Cantidad</small></th>
								<th class="text-center"><small>Lugar</small></th>
								<th class="text-center"><small>Valor X Galón</small></th>
								<th class="text-center"><small>Valor Total</small></th>
								<th class="text-center"><small>Labor Realizada</small></th>
								<th class="text-center"><small>Editar</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoControlCombustible as $lista):
									echo "<tr>";
									echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G",strtotime($lista['fecha_combustible']))) . "</small></td>";
									echo "<td class='text-right'><small>" . number_format($lista['kilometros_actuales']) . "</small></td>";
									echo "<td><small>" . $lista['name'] . "</small></td>";
									echo "<td class='text-center'>";
									switch ($lista['tipo_consumo']) {
										case 1:
											$valor = 'Combustible';
											$clase = "text-danger";
											break;
										case 2:
											$valor = 'Grasa';
											$clase = "text-success";
											break;
										case 3:
											$valor = 'Aceite Transmisión';
											$clase = "text-warning";
											break;
										case 4:
											$valor = 'Aceite Hidráulico';
											$clase = "text-primary";
											break;
										case 5:
											$valor = 'Aceite Motor';
											$clase = "text-violeta";
											break;
									}
									echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
									echo "</td>";

									echo "<td><small>" . $lista['cantidad'] . "</small></td>";
									echo "<td><small>" . $lista['lugar'] . "</small></td>";
									echo "<td class='text-right'><small>$" . number_format($lista['valor_x_galon'], 2) . "</small></td>";
									echo "<td class='text-right'><small>$" . number_format($lista['valor_total'], 2) . "</small></td>";
									echo "<td><small>" . $lista['labor_realizada'] . "</small></td>";
									
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo_control_combustible']; ?>" >
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