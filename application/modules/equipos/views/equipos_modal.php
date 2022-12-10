<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo_v3.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Equipos</h4>
</div>

<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_equipo"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="numero_inventario">No. Inventario Entidad: *</label>
					<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $information?$information[0]["numero_inventario"]:""; ?>" placeholder="No. Inventario Entidad" >
				</div>
			</div>
			
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="id_dependencia">Área Responsable: *</label>
					<select name="id_dependencia" id="id_dependencia" class="form-control" required>
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($dependencias); $i++) { ?>
							<option value="<?php echo $dependencias[$i]["id_dependencia"]; ?>" <?php if($information && $information[0]["fk_id_dependencia"] == $dependencias[$i]["id_dependencia"]) { echo "selected"; }  ?>><?php echo $dependencias[$i]["dependencia"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="marca">Marca: *</label>
					<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $information?$information[0]["marca"]:""; ?>" placeholder="Marca" >
				</div>
			</div>
		</div>
		
		<div class="row">

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="modelo">Modelo: *</label>
					<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $information?$information[0]["modelo"]:""; ?>" placeholder="Modelo" >
				</div>
			</div>
	
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="numero_serial">Número Serial/Serie: *</label>
					<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $information?$information[0]["numero_serial"]:""; ?>" placeholder="Número Serial" >
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="id_tipo_equipo">Tipo Equipo: *</label>
					<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required>
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
							<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($information && $information[0]["fk_id_tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>		
		</div>

		<div class="row">
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="id_contrato">Contrato de Mantenimiento: *</label>
					<select name="id_contrato" id="id_contrato" class="form-control">
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($contratosMantenimiento); $i++) { ?>
							<option value="<?php echo $contratosMantenimiento[$i]["id_contrato_mantenimiento"]; ?>" <?php if($information && $information[0]["fk_id_contrato_mantenimiento"] == $contratosMantenimiento[$i]["id_contrato_mantenimiento"]) { echo "selected"; }  ?>><?php echo $contratosMantenimiento[$i]["numero_contrato"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Placa: </label>
					<input type="text" id="placa" name="placa" class="form-control" value="<?php echo $information?$information[0]["placa"]:""; ?>" placeholder="Placa" >
				</div>
			</div>

<script>
	$( function() {
		$( "#fecha_adquisicion" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
		
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="valor_comercial">Valor Comercial: </label>
					<input type="text" id="valor_comercial" name="valor_comercial" class="form-control" value="<?php echo $information?$information[0]["valor_comercial"]:""; ?>" placeholder="Valor Comercial" >
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Fecha Adquisición: *</label>
					<input type="text" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" value="" placeholder="Fecha Adquisición" />
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="id_responsable">Operador/Conductor: *</label>
					<select name="id_responsable" id="id_responsable" class="form-control" >
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($listaUsuarios); $i++) { ?>
							<option value="<?php echo $listaUsuarios[$i]["id_user"]; ?>" <?php if($information && $information[0]["fk_id_responsable"] == $listaUsuarios[$i]["id_user"]) { echo "selected"; }  ?>><?php echo $listaUsuarios[$i]["first_name"] . ' ' . $listaUsuarios[$i]["last_name"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado: *</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value=''>Select...</option>
						<option value=1 <?php if($information && $information[0]["estado_equipo"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information && $information[0]["estado_equipo"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>	
		</div>

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="profesional_asignado">Profesional asignado: *</label>
					<select name="profesional_asignado" id="profesional_asignado" class="form-control" required>
						<option value=''>Select...</option>
						<option value=1 <?php if($information && $information[0]["profesional_asignado"] == 1) { echo "selected"; }  ?>>Director</option>
						<option value=2 <?php if($information && $information[0]["profesional_asignado"] == 2) { echo "selected"; }  ?>>Secretario</option>
						<option value=2 <?php if($information && $information[0]["profesional_asignado"] == 3) { echo "selected"; }  ?>>Subdirector técnico y operativo</option>
					</select>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="observacion">Observación: </label>
					<textarea id="observacion" name="observacion" placeholder="Observación" class="form-control" rows="3"><?php echo $information?$information[0]["observacion"]:""; ?></textarea>
				</div>
			</div>

		</div>
						
		<div class="form-group">
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
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>