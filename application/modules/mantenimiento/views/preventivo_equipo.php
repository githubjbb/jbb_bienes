<script>
$(function(){
	$(".btn-violeta").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'ordentrabajo/cargarModalOrdenTrabajo',
			data: {'idCompuesto': oID, 'tipoMantenimiento': 2},
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
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-wrench"></i> <strong>MANTENIMIENTOS PREVENTIVOS DEL EQUIPO</strong>
					<div class="pull-right">
						<div class="btn-group">
					<?php if($infoPreventivoEquipo){ ?>
						<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalMantenimiento" id="x">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Mantinimiento Preventivo
						</button>
					<?php }else { ?>
						<!-- boton para cargue de mantenimiento desde la plantilla -->
						<a class='btn btn-info btn-xs' href='<?php echo base_url('mantenimiento/add_mantenimiento_preventivo/' . $info[0]['id_equipo'] . '/' . $info[0]['fk_id_tipo_equipo']) ?>'>
								<span class="glyphicon glyphicon-plus" aria-hidden="true"> </span>  Adicionar Mantinimientos Preventivos
						</a>
					<?php } ?>
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
						if(!$infoPreventivoEquipo){ 
							echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
								</div>';
						} else {
					?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center"><small>Descripción</small></th>
								<th class="text-center"><small>Frecuencia Km/Horas</small></th>
								<th class="text-center"><small>Próximo Mantenimiento Km/Horas</small></th>
								<th class="text-center"><small>Orden Trabajo</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPreventivoEquipo as $lista):
								echo "<tr>";
								echo "<td><small>" . $lista['descripcion'] . "</small></td>";
								echo "<td class='text-right'><small>" . number_format($lista['frecuencia']) . "</small></td>";
								$idRecord = $lista['id_preventivo_equipo'];

								// el valor minimo del campo es igual a los kilometros actuales del equipo
								$minKilometros = $info[0]['horas_kilometros_actuales'];
								$minKilometros = 'min=' . $minKilometros;
						?>
						<form  name="mantenimiento_<?php echo $idRecord ?>" id="mantenimiento_<?php echo $idRecord ?>" method="post" action="<?php echo base_url("mantenimiento/actualizar_proximo_mantenimiento_preventivo"); ?>">

							<input type="hidden" id="hddIdMantenimiento" name="hddIdMantenimiento" value="<?php echo $idRecord; ?>"/>
							<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>" />
						
							<td class='text-center'>
								<input type="number" id="proximo_mantenimiento" name="proximo_mantenimiento" class="form-control" placeholder="Próximo Mantenimiento (Horas/Kilometros)" <?php echo $minKilometros; ?> value="<?php echo number_format($lista['proximo_mantemiento_kilometros_horas']); ?>" required >
								<button type="submit" id="btnSubmitProximoMantenimiento" name="btnSubmitProximoMantenimiento" class="btn btn-primary btn-xs" title="Guardar Próximo Mantenimiento" value="1" >
									<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
								</button>
						<?php
							if($lista['proximo_mantemiento_kilometros_horas']>0){
						?>
	                            <button type="submit" class="btn btn-default btn-xs" id="btnSubmitProximoMantenimiento" name="btnSubmitProximoMantenimiento" title="Historial" value="2" >
	                               <span class="fa fa-th-list" aria-hidden="true" />
	                            </button>
	                    <?php } ?>
							</td>

						</form>

						<?php
								echo "<td class='text-center'>";
								$idCompuesto = $lista['id_preventivo_equipo'] . '-' . $info[0]['id_equipo'];
								?>
								<button type="button" class="btn btn-violeta btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $idCompuesto; ?>" >
									Crear O.T. <span class="glyphicon glyphicon-briefcase" aria-hidden="true">
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
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDENES DE TRABAJO</strong>
				</div>
				<div class="panel-body">

					<?php 										
						if(!$infoOrdenesTrabajo){ 
							echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
								</div>';
						} else {
					?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
                                <th class='text-center'><small>No. O.T.</small></th>
                                <th class='text-center'><small>Fecha Asignación</small></th>
                                <th class='text-center'><small>Asignado a</small></th>
                                <th class='text-center'><small>Estado</small></th>
                                <th class='text-center'><small>Información Adicional</small></th>
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
								echo '<small><p class="' . $clase . '"><strong>' . $valor . '</small></strong></p>';
                                echo "</td>";
                                echo "<td><small>" . $lista['informacion_adicional'] . "</small></td>";
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

<!--INICIO Modal para adicionar MANTENIMIENTO -->
<div class="modal fade text-center" id="modalMantenimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Adicionar Mantenimiento Preventivo</h4>
			</div>

			<div class="modal-body">
				<form name="formMantenimiento" id="formMantenimiento" role="form" method="post" action="<?php echo base_url("mantenimiento/guardar_un_mantenimiento_preventivo") ?>" >
					<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>
					
					<div class="form-group text-left">
						<label class="control-label" for="mantenimiento">Mantenimiento Preventivo</label>
						<select name="mantenimiento" id="mantenimiento" class="form-control" required >
							<option value=''>Select...</option>
							<?php for ($i = 0; $i < count($infoPreventivo); $i++) { ?>
								<option value="<?php echo $infoPreventivo[$i]["id_preventivo_plantilla"]; ?>" ><?php echo $infoPreventivo[$i]["descripcion"] . '. ---> Cada: ' . number_format($infoPreventivo[$i]["frecuencia"]); ?></option>	
							<?php } ?>
						</select>
					</div>
										
					<div class="form-group">
						<div id="div_load" style="display:none">		
							<div class="progress progress-striped active">
								<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
									<span class="sr-only">45% completado</span>
								</div>
							</div>
						</div>
						<div id="div_error" style="display:none">			
							<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
						</div>	
					</div>

					<div class="form-group">
						<div class="row" align="center">
							<div style="width:50%;" align="center">
								<button type="submit" id="btnSubmitMantenimiento" name="btnSubmitMantenimiento" class="btn btn-primary" >
									Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
								</button> 
							</div>
						</div>
					</div>
						
				</form>
			</div>

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar MANTENIMIENTO -->

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