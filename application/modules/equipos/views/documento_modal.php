<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/documento.js"); ?>"></script>

<script>
$(document).ready(function () {
	
    $('#noAplica').change(function () {
            if ($('#noAplica').prop('checked') ) {
				$("#div_no_aplica").css("display", "inline");
            }else{
                $('#fecha_inicio').val("");
                $('#fecha_vencimiento').val("");
                $("#div_no_aplica").css("display", "none");
            }

    });
    
});
</script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Documento del Equipo
	<br><small>Adicionar/Editar Documento</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $idEquipo; ?>"/>
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_equipo_documento"]:""; ?>"/>

<script>
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
		to = $( "#fecha_vencimiento" ).datepicker({
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
	$fechaInicio = date('m/d/Y', strtotime($information[0]['fecha_inicio']));
	$fechaVencimiento = date('m/d/Y', strtotime($information[0]['fecha_vencimiento']));
}
?>
		
		<div class="row">	
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="tipo_documento">Tipo Documento: *</label>
						<select name="tipo_documento" id="tipo_documento" class="form-control" required>
							<option value="">Seleccione...</option>
							<?php for ($i = 0; $i < count($tiposDocumento); $i++) { ?>
								<option value="<?php echo $tiposDocumento[$i]["id_tipo_documento"]; ?>" <?php if($information && $information[0]["fk_id_tipo_documento"] == $tiposDocumento[$i]["id_tipo_documento"]) { echo "selected"; }  ?>><?php echo $tiposDocumento[$i]["tipo_documento"]; ?></option>	
							<?php } ?>
						</select>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="numero_documento">No. Documento: *</label>
					<input type="text" class="form-control" id="numero_documento" name="numero_documento" value="<?php echo $information?$information[0]["numero_documento"]:""; ?>" placeholder="No. Documento" />
				</div>
			</div>
		</div>

		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group text-left">
					<input type="checkbox" id="noAplica" name="noAplica" value="1" <?php if($information && $information[0]["aplica_fechas"]){echo "checked";} ?> > Aplica fechas
				</div>
			</div>
		</div>

<?php 
	$fieldFechas = "none";
	if($information && $information[0]["aplica_fechas"]){
		$fieldFechas = "inline";
	}
?>
						
		<div class="row" id="div_no_aplica" style="display:<?php echo $fieldFechas; ?>">	
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_inicio">Fecha Inicio: *</label>
					<input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $information?$fechaInicio:""; ?>" placeholder="Fecha Inicio" />
				</div>
			</div>
			
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="fecha_vencimiento">Fecha Vencimiento: *</label>
					<input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $information?$fechaVencimiento:""; ?>" placeholder="Fecha Vencimiento" />
				</div>
			</div>
		</div>

		<div class="row">				
			<div class="col-sm-12">		
				<div class="form-group text-left">
					<label class="control-label" for="descripcion">Descripción: </label>
					<textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" rows="3"><?php echo $information?$information[0]["descripcion"]:""; ?></textarea>
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