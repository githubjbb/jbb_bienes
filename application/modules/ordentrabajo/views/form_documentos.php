<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href="<?php echo base_url('ordentrabajo/ver_orden/' . $idOT); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-image"></i> <strong>DOCUMENTOS ORDEN DE TRABAJO</strong> 
				</div>
				<div class="panel-body">
		
					<form  name="form_doc" id="form_doc" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("ordentrabajo/do_upload_doc_OT"); ?>">
					<input type="hidden" class="form-control" id="hddIdOT" name="hddIdOT" value="<?php echo $idOT; ?>" />

						<div class="form-group">
							<label class="col-sm-4 control-label" for="tipo_documento">Tipo Documento: *</label>
							<div class="col-sm-4">
								<select name="tipo_documento" id="tipo_documento" class="form-control" required>
									<option value=''>Seleccione...</option>
									<option value=1 >Factura</option>
									<option value=2 >Informe de mantenimiento</option>
								</select>
							</div>
						</div>
				
						<div class="col-lg-6">				
							<div class="form-group">					
								<label class="col-sm-5 control-label" for="hddTask">Adjuntar documento</label>
								<div class="col-sm-5">
									 <input type="file" name="userfile" required />
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