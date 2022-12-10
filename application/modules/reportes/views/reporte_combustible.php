<?php
// create some HTML content	
$html = '<br><p><h1 align="center" style="color:#3e403e;">SEGUIMIENTO DE OPERACIÓN DE EQUIPO</h1></p>';
$html .= '
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	</style>';
				
//datos especificos
if($listadoControlCombustible)
{ 
	foreach ($listadoControlCombustible as $lista):
		switch ($lista['tipo_consumo']) {
			case 1:
				$valor = 'Combustible';
				break;
			case 2:
				$valor = 'Grasa';
				break;
			case 3:
				$valor = 'Aceite Transmisión';
				break;
			case 4:
				$valor = 'Aceite Hidráulico';
				break;
			case 5:
				$valor = 'Aceite Motor';
				break;
		}
	
		$html.= '<br><br><table cellspacing="0" cellpadding="5">
					<tr>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Registro </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Horas o Kilometros </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Operador </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Consumo </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Cantidad (Galones) </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Lugar </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Valor X Galón </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Labor Realizada </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Valor Total </strong></th>
					</tr>
					<tr>
						<th >' . strftime("%b %d, %G",strtotime($lista['fecha_combustible'])) . '</th>
						<th >' . $lista['kilometros_actuales']. '</th>
						<th >' . $lista['name']. '</th>
						<th >' . $valor. '</th>
						<th >' . $lista['cantidad']. '</th>
						<th >' . $lista['lugar']. '</th>
						<th >$' . number_format($lista['valor_x_galon'], 2) . '</th>
						<th >$' . number_format($lista['valor_total'], 2) . '</th>
						<th >' . $lista['labor_realizada']. '</th>
					</tr>
				</table>';
	endforeach;
}
		
echo $html;
						
?>