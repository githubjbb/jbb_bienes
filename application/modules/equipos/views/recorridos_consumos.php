<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalConsumo',
				data: {'idRecorrido': oID, 'idConsumo': 'x'},
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
				url: base_url + 'equipos/cargarModalConsumo',
				data: {'idRecorrido': '', 'idConsumo': oID},
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
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href="<?php echo base_url('equipos/recorridos'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-wrench"></i> <strong>CONSUMOS DE LOS RECORRIDOS</strong>
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $infoRecorridos[0]['id_equipo_recorrido']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Consumo
					</button><br>
				<?php
					if($listadoControlConsumos){
				?>				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Fecha</th>
								<th class="text-center">Valor X Galón</th>
								<th class="text-center">No. Galones</th>
								<th class="text-center">Horas o Kilometraje</th>
								<th class="text-center">Valor Total</th>
								<th class="text-center">Editar</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoControlConsumos as $lista):
																
									echo "<tr>";
							
									echo "<td class='text-center'>" . $lista['fecha_consumo'] . "</td>";
									echo "<td class='text-right'>$ " . number_format($lista['valor_x_galon_consumo']) . "</td>";
									echo "<td class='text-right'>" . $lista['numero_galones'] . "</td>";
									echo "<td class='text-right'>" . number_format($lista['kilometraje']) . "</td>";
									echo "<td class='text-right'>$ " . number_format($lista['valor_total_consumo']) . "</td>";
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo_recorrido_consumo']; ?>" >
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
	
		<div class="col-lg-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-automobile"></i> <strong>INFORMACIÓN DEL EQUIPO</strong>
				</div>
				<div class="panel-body">
			
					<!-- IMAGEN DEL EQUIPO -->
					<?php 
					$imagen = FALSE;
					if($fotosEquipos){ 
						$imagen = base_url($fotosEquipos[0]["equipo_foto"]);
					}elseif($infoEquipo[0]["qr_code_img"]){
						$imagen = base_url($infoEquipo[0]["qr_code_img"]);
					}
					if($imagen){
						?>
						<div class="form-group">
							<div class="row" align="center">
								<img src="<?php echo $imagen; ?>" class="img-rounded" width="150" height="150" alt="Imagen Equipo" />
							</div>
						</div>
					<?php } ?>
					<!-- FIN IMAGEN DEL EQUIPO -->
					<strong>No. Inventario: </strong><?php echo $infoEquipo[0]['numero_inventario']; ?><br>
					<strong>Marca: </strong><?php echo $infoEquipo[0]['marca']; ?><br>
					<strong>Modelo: </strong><?php echo $infoEquipo[0]['modelo']; ?><br>
					<strong>No. Serial: </strong><?php echo $infoEquipo[0]['numero_serial']; ?>
					<?php 
					if($infoEquipo[0]['horas_kilometros_actuales']){ 
						echo "<br><strong>Kilometos/Horas actuales: </strong>" . number_format($infoEquipo[0]['horas_kilometros_actuales']);
					}
					?>
				</div>
			</div>

			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-times"></i> <strong>INFORMACIÓN RECORRIDO</strong>
				</div>
				<div class="panel-body">
					<strong>Conductor: </strong><?php echo $infoRecorridos[0]['conductor']; ?><br>
					<strong>Dependencia: </strong><?php echo $infoRecorridos[0]['dependencia']; ?><br>
					<strong>Mes: </strong><?php echo $infoRecorridos[0]['mes']; ?><br>
				</div>
			</div>
		</div>	
	</div>
	
</div>

<!--INICIO Modal -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal -->