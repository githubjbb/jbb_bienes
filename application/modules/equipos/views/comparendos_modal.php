<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/comparendos.js"); ?>"></script>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Comparendos Conductores </h4>
</div>

<div class="modal-body">
	<form  name="formComparendos" id="formComparendos" role="form" method="post" >
		<input type="hidden" id="hddidEquipo" name="hddidEquipo" value="<?php echo $infoEquipo[0]["id_equipo"]; ?>"/>
		<input type="hidden" id="hddidConductor" name="hddidConductor" value="<?php echo $infoEquipo[0]["fk_id_responsable"]; ?>"/>
		<input type="hidden" id="hddidComparendo" name="hddidComparendo" value="<?php echo $information?$information[0]["id_comparendo"]:""; ?>"/>
	
<script>
	$( function() {
		$( "#fecha_revision" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
		
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_revision">Fecha Revisión: *</label>
					<input type="text" class="form-control" id="fecha_revision" name="fecha_revision" value="<?php echo $information?$information[0]["fecha_revision"]:""; ?>" placeholder="Fecha Revisión" required />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="verificacion_runt">Verificación RUNT: *</label>
					<input type="text" id="verificacion_runt" name="verificacion_runt" class="form-control" value="<?php echo $information?$information[0]["verificacion_runt"]:""; ?>" placeholder="Verificación RUNT" required>
				</div>
			</div>

			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="verificacion_simit">Verificación SIMIT: *</label>
					<input type="text" id="verificacion_simit" name="verificacion_simit" class="form-control" value="<?php echo $information?$information[0]["verificacion_simit"]:""; ?>" placeholder="Verificación SIMIT" required>
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
					<button type="button" id="btnSubmitComparendos" name="btnSubmitComparendos" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
		
	</form>
</div>