<div id="page-wrapper">
	<br>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href=" <?php echo base_url('equipos/documento/' . $infoDocumento[0]['fk_id_equipo_d']); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-clock-o"></i> CAMBIOS REALIZADOS AL DOCUMENTO: 
				</div>
				<div class="panel-body">

				<?php
					if($infoDocumentoHistorial){
				?>				
					<table class="table table-hover">
						<thead>
							<tr>
                                <th class='text-center'><small>Fecha cambio</small></th>
                                <th><small>Realizado por</small></th>
                                <th><small>Tipo Documento</small></th>
								<th class="text-center"><small>Fecha Inicio</small></th>
								<th class="text-center"><small>Fecha Vencimiento</small></th>
								<th class="text-center"><small>No. Documento</small></th>
								<th><small>Descripción</small></th>
                                <th><small>URL</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoDocumentoHistorial as $lista):
								echo '<tr>';
                                echo '<td class="text-center"><small>' . $lista['fecha_registro'] . '</small></td>';
                                echo '<td><small>' . $lista['name'] . '</small></td>';
                                echo '<td><small>' . $lista['tipo_documento'] . '</small></td>';
								echo "<td class='text-center'><small>" . strftime("%B %d, %G",strtotime($lista['fecha_inicio'])) . "</small></td>";
								echo "<td class='text-center'><small>" . strftime("%B %d, %G",strtotime($lista['fecha_vencimiento'])) . "</small></td>";
                                echo "<td class='text-center'><small>" . $lista['numero_documento'] . "</small></td>";
                                echo '<td><small>' . $lista['descripcion'] . '</small></td>';
                                echo '<td><small>';
								if($lista['url_documento']){
									$enlace = '../files/equipos/' . $lista['url_documento'];
									echo "<a href='$enlace' target='_blank'>Ver Documento</a>";
								}else{
									echo "---";
								}
                                echo  '</small></td>';
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