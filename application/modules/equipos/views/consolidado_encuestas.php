<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-gear fa-fw"></i> EQUIPOS - CONSOLIDADO ENCUESTAS DE SATISFACCIÓN
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-building"></i> CONSOLIDADO ENCUESTAS DE SATISFACCIÓN
					<div class="pull-right">
						<div class="btn-group">																				
							<a href="<?php echo base_url('external/add_encuesta'); ?>" class="btn btn-info btn-xs">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Encuesta de Satisfacción
							</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
<?php
	$retornoExito = $this->session->flashdata('retornoExito');
	if ($retornoExito) {
?>
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
<?php
	}
	$retornoError = $this->session->flashdata('retornoError');
	if ($retornoError) {
?>
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
<?php
	}
?> 

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
		to = $( "#fecha_fin" ).datepicker({
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
					<form name="formCheckin" id="formCheckin" method="post">
						<div class="panel panel-default">
							<div class="panel-footer">
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group input-group-sm">	
											<label class="control-label" for="idMes">Mes: *</label>
											<select name="idMes" id="idMes" class="form-control" required >
												<option value="">Seleccione...</option>
												<?php for ($i = 0; $i < count($listaMeses); $i++) { ?>
													<option value="<?php echo $listaMeses[$i]["id_mes"]; ?>" <?php if($_POST && $_POST["idMes"] == $listaMeses[$i]["id_mes"]) { echo "selected"; }  ?>><?php echo $listaMeses[$i]["mes"]; ?></option>	
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group"><br>
											<button type="submit" id="btnSearch" name="btnSearch" class="btn btn-primary btn-sm" >
												Buscar <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
											</button> 
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php
					if($_POST){
				?>	
					<div class="row">
						<div class="col-lg-12">
							<div class="btn-group" >
								<h2>Número de Encuestas de Satisfacción: <?php echo $numeroEncuestas; ?></h2>
							</div>
						</div>
					</div>

					<table class="table table-hover small">
						<thead>
							<tr>
								<th>Pregunta</th>
								<th class="text-center">No. Encuestas con valor Insatisfecho o Poco Satisfecho</th>
							</tr>
						</thead>
						<tbody>							
							<tr>
								<th>Amabilidad y Respeto del Conductor</th>
								<th class="text-center"> 
									<?php echo $numeroAmabilidad; 
										if($numeroAmabilidad > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/amabilidad/x"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
							<tr>
								<th>Presentación Personal del Conductor</th>
								<th class="text-center">
									<?php echo $numeroPresentacion; 
										if($numeroPresentacion > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/presentacion/x"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
							<tr>
								<th>Limpieza del Vehículo</th>
								<th class="text-center">
									<?php echo $numeroLimpieza; 
										if($numeroLimpieza > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/limpieza/x"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
							<tr>
								<th>Calidad del servicio en modo, tiempo y lugar</th>
								<th class="text-center">
									<?php echo $numeroCalidad; 
										if($numeroCalidad > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/calidad/x"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
						</tbody>
					</table>

					<table class="table table-hover small">
						<thead>
							<tr>
								<th>Pregunta</th>
								<th class="text-center">No. Encuestas con NO como respuesta</th>
							</tr>
						</thead>
						<tbody>							
							<tr>
								<th>El conductor cumplió con las normas de Tránsito </th>
								<th class="text-center">
									<?php echo $numeroNormas; 
										if($numeroNormas > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/x/normas"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
							<tr>
								<th>El recorrido se realizó con la velocidad permitida</th>
								<th class="text-center">
									<?php echo $numeroVelocidad; 
										if($numeroVelocidad > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/x/velocidad"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
							<tr>
								<th>El conductor utilizó y solicitó que usted usara el cinturón de seguridad</th>
								<th class="text-center">
									<?php echo $numeroCinturon; 
										if($numeroCinturon > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/x/cinturon"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
							<tr>
								<th>El conductor usó aparatos móviles o bidireccionales (pantallas, tablets, etc) con el vehículo en movimiento y sin audífonos o bluetooth? </th>
								<th class="text-center">
									<?php echo $numeroAparatos; 
										if($numeroAparatos > 0){
									?> 
									<a href="<?php echo base_url("reportes/encuesta_insatisfechas/". $idMes ."/x/aparatos"); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></span> Ver las Encuestas</a>
									<?php } ?> 
								</th>
							</tr>
						</tbody>
					</table>
				<?php } ?>
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
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->