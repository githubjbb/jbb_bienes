<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/ordentrabajo/search.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/ordentrabajo/ajaxEquipos.js"); ?>"></script>

<div id="page-wrapper">

	<br>	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDENES DE TRABAJO</strong>
				</div>
				<div class="panel-body">
					<div class="alert alert-info">
						<strong>Nota:</strong> 
						Seleccione por lo menos una opción
					</div>
					<form  name="form" id="form" role="form" method="post" class="form-horizontal" >

						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="from">Tipo Equipo </label>
								<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control">
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
										<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>"><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
									<?php } ?>
								</select>
							</div>
							
							<div class="col-sm-5" id="div_equipo">
								<label for="idEquipo">Equipo</label>
								<select name="idEquipo" id="idEquipo" class="form-control">
									<option value=''>Seleccione...</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="OTNumber">Número Orden de Trabajo </label>
								<input type="text" id="OTNumber" name="OTNumber" class="form-control" placeholder="# O.T." >
							</div>
							
							<div class="col-sm-5">
								<label for="from">Estado </label>
								<select name="estado" id="estado" class="form-control" >
									<option value=''>Seleccione...</option>
									<option value=1 >Asignada</option>
									<option value=2 >Solucionada</option>
									<option value=3 >Cancelada</option>
								</select>
							</div>
						</div>
						
<script>
$( function() {
var dateFormat = "mm/dd/yy",
from = $( "#from" )
.datepicker({
changeMonth: true,
numberOfMonths: 2
})
.on( "change", function() {
to.datepicker( "option", "minDate", getDate( this ) );
}),
to = $( "#to" ).datepicker({
changeMonth: true,
numberOfMonths: 2
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
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="from">Rango Fecha Registro</label>
								<input type="text" id="from" name="from" class="form-control" placeholder="Desde" >
							</div>
							<div class="col-sm-5">
								<br>
								<input type="text" id="to" name="to" class="form-control" placeholder="Hasta" >
							</div>
						</div>

						<div class="row"></div><br>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width80%;" align="center">
									
								 <button type="submit" class="btn btn-primary" id='btnSubmit' name='btnSubmit'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar </button>
									
								</div>
							</div>
						</div>
						
					</form>

				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
		
		<div class="col-lg-4">
            <div class="panel panel-violeta">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> OT - <?php echo date("Y"); ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php 
                            $enlace = '#';
                            $enlace2 = '#';
                            $enlace3 = '#';
                            if($asignadas){
                                $enlace = base_url("ordentrabajo/orden_estado/1/" . date("Y"));
                            }
                            if($solucionadas){
                                $enlace2 = base_url("ordentrabajo/orden_estado/2/" . date("Y"));
                            }
                            if($canceladas){
                                $enlace3 = base_url("ordentrabajo/orden_estado/3/" . date("Y"));
                            }
                        ?>
                        <a href="<?php echo $enlace; ?>" class="list-group-item" disabled>
                            <p class="text-info"><i class="fa fa-thumb-tack fa-fw"></i><strong> Asignadas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $asignadas; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="<?php echo $enlace2; ?>" class="list-group-item">
                            <p class="text-success"><i class="fa fa-check fa-fw"></i><strong> Solucionadas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $solucionadas; ?></em>
                                </span>
                            </p>
                        </a>
                        <a href="<?php echo $enlace3; ?>" class="list-group-item">
                            <p class="text-danger"><i class="fa fa-times fa-fw"></i><strong> Canceladas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $canceladas; ?></em>
                                </span>
                            </p>
                        </a>

                    </div>
                    <!-- /.list-group -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

		</div>
		<!-- /.col-lg-4 -->

	</div>
	<!-- /.row -->
	
</div>
<!-- /#page-wrapper -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"ordering": true,
		paging: false,
		"info": false
	});
});
</script>