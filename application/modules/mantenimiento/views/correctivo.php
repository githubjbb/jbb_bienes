<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
	$(".btn-info").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'mantenimiento/cargarModalCorrectivo',
			data: {'idEquipo': oID, 'idCorrectivo': 'x'},
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
			url: base_url + 'mantenimiento/cargarModalCorrectivo',
			data: {'idEquipo': '', 'idCorrectivo': oID},
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
	});
	$(".btn-violeta").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'ordentrabajo/cargarModalOrdenTrabajo',
			data: {'idCompuesto': oID, 'tipoMantenimiento': 1},
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
					<i class="fa fa-wrench"></i> <strong>MANTENIMIENTOS CORRECTIVOS DEL EQUIPO</strong>
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Solicitar Mantenimiento Correctivo
							</button>
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
						if(!$listadoCorrectivos){ 
							echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
								</div>';
						} else {
					?>
					<table class="table table-bordered table-striped table-hover table-condensed">
						<tr class="dafault">
							<th class="text-center"><small>Fecha Solicitud</small></th>
							<th class="text-center"><small>Descripción Falla</small></th>
							<th class="text-center"><small>Consideración o Requerimiento</small></th>
							<th class="text-center"><small>Solicitante</small></th>
							<th class="text-center"><small>Estado</small></th>
							<th class="text-center"><small>Editar</small></th>
							<th class="text-center"><small>Foto Falla</small></th>
							<th class="text-center"><small>Orden Trabajo</small></th>
						</tr>
						<?php
							foreach ($listadoCorrectivos as $data):
								echo "<tr>";					
								echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($data['fecha']))) . "</small></td>";
								echo "<td><small>" . $data['descripcion'] . "</small></td>";
								echo "<td><small>" . $data['consideracion'] . "</small></td>";
								echo "<td><small>" . $data['name'] . "</small></td>";
								echo "<td class='text-center'>";
								switch ($data['estado']) {
									case 1:
										$valor = 'Pendiente';
										$clase = "text-warning";
										break;
									case 2:
										$valor = 'En Proceso';
										$clase = "text-danger";
										break;
									case 3:
										$valor = 'Finalizado';
										$clase = "text-success";
										break;
								}
								echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
								echo "</td>";
								echo "<td class='text-center'>";

								//DESHABILITAR BOTONES
								$deshabilitar = '';
								$bandera = '';
								$userRol = $this->session->rol;
								$idUser = $this->session->id;
								$estadoMantenimiento = $data['estado'];
								
								if($userRol != 99 && $estadoMantenimiento > 1 )
								{
									$deshabilitar = 'disabled';
								}

								if($userRol != 99 && $data['fk_id_user_correctivo']!=$idUser )
								{
									$bandera = 'disabled';
								}
								?>
								<?php if(!$deshabilitar && !$bandera){ ?>
								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $data['id_correctivo']; ?>" >
									Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
								</button>
								<?php }else{ echo "---";} ?>
								<?php
								echo "</td>";
								echo "<td class='text-center'>";
								?>
								<?php if(!$deshabilitar){ ?>
									<a href="<?php echo base_url("mantenimiento/foto_danio/" . $data['fk_id_equipo_correctivo'] . "/" . $data['id_correctivo']); ?>" class="btn btn-default btn-warning btn-xs">Foto <span class="glyphicon glyphicon-picture" aria-hidden="true"></a>
								<?php }else{ echo "---";} ?>

								<?php
								echo "</td>";
								echo "<td class='text-center'>";
								$idCompuesto = $data['id_correctivo'] . '-' . $info[0]['id_equipo'];
								?>
								<?php if(!$deshabilitar){ ?>
									<button type="button" class="btn btn-violeta btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $idCompuesto; ?>" >
										Crear O.T. <span class="glyphicon glyphicon-briefcase" aria-hidden="true">
									</button>
								<?php 
								}else{ 
									//buscar numero de la OT
									$ci = &get_instance();
									$ci->load->model("general_model");
									
									//Left MENU 
									$arrParam = array(
										"idMantenimiento" => $data['id_correctivo'],
										"tipoMantenimiento" => 1
									);
									$infoOT = $this->general_model->get_orden_trabajo($arrParam);
									$idOT = $infoOT[0]['id_orden_trabajo'];
								?>
									<a href="<?php echo base_url("ordentrabajo/ver_orden/" . $idOT); ?>" class="btn btn-success btn-xs">Ver O.T. <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
								<?php } ?>

								<?php
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