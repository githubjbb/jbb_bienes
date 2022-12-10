<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalContratos',
                data: {'idContrato': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-truck fa-fw"></i> EQUIPOS - CONTRATOS MANTENIMIENTO
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
					<i class="fa fa-book"></i> LISTA CONTRATOS DE MANTENIMIENTO
					<div class="pull-right">
						<div class="btn-group">							
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="x">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Contrato de Mantenimiento
							</button>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills">
						<li <?php if($estado == 1){ echo "class='active'";} ?>><a href="<?php echo base_url("equipos/contratos/1"); ?>">Contratos en Ejecución</a>
						</li>
						<li <?php if($estado == 3){ echo "class='active'";} ?>><a href="<?php echo base_url("equipos/contratos/3"); ?>">Contratos Finalizados</a>
						</li>
					</ul>
					<br>

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

				<?php
					if($info){
				?>			
				<div class="row">
					<div class="col-lg-6">
						<div class="alert alert-danger">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Cuando la fila esta en rojo, es porque el <b>Contrato de Mantenimiento esta vencido.</b>
						</div>		
					</div>
					<div class="col-lg-6">
						<div class="alert alert-warning">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Cuando la fila esta en amarillo, es porque el <b>Contrato de Mantenimiento tiene menos de 30 días para vencerse.</b>
						</div>		
					</div>
				</div>
				
					<table class="table table-hover">
						<thead>
							<tr>
								<th><small>Número Contrato</small></th>
								<th><small>Proveedor</small></th>
								<th class="text-center"><small>Vigencia Desde</small></th>
								<th class="text-center"><small>Vigencia Hasta</small></th>
								<th><small>Supervisor</small></th>
								<th class="text-right"><small>Valor</small></th>
								<th class="text-right"><small>Saldo</small></th>
								<th class="text-center"></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							$filtroFecha = strtotime(date('Y-m-d'));
							foreach ($info as $lista):
									//semaforo de acuerdo a fecha de vencimiento
									$fechaVencimiento = strtotime($lista['fecha_hasta']);
									$diferencia = $fechaVencimiento - $filtroFecha;
									//2678400 --> equivalen a 30 dias
									//si la diferencia es mayor a 30 dias no hay problema
									if($diferencia > 2678400){
										$estilosFila = '';
									}elseif($diferencia <= 2678400 && $diferencia >= 0){
										//si la diferencia es entre 0 y 30 dias, entonces se va a vencer pronto
										$estilosFila = 'warning text-warning';
									}else{
										//si la diferencia es menor que 0 entonces esta vencida
										$estilosFila = 'danger text-danger';
									}
									echo "<tr class='$estilosFila'>";
									echo "<td><small>" . $lista['numero_contrato'] . "</small></td>";
									echo "<td><small>" . $lista['nombre_proveedor'] . "</small></td>";
									echo "<td class='text-center'><small>" . $lista['fecha_desde'] . "</small></td>";
									echo "<td class='text-center'><small>" . $lista['fecha_hasta'] . "</small></td>";
									echo "<td><small>" . $lista['name'] . "</small></td>";
									echo "<td class='text-right'><small>$" . number_format($lista['valor_contrato']) . "</small></td>";
									echo "<td class='text-right'><small>$" . number_format($lista['saldo_contrato']) . "</small></td>";
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_contrato_mantenimiento']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>

								<br><br>

	                            <form  name="formHistorial" id="formHistorial" method="post" action="<?php echo base_url("equipos/historial_contratos"); ?>">
	                                <input type="hidden" class="form-control" id="hddidContrato" name="hddidContrato" value="<?php echo $lista['id_contrato_mantenimiento']; ?>" />
	                                
	                                <button type="submit" class="btn btn-default btn-xs" id="btnSubmit2" name="btnSubmit2">
	                                    Ver Cambios <span class="fa fa-th-list" aria-hidden="true" />
	                                </button>
	         
	                            </form>
						<?php
									switch ($lista['estado_contrato']) {
										case 1:
											echo '<small><strong>En Ejecución</strong></small>';
											break;
										case 2:
											echo '<small><strong>En Ejecución - Prorroga</strong></small>';
											break;
										case 3:
											echo '<small><strong>Finalizado</strong></small>';
											break;
									}
									echo "</td>";
							endforeach;
						?>
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

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"pageLength": 100
	});
});
</script>