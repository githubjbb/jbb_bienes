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
if($infoEncuesta)
{ 

	//<!-- FIN IMAGEN DEL EQUIPO -->
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>1. FECHA</strong></th>
					<th width="75%">' . $infoEncuesta[0]['fecha_registro']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>2. DEPEDENCIA</strong></th>
					<th>' . $infoEncuesta[0]['dependencia']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>3. NOMBRE DEL CONDUCTOR</strong></th>
					<th>' . $infoEncuesta[0]['name']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>4. VEHÍCULO</strong></th>
					<th>Nro. Inventario: ' . $infoEncuesta[0]['numero_inventario']. '- Placa: ' . $infoEncuesta[0]['placa'] . '</th>
				</tr>
			</table>';

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="100%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>RECORRIDO</strong></th>
				</tr>';
	$html.= '<tr>
				<th>'. $infoEncuesta[0]['recorrido'] . '</th>
			</tr>';

	$html.= '</table>';


	$html.= '<table cellspacing="0" cellpadding="5">';
	switch ($infoEncuesta[0]['amabilidad']) {
		case 0:
			$respuesta = 'Insatisfecho';
			break;
		case 1:
			$respuesta = 'Poco Satisfecho';
			break;
		case 2:
			$respuesta = 'Muy Satisfecho';
			break;
		case 3:
			$respuesta = 'Completamente Satisfecho';
			break;
	}
	$html.= '<tr>
				<th width="70%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Amabilidad y Respeto del Conductor</strong></th>
				<th width="30%">'. $respuesta . '</th>
			</tr>';
	switch ($infoEncuesta[0]['presentacion']) {
		case 0:
			$respuesta = 'Insatisfecho';
			break;
		case 1:
			$respuesta = 'Poco Satisfecho';
			break;
		case 2:
			$respuesta = 'Muy Satisfecho';
			break;
		case 3:
			$respuesta = 'Completamente Satisfecho';
			break;
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Presentación Personal del Conductor</strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	switch ($infoEncuesta[0]['limpieza']) {
		case 0:
			$respuesta = 'Insatisfecho';
			break;
		case 1:
			$respuesta = 'Poco Satisfecho';
			break;
		case 2:
			$respuesta = 'Muy Satisfecho';
			break;
		case 3:
			$respuesta = 'Completamente Satisfecho';
			break;
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Limpieza del Vehículo</strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	switch ($infoEncuesta[0]['calidad']) {
		case 0:
			$respuesta = 'Insatisfecho';
			break;
		case 1:
			$respuesta = 'Poco Satisfecho';
			break;
		case 2:
			$respuesta = 'Muy Satisfecho';
			break;
		case 3:
			$respuesta = 'Completamente Satisfecho';
			break;
	}
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Calidad del servicio en modo, tiempo y lugar</strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	$respuesta = $infoEncuesta[0]['normas']==1?'Si':'No';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>El conductor cumplió con las normas de Tránsito</strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	$respuesta = $infoEncuesta[0]['velocidad']==1?'Si':'No';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>El recorrido se realizó con la velocidad permitida</strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	$respuesta = $infoEncuesta[0]['cinturon']==1?'Si':'No';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>El conductor utilizó y solicitó que usted usara el cinturón de seguridad</strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	$respuesta = $infoEncuesta[0]['aparatos']==1?'Si':'No';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>El conductor usó aparatos móviles o bidireccionales (pantallas, tablets, etc) con el vehículo en movimiento y sin audífonos o bluetooth? </strong></th>
				<th>'. $respuesta . '</th>
			</tr>';

	$html.= '</table>';
	
}
		
echo $html;
						
?>