<?php
// create some HTML content					
$html = '<br><br><table cellspacing="0" cellpadding="5">
			<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;" colspan="5"><strong>Información del mantenimiento solicitado </strong></th>
			</tr>
			<tr>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Solicitud </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Descripción </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Consideración o Requerimiento</strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Solicitante </strong></th>
				<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo de Mantenimiento </strong></th>
			</tr>
			<tr>';
		if($infoOT[0]['tipo_mantenimiento'] == 1)
		{
			$html.='<th>' . ucfirst(strftime("%b %d, %G %H:%M",strtotime($infoMantenimiento[0]['fecha']))) . '</th>
					<th>' . $infoMantenimiento[0]['descripcion'] . '</th>
					<th>' . $infoMantenimiento[0]['consideracion'] . '</th>
					<th>' . $infoMantenimiento[0]['name'] . '</th>
					<th>Correctivo</th>';
		}else{
			$html.='<th>' . ucfirst(strftime("%b %d, %G %H:%M",strtotime($infoOT[0]['fecha_asignacion']))) . '</th>
					<th>';
			$html.= $infoMantenimiento[0]['descripcion'];
			$html.='<br><b>Frecuencia:</b><br>Cada ' . number_format($infoMantenimiento[0]['frecuencia']) . ' Km/Horas';
			$html.='<br><b>Próximo mantenimiento:</b><br>' . number_format($infoMantenimiento[0]['proximo_mantemiento_kilometros_horas']) . ' Km/Horas';
			$html.='</th>
					<th></th>
					<th>' . $infoOT[0]['name'] . '</th>
					<th>Preventivo</th>';
		}
$html.= '</tr>
		</table>';

		
echo $html;
						
?>