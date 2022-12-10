<div id="page-wrapper">
	<br>		
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-danger">
				<div class="panel-heading">	
					<i class="fa fa-truck"></i> EQUIPOS INACTIVOS
				</div>
				<div class="panel-body">	
				
<br>


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
	if(!$info){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
			
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>							
								<th class="text-center"><small>No. Inventario Entidad</small></th>
								<th class="text-center"><small>Dependencia</small></th>
								<th class="text-center"><small>Marca</small></th>
								<th class="text-center"><small>Modelo</small></th>
								<th class="text-center"><small>Número Serial</small></th>
								<th class="text-center"><small>Estado</small></th>
								<th class="text-center"><small>Observación</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
							
									echo "<tr>";
									echo "<td class='text-center'><small>" . $lista['numero_inventario'];
									echo "</small></td>";
									echo "<td class='text-center'><small>" . $lista['dependencia'] . "</small></td>";
									echo "<td><small>" . $lista['marca'] . "</small></td>";
									echo "<td><small>" . $lista['modelo'] . "</small></td>";
									echo "<td class='text-center'><small>" . $lista['numero_serial'] . "</small></td>";
									echo "<td class='text-center'>";
									switch ($lista['estado_equipo']) {
										case 1:
											$valor = 'Activo';
											$clase = "text-success";
											break;
										case 2:
											$valor = 'Inactivo';
											$clase = "text-danger";
											break;
									}
									echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
									echo "</td>";
									echo "<td><small>" . $lista['observacion'] . "</small></td>";
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
		paging: false,
		"searching": false,
		"pageLength": 25
	});
});
</script>