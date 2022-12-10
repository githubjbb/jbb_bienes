<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/inspeccion_vehiculos.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/ajaxInspeccion.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/validaciones_inspeccion.js"); ?>"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LdTEiAgAAAAADm0QRJnFXzX9Awr51t4XuaKW7Ku"></script>

<?php 	 
	$idEquipo = $vehicleInfo[0]["id_equipo"];
?>

<div id="page-wrapper">
	<br>
	
<form  name="form" id="form" method="post" >
	<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_inspection_vehiculos"]:""; ?>"/>
	<input type="hidden" id="hddIdVehicle" name="hddIdVehicle" value="<?php echo $idEquipo; ?>"/>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-tasks"></i><strong> CHEQUEO PREOPERACIONAL DIARIO</strong>
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


				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-info ">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				DE ACUERDO CON LA RESOLUCIÓN 1565 DE 2014, Y COMO COMPLEMENTO CON EL PLAN DE MANTENIMIENTO 
				PREVENTIVO SE REALIZARÁ DIARIAMENTE ANTES DE PONER EL VEHÍCULO EN MARCHA, EL SIGUIENTE FORMATO DE INSPECCIÓN DIARIA, EN EL CUAL SE REVISARÁN LOS ELEMENTOS DE SEGURIDAD ACTIVA Y PASIVA. ESTE ES DILIGENCIADO POR EL CONDUCTOR DEL VEHÍCULO. 
						</div>
					</div>
					<div class="col-lg-3">
						<?php if($fotosEquipos && $fotosEquipos[0]["equipo_foto"]){ ?>
							<div class="form-group">
								<div class="row" align="center">
									<img src="<?php echo base_url($fotosEquipos[0]['equipo_foto']); ?>" class="img-rounded" alt="Foto Equipo" width="60" height="60" />
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-lg-3">		
						<strong>Placas del Vehículo: </strong><?php echo $vehicleInfo[0]['placa']; ?><br>
						<strong>Número Inventario: </strong><?php echo $vehicleInfo[0]['numero_inventario']; ?>
					</div>
					<div class="col-lg-3">
						<strong>Número Serial: </strong><?php echo $vehicleInfo[0]['numero_serial']; ?><br>
						<strong>Tipo Equipo: </strong><?php echo $vehicleInfo[0]['tipo_equipo']; ?>
					</div>
					<div class="col-lg-3">
						<strong>Marca: </strong><?php echo $vehicleInfo[0]['marca']; ?><br>
						<strong>Modelo: </strong><?php echo $vehicleInfo[0]['modelo']; ?>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-3">
						<strong>Fecha: </strong><?php echo date('Y-m-d'); ?><br>
					</div>
					<div class="col-lg-3">
						<strong>Operador/Conductor: </strong>
						<select name="id_conductor" id="id_conductor" class="form-control" >
							<option value="">Seleccione...</option>
							<?php for ($i = 0; $i < count($listaUsuarios); $i++) { ?>
								<option value="<?php echo $listaUsuarios[$i]["id_user"]; ?>" <?php if($information && $information[0]["fk_id_user_responsable"] == $listaUsuarios[$i]["id_user"]) { echo "selected"; }  ?>><?php echo $listaUsuarios[$i]["first_name"] . ' ' . $listaUsuarios[$i]["last_name"]; ?></option>	
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-3">
						<span id="numero_identificacion">
							<?php 
							if($information)
							{ 
								echo "<b>Número de Identificación: </b>" . $information[0]["numero_cedula"];
								echo "<br><b>Dependencia: </b>" . $information[0]["dependencia"];
							}
							?>
						</span>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">									
							<label class="control-label" for="activo">¿El vehículo se encuentra activo? <small class="text-primary"> </small></label>
							<select name="activo" id="activo" class="form-control" required>
								<option value=''>Seleccione...</option>
								<option value=1 <?php if($information && $information[0]["activo"] == 1) { echo "selected"; }  ?>>Activo</option>
								<option value=2 <?php if($information && $information[0]["activo"] == 2) { echo "selected"; }  ?>>Inactivo</option>
							</select>
						</div>
					</div>

<?php 
	$validacion = "none";
	$validacion2 = "none";
	if($information && $information[0]["activo"] == 2){
		$validacion = "inline";
		$validacion2 = "none";
	}elseif($information && $information[0]["activo"] == 1){
		$validacion = "none";
		$validacion2 = "inline";
	}
?>
					<div class="col-lg-4">
						<div class="form-group" id="div_razon" style="display:<?php echo $validacion; ?>">						
							<label class="control-label" for="razon">Razón por la cual no se encuentra en movimiento <small class="text-primary"> </small></label>
							<select name="razon" id="razon" class="form-control">
								<option value=''>Seleccione...</option>
								<option value=0 <?php if($information && $information[0]["razon_inactivo"] == 1) { echo "selected"; }  ?>>Mantenimiento Preventivo</option>
								<option value=2 <?php if($information && $information[0]["razon_inactivo"] == 2) { echo "selected"; }  ?>>Mantenimiento Correctivo</option>
								<option value=3 <?php if($information && $information[0]["razon_inactivo"] == 3) { echo "selected"; }  ?>>No se requiere su servicio</option>
								<option value=4 <?php if($information && $information[0]["razon_inactivo"] == 4) { echo "selected"; }  ?>>Otro</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group" id="div_cual" style="display:<?php echo $validacion; ?>">					
							<label class="control-label" for="cual">¿Cual?<small class="text-primary"> </small></label>
							<input type="text" id="cual" name="cual" class="form-control" value="<?php if($information){ echo $information[0]["razon_cual"]; }?>" placeholder="¿Cual?" >
						</div>
					</div>
				</div>
					

<!-- INICIO Firma del conductor -->					
<?php 
if($information)
{ 
	//si ya esta la firma entonces se muestra mensaje que ya termino el reporte
	if($information[0]["signature"]){ 
?>
			<div class="col-lg-12">	
				<div class="alert alert-success ">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					El diagnóstico esta completo.
				</div>
			</div>
<?php   }  ?>
				<div class="col-lg-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> Firma responsable diagnóstico
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							<div class="form-group">
								<div class="row" align="center">
									<div style="width:70%;" align="center">
										 
<?php 								
	$class = "btn-primary";						
	if($information[0]["signature"]){ 
		$class = "btn-default";
?>
		
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" >
	<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver firma
</button>

<div id="myModal" class="modal fade" role="dialog">  
	<div class="modal-dialog">
		<div class="modal-content">      
			<div class="modal-header">        
				<button type="button" class="close" data-dismiss="modal">×</button>        
				<h4 class="modal-title">Firma responsable diagnóstico</h4>      </div>      
			<div class="modal-body text-center"><img src="<?php echo base_url($information[0]["signature"]); ?>" class="img-rounded" alt="Management/Safety Advisor Signature" width="304" height="236" />   </div>      
			<div class="modal-footer">        
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>     
			</div>  
		</div>  
	</div>
</div>

<?php } ?>

<a class="btn <?php echo $class; ?>" href="<?php echo base_url("external/add_signature/vehiculos/" . $information[0]["id_inspection_vehiculos"]); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Firma </a>

									</div>
								</div>
							</div>
					
						</div>
						<!-- /.panel-body -->
					</div>
				</div>
<?php } ?>
<!-- FIN Firma del conductor -->

					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<div class="form-group" id="div_kilometros" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-12">				
			<div class="panel panel-primary">
				<div class="panel-heading">					
					KILOMETRAJE DEL VEHÍCULO
				</div>
				<div class="panel-body">
					<div class="form-group">									
						<label class="col-sm-4 control-label" for="hours">Horas o Kilometros actuales <small class="text-primary"> </small></label>
						<div class="col-sm-5">
							<input type="number" min="0" id="hours" name="hours" class="form-control" value="<?php if($information){ echo $information[0]["horas_actuales_vehiculo"]; }?>" placeholder="Horas o Kilometros actuales" >
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row" id="div_second_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					VERIFICAR LOS SIGUIENTES DOCUMENTOS <small>(Revisar la vigencia)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="licencia">Licencia de conducción</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="licencia" id="licencia1" value=1 <?php if($information && $information[0]["licencia"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="licencia" id="licencia2" value=0 <?php if($information && $information[0]["licencia"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="licencia" id="licencia3" value=99 <?php if($information && $information[0]["licencia"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="soat">SOAT</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="soat" id="soat1" value=1 <?php if($information && $information[0]["soat"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="soat" id="soat2" value=0 <?php if($information && $information[0]["soat"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="soat" id="soat3" value=99 <?php if($information && $information[0]["soat"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="tarjeta_propiedad">Tarjeta de propiedad</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="tarjeta_propiedad" id="tarjeta_propiedad1" value=1 <?php if($information && $information[0]["tarjeta_propiedad"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="tarjeta_propiedad" id="tarjeta_propiedad2" value=0 <?php if($information && $information[0]["tarjeta_propiedad"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="tarjeta_propiedad" id="tarjeta_propiedad3" value=99 <?php if($information && $information[0]["tarjeta_propiedad"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="seguro">Seguro de daños a terceros</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="seguro" id="seguro1" value=1 <?php if($information && $information[0]["seguro"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="seguro" id="seguro2" value=0 <?php if($information && $information[0]["seguro"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="seguro" id="seguro3" value=99 <?php if($information && $information[0]["seguro"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_1()" >N/A
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
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_documentos">Observaciones</label>
								<textarea id="observacion_documentos" name="observacion_documentos" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_documentos"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					DIRECCIONALES  <small>(Funcionamiento adecuado)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="dir_delanteras">Direccionales delanteras</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="dir_delanteras" id="dir_delanteras1" value=1 <?php if($information && $information[0]["dir_delanteras"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="dir_delanteras" id="dir_delanteras2" value=0 <?php if($information && $information[0]["dir_delanteras"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="dir_delanteras" id="dir_delanteras3" value=99 <?php if($information && $information[0]["dir_delanteras"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="dir_traseras">Direccionales traseras</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="dir_traseras" id="dir_traseras1" value=1 <?php if($information && $information[0]["dir_traseras"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="dir_traseras" id="dir_traseras2" value=0 <?php if($information && $information[0]["dir_traseras"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="dir_traseras" id="dir_traseras3" value=99 <?php if($information && $information[0]["dir_traseras"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_2()" >N/A
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
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_dir">Observaciones</label>
								<textarea id="observacion_dir" name="observacion_dir" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_dir"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<div class="row" id="div_third_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					LUCES <small>(Funcionamiento de bombilla, cubierta sin rotura, bombillos no fundidos)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="luces_altas">Luces altas</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="luces_altas" id="luces_altas1" value=1 <?php if($information && $information[0]["luces_altas"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_altas" id="luces_altas2" value=0 <?php if($information && $information[0]["luces_altas"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_altas" id="luces_altas3" value=99 <?php if($information && $information[0]["luces_altas"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="luces_bajas">Luces bajas</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="luces_bajas" id="luces_bajas1" value=1 <?php if($information && $information[0]["luces_bajas"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_bajas" id="luces_bajas2" value=0 <?php if($information && $information[0]["luces_bajas"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_bajas" id="luces_bajas3" value=99 <?php if($information && $information[0]["luces_bajas"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="luces_stops">Luces stops</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="luces_stops" id="luces_stops1" value=1 <?php if($information && $information[0]["luces_stops"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_stops" id="luces_stops2" value=0 <?php if($information && $information[0]["luces_stops"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_stops" id="luces_stops3" value=99 <?php if($information && $information[0]["luces_stops"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="luces_reversa">Luces de reversa</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="luces_reversa" id="luces_reversa1" value=1 <?php if($information && $information[0]["luces_reversa"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_reversa" id="luces_reversa2" value=0 <?php if($information && $information[0]["luces_reversa"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_reversa" id="luces_reversa3" value=99 <?php if($information && $information[0]["luces_reversa"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="luces_parqueo">Luces de parqueo</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="luces_parqueo" id="luces_parqueo1" value=1 <?php if($information && $information[0]["luces_parqueo"] == 1) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_parqueo" id="luces_parqueo2" value=0 <?php if($information && $information[0]["luces_parqueo"] == 0) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="luces_parqueo" id="luces_parqueo3" value=99 <?php if($information && $information[0]["luces_parqueo"] == 99) { echo "checked"; }  ?> onclick="valid_cuadro_3()" >N/A
								</label>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
	                    <div class="form-group">
	                        <div class="col-sm-12">
	                            <input type="hidden" id="hdd_cuadro_3" name="hdd_cuadro_3" />
	                        </div>
	                    </div>
	                </div>
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_luces">Observaciones</label>
								<textarea id="observacion_luces" name="observacion_luces" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_luces"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					LIMPIABRISAS <small>(Plumilla en buen estado, limpieza y estructura)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="limpiabrizas">Limpiabrisas der/izq/atrás</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="limpiabrizas" id="limpiabrizas1" value=1 <?php if($information && $information[0]["limpiabrizas"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="limpiabrizas" id="limpiabrizas2" value=0 <?php if($information && $information[0]["limpiabrizas"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="limpiabrizas" id="limpiabrizas3" value=99 <?php if($information && $information[0]["limpiabrizas"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_limpia">Observaciones</label>
								<textarea id="observacion_limpia" name="observacion_limpia" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_limpia"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<div class="row" id="div_fourth_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					FRENOS <small>(Verificar al momento de comenzar la marcha)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="freno_princiapal">Freno principal</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="freno_princiapal" id="freno_princiapal1" value=1 <?php if($information && $information[0]["freno_princiapal"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="freno_princiapal" id="freno_princiapal2" value=0 <?php if($information && $information[0]["freno_princiapal"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="freno_princiapal" id="freno_princiapal3" value=99 <?php if($information && $information[0]["freno_princiapal"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="freno_emergencia">Freno de emergencia</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="freno_emergencia" id="freno_emergencia1" value=1 <?php if($information && $information[0]["freno_emergencia"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="freno_emergencia" id="freno_emergencia2" value=0 <?php if($information && $information[0]["freno_emergencia"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="freno_emergencia" id="freno_emergencia3" value=99 <?php if($information && $information[0]["freno_emergencia"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_freno">Observaciones</label>
								<textarea id="observacion_freno" name="observacion_freno" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_freno"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					LLANTAS <small>(Verificar su estado, profundidad del labrado y Presión)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="llantas_delanteras">Llantas delanteras</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="llantas_delanteras" id="llantas_delanteras1" value=1 <?php if($information && $information[0]["llantas_delanteras"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="llantas_delanteras" id="llantas_delanteras2" value=0 <?php if($information && $information[0]["llantas_delanteras"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="llantas_delanteras" id="llantas_delanteras3" value=99 <?php if($information && $information[0]["llantas_delanteras"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="llantas_traseras">Llantas traseras</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="llantas_traseras" id="llantas_traseras1" value=1 <?php if($information && $information[0]["llantas_traseras"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="llantas_traseras" id="llantas_traseras2" value=0 <?php if($information && $information[0]["llantas_traseras"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="llantas_traseras" id="llantas_traseras3" value=99 <?php if($information && $information[0]["llantas_traseras"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="llantas_repuesto">Llanta de repuesto</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="llantas_repuesto" id="llantas_repuesto1" value=1 <?php if($information && $information[0]["llantas_repuesto"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="llantas_repuesto" id="llantas_repuesto2" value=0 <?php if($information && $information[0]["llantas_repuesto"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="llantas_repuesto" id="llantas_repuesto3" value=99 <?php if($information && $information[0]["llantas_repuesto"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_llantas">Observaciones</label>
								<textarea id="observacion_llantas" name="observacion_llantas" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_llantas"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row" id="div_fifth_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					ESPEJOS <small>(Verificar limpieza, estado, sin roturas, ni opacidad) UBICAR ACORDE A NECESIDAD.</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="espejos_laterales">Espejos laterales</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="espejos_laterales" id="espejos_laterales1" value=1 <?php if($information && $information[0]["espejos_laterales"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="espejos_laterales" id="espejos_laterales2" value=0 <?php if($information && $information[0]["espejos_laterales"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="espejos_laterales" id="espejos_laterales3" value=99 <?php if($information && $information[0]["espejos_laterales"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="espejos_retrovisor">Espejo retrovisor</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="espejos_retrovisor" id="espejos_retrovisor1" value=1 <?php if($information && $information[0]["espejos_retrovisor"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="espejos_retrovisor" id="espejos_retrovisor2" value=0 <?php if($information && $information[0]["espejos_retrovisor"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="espejos_retrovisor" id="espejos_retrovisor3" value=99 <?php if($information && $information[0]["espejos_retrovisor"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_espejos">Observaciones</label>
								<textarea id="observacion_espejos" name="observacion_espejos" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_espejos"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					PITO <small>(Accionar antes de iniciar la marcha debe responder en forma adecuada)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="pito">Pito</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="pito" id="pito1" value=1 <?php if($information && $information[0]["pito"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="pito" id="pito2" value=0 <?php if($information && $information[0]["pito"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="pito" id="pito3" value=99 <?php if($information && $information[0]["pito"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_pito">Observaciones</label>
								<textarea id="observacion_pito" name="observacion_pito" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_pito"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row" id="div_sixth_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					NIVELES DE FLUIDOS <small>(Niveles adecuados sin fugas)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="nivel_frenos">Frenos</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="nivel_frenos" id="nivel_frenos1" value=1 <?php if($information && $information[0]["nivel_frenos"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_frenos" id="nivel_frenos2" value=0 <?php if($information && $information[0]["nivel_frenos"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_frenos" id="nivel_frenos3" value=99 <?php if($information && $information[0]["nivel_frenos"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="nivel_aceite">Aceite</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="nivel_aceite" id="nivel_aceite1" value=1 <?php if($information && $information[0]["nivel_aceite"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_aceite" id="nivel_aceite2" value=0 <?php if($information && $information[0]["nivel_aceite"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_aceite" id="nivel_aceite3" value=99 <?php if($information && $information[0]["nivel_aceite"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="nivel_refrigerante">Refrigerante</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="nivel_refrigerante" id="nivel_refrigerante1" value=1 <?php if($information && $information[0]["nivel_refrigerante"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_refrigerante" id="nivel_refrigerante2" value=0 <?php if($information && $information[0]["nivel_refrigerante"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_refrigerante" id="nivel_refrigerante3" value=99 <?php if($information && $information[0]["nivel_refrigerante"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="nivel_caja">Líquido de caja de dirección</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="nivel_caja" id="nivel_caja1" value=1 <?php if($information && $information[0]["nivel_caja"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_caja" id="nivel_caja2" value=0 <?php if($information && $information[0]["nivel_caja"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="nivel_caja" id="nivel_caja3" value=99 <?php if($information && $information[0]["nivel_caja"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_niveles">Observaciones</label>
								<textarea id="observacion_niveles" name="observacion_niveles" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_niveles"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					APOYA CABEZAS <small>(Ajustar al iniciar la marcha)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="apoyo_delantero">Apoya cabezas delanteros</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="apoyo_delantero" id="apoyo_delantero1" value=1 <?php if($information && $information[0]["apoyo_delantero"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="apoyo_delantero" id="apoyo_delantero2" value=0 <?php if($information && $information[0]["apoyo_delantero"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="apoyo_delantero" id="apoyo_delantero3" value=99 <?php if($information && $information[0]["apoyo_delantero"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="apoyo_trasero">Apoya cabezas traseros</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="apoyo_trasero" id="apoyo_trasero1" value=1 <?php if($information && $information[0]["apoyo_trasero"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="apoyo_trasero" id="apoyo_trasero2" value=0 <?php if($information && $information[0]["apoyo_trasero"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="apoyo_trasero" id="apoyo_trasero3" value=99 <?php if($information && $information[0]["apoyo_trasero"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_apoyo">Observaciones</label>
								<textarea id="observacion_apoyo" name="observacion_apoyo" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_apoyo"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row" id="div_seventh_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					CINTURONES DE SEGURIDAD <small>(Verificar el estado)</small>
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="cinturon_delantero">Cinturones delanteros</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="cinturon_delantero" id="cinturon_delantero1" value=1 <?php if($information && $information[0]["cinturon_delantero"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="cinturon_delantero" id="cinturon_delantero2" value=0 <?php if($information && $information[0]["cinturon_delantero"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="cinturon_delantero" id="cinturon_delantero3" value=99 <?php if($information && $information[0]["cinturon_delantero"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="cinturon_trasero">Cinturones traseros</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="cinturon_trasero" id="cinturon_trasero1" value=1 <?php if($information && $information[0]["cinturon_trasero"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="cinturon_trasero" id="cinturon_trasero2" value=0 <?php if($information && $information[0]["cinturon_trasero"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="cinturon_trasero" id="cinturon_trasero3" value=99 <?php if($information && $information[0]["cinturon_trasero"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_cinturon">Observaciones</label>
								<textarea id="observacion_cinturon" name="observacion_cinturon" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_cinturon"]; }?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row" id="div_eighth_box" style="display:<?php echo $validacion2; ?>">
		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					EQUIPOS DE SEGURIDAD<br>
					REVISAR LOS EQUIPOS DE SEGURIDAD DIARIAMENTE ESTADO Y FECHAS DE VENCIMIENTO
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_seguridad">Observaciones</label>
								<textarea id="observacion_seguridad" name="observacion_seguridad" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_seguridad"]; }?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6">				
			<div class="panel panel-primary">
				<div class="panel-heading">
					EQUIPOS DE CARRETERA
				</div>
				<div class="panel-body">

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="extintor">Extintor (Vencimiento y estado)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="extintor" id="extintor1" value=1 <?php if($information && $information[0]["extintor"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="extintor" id="extintor2" value=0 <?php if($information && $information[0]["extintor"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="extintor" id="extintor3" value=99 <?php if($information && $information[0]["extintor"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="herramientas">Herramientas (Las necesarias)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="herramientas" id="herramientas1" value=1 <?php if($information && $information[0]["herramientas"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="herramientas" id="herramientas2" value=0 <?php if($information && $information[0]["herramientas"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="herramientas" id="herramientas3" value=99 <?php if($information && $information[0]["herramientas"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="cruceta">Cruceta (Apta)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="cruceta" id="cruceta1" value=1 <?php if($information && $information[0]["cruceta"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="cruceta" id="cruceta2" value=0 <?php if($information && $information[0]["cruceta"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="cruceta" id="cruceta3" value=99 <?php if($information && $information[0]["cruceta"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="gato">Gato (Con capacidad)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="gato" id="gato1" value=1 <?php if($information && $information[0]["gato"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="gato" id="gato2" value=0 <?php if($information && $information[0]["gato"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="gato" id="gato3" value=99 <?php if($information && $information[0]["gato"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="tacos">Tacos (dos tacos)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="tacos" id="tacos1" value=1 <?php if($information && $information[0]["tacos"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="tacos" id="tacos2" value=0 <?php if($information && $information[0]["tacos"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="tacos" id="tacos3" value=99 <?php if($information && $information[0]["tacos"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="triangulo">Señaletica (Triangulo con material reflectivo)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="triangulo" id="triangulo1" value=1 <?php if($information && $information[0]["triangulo"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="triangulo" id="triangulo2" value=0 <?php if($information && $information[0]["triangulo"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="triangulo" id="triangulo3" value=99 <?php if($information && $information[0]["triangulo"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="chaleco">Chaleco (Reflectivo)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="chaleco" id="chaleco1" value=1 <?php if($information && $information[0]["chaleco"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="chaleco" id="chaleco2" value=0 <?php if($information && $information[0]["chaleco"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="chaleco" id="chaleco3" value=99 <?php if($information && $information[0]["chaleco"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label class="col-sm-5 control-label" for="botiquin">Botiquin (Vencimiento y estado)</label>
							<div class="col-sm-7">
								<label class="radio-inline">
									<input type="radio" name="botiquin" id="botiquin1" value=1 <?php if($information && $information[0]["botiquin"] == 1) { echo "checked"; }  ?>>Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="botiquin" id="botiquin2" value=0 <?php if($information && $information[0]["botiquin"] == 0) { echo "checked"; }  ?>>No Cumple
								</label>
								<label class="radio-inline">
									<input type="radio" name="botiquin" id="botiquin3" value=99 <?php if($information && $information[0]["botiquin"] == 99) { echo "checked"; }  ?>>N/A
								</label>
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label" for="observacion_botiquin">Observaciones</label>
								<textarea id="observacion_botiquin" name="observacion_botiquin" placeholder="Observación" class="form-control" rows="3" ><?php if($information){ echo $information[0]["observacion_botiquin"]; }?></textarea>
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
	
</div>
<!-- /#page-wrapper -->