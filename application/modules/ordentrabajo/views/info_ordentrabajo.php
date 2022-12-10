<script>
$(function(){
	$(".btn-violeta").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'ordentrabajo/cargarModalEstadoOrdenTrabajo',
			data: {'idOrdenTrabajo': oID},
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
	<div class="row">
		<!-- Start of menu -->
		<?php
			$this->load->view('equipos/menu_equipos');
		?>
		<!-- End of menu -->
		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDEN DE TRABAJO</strong>
					<div class="pull-right">
						<div class="btn-group">
							<a class="btn btn-violeta btn-xs" href="<?php echo base_url('reportes/reporteOT/' . $information[0]['id_orden_trabajo']); ?>" target="_blank">Descargar informe OT <i class='fa fa-upload fa-fw'></i>
							</a>
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

					<table class="table table-bordered table-striped table-hover table-condensed">
						<tr>
							<th colspan="5">Información del mantenimiento solicitado</th>
						</tr>
						<tr class="dafault">
							<th class="text-center"><small>Fecha Solicitud</small></th>
							<th class="text-center"><small>Descripción</small></th>
							<th class="text-center"><small>Consideración o Requerimiento</small></th>
							<th class="text-center"><small>Solicitante</small></th>
							<th class="text-center"><small>Tipo de Mantenimiento</small></th>
						</tr>
						<tr>
						<?php
							if($information[0]['tipo_mantenimiento'] == 1)
							{
								echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($infoMantenimiento[0]['fecha']))) . "</small></td>";
								echo "<td><small>" . $infoMantenimiento[0]['descripcion'] . "</small></td>";
								echo "<td><small>" . $infoMantenimiento[0]['consideracion'] . "</small></td>";
								echo "<td><small>" . $infoMantenimiento[0]['name'] . "</small></td>";
								echo "<td><small>Correctivo</small></td>";
							}else{
								echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($information[0]['fecha_asignacion']))) . "</small></td>";
								echo "<td><small>";
								echo $infoMantenimiento[0]['descripcion'];
								echo "<br><b>Frecuencia:</b><br>Cada " . number_format($infoMantenimiento[0]['frecuencia']) . " Km/Horas";
								echo "<br><b>Próximo mantenimiento:</b><br>" . number_format($infoMantenimiento[0]['proximo_mantemiento_kilometros_horas']) . " Km/Horas";
								echo "</small></td>";
								echo "<td><small></small></td>";
								echo "<td><small>" . $information[0]['name'] . "</small></td>";
								echo "<td><small>Preventivo</small></td>";
							}
						?>
						</tr>
					</table>

					<?php
						if($information[0]['usar_contrato'] == 1){
					?>
							<div class="alert alert-danger">
								<span class="fa fa-info-circle" aria-hidden="true"></span>
								<strong>Nota: </strong>Para esta O.T. se hace uso del contrato de mantenimiento.<br>
								<strong>No. Contrato Mantenimiento: </strong><?php echo $info[0]['numero_contrato']; ?><br>
								<strong>Saldo Disponible: </strong> $<?php echo number_format($info[0]['saldo_contrato']); ?> 
							</div>
					<?php
						}
					?>

					<table class="table table-bordered table-striped table-hover table-condensed">
						<tr>
							<th colspan="8">Información Orden de Trabajo</th>
						</tr>
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
                            echo "<tr>";
                            echo "<td class='text-center'><small>" . $information[0]['id_orden_trabajo'] . "</small></td>";
                            echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($information[0]['fecha_asignacion']))) . "</small></td>";
                            echo "<td ><small>" . $information[0]['encargado'] . "</small></td>";
                            echo "<td><small>" . $information[0]['observacion'] . "</small></td>";
                            echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($information[0]['fecha_ultima_actualizacion']))) . "</small></td>";
                            echo "<td class='text-center'>";
							switch ($information[0]['estado_actual']) {
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
							echo "<td class='text-right'>";
							if($information[0]['estado_actual']==2){
								$dteStart = new DateTime($information[0]['fecha_asignacion']);
								$dteEnd   = new DateTime($information[0]['fecha_ultima_actualizacion']);
								
								$dteDiff  = $dteStart->diff($dteEnd);
								$workingTime = $dteDiff->format("%R%a días %H:%I:%S");//days hours:minutes:seconds
								echo $workingTime;
							}
							echo "</td>";
							echo "<td class='text-right'>";
							echo "<small>$" . number_format($information[0]['costo_mantenimiento']) . '<small>';
							echo "</td>";
                            echo "</tr>";
						?>
					</table>

					<button type="button" class="btn btn-violeta btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $information[0]['id_orden_trabajo']; ?>" <?php echo $deshabilitar; ?>>
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Información
					</button><br>

					<table class="table table-bordered table-striped table-hover table-condensed">
						<thead>
							<tr>
								<th colspan="5">Histórico</th>
							</tr>
							<tr>
								<th class="text-center"><small>Fecha Registro</small></th>
								<th class="text-center"><small>Registrado por</small></th>
								<th class="text-center"><small>Información Adicional</small></th>
								<th class="text-center"><small>Estado</small></th>
								<th class="text-center"><small>Documentos</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoEstado as $lista):
									echo "<tr>";
									echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_registro_estado']))) . "</small></td>";
									echo "<td><small>" . $lista['name'] . "</small></td>";
									echo "<td><small>" . $lista['informacion_adicional_estado'] . "</small></td>";
									echo "<td class='text-center'>";
									switch ($lista['estado']) {
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
									//habilito boton para cargar la factura y el informe de mantenimiento si esta solcionado
									if($lista['estado'] == 2){
										if($infoDocumentos){
											foreach ($infoDocumentos as $listaDoc):
												$enlace = '../../files/OT/' . $listaDoc['url_documento'];
												echo "<a href='$enlace' target='_blank'>" . $listaDoc['url_documento'] . "</a>";
												echo "<br>";
											endforeach;
										}

							?>
								<a class="btn btn-success btn-xs" href="<?php echo base_url('ordentrabajo/documents_form_ot/' . $information[0]['id_orden_trabajo']); ?>">Cargar <i class='fa fa-upload fa-fw'></i>
								</a>
							<?php
									}
									echo "</td>";
									echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>

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