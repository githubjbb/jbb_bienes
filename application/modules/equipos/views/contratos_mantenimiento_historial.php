<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-truck fa-fw"></i> EQUIPOS - CONTRATOS MANTENIMIENTO
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href=" <?php echo base_url('equipos/contratos'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-clock-o"></i> CAMBIOS REALIZADOS AL CONTRATO DE MANTENIMINENTO: 
				</div>
				<div class="panel-body">

				<?php
					if($infoContratosHistorial){
				?>				
					<table class="table table-hover">
						<thead>
							<tr>
                                <th class='text-center'><small>Fecha cambio</small></th>
                                <th><small>Realizado por</small></th>
								<th><small>Número Contrato</small></th>
								<th><small>Proveedor</small></th>
								<th class="text-center"><small>Vigencia Desde</small></th>
								<th class="text-center"><small>Vigencia Hasta</small></th>
								<th><small>Supervisor</small></th>
								<th class="text-right"><small>Valor</small></th>
								<th class="text-right"><small>Saldo</small></th>
								<th class="text-center"><small>No. O.T.</small></th>
								<th class="text-center"><small>Estado</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoContratosHistorial as $lista):
								echo '<tr>';
                                echo '<td class="text-center"><small>' . $lista['fecha_registro'] . '</small></td>';
                                echo '<td><small>' . $lista['name'] . '</small></td>';
								echo "<td><small>" . $lista['numero_contrato'] . "</small></td>";
								echo "<td><small>" . $lista['nombre_proveedor'] . "</small></td>";
								echo "<td class='text-center'><small>" . $lista['fecha_desde'] . "</small></td>";
								echo "<td class='text-center'><small>" . $lista['fecha_hasta'] . "</small></td>";
								echo "<td><small>" . $lista['supervisor'] . "</small></td>";
								echo "<td class='text-right'><small>$" . number_format($lista['valor_contrato']) . "</small></td>";
								echo "<td class='text-right'><small>$" . number_format($lista['saldo_contrato']) . "</small></td>";
								echo "<td class='text-center'><small>";
						?>
<a href='<?php echo base_url('ordentrabajo/ver_orden/' . $lista['fk_id_orden_trabajo']); ?>' class="btn btn-primary btn-xs" title="No. O.T."> <?php echo $lista['fk_id_orden_trabajo'] ?>&nbsp;<i class="fa fa-briefcase"></i></a>
						<?php
								echo "</small></td>";
								echo "<td class='text-center'>";
								switch ($lista['estado_contrato']) {
									case 1:
										$valor = 'En Ejecución';
										$clase = "text-primary";
										break;
									case 2:
										$valor = 'En Ejecución - Prorroga';
										$clase = "text-warning";
										break;
									case 3:
										$valor = 'Finalizado';
										$clase = "text-danger";
										break;
								}
								echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
								echo "</td>";
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