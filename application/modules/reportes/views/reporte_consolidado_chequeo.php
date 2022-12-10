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

if($listadoRevision)
{ 

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" style="color:#3e403e;text-align:center;"><strong>LISTADO DE CHEQUEO PREOCUPACIONAL VEHÍCULO</strong></th>
				</tr>
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>VEHÍCULO</strong></th>
					<th width="25%">' . $infoEquipo[0]["marca"] . ' - ' . $infoEquipo[0]["modelo"] . '</th>
					<th colspan="2" width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>PLACA</strong></th>
					<th colspan="2" width="25%">' . $infoEquipo[0]["placa"] . '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CONDUCTOR</strong></th>
					<th>' . $infoEquipo[0]["name"] . '</th>
					<th width="12%" bgcolor="#dde1da" style="color:#3e403e;"><strong>AÑO</strong></th>
					<th width="13%" >' . date('Y'). '</th>
					<th width="12%" bgcolor="#dde1da" style="color:#3e403e;"><strong>MES</strong></th>
					<th width="13%">' . $infoMes[0]["mes"] . '</th>
				</tr>
			</table><br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">';
	$html.= '<tr>
				<th width="10%" bgcolor="#dde1da" style="color:#3e403e;"><strong>Pregunta / No. Día</strong></th>';
				$numeroValores = count($listadoRevision);
				$ancho = 90/$numeroValores;
				foreach ($listadoRevision as $lista):
					$html.= '<th width="'.$ancho.'%" style="text-align:center;">' . date("d", strtotime($lista['fecha_registro'])) . '</th>';
				endforeach;
	$html.= '</tr>';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Licencia de conducción</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['licencia']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['licencia']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SOAT</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['soat']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['soat']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';
	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>TARJETA DE PROPIEDAD</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['tarjeta_propiedad']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['tarjeta_propiedad']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';



	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SEGURO DE DAÑOS A TERCEROS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['seguro']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['seguro']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DIRECCIONALES DELANTERAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['dir_delanteras']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['dir_delanteras']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>DIRECCIONALES TRASERAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['dir_traseras']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['dir_traseras']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LUCES ALTAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['luces_altas']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['luces_altas']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LUCES BAJAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['luces_bajas']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['luces_bajas']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LUCES STOPS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['luces_stops']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['luces_stops']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LUCES REVERSA</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['luces_reversa']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['luces_reversa']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LUCES PARQUEO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['luces_parqueo']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['luces_parqueo']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LIMPIABRISAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['limpiabrizas']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['limpiabrizas']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>FRENO PRINCIPAL</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['freno_princiapal']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['freno_princiapal']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>FRENOS DE EMERGENIA </strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['freno_emergencia']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['freno_emergencia']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LLANTAS DELANTERAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['llantas_delanteras']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['llantas_delanteras']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LLANTAS TRASERAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['llantas_traseras']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['llantas_traseras']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>LLANTAS DE REPUESTO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['llantas_repuesto']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['llantas_repuesto']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>ESPEJOS LATERALES</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['espejos_laterales']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['espejos_laterales']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>RETROVISOR</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['espejos_retrovisor']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['espejos_retrovisor']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>PITO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['pito']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['pito']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>FRENOS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['nivel_frenos']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['nivel_frenos']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>ACEITE</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['tarjeta_propiedad']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['tarjeta_propiedad']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>REFRIGERANTE</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['nivel_refrigerante']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['nivel_refrigerante']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CAJA DE DIRECCIÓN </strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['nivel_caja']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['nivel_caja']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>APOYA CABEZAS DELANTEROS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['apoyo_delantero']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['apoyo_delantero']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>APOYA CABEZAS TRASERO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['apoyo_trasero']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['apoyo_trasero']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CINTURON DELANTERO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['cinturon_delantero']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['cinturon_delantero']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CINTURON TRASERO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['cinturon_trasero']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['cinturon_trasero']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>EXTINTOR</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['extintor']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['extintor']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>HERRAMIENTAS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['herramientas']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['herramientas']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CRUCETA</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['cruceta']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['cruceta']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>GATO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['gato']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['gato']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>TACOS</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['tacos']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['tacos']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SEÑALETICA </strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['triangulo']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['triangulo']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CHALECO</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['chaleco']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['chaleco']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>BOTIQUIN</strong></th>';
				foreach ($listadoRevision as $lista):
					$valor = "";
					if($lista['botiquin']==1){
						$valor = "C";
						$licenciaNOCumple = "";
					}elseif($lista['botiquin']==0){
						$valor = "NC";
					}else{
						$valor = "N/A";
					}
					$html.= '<th style="text-align:center;">' . $valor . '</th>';
				endforeach;
	$html.= '</tr>';

	$html.= '</table>';

}
			
echo $html;
				
?>