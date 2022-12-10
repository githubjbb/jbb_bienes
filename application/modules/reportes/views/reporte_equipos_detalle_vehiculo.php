<?php
// create some HTML content	
$html = '
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #939591;
		text-align: left;
		padding: 8px;
	}
	</style>';
				
//datos especificos
if($infoEquipo)
{ 
	//<!-- IMAGEN DEL EQUIPO -->
	$imagen = FALSE;
	if($fotosEquipos){ 
		$imagen = base_url($fotosEquipos[0]["equipo_foto"]);
	}elseif($infoEquipo[0]["qr_code_img"]){
		$imagen = base_url($infoEquipo[0]["qr_code_img"]);
	}
	//<!-- FIN IMAGEN DEL EQUIPO -->
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th rowspan="5" width="20%">
					<img src="' . $imagen . '" class="img-rounded" width="150" height="150" />
					</th>
					<th bgcolor="#dde1da" style="color:#3e403e;" width="15%"><strong>Marca: </strong></th>
					<th width="20%">' . $infoEquipo[0]['marca']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Modelo: </strong></th>
					<th >' . $infoEquipo[0]['modelo']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Número Serial: </strong></th>
					<th >' . $infoEquipo[0]['numero_serial']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Placa: </strong></th>
					<th >' . $infoEquipo[0]['placa']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Equipo: </strong></th>
					<th >' . $infoEquipo[0]['tipo_equipo']. '</th>
				</tr>
			</table>';
	$html.='<br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Dependencia: </strong></th>
					<th >' . $infoEquipo[0]['dependencia']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Contrato de Mantenimiento: </strong></th>
					<th>' . $infoEquipo[0]['numero_contrato']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Valor Comercial: </strong></th>
					<th >$' . number_format($infoEquipo[0]['valor_comercial']) . '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Fecha Adquisición: </strong></th>
					<th >' . $infoEquipo[0]['fecha_adquisicion']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Responsable del Equipo: </strong></th>
					<th>' . $infoEquipo[0]['name']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Horas/Kilometros Actuales: </strong></th>
					<th >' . number_format($infoEquipo[0]['horas_kilometros_actuales']) . '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Observación: </strong></th>
					<th colspan="5">' . $infoEquipo[0]['observacion']. '</th>
				</tr>
			</table>';
}

//datos detalados 
if($infoEspecifica)
{ 
	$combustible = $infoEspecifica[0]['combustible']==1?'Gasolina':'Diesel';
	$multas = $infoEspecifica[0]['multas']==1?'Si':'No';
	$html.= '<br><br><table cellspacing="0" cellpadding="5">
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Dimensiones: </strong></th>
					<th >' . $infoEspecifica[0]['dimensiones']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Línea: </strong></th>
					<th >' . $infoEspecifica[0]['linea']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Color: </strong></th>
					<th >' . $infoEspecifica[0]['color']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Combustible: </strong></th>
					<th >' . $combustible . '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Clase Vehículo: </strong></th>
					<th>' . $infoEspecifica[0]['clase_vehiculo']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Tipo Carrocería: </strong></th>
					<th >' . $infoEspecifica[0]['tipo_carroceria'] . '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Capacidad: </strong></th>
					<th >' . $infoEspecifica[0]['capacidad']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Servicio: </strong></th>
					<th >' . $infoEspecifica[0]['servicio']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Número Motor: </strong></th>
					<th >' . $infoEspecifica[0]['numero_motor']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Número Chasis: </strong></th>
					<th >' . $infoEspecifica[0]['numero_chasis']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Código GPS: </strong></th>
					<th >' . $infoEspecifica[0]['codigo_gps']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Código Ship: </strong></th>
					<th >' . $infoEspecifica[0]['codigo_ship']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;" colspan="2"><strong>Número de Licencia de Tránsito: </strong></th>
					<th >' . $infoEspecifica[0]['numero_licencia_transito']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>Multas: </strong></th>
					<th >' . $multas . '</th>
				</tr>
			</table>';
}
			
echo $html;
						
?>