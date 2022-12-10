<?php
// create some HTML content		
switch ($infoOT[0]['estado_actual']) {
	case 1:
		$valor = 'Asignada';
		break;
	case 2:
		$valor = 'Solucionado';
		break;
	case 3:
		$valor = 'Cancelado';
		break;
}

$workingTime = '';
if($infoOT[0]['estado_actual']==2){
	$dteStart = new DateTime($infoOT[0]['fecha_asignacion']);
	$dteEnd   = new DateTime($infoOT[0]['fecha_ultima_actualizacion']);
	
	$dteDiff  = $dteStart->diff($dteEnd);
	$workingTime = $dteDiff->format("%R%a días %H:%I:%S");//days hours:minutes:seconds
}

$html = '<br><br><table cellspacing="0" cellpadding="5">
			<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;" colspan="8"><strong>Información Orden de Trabajo </strong></th>
			</tr>
			<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. O.T. </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Asignación </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Asignado a</strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Observación </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Última Actualización </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Estado Actual</strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tiempo de Solución </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Costo Mantenimiento </strong></th>
			</tr>
			<tr>
				<th>' . $infoOT[0]['id_orden_trabajo'] . '</th>
				<th>' . ucfirst(strftime("%b %d, %G %H:%M",strtotime($infoOT[0]['fecha_asignacion']))) . '</th>
				<th>' . $infoOT[0]['encargado'] . '</th>
				<th>' . $infoOT[0]['observacion'] . '</th>
				<th>' . ucfirst(strftime("%b %d, %G %H:%M",strtotime($infoOT[0]['fecha_ultima_actualizacion']))) . '</th>
				<th>' . $valor . '</th>
				<th>' . $workingTime . '</th>
				<th>$' . number_format($infoOT[0]['costo_mantenimiento']) . '</th>
			</tr>
		</table>';


$html.= '<br><br><table cellspacing="0" cellpadding="5">
			<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;" colspan="4"><strong>Histórico </strong></th>
			</tr>
			<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Registro </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Registrado por </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Información Adicional</strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Estado </strong></th>
			</tr>';
foreach ($infoEstado as $lista):
	$html.= '<tr>
				<th>' . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_registro_estado']))) . '</th>
				<th>' . $lista['name'] . '</th>
				<th>' . $lista['informacion_adicional_estado']  . '</th>
				<th>';
				switch ($lista['estado']) {
					case 1:
						$valor = 'Asignada';
						break;
					case 2:
						$valor = 'Solucionado';
						break;
					case 3:
						$valor = 'Cancelado';
						break;
				}
	$html.= $valor . '</th>
			</tr>';
endforeach;
$html.= '</table>';

echo $html;
						
?>