<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/ajaxEquipos.js"); ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalRecorrido',
                data: {'idRecorrido': oID},
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
					<i class="fa fa-gear fa-fw"></i> EQUIPOS - RECORRIDO
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
					<i class="fa fa-building"></i> LISTA DE RECORRIDOS
					<div class="pull-right">
						<div class="btn-group">																				
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="x">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Recorrido
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
					<form name="formCheckin" id="formCheckin" method="post">
						<div class="panel panel-default">
							<div class="panel-footer">
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group input-group-sm">	
											<label class="control-label" for="idTipoEquipoSearch">Tipo de Equipo: *</label>								
											<select name="idTipoEquipoSearch" id="idTipoEquipoSearch" class="form-control" required >
												<option value="">Seleccione...</option>
												<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
													<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($_POST && $_POST["idTipoEquipoSearch"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-lg-2">
										<div class="form-group input-group-sm">	
											<label class="control-label" for="idEquipoSearch">Equipo: *</label>
											<select name="idEquipoSearch" id="idEquipoSearch" class="form-control" required>

											</select>
										</div>
									</div>

									<div class="col-sm-2">		
										<div class="form-group input-group-sm">
											<label class="control-label" for="idMes">Mes: *</label>
											<select name="idMes" id="idMes" class="form-control" required >
												<option value="">Seleccione...</option>
												<?php for ($i = 0; $i < count($listaMeses); $i++) { ?>
													<option value="<?php echo $listaMeses[$i]["id_mes"]; ?>" <?php if($_POST && $_POST["idMes"] == $listaMeses[$i]["id_mes"]) { echo "selected"; }  ?>><?php echo $listaMeses[$i]["mes"]; ?></option>	
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group"><br>
											<button type="submit" id="btnSearch" name="btnSearch" class="btn btn-primary btn-sm" >
												Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
											</button> 
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php
					if($info){
				?>	

				<?php
					if($_POST){
						$idEquipo = $_POST["idEquipoSearch"];
				?>

					<div class="row">
						<div class="col-lg-12" align="right">
							<div class="btn-group" >
								<a href="<?php echo base_url("reportes/recorridoDiarioPDF/". $idEquipo); ?>" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-file-pdf-o" aria-hidden="true" ></span> Descargar Formato - Plantilla De Recorrido Diario - FIS.PR.06.F.10</a>
							</div>
						</div>
					</div>
				<?php
					}
				?>
					<table class="table table-hover small">
						<thead>
							<tr>
								<th>Tipo Equipo</th>
								<th class="text-center">Equipo</th>
								<th>Conductor</th>
								<th>Dependencia</th>
								<th class="text-center">Mes</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Recorrido</th>
								<th class="text-center">Área</th>
								<th class="text-center">Nombre Usuario</th>
								<th class="text-center">Correo Usuario</th>
								<th class="text-center">Editar</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>" . $lista['tipo_equipo'] . "</td>";
									echo "<td class='text-center'>" . $lista['numero_inventario'] . "</td>";
									echo "<td>" . $lista['conductor'] . "</td>";
									echo "<td>" . $lista['dependencia'] . "</td>";
									echo "<td class='text-center'>" . $lista['mes'] . "</td>";
									echo "<td>" . $lista['fecha_recorrido'] . "</td>";
									echo "<td>" . $lista['recorrido'] . "</td>";
									echo "<td>" . $lista['area'] . "</td>";
									echo "<td>" . $lista['usuario_nombre'] . "</td>";
									echo "<td>" . $lista['usuario_correo'] . "</td>";
									echo "<td class='text-center'>";
						?>
									<button title="Editar" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo_recorrido']; ?>" >
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									</button>

									<a href="<?php echo base_url("equipos/consumos/" . $lista['id_equipo_recorrido']); ?>" class="btn btn-primary btn-xs">Consumos de Recorrido <span class="glyphicon glyphicon-plus" aria-hidden="true"></a>
						<?php
									echo "</td>";
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