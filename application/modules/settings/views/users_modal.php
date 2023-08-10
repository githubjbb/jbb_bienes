<script type="text/javascript" src="<?php echo base_url("assets/js/validate/settings/users.js"); ?>"></script>

<script>
$(document).ready(function () {
	
    $('#id_role').change(function () {
            if ($('#id_role').val() ==  $('#hddIdConductor').val() ) {
				$("#div_conductor").css("display", "inline");
            }else{
                $('#numero_licencia').val("");
                $('#categoria').val("");
                $('#vigencia').val("");
                $('#numero_contrato').val("");
                $('#fecha_inicio').val("");
                $('#fecha_final').val("");
                $('#tipoVinculacion').val("");
                $("#div_conductor").css("display", "none");
            }

    });
    
});

	$( function() {
		var dateFormat = "mm/dd/yy",
		from = $( "#fecha_inicio" )
		.datepicker({
			changeMonth: true,
			changeYear: true
		})
		.on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
		}),
		to = $( "#fecha_final" ).datepicker({
			changeMonth: true,
			changeYear: true
		})
		.on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
		});

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}

			return date;
		}
	});
</script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Usuario
	<br><small>Adicionar/Editar Usuario</small>
	</h4>
</div>

<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_user"]:""; ?>"/>
		<input type="hidden" id="hddIdConductor" name="hddIdConductor" value="<?php echo ID_ROL_CONDUCTOR; ?>"/>
		
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="firstName">Nombre: *</label>
					<input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $information?$information[0]["first_name"]:""; ?>" placeholder="Nombre" required >
				</div>
			</div>
			
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="lastName">Apellido: *</label>
					<input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $information?$information[0]["last_name"]:""; ?>" placeholder="Apellido" required >
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="numeroCelular">Número Cédula: *</label>
					<input type="text" id="numeroCelular" name="numeroCelular" class="form-control" value="<?php echo $information?$information[0]["numero_cedula"]:""; ?>" placeholder="Número Cédula" required >
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="user">Nombre Usuario: *</label>
					<input type="text" id="user" name="user" class="form-control" value="<?php echo $information?$information[0]["log_user"]:""; ?>" placeholder="Nombre Usuario" required >
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo: *</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $information?$information[0]["email"]:""; ?>" placeholder="Correo" />
				</div>
			</div>

			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="idDependencia">Dependencia: *</label>
					<select name="idDependencia" id="idDependencia" class="form-control" required >
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($dependencias); $i++) { ?>
							<option value="<?php echo $dependencias[$i]["id_dependencia"]; ?>" <?php if($information && $information[0]["fk_id_dependencia_u"] == $dependencias[$i]["id_dependencia"]) { echo "selected"; }  ?>><?php echo $dependencias[$i]["dependencia"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="id_role">Rol Usuario: *</label>					
					<select name="id_role" id="id_role" class="form-control" required>
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($roles); $i++) { ?>
							<option value="<?php echo $roles[$i]["id_role"]; ?>" <?php if($information && $information[0]["fk_id_user_role"] == $roles[$i]["id_role"]) { echo "selected"; }  ?>><?php echo $roles[$i]["role_name"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="movilNumber">Número Celular: *</label>
					<input type="text" id="movilNumber" name="movilNumber" class="form-control" value="<?php echo $information?$information[0]["movil"]:""; ?>" placeholder="Número Celular" required >
				</div>
			</div>


	<?php if($information){ ?>
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="state">Estado: *</label>
					<select name="state" id="state" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information[0]["state"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information[0]["state"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>
	<?php } ?>
		</div>

<?php 
	$fieldConductor = "none";
	if($information && $information[0]["fk_id_user_role"] == ID_ROL_CONDUCTOR){
		$fieldConductor = "inline";
	}
?>

		<div class="row" id="div_conductor" style="display:<?php echo $fieldConductor; ?>">	
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="numero_licencia">No. Licencia: </label>
					<input type="text" class="form-control" id="numero_licencia" name="numero_licencia" value="<?php echo $information?$information[0]["numero_licencia"]:""; ?>" placeholder="No. Licencia" />
				</div>
			</div>
			
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="categoria">Categoría: </label>
					<input type="text" id="categoria" name="categoria" class="form-control" value="<?php echo $information?$information[0]["categoria"]:""; ?>" placeholder="Categoría" />
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="vigencia">Vigencia: </label>
					<input type="text" id="vigencia" name="vigencia" class="form-control" value="<?php echo $information?$information[0]["vigencia"]:""; ?>" placeholder="Vigencia" />
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="numero_contrato">No. Contrato: </label>
					<input type="text" id="numero_contrato" name="numero_contrato" class="form-control" value="<?php echo $information?$information[0]["numero_contrato"]:""; ?>" placeholder="No. Contrato" />
				</div>
			</div>

<?php 
if($information){
	$fechaInicio = date('m/d/Y', strtotime($information[0]['fecha_inicio_contrato']));
	$fechaFinal= date('m/d/Y', strtotime($information[0]['fecha_final_contrato']));
}
?>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_inicio">Fecha Inicio: </label>
					<input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $information?$fechaInicio:""; ?>" placeholder="Fecha Inicio" />
				</div>
			</div>
			
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="fecha_final">Fecha Final: </label>
					<input type="text" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $information?$fechaFinal:""; ?>" placeholder="Fecha Final" />
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="tipoVinculacion">Tipo Vinculación:</label>
					<select name="tipoVinculacion" id="tipoVinculacion" class="form-control">
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information && $information[0]["tipo_vinculacion"] == 1) { echo "selected"; }  ?>>Planta</option>
						<option value=2 <?php if($information && $information[0]["tipo_vinculacion"] == 2) { echo "selected"; }  ?>>Contratista</option>
					</select>
				</div>
			</div>			

			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="tiene_multas">Actualmente tiene multas?: </label>
					<select name="tiene_multas" id="tiene_multas" class="form-control" >
						<option value=''>Select...</option>
						<option value=1 <?php if($information && $information[0]["tiene_multas"] == 1) { echo "selected"; }  ?>>Si</option>
						<option value=2 <?php if($information && $information[0]["tiene_multas"] == 2) { echo "selected"; }  ?>>No</option>
					</select>
				</div>
			</div>
			
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="codigo_multa">Código multa: </label>
					<input type="text" id="codigo_multa" name="codigo_multa" class="form-control" value="<?php echo $information?$information[0]["codigo_multa"]:""; ?>" placeholder="Código y/o motivo" maxlength="30" >
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
		<!--<p class="text-danger text-left">Clave usuarios nuevos: <strong>Jardin2021<strong></p>-->
	</form>
</div>