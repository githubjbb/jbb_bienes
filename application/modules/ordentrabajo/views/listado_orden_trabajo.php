<div id="page-wrapper">
	<br>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<?php $dashboardURL = $this->session->userdata("dashboardURL"); ?>
					<a class="btn btn-violeta btn-xs" href="<?php echo base_url($dashboardURL); ?>"><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
					<i class="fa fa-briefcase"></i> <strong>ORDENES DE TRABAJO</strong>
				</div>
				<div class="panel-body">

				<?php
					if(!$infoOrdenesTrabajo){ 
				?>
				        <div class="col-lg-12">
				            <small>
				                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en la base de datos.</p>
				            </small>
				        </div>
				<?php
					}else{
				?>	

					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
                                <th class='text-center'><small>No. O.T.</small></th>
                                <th class='text-center'><small>Fecha Asignación</small></th>
                                <th class='text-center'><small>Asignado a</small></th>
                                <th class='text-center'><small>Tipo Mantenimiento</small></th>
                                <th class='text-center'><small>Observacion</small></th>
                                <th class='text-center'><small>Estado Actual</small></th>
                                <th class='text-center'><small>Ver</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
                            foreach ($infoOrdenesTrabajo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'><small>" . $lista['id_orden_trabajo'] . "</small></td>";
                                echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_asignacion']))) . "</small></td>";
                                echo "<td ><small>" . $lista['encargado'] . "</small></td>";
                                echo "<td class='text-center'>";
                                switch ($lista['tipo_mantenimiento']) {
                                    case 1:
                                        $valor = 'Correctivo';
                                        $clase = "text-danger";
                                        break;
                                    case 2:
                                        $valor = 'Preventivo';
                                        $clase = "text-info";
                                        break;
                                }
                                echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
                                echo "</td>";
                                echo "<td><small>" . $lista['observacion'] . "</small></td>";
                                echo "<td class='text-center'>";
								switch ($lista['estado_actual']) {
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
                                echo "<td class='text-center'>";
                                ?>
                                <a href="<?php echo base_url("ordentrabajo/ver_orden/" . $lista['id_orden_trabajo']); ?>" class="btn btn-success btn-xs">Ver O.T. <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
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

<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true,
		 "ordering": false,
		 paging: false,
		"info": false,
		"searching": false
    });
});
</script>