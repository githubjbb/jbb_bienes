<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/correctivo.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Mantenimiento Correctivo del Equipo
	<br><small>Adicionar/Editar Mantenimiento Correctivo</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $idEquipo; ?>"/>
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoCorrectivo?$infoCorrectivo[0]['id_correctivo']:""; ?>"/>
		<?php 
		if($infoCorrectivo){
			$descripcion = $infoCorrectivo[0]['descripcion'];
			$consideracion = $infoCorrectivo[0]['consideracion'];
		}
		?>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="descripcion">Descripción de la Falla o Daño: *</label>
					<textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción de la Falla o Daño" rows="3" required><?php echo $infoCorrectivo?$descripcion:""; ?></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="consideracion">Consideración o Requerimiento: *</label>
					<textarea class="form-control" id="consideracion" name="consideracion" placeholder="Consideración o Requerimiento" rows="3" required><?php echo $infoCorrectivo?$consideracion:""; ?></textarea>
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