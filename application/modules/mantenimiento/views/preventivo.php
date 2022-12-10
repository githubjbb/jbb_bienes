<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/buscarPreventivo.js"); ?>"></script>
<script>
$(function(){
	$(".btn-success").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'mantenimiento/cargarModalPreventivo',
            data: {'idPreventivo': oID},
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
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-gear fa-fw"></i> CONFIGURACIÓN - PLANTILLAS MANTENIMIENTO PREVENTIVO
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
				<i class="fa fa-wrench"></i> LISTA DE MANTENIMIENTOS PREVENTIVOS
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="x">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar
							</button>
						</div>
					</div>
				</div>
				<div class="panel-body">	
					<ul class="nav nav-pills">
						<?php
							foreach ($listadoTipoEquipo as $tipo):
						?>
							<li <?php if($tipoEquipo == $tipo['id_tipo_equipo']){ echo "class='active'";} ?>><a href="<?php echo base_url("mantenimiento/preventivo/" . $tipo['id_tipo_equipo']); ?>"><?php echo $tipo['tipo_equipo'];?></a>
							</li>
						<?php
							endforeach;
						?>
					</ul>
				<?php
					if(!$infoPreventivo){
						echo '<div class="col-lg-12">
						<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
						</div>';
					} else {
				?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Tipo Equipo</th>
								<th class="text-center">Frecuencia Km/Horas</th>
								<th class="text-center">Descripción</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Editar</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPreventivo as $lista):
								echo "<tr>";
								echo "<td>" . $lista['tipo_equipo'] . "</td>";
								echo "<td class='text-right'>" . number_format($lista['frecuencia']) . "</td>";
								echo "<td>" . $lista['descripcion'] . "</td>";
								echo "<td>" . $lista['name'] . "</td>";
								echo "<td class='text-center'>";
								?>
								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_preventivo_plantilla']; ?>" >
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

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		paging: false,
		"pageLength": 25
	});
});
</script>