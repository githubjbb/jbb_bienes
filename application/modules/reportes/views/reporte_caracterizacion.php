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

	//<!-- FIN IMAGEN DEL EQUIPO -->
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Maquina/Equipo:</strong></th>
					<th width="15%">' . $infoEspecifica[0]['servicio']. '</th>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha de adquisición:</strong></th>
					<th width="10%">' . $infoEquipo[0]['fecha_adquisicion']. '</th>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Vida Util Aproximada:</strong></th>
					<th width="15%"></th>
				</tr>
				<tr>
					<th colspan="2" bgcolor="#dde1da" style="color:#3e403e;"><strong>Lugar donde reposa el manual:</strong></th>
					<th></th>
					<th colspan="2" bgcolor="#dde1da" style="color:#3e403e;"><strong>Codigo o placa:</strong></th>
					<th>' . $infoEquipo[0]['placa']. '</th>
				</tr>
			</table>';


	$combustible = $infoEspecifica[0]["combustible"]==1?"Gasolina":"Diesel";
	$html.='<br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>INFORMACIÓN DEL FABRICANTE</strong></th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fabricante</strong></th>
					<th colspan="5"></th>
				</tr>
				<tr>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Marca</strong></th>
					<th width="15%">' . $infoEquipo[0]['marca']. '</th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Modelo</strong></th>
					<th width="15%">' . $infoEquipo[0]['modelo']. '</th>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Procedencia</strong></th>
					<th width="15%"></th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Serie de motor:</strong></th>
					<th colspan="2">' . $infoEspecifica[0]['numero_motor']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Serie de chasis:</strong></th>
					<th colspan="2">' . $infoEspecifica[0]['numero_chasis']. '</th>
				</tr>
			</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CARACTERISTICAS TÉCNICAS</strong></th>
				</tr>
				<tr>
					<th width="15%">Altura:<br></th>
					<th width="15%">Ancho:<br></th>
					<th width="15%">Longitud:<br></th>
					<th width="15%">Cilindraje:<br>' . $infoEspecifica[0]['cilindraje']. '</th>
					<th width="15%">Combustible:<br>' . $combustible. '</th>
					<th width="15%">HP:<br></th>
				</tr>
			</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="3" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>CONDICIONES DE MANTENIMIENTO</strong></th>
				</tr>
				<tr>
					<th width="33%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;">Recomendaciones del manual</th>
					<th width="33%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;">Horas y/o Kilometraje </th>
					<th width="34%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;">Elementos de uso</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</table>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th>Otras consideraciones a tener en cuenta:</th>
					<th></th>
				</tr>
			</table>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="33%">FIRMA RESPONSABLE DE LA MAQUINA/ EQUIPO O VEHICULO</th>
					<th width="33%">FIRMA TECNICO DE MANTENIMIENTO </th>
					<th width="34%">FIRMA COORDINADOR O JEFE DE ÁREA</th>
				</tr>
			</table>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="10%">Nombre:</th>
					<th width="23%"></th>
					<th width="10%">Nombre:</th>
					<th width="23%"></th>
					<th width="10%">Nombre:</th>
					<th width="24%"></th>
				</tr>
				<tr>
					<th>Cargo:</th>
					<th></th>
					<th>Cargo:</th>
					<th></th>
					<th>Cargo:</th>
					<th></th>
				</tr>
			</table>';
	$html.='<br><br>';

}
			
echo $html;						
?>