<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/encuesta_vehiculos.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/ajaxEncuesta.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/validaciones_encuesta.js"); ?>"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LdTEiAgAAAAADm0QRJnFXzX9Awr51t4XuaKW7Ku"></script>

<div id="page-wrapper">
	<br>

<?php
if($idEncuesta){
	$retornoExito = $this->session->flashdata('retornoExito');
	if ($retornoExito) {
?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-tasks"></i><strong> ENCUESTA DE SATISFACCIÓN CONDUCTORES</strong>
				</div>
				<div class="panel-body">
					<div class="alert alert-success ">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						<?php echo $retornoExito ?>		
					</div>
				</div>
			</div>
		</div>
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
	}else{
?>
<form  name="form" id="form" action="pruebas.php" method="post" >
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-tasks"></i><strong> ENCUESTA DE SATISFACCIÓN CONDUCTORES</strong>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-info ">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					Esta encuesta se realiza con el fin de conocer la percepción de los usuarios frente a la conducción y el cumplimiento de las regulaciones por parte de los conductores de los vehículos de la Entidad. 
							</div>
						</div>
						<div class="col-lg-3">
							<select name="id_equipo" id="id_equipo" class="form-control" >
								<option value="">Seleccione...</option>
								<?php for ($i = 0; $i < count($listaVehiculos); $i++) { ?>
									<option value="<?php echo $listaVehiculos[$i]["id_equipo"]; ?>" <?php if($information && $information[0]["fk_id_user_responsable"] == $listaVehiculos[$i]["id_equipo"]) { echo "selected"; }  ?>><?php echo $listaVehiculos[$i]["marca"] . ' ' . $listaVehiculos[$i]["placa"]; ?></option>	
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-3">
							<strong>Fecha: </strong><?php echo date('Y-m-d'); ?><br>
						</div>
					</div>
					<div class="row"><br>
						<span id="info_equipo">

						</span>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">									
								<label class="control-label" for="recorrido">Recorrido<small class="text-primary"> </small></label>
								<input type="text" id="recorrido" name="recorrido" class="form-control" value="<?php if($information){ echo $information[0]["recorrido"]; }?>" placeholder="Recorrido" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					En las siguientes preguntas le pedimos valorar al conductor. Puntúe de 1 a 4 donde 1 es completamente insatisfecho y 4 es completamente satisfecho. 
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="amabilidad">Amabilidad y Respeto del Conductor</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="amabilidad" id="amabilidad1" value=0 <?php if($information && $information[0]["amabilidad"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Insatisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="amabilidad" id="amabilidad2" value=1 <?php if($information && $information[0]["amabilidad"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Poco Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="amabilidad" id="amabilidad3" value=2 <?php if($information && $information[0]["amabilidad"] == 2) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Muy Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="amabilidad" id="amabilidad4" value=3 <?php if($information && $information[0]["amabilidad"] == 3) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Completamente Satisfecho
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="presentacion">Presentación Personal del Conductor</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="presentacion" id="presentacion1" value=0 <?php if($information && $information[0]["presentacion"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Insatisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="presentacion" id="presentacion2" value=1 <?php if($information && $information[0]["presentacion"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Poco Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="presentacion" id="presentacion3" value=2 <?php if($information && $information[0]["presentacion"] == 2) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Muy Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="presentacion" id="presentacion4" value=3 <?php if($information && $information[0]["presentacion"] == 3) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Completamente Satisfecho
								</label>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
	                    <div class="form-group">
	                        <div class="col-sm-12">
	                            <input type="hidden" id="hdd_cuadro_1" name="hdd_cuadro_1" />
	                        </div>
	                    </div>
	                </div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					En las siguientes preguntas le pedimos valorar al conductor. Puntúe de 1 a 4 donde 1 es completamente insatisfecho y 4 es completamente satisfecho. 
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="limpieza">Limpieza del Vehículo</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="limpieza" id="limpieza1" value=0 <?php if($information && $information[0]["limpieza"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Insatisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="limpieza" id="limpieza2" value=1 <?php if($information && $information[0]["limpieza"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Poco Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="limpieza" id="limpieza3" value=2 <?php if($information && $information[0]["limpieza"] == 2) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Muy Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="limpieza" id="limpieza3" value=3 <?php if($information && $information[0]["limpieza"] == 3) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Completamente Satisfecho
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="calidad">Calidad del servicio en modo, tiempo y lugar</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="calidad" id="calidad1" value=0 <?php if($information && $information[0]["calidad"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Insatisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="calidad" id="calidad2" value=1 <?php if($information && $information[0]["calidad"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Poco Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="calidad" id="calidad3" value=2 <?php if($information && $information[0]["calidad"] == 2) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Muy Satisfecho
								</label>
								<label class="radio-inline">
									<input type="radio" name="calidad" id="calidad4" value=3 <?php if($information && $information[0]["calidad"] == 3) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Completamente Satisfecho
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
	                    <div class="form-group">
	                        <div class="col-sm-12">
	                            <input type="hidden" id="hdd_cuadro_2" name="hdd_cuadro_2" />
	                        </div>
	                    </div>
	                </div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					PLAN ESTRATÉGICO DE SEGURIDAD VIAL (PESV) 
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">									
								<label class="control-label" for="normas">El conductor cumplió con las normas de Tránsito <small class="text-primary"> </small></label>
								<select name="normas" id="normas" class="form-control" required>
									<option value=''>Seleccione...</option>
									<option value=1 <?php if($information && $information[0]["normas"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($information && $information[0]["normas"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">									
								<label class="control-label" for="velocidad">El recorrido se realizó con la velocidad permitida<small class="text-primary"> </small></label>
								<select name="velocidad" id="velocidad" class="form-control" required >
									<option value=''>Seleccione...</option>
									<option value=1 <?php if($information && $information[0]["velocidad"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($information && $information[0]["velocidad"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">									
								<label class="control-label" for="cinturon">El conductor utilizó y solicitó que usted usara el cinturón de seguridad<small class="text-primary"> </small></label>
								<select name="cinturon" id="cinturon" class="form-control" required>
									<option value=''>Seleccione...</option>
									<option value=1 <?php if($information && $information[0]["cinturon"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($information && $information[0]["cinturon"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">									
								<label class="control-label" for="aparatos">El conductor usó aparatos móviles o bidireccionales (pantallas, tablets, etc) con el vehículo en movimiento y sin audífonos o bluetooth?  <small class="text-primary"> </small></label>
								<select name="aparatos" id="aparatos" class="form-control" required>
									<option value=''>Seleccione...</option>
									<option value=1 <?php if($information && $information[0]["aparatos"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($information && $information[0]["aparatos"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

	<div class="form-group">
		<div class="row" align="center">
			<div style="width:50%;" align="center">
				<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
					Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
				</button> 
			</div>
		</div>
	</div>
						
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
</form>	
<?php
	}
?>
</div>
<!-- /#page-wrapper -->