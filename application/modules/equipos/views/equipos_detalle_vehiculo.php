<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo_detalle_vehiculo_v2.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<!-- Start of menu -->
		<?php
			$this->load->view('menu_equipos');
		?>
		<!-- End of menu -->
		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-tags"></i> <strong>INFORMACIÓN ESPECÍFICA</strong>
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

					<form  name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoEspecifica?$infoEspecifica[0]["id_equipo_detalle_vehiculo"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<input type="hidden" id="hddMetodoGuardar" name="hddMetodoGuardar" value="<?php echo $info[0]['metodo_guardar']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="dimensiones">Dimensiones: </label>
								<input type="text" id="dimensiones" name="dimensiones" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["dimensiones"]:""; ?>" placeholder="Dimensiones" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="linea">Línea: </label>
								<input type="text" id="linea" name="linea" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["linea"]:""; ?>" placeholder="Línea" <?php echo $deshabilitar; ?>>
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="color">Color: </label>
								<input type="text" id="color" name="color" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["color"]:""; ?>" placeholder="Color" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="from">Combustible: </label>
								<select name="combustible" id="combustible" class="form-control" <?php echo $deshabilitar; ?>>
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["combustible"] == 1) { echo "selected"; }  ?>>Gasolina</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["combustible"] == 2) { echo "selected"; }  ?>>Diesel</option>
								</select>
							</div>
						</div>

<?php if($info[0]['fk_id_tipo_equipo'] == 1){ ?>						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Tipo Vehículo: </label>
								<select name="id_clase_vechiculo" id="id_clase_vechiculo" class="form-control" <?php echo $deshabilitar; ?>>
									<option value="">Seleccione...</option>
									<?php 									
									for ($i = 0; $i < count($claseVehiculo); $i++) { ?>
										<option value="<?php echo $claseVehiculo[$i]["id_clase_vechiculo"]; ?>" <?php if($infoEspecifica && $infoEspecifica[0]["fk_id_clase_vechiculo"] == $claseVehiculo[$i]["id_clase_vechiculo"]) { echo "selected"; }  ?>><?php echo $claseVehiculo[$i]["clase_vehiculo"]; ?></option>	
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-6">
								<label for="from">Tipo Carrocería: </label>
								<select name="id_tipo_carroceria" id="id_tipo_carroceria" class="form-control" <?php echo $deshabilitar; ?>>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoCarroceria); $i++) { ?>
										<option value="<?php echo $tipoCarroceria[$i]["id_tipo_carroceria"]; ?>" <?php if($infoEspecifica && $infoEspecifica[0]["fk_id_tipo_carroceria"] == $tipoCarroceria[$i]["id_tipo_carroceria"]) { echo "selected"; }  ?>><?php echo $tipoCarroceria[$i]["tipo_carroceria"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
<?php } ?>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="capacidad">Capacidad - Peso(kg): </label>
								<input type="text" id="capacidad" name="capacidad" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["capacidad"]:""; ?>" placeholder="Capacidad"  <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="servicio">Clase: </label>
								<input type="text" id="servicio" name="servicio" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["servicio"]:""; ?>" placeholder="Servicio"  <?php echo $deshabilitar; ?>>
							</div>						
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_puertas">Número Puertas: </label>
								<input type="number" min="0" max="5" id="numero_puertas" name="numero_puertas" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_puertas"]:""; ?>" placeholder="Número Puertas" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="numero_ocupantes">Número Ocupantes: </label>
								<input type="number" min="0" max="20" id="numero_ocupantes" name="numero_ocupantes" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_ocupantes"]:""; ?>" placeholder="Número Ocupantes" <?php echo $deshabilitar; ?>>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="cilindraje">Cilindraje: </label>
								<input type="text" id="cilindraje" name="cilindraje" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["cilindraje"]:""; ?>" placeholder="Cilindraje" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="numero_motor">Número Motor: </label>
								<input type="text" id="numero_motor" name="numero_motor" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_motor"]:""; ?>" placeholder="Número Motor" <?php echo $deshabilitar; ?>>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_chasis">Número Chasis: </label>
								<input type="text" id="numero_chasis" name="numero_chasis" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_chasis"]:""; ?>" placeholder="Número Chasis" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="codigo_gps">Código GPS: </label>
								<input type="text" id="codigo_gps" name="codigo_gps" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["codigo_gps"]:""; ?>" placeholder="Código GPS" <?php echo $deshabilitar; ?>>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="codigo_ship">Código Ship: </label>
								<input type="text" id="codigo_ship" name="codigo_ship" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["codigo_ship"]:""; ?>" placeholder="Código Ship" <?php echo $deshabilitar; ?>>
							</div>						

<?php if($info[0]['fk_id_tipo_equipo'] == 1){ ?>
							<div class="col-sm-6">
								<label for="numero_licencia_transito">Número de Licencia de Tránsito: </label>
								<input type="text" id="numero_licencia_transito" name="numero_licencia_transito" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_licencia_transito"]:""; ?>" placeholder="Número de Licencia de Tránsito" maxlength="30" <?php echo $deshabilitar; ?>>
							</div>
<?php } ?>
						</div>

<?php if($info[0]['fk_id_tipo_equipo'] == 1){ ?>
						<div class="form-group">					
							<div class="col-sm-6">
								<label for="multas">Multa por placa?: </label>
								<select name="multas" id="multas" class="form-control" <?php echo $deshabilitar; ?>>
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["multas"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["multas"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>

							<div class="col-sm-6">
								<label for="multas_conductor">Multa por cédula conductor?: </label>
								<select name="multas_conductor" id="multas_conductor" class="form-control" <?php echo $deshabilitar; ?>>
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["multas_conductor"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["multas_conductor"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>	
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="restricciones">Actualmente tiene restricciones?: </label>
								<select name="restricciones" id="restricciones" class="form-control" <?php echo $deshabilitar; ?>>
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["restricciones"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["restricciones"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>	

							<div class="col-sm-6">
								<label for="motivo_multa">Código y/o motivo de la multa y/o restricción: </label>
								<input type="text" id="motivo_multa" name="motivo_multa" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motivo_multa"]:""; ?>" placeholder="Código y/o motivo" maxlength="30" <?php echo $deshabilitar; ?>>
							</div>
						</div>
<?php } ?>

						<div class="form-group">
							<div class="row" align="center">
								<div style="width:80%;" align="center">
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
							</div>
						</div>	

						<?php if(!$deshabilitar){ ?>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:100%;" align="center">							
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-info'>
										Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button>
								</div>
							</div>
						</div>
						<?php } ?>
															
					</form>

				</div>
			</div>
		</div>
		
					
	</div>
	
</div>
<!-- /#page-wrapper -->