<?php
// create some HTML content	
$html = '<br><p><h1 align="center" style="color:#3e403e;">LOCALIZACIÓN</h1></p>';
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
if($listadoLocalizacion)
{ 
	foreach ($listadoLocalizacion as $lista):
		$html.= '<br><br><table cellspacing="0" cellpadding="5">
					<tr>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Registro </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Localización </strong></th>
						<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Usuario </strong></th>
					</tr>
					<tr>
						<th >' . strftime("%b %d, %G",strtotime($lista['fecha_localizacion'])) . '</th>
						<th >' . $lista['localizacion']. '</th>
						<th >' . $lista['name']. '</th>
					</tr>
				</table>';
	endforeach;
}
		
echo $html;
						
?>