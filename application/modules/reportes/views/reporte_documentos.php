<?php
// create some HTML content	
$html = '<br><p><h1 align="center" style="color:#3e403e;">DOCUMENTOS</h1></p>';
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
if($listadoDocumentos)
{ 
	foreach ($listadoDocumentos as $lista):
		$html.= '<br><br><table cellspacing="0" cellpadding="5">
					<tr>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Documento </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Inicio </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Vencimiento</strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. Documento </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Descripción </strong></th>
					</tr>
					<tr>
						<th >' . $lista['tipo_documento']. '</th>
						<th >' . strftime("%b %d, %G",strtotime($lista['fecha_inicio'])). '</th>
						<th >' . strftime("%b %d, %G",strtotime($lista['fecha_vencimiento'])) . '</th>
						<th >' . $lista['numero_documento']. '</th>
						<th >' . $lista['descripcion']. '</th>
					</tr>
				</table>';
	endforeach;
}
		
echo $html;
						
?>