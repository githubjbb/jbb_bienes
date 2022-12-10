<?php
// create some HTML content	
$html = '<br><p><h1 align="center" style="color:#5ea431;">PÓLIZAS VIGENTES</h1></p>';
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
if($listadoPolizas)
{ 
	foreach ($listadoPolizas as $lista):
		$html.= '<br><br><table cellspacing="0" cellpadding="5">
					<tr>
						<th bgcolor="#86bd62" style="color:white;"><strong>Fecha Inicio </strong></th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Fecha Vencimiento</strong></th>
						<th bgcolor="#86bd62" style="color:white;"><strong>No. Póliza </strong></th>
						<th bgcolor="#86bd62" style="color:white;"><strong>Descripción </strong></th>
					</tr>
					<tr>
						<th >' . strftime("%b %d, %G",strtotime($lista['fecha_inicio'])). '</th>
						<th >' . strftime("%b %d, %G",strtotime($lista['fecha_vencimiento'])) . '</th>
						<th >' . $lista['numero_poliza']. '</th>
						<th >' . $lista['descripcion']. '</th>
					</tr>
				</table>';
	endforeach;
}
		
echo $html;
						
?>