<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/ajaxEquipos.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-gear fa-fw"></i> EQUIPOS - CONSOLIDADO CHEQUEO PREOPERACIONAL
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
					<i class="fa fa-building"></i> CONSOLIDADO CHEQUEO PREOPERACIONAL
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
									<div class="col-lg-2">
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
					if($_POST){
				?>	
<?php 										
	if(!$listadoRevision){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>

					<div class="row">
						<div class="col-lg-12" align="right">
							<div class="btn-group" >
								<a href="<?php echo base_url("reportes/consolidadoChequoPDF/". $idEquipo . "/" . $idMes); ?>" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-file-pdf-o" aria-hidden="true" ></span> Descargar Consolidado Mes</a>
							</div>
						</div>
					</div>

					<table width="100%" class="table table-striped table-bordered table-hover small" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Fecha Registro</th>
								<th class="text-center">Operador/Conductor</th>
								<th class="text-center">Dependencia</th>
								<th class="text-center">Vehículo Activo</th>
								<th class="text-center">Enlaces</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoRevision as $lista):
									echo "<tr>";
									echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_registro'])) . "</td>";
									echo "<td class='text-center'>" . $lista['name'] . "</td>";
									echo "<td class='text-center'>" . $lista['dependencia'] . "</td>";
									echo "<td class='text-center'>";
									if($lista['activo'] == 1){
										echo "Si";
									}else{
										echo "No";
									}
									echo "</td>";
									echo "<td class='text-center'>";
						?>
									<a title="Descargar Chequeo Preoperacional - FIS.PR.06.F.13" href="<?php echo base_url("reportes/inspecciones/". $lista['id_inspection_vehiculos']); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></a>

									<button type="button" id="<?php echo $lista['id_inspection_vehiculos']; ?>" class='btn btn-danger btn-xs' title="Eliminar Chequeo Preoperacional">
											<i class="fa fa-trash-o"></i>
									</button>
						<?php
									echo "</td>";
									echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>