<div id="page-wrapper">
	<br>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href=" <?php echo base_url('mantenimiento/preventivo_equipo/' . $infoPreventivoHistorial[0]['fk_id_equipo_mpe']); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-clock-o"></i> CAMBIOS REALIZADOS AL PRÓXIMO MANTENIMINETO PREVENTIVO: 
				</div>
				<div class="panel-body">

				<?php
					if($infoPreventivoHistorial){
				?>				
					<table class="table table-hover">
						<thead>
							<tr>
                                <th class='text-center'><small>Fecha cambio</small></th>
                                <th><small>Realizado por</small></th>
								<th class="text-center"><small>Descripción Mantenimiento</small></th>
								<th class="text-center"><small>Frecuencia Km/Horas</small></th>
								<th class="text-center"><small>Próximo Mantenimiento Km/Horas</small></th>
								<th class="text-center"><small>No. O.T.</small></th>
								<th class="text-center"><small>Observación</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPreventivoHistorial as $lista):
								echo '<tr>';
                                echo '<td class="text-center"><small>' . $lista['fecha_registro'] . '</small></td>';
                                echo '<td><small>' . $lista['name'] . '</small></td>';
                                echo '<td><small>' . $lista['descripcion'] . '</small></td>';
								echo "<td class='text-right'><small>" . number_format($lista['frecuencia']) . "</small></td>";
								echo "<td class='text-right'><small>" . number_format($lista['proximo_mantemiento_kilometros_horas']) . "</small></td>";
                                echo "<td class='text-center'><small>" . $lista['fk_id_orden_trabajo'] . "</small></td>";
                                echo '<td><small>' . $lista['descripcion_auditoria'] . '</small></td>';
                                echo '</tr>';
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
		"pageLength": 100
	});
});
</script>