<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/consumo.js"); ?>"></script>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Consumo del Recorrido</h4>
</div>

<div class="modal-body">
	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	<form  name="formConsumo" id="formConsumo" role="form" method="post" >
		<input type="hidden" id="hddidConsumo" name="hddidConsumo" value="<?php echo $information?$information[0]["id_equipo_recorrido_consumo"]:""; ?>"/>
		<input type="hidden" id="hddidRecorrido" name="hddidRecorrido" value="<?php echo $idRecorrido; ?>"/>

<script>
	$( function() {
		$( "#fecha_consumo" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_consumo">Fecha: *</label>
					<input type="text" class="form-control" id="fecha_consumo" name="fecha_consumo" value="<?php echo $information?$information[0]["fecha_consumo"]:""; ?>" placeholder="Fecha" required />
				</div>
			</div>
		</div>
				
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="valor_x_galon">Valor por Galón: *</label>
					<input type="number" id="valor_x_galon" name="valor_x_galon" class="form-control" value="<?php echo $information?$information[0]["valor_x_galon_consumo"]:""; ?>" placeholder="Valor por Galón" >
				</div>
			</div>

			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="cantidad">Número de Galones: *</label>
					<input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo $information?$information[0]["numero_galones"]:""; ?>" placeholder="Número de Galones" >
				</div>
			</div>
		</div>

		<div class="row">


			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="Kilometraje">Horas o Kilometraje: *</label>
					<input type="number" id="Kilometraje" name="Kilometraje" class="form-control" value="<?php echo $information?$information[0]["kilometraje"]:""; ?>" placeholder="Horas o Kilometraje" >
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
					<button type="button" id="btnSubmitConsumo" name="btnSubmitConsumo" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
		
	</form>
</div>