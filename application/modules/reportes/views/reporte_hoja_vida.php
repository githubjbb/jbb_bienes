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
					<th width="24%" bgcolor="#dde1da" style="color:#3e403e;"><strong>VEHÍCULO</strong></th>
					<th width="23%">' . $infoEspecifica[0]['servicio']. '</th>
					<th width="23%" bgcolor="#dde1da" style="color:#3e403e;"><strong>ÁREA RESPONSABLE</strong></th>
					<th width="30%">' . $infoEquipo[0]['dependencia']. '</th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>NÚMERO INVENTARIO</strong></th>
					<th>' . $infoEquipo[0]['numero_inventario']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>FIRMA</strong></th>
					<th></th>
				</tr>
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>FECHA DE DILIGENCIAMIENTO</strong></th>
					<th>' . $infoEquipo[0]['fecha_diligenciamiento']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>PESONA QUE DILIGENCIO</strong></th>
					<th>' . $infoEquipo[0]['persona_diligencio']. '</th>
				</tr>
			</table>';



	$combustible = $infoEspecifica[0]["combustible"]==1?"Gasolina":"Diesel";
	$html.='<br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>DATOS DEL VEHÍCULO</strong></th>
				</tr>
				<tr>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>TIPO DE VEHÍCULO</strong></th>
					<th width="15%">' . $infoEquipo[0]['tipo_equipo']. '</th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>MARCA</strong></th>
					<th width="15%">' . $infoEquipo[0]['marca']. '</th>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>LÍNEA</strong></th>
					<th width="15%">' . $infoEquipo[0]['modelo']. '</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>MODELO</strong></th>
					<th>' . $infoEquipo[0]['modelo']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CLASE</strong></th>
					<th>' . $infoEspecifica[0]['clase_vehiculo']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CARROCERÍA</strong></th>
					<th>' . $infoEspecifica[0]['tipo_carroceria']. '</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>COLOR</strong></th>
					<th>' . $infoEspecifica[0]['color']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CILINDRAJE</strong></th>
					<th>' . $infoEspecifica[0]['cilindraje']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>COMBUSTIBLE</strong></th>
					<th>' . $combustible. '</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. DE OCUPANTES</strong></th>
					<th>' . $infoEspecifica[0]['numero_ocupantes']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>CAPACIDAD PESO(KG)</strong></th>
					<th>' . $infoEspecifica[0]['capacidad']. '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. DE PUERTAS</strong></th>
					<th>' . $infoEspecifica[0]['numero_puertas']. '</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SERVICIO</strong></th>
					<th colspan="5">' . $infoEspecifica[0]['servicio']. '</th>
				</tr>
			</table>';
	$html.='<br><br>';


	$soat = "";
	$fechaSoat = "";
	$tecnoMecanica = "";
	$fechaTecnoMecanica = "";
	if($infoSOAT){
		$soat = $infoSOAT[0]['numero_documento'];
		$fechaSoat = $infoSOAT[0]['fecha_vencimiento'];
	}
	if($infoTecnoMecanica){
		$tecnoMecanica = $infoTecnoMecanica[0]['numero_documento'];
		$fechaTecnoMecanica = $infoTecnoMecanica[0]['fecha_vencimiento'];
	}
	if($infoPoliza){
		$poliza = $infoPoliza[0]['numero_documento'];
		$fechaPoliza = $infoPoliza[0]['fecha_vencimiento'];
	}

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="5" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>IDENTIFICACIÓN Y REGISTRO LEGAL AUTOMOTRIZ</strong></th>
				</tr>
				<tr>
					<th width="30%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. LICENCIA DE TRANSITO</strong></th>
					<th width="15%">' . $infoEspecifica[0]['numero_licencia_transito']. '</th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>PLACA</strong></th>
					<th width="20%">' . $infoEquipo[0]['placa']. '</th>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>PROPIETARIO</strong></th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. MOTOR</strong></th>
					<th colspan="3">' . $infoEspecifica[0]['numero_motor']. '</th>
					<th>JBB</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. SERIE</strong></th>
					<th colspan="3">' . $infoEquipo[0]['numero_serial']. '</th>
					<th width="20%" bgcolor="#dde1da" style="color:#3e403e;"><strong>ID PROPIETARIO</strong></th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. CHASIS</strong></th>
					<th colspan="3">' . $infoEspecifica[0]['numero_chasis']. '</th>
					<th>860030197</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. SOAT</strong></th>
					<th>' . $soat . '</th>
					<th>VENCIMIENTO ' . $fechaSoat . '</th>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>SEGURO TODO RIESGO </strong> ' . $poliza . '</th>
					<th>VENCIMIENTO ' . $fechaPoliza . '</th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>No. TÉCNICO MECANICA</strong></th>
					<th>' . $tecnoMecanica . '</th>
					<th>VENCIMIENTO ' . $fechaTecnoMecanica . '</th>
					<th></th>
					<th></th>
				</tr>

				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e;"><strong>OBSERVACIONES ADICIONALES</strong></th>
					<th colspan="4">	</th>
				</tr>
			</table>';
	$html.='<br><br>';

	//<!-- IMAGEN DEL EQUIPO -->
	$imagen = '#';
	if($fotosEquipos){ 
		$imagen2 = base_url($fotosEquipos[0]["equipo_foto"]);
	}
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>REGISTRO FOTOGRAFÍCO</strong></th>
				</tr>
				<tr>
					<th style="color:#3e403e; text-align: center;"><img src="' . $imagen . '" class="img-rounded" width="150" height="150" /></th>
				</tr>

			</table>';
	$html.='<br><br>';
	$profesional = "";
	switch ($infoEquipo[0]['profesional_asignado']) {
		case 1:
			$profesional = 'Director(a)';
			break;
		case 2:
			$profesional = 'Secretario General y de Control Disciplinario';
			break;
		case 3:
			$profesional = 'Subdirector de Educativa';
			break;
	}
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>INFORMACIÓN RESPONSABLE VEHÍCULO</strong></th>
				</tr>
				<tr>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>PROFESIONAL ASIGNADO</strong></th>
					<th width="85%" colspan="5">' . $profesional. '</th>
				</tr>
				<tr>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>CONDUCTOR/OPERADOR</strong></th>
					<th width="55%" colspan="3">' . $infoEquipo[0]['name']. '</th>
					<th width="10%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. DE CÉDULA</strong></th>
					<th width="20%">' . $infoEquipo[0]['numero_cedula']. '</th>
				</tr>

				<tr>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. LICENCIA DE CONUDCCIÓN</strong></th>
					<th width="20%">' . $infoEquipo[0]['numero_licencia']. '</th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>CATEGORÍA</strong></th>
					<th width="20%">' . $infoEquipo[0]['categoria']. '</th>
					<th width="10%" bgcolor="#dde1da" style="color:#3e403e;"><strong>VIGENCIA</strong></th>
					<th width="20%">' . $infoEquipo[0]['vigencia']. '</th>
				</tr>

				<tr>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>No. CONTRATO</strong></th>
					<th width="20%">' . $infoEquipo[0]['numero_contrato']. '</th>
					<th width="15%" bgcolor="#dde1da" style="color:#3e403e;"><strong>FECHA DE INICIO</strong></th>
					<th width="20%">' . $infoEquipo[0]['fecha_inicio_contrato']. '</th>
					<th width="10%" bgcolor="#dde1da" style="color:#3e403e;"><strong>FECHA DE FINAL</strong></th>
					<th width="20%">' . $infoEquipo[0]['fecha_final_contrato']. '</th>
				</tr>
			</table>';
	$tieneMultas = $infoEquipo[0]['tiene_multas']==1?"Si":"No";
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>ACTUALMENTE TIENE MULTAS</strong></th>
					<th width="25%">' . $tieneMultas. '</th>
					<th width="25%" bgcolor="#dde1da" style="color:#3e403e;"><strong>CÓDIGO MULTA</strong></th>
					<th width="25%">' . $infoEquipo[0]['codigo_multa']. '</th>
				</tr>
			</table>';
	$html.='<br><br>';

	$multas = $infoEspecifica[0]['multas']==1?"Si":"No";
	$restricciones = $infoEspecifica[0]['restricciones']==1?"Si":"No";

	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th colspan="6" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>INFORMACIÓN MULTAS Y RESTRICCIONES DEL VEHÍCULO</strong></th>
				</tr>
				<tr>
					<th width="33%" bgcolor="#dde1da" style="color:#3e403e;"><strong>EL VEHÍCULO CUENTA ACTUALMENTE CON MULTAS</strong></th>
					<th width="33%" >' . $multas. '</th>
					<th width="34%" bgcolor="#dde1da" style="color:#3e403e;"><strong>CÓDIGO Y MOTIVO DE LA MULTA Y/O RESTIRCCIÓN</strong></th>
				</tr>

				<tr>
					<th width="33%" bgcolor="#dde1da" style="color:#3e403e;"><strong>EL VEHÍCULO CUENTA ACTUALMENTE CON RESTRICCIONES</strong></th>
					<th width="33%">' . $restricciones. '</th>
					<th width="34%">' . $infoEspecifica[0]['motivo_multa']. '</th>
				</tr>
			</table>';
	$html.='<br><br>';
	$html.= '<table cellspacing="0" cellpadding="5">
				<tr>
					<th width="33%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>ELABORÓ </strong></th>
					<th width="33%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>REVISÓ </strong></th>
					<th width="34%" bgcolor="#dde1da" style="color:#3e403e; text-align: center;"><strong>APROBÓ </strong></th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>

				<tr>
					<th ></th>
					<th ></th>
					<th ></th>
				</tr>

			</table>';

}


			
echo $html;
						
?>