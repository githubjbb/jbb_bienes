<div id="page-wrapper">
    <div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
                        <i class="fa fa-dashboard fa-fw"></i>
						INICIO
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
    </div>
								
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-success ">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<strong><?php echo $this->session->userdata("firstname"); ?></strong> <?php echo $retornoExito ?>		
			</div>
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}
?> 
			
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-briefcase fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $noOrdenesTrabajo; ?></div>
                            <div>Ordenes de Trabajo Asignadas</div>
                        </div>
                    </div>
                </div>
				
                <a href="#anclaOT">
                    <div class="panel-footer">
                        <span class="pull-left">Ver registros</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $solucionadas; ?></div>
                            <div>Ordenes de Trabajo Solucionadas</div>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url("ordentrabajo/orden_estado/2/" . date("Y")) ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver registros</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-times fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $canceladas; ?></div>
                            <div>Ordenes de Trabajo Canceladas</div>
                        </div>
                    </div>
                </div>

                <a href="<?php echo base_url("ordentrabajo/orden_estado/3/" . date("Y")) ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver registros</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Equipos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">

                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="1" >
                            <button type="submit" class="btn list-group-item">
                            <p class="text-default"><i class="fa fa-car fa-fw"></i><strong> Vehículos</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noVehiculos; ?></em>
                                </span>
                            </p>
                            </button>
                    </form>

                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="2" placeholder="Número Inventario Entidad" >
                            <button type="submit" class="btn list-group-item">
                            <p class="text-default"><i class="fa fa-bomb fa-fw"></i><strong> Bombas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noBombas; ?></em>
                                </span>
                            </p>
                            </button>
                    </form>

                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="3" placeholder="Número Inventario Entidad" >
                            <button type="submit" class="btn list-group-item">
                            <p class="text-default"><i class="fa fa-truck fa-fw"></i><strong> Maquinaria</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noMaquinas; ?></em>
                                </span>
                            </p>
                            </button>
                    </form>



                    </div>
                    <!-- /.list-group -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-4 -->
	


	</div>


<?php
    if($infoMantenimientoCorrectivo){ 
?>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <i class="fa fa-wrench fa-fw"></i> Mantenimientos Correctivo <strong>Pendientes - <?php echo date("Y"); ?></strong>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class='text-center'><small>No. Inventario</small></th>
                                <th class='text-center'><small>Fecha Solicitud</small></th>
                                <th class='text-center'><small>Descripción Falla</small></th>
                                <th class='text-center'><small>Consideración o Requerimiento</small></th>
                                <th class='text-center'><small>Solicitante</small></th>
                                <th class='text-center'><small>Ver</small></th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            foreach ($infoMantenimientoCorrectivo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'>";
?>
<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="Tipo Equipo: <?php echo $lista['tipo_equipo'];?>"><?php echo $lista['numero_inventario']; ?> <i class='fa fa-info-circle fa-fw'></i>
</button>
<?php
                                echo "</td>";
                                echo "<td class='text-center'><small>" . $lista['fecha'] . "</small></td>";
                                echo "<td><small>" . $lista['descripcion'] . "</small></td>";
                                echo "<td><small>" . $lista['consideracion'] . "</small></td>";
                                echo "<td><small>" . $lista['name'] . "</small></td>";
                                echo "<td class='text-center'>";
                                ?>
                                <a href="<?php echo base_url("mantenimiento/correctivo/" . $lista['fk_id_equipo_correctivo']); ?>" class="btn btn-success btn-xs">Ver <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                            endforeach;
                        ?>
                        </tbody>
                    </table>                   
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
<?php   } ?> 

    <!-- /.row -->
    <div class="row">
<a name="anclaOT" ></a>
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <i class="fa fa-briefcase fa-fw"></i> Ordenes de Trabajo <strong>Asignadas - <?php echo date("Y"); ?></strong>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php
    if(!$infoOrdenesTrabajo){ 
?>
        <div class="col-lg-12">
            <small>
                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en la base de datos.</p>
            </small>
        </div>
<?php
    }else{
?>                      
                    
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class='text-center'><small>No. O.T.</small></th>
                                <th class='text-center'><small>No. Inventario</small></th>
                                <th class='text-center'><small>Fecha Asignación</small></th>
                                <th class='text-center'><small>Asignado a</small></th>
                                <th class='text-center'><small>Tipo Mantenimiento</small></th>
                                <th class='text-center'><small>Observación</small></th>
                                <th class='text-center'><small>Última Actualización</small></th>
                                <th class='text-center'><small>Ver</small></th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            foreach ($infoOrdenesTrabajo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'><small>" . $lista['id_orden_trabajo'] . "</small></td>";
                                echo "<td class='text-center'>";
?>
<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="Tipo Equipo: <?php echo $lista['tipo_equipo'];?>"><?php echo $lista['numero_inventario']; ?> <i class='fa fa-info-circle fa-fw'></i></button>
<?php
                                echo "</td>";
                                echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_asignacion']))) . "</small></td>";
                                echo "<td ><small>" . $lista['encargado'] . "</small></td>";
                                echo "<td class='text-center'>";
                                switch ($lista['tipo_mantenimiento']) {
                                    case 1:
                                        $valor = 'Correctivo';
                                        $clase = "text-danger";
                                        break;
                                    case 2:
                                        $valor = 'Preventivo';
                                        $clase = "text-info";
                                        break;
                                }
                                echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
                                echo "</td>";
                                echo "<td><small>" . $lista['observacion'] . "</small></td>";
                                echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_ultima_actualizacion']))) . "</small></td>";
                                echo "<td class='text-center'>";
                                ?>
                                <a href="<?php echo base_url("ordentrabajo/ver_orden/" . $lista['id_orden_trabajo']); ?>" class="btn btn-success btn-xs">Ver O.T. <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                            endforeach;
                        ?>
                        </tbody>
                    </table>
                    
<?php   } ?>                    
                </div>
                <!-- /.panel-body -->
            </div>

        </div>


    
    </div>

</div>