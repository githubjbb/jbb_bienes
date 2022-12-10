<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/add_mantenimiento_preventivo.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-life-saver"></i> MANTENIMIENTO - ADICIONAR MANTENIMIENTOS PREVENTIVOS
				</div>
				<div class="panel-body">
				<?php 										
					if(!$infoPreventivo){ 
						echo '<div class="col-lg-12">
							<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema. Solicutar al Adminstrador adicionar Mantenimientos Preventivos para este tipo de Equipo de acuerdo al manual del fabricante.</p>
							</div>';
					} else {
				?>
					<form  name="form" id="form" class="form-horizontal" method="post" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $idEquipo; ?>"/>
								
                        <table class="table table-striped table-hover table-condensed table-bordered">
                            <tr class="info">
                                <td ><p class="text-center"><strong>Seleccionar</strong></p></td>
                                <td ><p class="text-center"><strong>Mantenimiento preventivo</strong></p></td>
                                <td ><p class="text-center"><strong>Frecuencia Km/Horas</strong></p></td>
                            </tr>
                            <?php
                            foreach ($infoPreventivo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'>";
                                $data = array(
                                    'name' => 'mantenimiento[]',
                                    'id' => 'mantenimiento',
                                    'value' => $lista['id_preventivo_plantilla'],
                                    'style' => 'margin:10px'
                                );
                                echo form_checkbox($data);
                                echo "</td>";
								echo "<td>" . $lista["descripcion"] . "</td>";
								echo "<td class='text-right'>" . number_format($lista["frecuencia"]) . "</td>";
                                echo "</tr>";
                            endforeach
                            ?>
                        </table>											
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:80%;" align="center">
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
				<?php } ?>
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