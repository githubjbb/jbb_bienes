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
if($infoComparendos)
{ 

	//<!-- FIN IMAGEN DEL EQUIPO -->
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="10%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Tipo de vehículo</strong></th>
					<th width="10%" rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Placa</strong></th>
					<th width="70%" colspan="5" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Datos personales del conductror </strong></th>
					<th width="10%" rowspan="2"bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Fecha de Revisión </strong></th>				
				</tr>
				<tr>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Nombres</strong></th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Apellidos</strong></th>
					<th width="10%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Identificación</strong></th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Verificación de comparendo en RUNT</strong></th>	
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Verificación de comparendo en SIMIT</strong></th>
				</tr>';
				foreach ($infoComparendos as $lista):
					$html.= '<tr>
								<th >' . $lista['tipo_equipo']. '</th>
								<th >' . $lista['placa']. '</th>
								<th >' . $lista['first_name']. '</th>
								<th >' . $lista['last_name']. '</th>
								<th >' . $lista['numero_cedula']. '</th>
								<th >' . $lista['verificacion_runt']. '</th>
								<th >' . $lista['verificacion_simit']. '</th>
								<th >' . $lista['fecha_revision']. '</th>
							</tr>';
				endforeach;
	$html.= '</table>';

}
		
echo $html;
						
?>