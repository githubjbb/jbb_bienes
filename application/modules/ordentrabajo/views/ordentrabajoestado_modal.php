<script type="text/javascript" src="<?php echo base_url("assets/js/validate/ordentrabajo/ordentrabajo_estado.js"); ?>"></script>
<script>
$(document).ready(function () {	
    $('#estado').change(function () {
        $('#estado option:selected').each(function () {
            var estado = $('#estado').val();
			var tipoMantenimiento = $('#hddtipoMantenimiento').val();
            if ((estado > 0 || estado != '') ) {
				$("#div_costo").css("display", "none");
                $('#costo_mantenimiento').val("");
                $("#div_proximo_mantenimiento").css("display", "none");
                $('#proximo_mantenimiento').val("");
                $("#div_kilometros_actuales").css("display", "none");
                //si el estado es SOLUCIONADO entonces habilito campo de cosoto del mantenimiento
				if(estado==2){
					$("#div_costo").css("display", "inline");
					//si el estado es SOLUCIONADO y el timpo de mantenimineto es preventivo entonces habilito campo de proximo mantenimiento
					if(tipoMantenimiento==2){
						$("#div_proximo_mantenimiento").css("display", "inline");
						$("#div_kilometros_actuales").css("display", "inline");
					}
				}
            }
        });
    });
});
</script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Adicionar Información Orden de Trabajo	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddIdOrdenTrabajo" name="hddIdOrdenTrabajo" value="<?php echo $idOrdenTrabajo; ?>"/>
		<input type="hidden" id="hddtipoMantenimiento" name="hddtipoMantenimiento" value="<?php echo $infoOT[0]['tipo_mantenimiento']; ?>"/>
		<input type="hidden" id="hddIdMantenimiento" name="hddIdMantenimiento" value="<?php echo $infoOT[0]['fk_id_mantenimiento']; ?>"/>
		<!-- los siguientes campos se pasan para actualizar datos de la tabla de Contratos de mantenimiento y AUDITORIA -->
		<input type="hidden" id="hddUsarContrato" name="hddUsarContrato" value="<?php echo $infoOT[0]['usar_contrato']; ?>"/>
		<input type="hidden" id="hddSaldoContrato" name="hddSaldoContrato" value="<?php echo $infoEquipo[0]['saldo_contrato']; ?>"/>
		<input type="hidden" id="hddIdContratoMantenimiento" name="hddIdContratoMantenimiento" value="<?php echo $infoEquipo[0]['fk_id_contrato_mantenimiento']; ?>"/>
		
		<input type="hidden" id="hddValorContrato" name="hddValorContrato" value="<?php echo $infoEquipo[0]['valor_contrato']; ?>"/>
		<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $infoEquipo[0]['id_equipo']; ?>"/>

		<?php
			//si se va ausar el contrato entonces el valor maximo del mantenimiento deber ser el saldo del contrato
			$maxCosto = "";
			if($infoOT[0]['usar_contrato'] == 1 ){
				$maxCosto = 'max=' . $infoEquipo[0]['saldo_contrato'];
			}

			//si es mantenimiento preventivo entonces coloco 
			//el valor minimo del campo es igual a los kilometros actuales del equipo, mas la frecuencia del mantenimiento
			$minKilometros = "";
			$minKilometrosActuales = 'min=' . $infoEquipo[0]['horas_kilometros_actuales'];
			if($infoOT[0]['tipo_mantenimiento'] == 2){
				$minKilometros = $infoEquipo[0]['horas_kilometros_actuales'] + $infoPreventivo[0]['frecuencia'];
				$minKilometros = 'min=' . $minKilometros;
			}
		?>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado: *</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($infoOT && $infoOT[0]["estado_actual"] == 1) { echo "selected"; }  ?>>Asignada</option>
						<option value=2 <?php if($infoOT && $infoOT[0]["estado_actual"] == 2) { echo "selected"; }  ?>>Solucionada</option>
						<option value=3 <?php if($infoOT && $infoOT[0]["estado_actual"] == 3) { echo "selected"; }  ?>>Cancelada</option>
					</select>
				</div>
			</div>

			<div class="col-sm-6" id="div_costo" style="display:none">
				<div class="form-group text-left">
					<label class="control-label" for="costo_mantenimiento">Costo Mantenimiento: *</label>
					<input type="number" id="costo_mantenimiento" name="costo_mantenimiento" class="form-control" placeholder="Costo Mantenimiento" <?php echo $maxCosto; ?>  >
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6" id="div_kilometros_actuales" style="display:none">
				<div class="form-group text-left">
					<label class="control-label" for="kilometros_actuales">Horas/Kilometros Actuales: *<br><br></label>
					<input type="number" id="kilometros_actuales" name="kilometros_actuales" class="form-control" placeholder="Horas/Kilometros Actuales" value="<?php echo $infoEquipo[0]['horas_kilometros_actuales']; ?>" <?php echo $minKilometrosActuales; ?>  >
				</div>
			</div>

			<div class="col-sm-6" id="div_proximo_mantenimiento" style="display:none">
				<div class="form-group text-left">
					<label class="control-label" for="proximo_mantenimiento">Próximo Mantenimiento *<br><small>(Horas/Kilometros):</small></label>
					<input type="number" id="proximo_mantenimiento" name="proximo_mantenimiento" class="form-control" placeholder="Próximo Mantenimiento (Horas/Kilometros)" <?php echo $minKilometros; ?>  >
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="informacion">Información Adicional: *</label>
					<textarea id="informacion" name="informacion" placeholder="Información Adicional" class="form-control" rows="3" ></textarea>
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