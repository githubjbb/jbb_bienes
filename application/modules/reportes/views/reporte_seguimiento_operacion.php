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
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>CÓDIGO Y/O PLACA:</strong></th>
					<th>' . $infoEquipo[0]['placa']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>RESPONSABLE DE LA MAQUINA, EQUIPO O VEHICULO:</strong></th>
					<th >' . $infoEquipo[0]['name'] . '<br>C.C. ' . $infoEquipo[0]['numero_cedula'] . '</th>
				</tr>
			</table>';


	$html.='<br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Nombre Operador y/o usuario </strong></th>
					<th rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Fecha</strong></th>
					<th colspan="3" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Aceite(GI/LT) </strong></th>
					<th rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Grasa</strong></th>
					<th colspan="3" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Combustible (GI/M3) </strong></th>
					<th colspan="3" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Labor Realizada</strong></th>
					<th rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Firma del operador y/o usuario</strong></th>
					<th rowspan="2" bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Firma de responsable del equipo</strong></th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Trans </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Hidr </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Mot </strong></th>

					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Gasolina </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Gas </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>ACPM </strong></th>

					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Labor </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Área </strong></th>
					<th bgcolor="#dde1da" style="color:#3e403e;text-align:center;"><strong>Horas y/o Km </strong></th>
				</tr>';



				if($listadoControlCombustible){
					foreach ($listadoControlCombustible as $lista):
						$gasolina ="";
						$acpm ="";
						$grasa = "";
						$trans= "";
						$hidr= "";
						$motor= "";
						switch ($lista['tipo_consumo']) {
							case 1:
								if($infoEspecifica[0]["combustible"]==1){
									$gasolina ="x";
								}else{
									$acpm ="X";
								}
								break;
							case 2:
								$grasa = "X";
								break;
							case 3:
								$trans= "X";
								break;
							case 4:
								$hidr= "X";
								break;
							case 5:
								$motor= "X";
								break;
						}
						$html.= '<tr>
									<th>'. $lista["name"].'</th>
									<th>'. $lista["fecha_combustible"].'</th>
									<th style="text-align:center;">'. $trans.'</th>
									<th style="text-align:center;">'. $hidr.'</th>
									<th style="text-align:center;">'. $motor.'</th>
									<th style="text-align:center;">'. $grasa.'</th>
									<th style="text-align:center;">'. $gasolina.'</th>
									<th></th>
									<th>'. $acpm .'</th>
									<th>'. $lista["labor_realizada"].'</th>
									<th>'. $lista["lugar"].'</th>
									<th style="text-align:right;">'. $lista["kilometros_actuales"].'</th>
									<th></th>
									<th></th>
								</tr>';
					endforeach;
				} 
	$html.= '</table>';


	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th>Observaciones:</th>
				</tr>
			</table>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th style="text-align:center;"> Trans: Transmisión - Hidr: Hidraulica - Mot: Motor - Gas: Gasolina</th>
				</tr>
			</table>';

}
			
echo $html;
						
?>