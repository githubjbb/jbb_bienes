<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function () {
	
    $('#noAplica').change(function () {
            $('#fecha_inicio').val("");
            $('#fecha_vencimiento').val("");
            if ($('#noAplica').prop('checked') ) {
				$("#div_no_aplica").css("display", "inline");
            }else{
                $("#div_no_aplica").css("display", "none");
            }

    });
    
});
</script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href="<?php echo base_url('equipos/documento/' . $info[0]['id_equipo']); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-image"></i> <strong>DOCUMENTOS </strong> 
					<br><strong>Tipo Equipo: </strong><?php echo $info[0]['tipo_equipo']; ?>
					<br><strong>No. Inventario: </strong><?php echo $info[0]['numero_inventario']; ?>
				</div>
				<div class="panel-body">

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
				
					<form  name="form_map" id="form_map" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("equipos/do_upload_doc"); ?>">
					<input type="hidden" class="form-control" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>" />
					<input type="hidden" id="hddidDocumento" name="hddidDocumento" value="<?php echo $information?$information[0]["id_equipo_documento"]:""; ?>"/>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="tipo_documento">Tipo Documento: *</label>
							<div class="col-sm-5">
								<select name="tipo_documento" id="tipo_documento" class="form-control" required>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tiposDocumento); $i++) { ?>
										<option value="<?php echo $tiposDocumento[$i]["id_tipo_documento"]; ?>" <?php if($information[0]["fk_id_tipo_documento"] == $tiposDocumento[$i]["id_tipo_documento"]) { echo "selected"; }  ?>><?php echo $tiposDocumento[$i]["tipo_documento"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="numero_documento">No. Documento: *</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="numero_documento" name="numero_documento" value="<?php echo $information?$information[0]["numero_documento"]:""; ?>" placeholder="No. Documento" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label" for="numero_documento">Fechas: </label>
							<div class="col-sm-5">
								<input type="checkbox" id="noAplica" name="noAplica" value="1" <?php if($information && $information[0]["aplica_fechas"]){echo "checked";} ?> > Aplica fechas
							</div>
						</div>

<?php 
	$fieldFechas = "none";
	if($information && $information[0]["aplica_fechas"]){
		$fieldFechas = "inline";
	}
?>
					<div class="row" id="div_no_aplica" style="display:<?php echo $fieldFechas; ?>">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="fecha_inicio">Fecha Inicio: *</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $information?$fechaInicio:""; ?>" placeholder="Fecha Inicio" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="fecha_vencimiento">Fecha Vencimiento: *</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $information?$fechaVencimiento:""; ?>" placeholder="Fecha Vencimiento" />
							</div>
						</div>
					</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="descripcion">Descripción: *</label>
							<div class="col-sm-5">
								<textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" rows="3"><?php echo $information?$information[0]["descripcion"]:""; ?></textarea>
							</div>
						</div>
				
						<div class="col-lg-6">				
							<div class="form-group">					
								<label class="col-sm-5 control-label" for="hddTask">Adjuntar documento</label>
								<div class="col-sm-5">
									 <input type="file" name="userfile" />
								</div>
							</div>
						</div>
					
						<div class="col-lg-6">				
							<div class="form-group">
								<div class="row" align="center">
									<div style="width:50%;" align="center">
										<button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
												Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
										</button>
									</div>
								</div>
							</div>
						</div>
				</form>

					<?php if($error){ ?>
					<div class="col-lg-12">
						<div class="alert alert-danger">
						<?php 
							echo "<strong>Error :</strong>";
							pr($error); 
						?><!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
						</div>
					</div>
					<?php } ?>
					
					<div class="col-lg-12">
						<div class="alert alert-danger">
								<strong>Nota :</strong><br>
								Tamaño máximo: 3000 KB
								
						</div>
					</div>

					
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->