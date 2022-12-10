<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo_detalle_bomba_v2.js"); ?>"></script>

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
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoEspecifica?$infoEspecifica[0]["id_equipo_detalle_bomba"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<input type="hidden" id="hddMetodoGuardar" name="hddMetodoGuardar" value="<?php echo $info[0]['metodo_guardar']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="dimension">Dimensión: </label>
								<input type="text" id="dimension" name="dimension" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["dimension"]:""; ?>" placeholder="Dimension" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="motor_frecuencia">Frecuencia Motor: </label>
								<input type="text" id="motor_frecuencia" name="motor_frecuencia" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motor_frecuencia"]:""; ?>" placeholder="Frecuencia Motor" <?php echo $deshabilitar; ?>>
							</div>							
						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="motor_velocidad">Velocidad Motor: </label>
								<input type="text" id="motor_velocidad" name="motor_velocidad" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motor_velocidad"]:""; ?>" placeholder="Velocidad Motor" <?php echo $deshabilitar; ?>>
							</div>
							
							<div class="col-sm-6">
								<label for="motor_voltaje">Voltaje Motor: </label>
								<input type="text" id="motor_voltaje" name="motor_voltaje" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motor_voltaje"]:""; ?>" placeholder="Voltaje Motor" <?php echo $deshabilitar; ?>>
							</div>
						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="potencia">Potencia: </label>
								<input type="text" id="potencia" name="potencia" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["potencia"]:""; ?>" placeholder="Potencia"  <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="consumo">Consumo: </label>
								<input type="text" id="consumo" name="consumo" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["consumo"]:""; ?>" placeholder="Consumo"  <?php echo $deshabilitar; ?>>
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="hmax">Hmax: </label>
								<input type="text" id="hmax" name="hmax" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["hmax"]:""; ?>" placeholder="Hmax" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="qmax">Qmax: </label>
								<input type="text" id="qmax" name="qmax" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["qmax"]:""; ?>" placeholder="Qmax" <?php echo $deshabilitar; ?>>
							</div>					
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="succion">Succión: </label>
								<input type="text" id="succion" name="succion" class="form-control" value='<?php echo $infoEspecifica?$infoEspecifica[0]["succion"]:""; ?>' placeholder="Succión" <?php echo $deshabilitar; ?>>
							</div>					
							
							<div class="col-sm-6">
								<label for="salida">Salida: </label>
								<input type="text" id="salida" name="salida" class="form-control" value='<?php echo $infoEspecifica?$infoEspecifica[0]["salida"]:""; ?>' placeholder="Salida" <?php echo $deshabilitar; ?>>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="color">Color: </label>
								<input type="text" id="color" name="color" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["color"]:""; ?>" placeholder="Color" <?php echo $deshabilitar; ?>>
							</div>					
							
							<div class="col-sm-6">
								<label for="peso">Peso: </label>
								<input type="text" id="peso" name="peso" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["peso"]:""; ?>" placeholder="Peso" <?php echo $deshabilitar; ?>>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="caracteristicas">Características: </label>
								<textarea id="caracteristicas" name="caracteristicas" placeholder="Características" class="form-control" rows="3" <?php echo $deshabilitar; ?>><?php echo $infoEspecifica?$infoEspecifica[0]["caracteristicas"]:""; ?></textarea>
							</div>
						
							<div class="col-sm-6">
								<label for="condiciones_operacion">Condiciones de Operación: </label>
								<textarea id="condiciones_operacion" name="condiciones_operacion" placeholder="Condiciones de Operación" class="form-control" rows="3" <?php echo $deshabilitar; ?>><?php echo $infoEspecifica?$infoEspecifica[0]["condiciones_operacion"]:""; ?></textarea>
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

						<?php if(!$deshabilitar){ ?>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:100%;" align="center">							
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-success'>
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