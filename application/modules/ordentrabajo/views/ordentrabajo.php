<div id="page-wrapper">
	<br>
	<div class="row">
		<!-- Start of menu -->
		<?php
			$this->load->view('equipos/menu_equipos');
		?>
		<!-- End of menu -->
		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDENES DE TRABAJO</strong>
				</div>
				<div class="panel-body">

				<?php 										
					if(!$infoOT){ 
						echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
							</div>';
					}else{
				?>
						<table class="table table-bordered table-striped table-hover table-condensed">
							<tr class="dafault">
	                            <th class='text-center'><small>No. O.T.</small></th>
	                            <th class='text-center'><small>Fecha Asignación</small></th>
	                            <th class='text-center'><small>Asignado a</small></th>
	                            <th class='text-center'><small>Observación</small></th>
	                            <th class='text-center'><small>Última Actualización</small></th>
	                            <th class='text-center'><small>Estado Actual</small></th>
	                            <th class='text-center'><small>Tiempo de Solución</small></th>
	                            <th class="text-center"><small>Costo Mantenimiento</small></th>	
							</tr>

						<?php
							foreach ($infoOT as $data):
	                            echo "<tr>";
	                            echo "<td class='text-center'><small>";
	                    ?>
                                <a href="<?php echo base_url("ordentrabajo/ver_orden/" . $data['id_orden_trabajo']); ?>" class="btn btn-violeta btn-xs"><?php echo $data['id_orden_trabajo']; ?> <i class='fa fa-sign-out fa-fw'></i></a>
	                    <?php
	                          	echo "</small></td>";
	                            echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($data['fecha_asignacion']))) . "</small></td>";
	                            echo "<td ><small>" . $data['encargado'] . "</small></td>";
	                            echo "<td><small>" . $data['observacion'] . "</small></td>";
	                            echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($data['fecha_ultima_actualizacion']))) . "</small></td>";
	                            echo "<td class='text-center'>";
								switch ($data['estado_actual']) {
									case 1:
										$valor = 'Asignada';
										$clase = "text-info";
										break;
									case 2:
										$valor = 'Solucionado';
										$clase = "text-success";
										break;
									case 3:
										$valor = 'Cancelado';
										$clase = "text-danger";
										break;
								}
								echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
								echo "</td>";
								echo "<td>";
								echo "</td>";
								echo "<td class='text-center'>";
								echo "<small>$" . number_format($data['costo_mantenimiento']) . '<small>';
								echo "</td>";
	                            echo "</tr>";
							endforeach;
						?>
						</table>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">
		</div>
	</div>
</div>
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