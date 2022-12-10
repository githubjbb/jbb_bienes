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
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>VEHÍCULO:</strong></th>
					<th>' . $infoEquipo[0]['placa']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>MES DEL REPORTE:</strong></th>
					<th ></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>CONDUCTOR RESPONSABLE::</strong></th>
					<th >' . $infoEquipo[0]['name'] . '<br>C.C. ' . $infoEquipo[0]['numero_cedula'] . '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>CÓDIGO:</strong></th>
					<th></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>N° CONTRATO:</strong></th>
					<th >' . $infoEquipo[0]['numero_contrato'] . '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>ÁREA RESPONSABLE:</strong></th>
					<th >' . $infoEquipo[0]['dependencia'] . '</th>
				</tr>
			</table>';


	$html.='<br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>DESCRIPCIÓN DE ACTIVIDADES </strong></th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>FECHA </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>RECORRIDO </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>ÁREA </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>NOMBRE USUARIO </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>CORREO ELECTRÓNICO </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>FIRMA </strong></th>
				</tr>';

				if($listadoRecorridos){
					foreach ($listadoRecorridos as $lista):
						$html.= '<tr>
									<th>'. $lista["fecha_recorrido"].'</th>
									<th>'. $lista["recorrido"].'</th>
									<th>'. $lista["area"].'</th>
									<th>'. $lista["usuario_nombre"].'</th>
									<th>'. $lista["usuario_correo"].'</th>
									<th></th>
								</tr>';
					endforeach;
				} 
	$html.= '</table>';

}
			
echo $html;
						
?>