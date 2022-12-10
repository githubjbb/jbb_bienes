<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/contratos.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario Contratos de Mantenimiento
	<br><small>Adicionar/Editar Contratos de Mantenimiento.</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_contrato_mantenimiento"]:""; ?>" />
		<input type="hidden" id="hddGastoContrato" name="hddGastoContrato" value="<?php echo $information?$information[0]["gastos_contrato"]:0; ?>" />
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="numero_contrato">Número de Contrato: *</label>
					<input type="text" id="numero_contrato" name="numero_contrato" class="form-control" value="<?php echo $information?$information[0]["numero_contrato"]:""; ?>" placeholder="Número de Contrato" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="id_proveedor">Proveedor: *</label>
					<select name="id_proveedor" id="id_proveedor" class="form-control">
						<option value="">Seleccione...</option>
						<?php 									
						for ($i = 0; $i < count($proveedores); $i++) { ?>
							<option value="<?php echo $proveedores[$i]["id_proveedor"]; ?>" <?php if($information && $information[0]["fk_id_proveedor"] == $proveedores[$i]["id_proveedor"]) { echo "selected"; }  ?>><?php echo $proveedores[$i]["nombre_proveedor"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		</div>

<script>
$( function() {
var dateFormat = "mm/dd/yy",
from = $( "#fecha_desde" )
.datepicker({
changeMonth: true,
changeYear: true
})
.on( "change", function() {
to.datepicker( "option", "minDate", getDate( this ) );
}),
to = $( "#fecha_hasta" ).datepicker({
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

<?php 
if($information){
	$fechaInicio = date('m/d/Y', strtotime($information[0]['fecha_desde']));
	$fechaVencimiento = date('m/d/Y', strtotime($information[0]['fecha_hasta']));
}
?>
		
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_desde">Vigencia Desde: *</label>
					<input type="text" class="form-control" id="fecha_desde" name="fecha_desde" value="<?php echo $information?$fechaInicio:""; ?>" placeholder="Fecha Inicio" />
				</div>
			</div>
			
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="fecha_hasta">Vigencia Hasta: *</label>
					<input type="text" class="form-control" id="fecha_hasta" name="fecha_hasta" value="<?php echo $information?$fechaVencimiento:""; ?>" placeholder="Fecha Vencimiento" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="id_supervidor">Supervisor del contrato: *</label>
					<select name="id_supervidor" id="id_supervidor" class="form-control">
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($listaUsuarios); $i++) { ?>
							<option value="<?php echo $listaUsuarios[$i]["id_user"]; ?>" <?php if($information && $information[0]["fk_id_supervisor"] == $listaUsuarios[$i]["id_user"]) { echo "selected"; }  ?>><?php echo $listaUsuarios[$i]["first_name"] . ' ' . $listaUsuarios[$i]["last_name"]; ?></option>		
						<?php } ?>
					</select>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="valor_contrato">Valor de Contrato: *</label>
					<input type="number" id="valor_contrato" name="valor_contrato" class="form-control" value="<?php echo $information?$information[0]["valor_contrato"]:""; ?>" placeholder="Valor de Contrato" required >
				</div>
			</div>
		</div>

	<?php if($information){ ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado: *</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information[0]["estado_contrato"] == 1) { echo "selected"; }  ?>>En Ejecución</option>
						<option value=2 <?php if($information[0]["estado_contrato"] == 2) { echo "selected"; }  ?>>Prorroga</option>
						<option value=3 <?php if($information[0]["estado_contrato"] == 3) { echo "selected"; }  ?>>Finalizado</option>
					</select>
				</div>
			</div>
		</div>
	<?php }else{ ?>
			<input type="hidden" id="estado" name="estado" value=1 />
	<?php } ?>
		
		
		<div class="row">
			<div class="col-sm-12">		
				<div class="form-group text-left">
					<label class="control-label" for="objeto_contrato">Objeto del Contrato: </label>
					<textarea id="objeto_contrato" name="objeto_contrato" placeholder="Objeto del Contrato" class="form-control" rows="3"><?php echo $information?$information[0]["objeto_contrato"]:""; ?></textarea>
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