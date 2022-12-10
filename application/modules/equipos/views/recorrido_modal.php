<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/recorrido.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/ajaxEquipos.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Recorridos </h4>
</div>

<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form  name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddidRecorrido" name="hddidRecorrido" value="<?php echo $information?$information[0]["id_equipo_recorrido"]:""; ?>"/>
				
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="idTipoEquipo">Tipo de Equipo: *</label>
					<select name="idTipoEquipo" id="idTipoEquipo" class="form-control" required >
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
							<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($information && $information[0]["fk_id_tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		
<?php 
	$mostrar = "none";
	if($information && !IS_NULL($information[0]["fk_id_equipo_r"]) && $information[0]["fk_id_equipo_r"] > 0 && $infoEquipos){
		$mostrar = "inline";
	}
?>

			<div class="col-sm-6" id="div_equipo" style="display:<?php echo $mostrar; ?>">
				<div class="form-group text-left">
					<label class="control-label" for="idEquipo">Equipo: *</label>
					<select name="idEquipo" id="idEquipo" class="form-control" required>
						<option value="">Select...</option>
						<?php 
						if($infoEquipos){
							for ($i = 0; $i < count($infoEquipos); $i++) { ?>
							<option value="<?php echo $infoEquipos[$i]["id_equipo"]; ?>" <?php if($information && $information[0]["fk_id_equipo_r"] == $infoEquipos[$i]["id_equipo"]) { echo "selected"; }  ?>>No. Inventario: <?php echo $infoEquipos[$i]["numero_inventario"]; ?></option>	
						<?php 
							}
						} 
						?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="idConductor">Conductor: *</label>
					<select name="idConductor" id="idConductor" class="form-control" required>
						<option value=''>Seleccione...</option>
						<?php for ($i = 0; $i < count($listaOperadores); $i++) { ?>
							<option value="<?php echo $listaOperadores[$i]["id_user"]; ?>" <?php if($information && $information[0]["fk_id_coductor_recorrido"] == $listaOperadores[$i]["id_user"]) { echo "selected"; }  ?>><?php echo $listaOperadores[$i]["first_name"] . ' ' . $listaOperadores[$i]["last_name"]; ?></option>		
						<?php } ?>
					</select>
				</div>
			</div>
		
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="idMes">Mes: *</label>
					<select name="idMes" id="idMes" class="form-control" required >
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($listaMeses); $i++) { ?>
							<option value="<?php echo $listaMeses[$i]["id_mes"]; ?>" <?php if($information && $information[0]["fk_id_mes_recorrdio"] == $listaMeses[$i]["id_mes"]) { echo "selected"; }  ?>><?php echo $listaMeses[$i]["mes"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>

		</div>

<script>
	$( function() {
		$( "#fecha_recorrido" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
		
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_recorrido">Fecha Recorrido: *</label>
					<input type="text" class="form-control" id="fecha_recorrido" name="fecha_recorrido" value="<?php echo $information?$information[0]["fecha_recorrido"]:""; ?>" placeholder="Fecha Recorrido" required />
				</div>
			</div>
		</div>

		<div class="row">				
			<div class="col-sm-12">		
				<div class="form-group text-left">
					<label class="control-label" for="recorrido">Recorrido: </label>
					<textarea id="recorrido" name="recorrido" placeholder="Recorrido" class="form-control" rows="3"><?php echo $information?$information[0]["recorrido"]:""; ?></textarea>
				</div>
			</div>
		</div>

		<div class="row">				
			<div class="col-sm-12">		
				<div class="form-group text-left">
					<label class="control-label" for="area">Área: </label>
					<textarea id="area" name="area" placeholder="Área" class="form-control" rows="3"><?php echo $information?$information[0]["area"]:""; ?></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="usuario_nombre">Nombre Usuario: *</label>
					<input type="text" id="usuario_nombre" name="usuario_nombre" class="form-control" value="<?php echo $information?$information[0]["usuario_nombre"]:""; ?>" placeholder="Nombre Usuario" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="usuario_correo">Correo Usuario: *</label>
					<input type="email" class="form-control" id="usuario_correo" name="usuario_correo" value="<?php echo $information?$information[0]["usuario_correo"]:""; ?>" placeholder="Correo Usuario" required />
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