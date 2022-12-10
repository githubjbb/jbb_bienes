<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/buscar.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalEquipo',
                data: {'idEquipo': oID},
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
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-search"></i> BUSCAR EQUIPOS <small> - <strong>Seleccionar</strong> mínimo una opción</small>
				</div>
				<div class="panel-body">

					<form  name="formBuscar" id="formBuscar" method="post" >

						<div class="row">
							<div class="col-lg-2">
								<div class="form-group input-group-sm">	
									<label class="control-label" for="idTipoEquipoSearch">Tipo de Equipo: </label>								
									<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" >
										<option value="">Seleccione...</option>
										<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
											<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($_POST && $_POST["id_tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group input-group-sm">	
									<label class="control-label" for="idTipoEquipoSearch">Número Inventario Entidad: </label>								
									<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $_POST?$this->input->post('numero_inventario'):""; ?>" placeholder="Número Inventario Entidad" >
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group input-group-sm">	
									<label class="control-label" for="idTipoEquipoSearch">Marca: </label>								
									<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $_POST?$this->input->post('marca'):""; ?>" placeholder="Marca" >
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group input-group-sm">	
									<label class="control-label" for="idTipoEquipoSearch">Número Serial: </label>								
									<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $_POST?$this->input->post('numero_serial'):""; ?>" placeholder="Número Serial" >
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-group"><br>
									<button type="submit" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm" >
										Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button> 
								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
<?php
	//DESHABILITAR EDICION
	$deshabilitar = 'disabled';
	$userRol = $this->session->rol;
	
	if($userRol == 99 || $userRol == 4){
		$deshabilitar = '';
	}
?>			
					
					<i class="fa fa-truck"></i> <?php echo $tituloListado; ?>
					<div class="pull-right">
						<div class="btn-group">														
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="x">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Equipo
							</button>
							<a href="<?php echo base_url("reportes/litadoEquipos"); ?>" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-file-pdf-o" aria-hidden="true" ></span> Lista Vehículos </a>
						</div>
					</div>
				</div>
				<div class="panel-body">	

<?php 										
	if(!$info){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
			
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center"><small>No. Inventario Entidad</small></th>
								<th class="text-center"><small>Placa</small></th>
								<th class="text-center"><small>Dependencia</small></th>
								<th class="text-center"><small>Marca</small></th>
								<th class="text-center"><small>Modelo</small></th>
								<th class="text-center"><small>Número Serial/Serie</small></th>
								<th class="text-center"><small>Operador/Conductor</small></th>
								<th class="text-center"><small>Observación</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
							
									echo "<tr>";
									echo "<td class='text-center'>";
						?>
<a href='<?php echo base_url('equipos/detalle/' . $lista['id_equipo']); ?>' class="btn btn-primary btn-xs" title=" <?php echo $lista['numero_inventario'] ?>"> <?php echo $lista['numero_inventario'] ?>&nbsp;<i class="fa <?php echo $lista['icono'] ?>"></i></a>
						<?php
									
									
									if(!$deshabilitar){
						?>			<br>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
						<?php
									}
									echo "</td>";
									echo "<td class='text-center'><small>" . $lista['placa'] . "</small></td>";
									echo "<td><small>" . $lista['dependencia'] . "</small></td>";
									echo "<td><small>" . $lista['marca'] . "</small></td>";
									echo "<td><small>" . $lista['modelo'] . "</small></td>";
									echo "<td class='text-center'><small>" . $lista['numero_serial'] . "</small></td>";
									echo "<td class='text-center'><small>";
									echo $lista['name']; 
									if($lista['numero_cedula']){
										echo " - " . $lista['numero_cedula'];
									}
									echo "</small></td>";
									echo "<td><small>" . $lista['observacion'] . "</small></td>";
									
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
		
				
<!--INICIO Modal para adicionar EQUIPOS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar EQUIPOS -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		paging: false,
		"searching": false,
		"pageLength": 25
	});
});
</script>