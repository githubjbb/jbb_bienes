<?php
// create some HTML content	
$html = '<style>
			table {
				font-family: arial, sans-serif;
				border: 1px solid black;
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid black;
				text-align: left;
				padding: 8px;
			}
			</style>';
				
//datos especificos
if($infoEquipo)
{ 

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="35%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Propietario/Entidad Asignada/Entidad tenedora del Vehículo:</strong></th>
					<th width="20%">Jardín Botánico De Bogotá</th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Identificación del Propietario:</strong></th>
					<th width="20%">860030197</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo de Servicio</strong></th>
					<th>Oficial</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha</strong></th>
					<th>' . date('Y-m-d') . '</th>
				</tr>
			</table><br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="4%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Nro. Inventario</strong></th>
					<th width="4%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Placa</strong></th>
					<th width="5%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Marca</strong></th>
					<th width="6%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Línea</strong></th>
					<th width="4%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Modelo</strong></th>
					<th width="4%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Color</strong></th>
					<th width="5%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Clase de Vehículo</strong></th>
					<th width="7%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Tipo Carrocería</strong></th>
					<th width="7%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Combustible</strong></th>
					<th width="6%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Capacidad</strong></th>
					<th width="7%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>No. Motor</strong></th>
					<th width="9%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>No. Serie/No. Chasis</strong></th>
					<th width="8%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Valor / Fecha Adquisición</strong></th>
					<th width="16%" colspan="3" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Multas o Restricciones</strong></th>
					<th width="8%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Conductor Responsable y Tipo Vinculación</strong></th>				
				</tr>
				<tr>
					<th width="4%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Por Placa</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Por Cédula Conductor</strong></th>
					<th width="6%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Motivo</strong></th>			
				</tr>';

				$x=0;
				foreach ($infoEquipo as $lista):
					$x++;
					$combustible = $lista["combustible"]==1?"Gasolina":"Diesel";
					$multas = $lista['multas']==1?"Si":"No";
					$multasConductor = $lista['multas_conductor']==1?"Si":"No";
					$tipoVinculacion = "";
					if($lista['tipo_vinculacion']==1){
						$tipoVinculacion = "<br><b>Tipo vinculación: </b>Planta";
					}elseif($lista['tipo_vinculacion']==2){
						$tipoVinculacion = "<br><b>Tipo vinculación: </b>Contratista";
					}
					$html.= '<tr>
								<th style="text-align:center;">' . $lista['numero_inventario']. '</th>
								<th >' . $lista['placa']. '</th>
								<th >' . $lista['marca']. '</th>
								<th >' . $lista['linea']. '</th>
								<th >' . $lista['modelo']. '</th>
								<th >' . $lista['color']. '</th>
								<th >' . $lista['clase_vehiculo']. '</th>
								<th >' . $lista['tipo_carroceria']. '</th>
								<th >' . $combustible. '</th>
								<th >' . $lista['capacidad']. '</th>
								<th >' . $lista['numero_motor']. '</th>
								<th >' . $lista['numero_chasis']. '</th>
								<th >$ ' . number_format($lista['valor_comercial'],0) . '<br>Fecha Adquisición: ' . $lista['fecha_adquisicion'] .  '</th>
								<th >' . $multas. '</th>
								<th >' . $multasConductor. '</th>
								<th >' . $lista['motivo_multa']. '</th>
								<th >' . $lista['name'] . '<br>C.C. ' . $lista['numero_cedula'] . $tipoVinculacion . '</th>

							</tr>';
				endforeach;
	$html.= '</table>';


}


			
echo $html;
						
?>