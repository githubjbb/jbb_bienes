<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/preventivo.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Mantenimientos Preventivos
	<br><small>Adicionar/Editar Mantenimiento Preventivo</small>
	</h4>
</div>
<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoPreventivo?$infoPreventivo[0]['id_preventivo_plantilla']:""; ?>"/>
		<?php 
		if($infoPreventivo){
			$descripcion = $infoPreventivo[0]['descripcion'];
		}
		?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="from">Tipo Equipo: *</label>
					<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required >
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
							<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($infoPreventivo && $infoPreventivo[0]["fk_id_tipo_equipo_mpp"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; } ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="frecuencia">Frecuencia: * <small class="text-danger">(Horas o Kilometros)</small></label>
					<input type="number" id="frecuencia" name="frecuencia" class="form-control" value="<?php echo $infoPreventivo?$infoPreventivo[0]["frecuencia"]:""; ?>" placeholder="Frecuencia" required >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="descripcion">Descripción: *</label>
					<textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" rows="3"><?php echo $infoPreventivo?$descripcion:""; ?></textarea>
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