<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Equipos_model extends CI_Model {

	    		
		/**
		 * Guardar equipo
		 * @since 19/11/2020
		 */
		public function guardarEquipo($pass) 
		{
				$idEquipo = $this->input->post('hddId');
				
				$data = array(
					'numero_inventario' => $this->input->post('numero_inventario'),
					'fk_id_dependencia' => $this->input->post('id_dependencia'),
					'marca' => $this->input->post('marca'),
					'modelo' => $this->input->post('modelo'),
					'numero_serial' => $this->input->post('numero_serial'),
					'fk_id_tipo_equipo' => $this->input->post('id_tipo_equipo'),
					'estado_equipo' => $this->input->post('estado'),
					'valor_comercial' => $this->input->post('valor_comercial'),
					'placa' => $this->input->post('placa'),
					'fk_id_contrato_mantenimiento' => $this->input->post('id_contrato'),
					'fk_id_responsable' => $this->input->post('id_responsable'),
					'fecha_adquisicion' => $this->input->post('fecha_adquisicion'),
					'observacion' => $this->input->post('observacion'),
					'profesional_asignado' => $this->input->post('profesional_asignado'),
					'fk_id_persona' => $this->session->userdata("id")
				);	

				//revisar si es para adicionar o editar
				if ($idEquipo == '') 
				{
					$data['fecha_diligenciamiento'] = date("Y-m-d");							
					$query = $this->db->insert('equipos', $data);
					$idEquipo = $this->db->insert_id();
					
					//actualizo la url del codigo QR
					$path = $idEquipo . $pass;
					$rutaQRcode = "images/equipos/QR/" . $idEquipo . "_qr_code.png";
			
					//actualizo campo con el path encriptado
					$sql = "UPDATE equipos SET qr_code_encryption = '$path', qr_code_img = '$rutaQRcode'  WHERE id_equipo = $idEquipo";
					$query = $this->db->query($sql);
				} else {
					$data['fecha_diligenciamiento'] = $this->input->post('fecha_diligenciamiento');
					$this->db->where('id_equipo', $idEquipo);
					$query = $this->db->update('equipos', $data);
				}
				if ($query) {
					return $idEquipo;
				} else {
					return false;
				}
		}	
		
		/**
		 * Guardar equipo
		 * @since 3/12/2020
		 */
		public function guardarInfoEspecificaVehiculo() 
		{
				$idInfoEspecificaEquipo = $this->input->post('hddId');
				
				$data = array(
					'fk_id_equipo' => $this->input->post('hddIdEquipo'),
					'dimensiones' => $this->input->post('dimensiones'),
					'linea' => $this->input->post('linea'),
					'color' => $this->input->post('color'),
					'fk_id_clase_vechiculo' => $this->input->post('id_clase_vechiculo'),
					'fk_id_tipo_carroceria' => $this->input->post('id_tipo_carroceria'),
					'combustible' => $this->input->post('combustible'),
					'capacidad' => $this->input->post('capacidad'),
					'servicio' => $this->input->post('servicio'),
					'numero_motor' => $this->input->post('numero_motor'),
					'numero_chasis' => $this->input->post('numero_chasis'),
					'codigo_gps' => $this->input->post('codigo_gps'),
					'codigo_ship' => $this->input->post('codigo_ship'),
					'numero_licencia_transito' => $this->input->post('numero_licencia_transito'),
					'multas' => $this->input->post('multas'),
					'multas_conductor' => $this->input->post('multas_conductor'),
					'restricciones' => $this->input->post('restricciones'),
					'motivo_multa' => $this->input->post('motivo_multa'),
					'numero_puertas' => $this->input->post('numero_puertas'),
					'numero_ocupantes' => $this->input->post('numero_ocupantes'),
					'cilindraje' => $this->input->post('cilindraje')
				);	

				//revisar si es para adicionar o editar
				if ($idInfoEspecificaEquipo == '') 
				{							
					$query = $this->db->insert('equipos_detalle_vehiculo', $data);
				} else {
					$this->db->where('id_equipo_detalle_vehiculo', $idInfoEspecificaEquipo);
					$query = $this->db->update('equipos_detalle_vehiculo', $data);
				}
				if ($query) {
					//guardo en la tabla de auditoria
					$idUser = $this->session->userdata("id");
					$data["fecha_diligenciamiento"] = date("Y-m-d G:i:s");
					$data["fk_id_persona"] = $idUser;
					$query = $this->db->insert('auditoria_equipos_detalle_vehiculo', $data);
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Guardar equipo
		 * @since 9/12/2020
		 */
		public function guardarInfoEspecificaBomba() 
		{
				$idInfoEspecificaEquipo = $this->input->post('hddId');
				
				$data = array(
					'fk_id_equipo_bomba' => $this->input->post('hddIdEquipo'),
					'dimension' => $this->security->xss_clean($this->input->post('dimension')),
					'motor_frecuencia' => $this->security->xss_clean($this->input->post('motor_frecuencia')),
					'motor_velocidad' => $this->security->xss_clean($this->input->post('motor_velocidad')),
					'motor_voltaje' => $this->security->xss_clean($this->input->post('motor_voltaje')),
					'potencia' => $this->security->xss_clean($this->input->post('potencia')),
					'consumo' => $this->security->xss_clean($this->input->post('consumo')),
					'hmax' => $this->security->xss_clean($this->input->post('hmax')),
					'qmax' => $this->security->xss_clean($this->input->post('qmax')),
					'succion' => $this->security->xss_clean($this->input->post('succion')),
					'salida' => $this->security->xss_clean($this->input->post('salida')),
					'color' => $this->security->xss_clean($this->input->post('color')),
					'peso' => $this->security->xss_clean($this->input->post('peso')),
					'caracteristicas' => $this->security->xss_clean($this->input->post('caracteristicas')),
					'condiciones_operacion' => $this->security->xss_clean($this->input->post('condiciones_operacion'))
				);	

				//revisar si es para adicionar o editar
				if ($idInfoEspecificaEquipo == '') 
				{							
					$query = $this->db->insert('equipos_detalle_bomba', $data);
				} else {
					$this->db->where('id_equipo_detalle_bomba', $idInfoEspecificaEquipo);
					$query = $this->db->update('equipos_detalle_bomba', $data);
				}
				if ($query) {
					//guardo en la tabla de auditoria
					$idUser = $this->session->userdata("id");
					$data["fecha_diligenciamiento"] = date("Y-m-d G:i:s");
					$data["fk_id_persona"] = $idUser;
					$query = $this->db->insert('auditoria_equipos_detalle_bomba', $data);
					return true;
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Verificar si el equipo ya existe por el numero de inventario
		 * @author BMOTTAG
		 * @since  10/12/2020
		 */
		public function verificarEquipo($arrData) 
		{
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('id_equipo !=', $arrData["idEquipo"]);
				}			

				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("equipos");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
		/**
		 * Add fotos
		 * @since 14/12/2020
		 */
		public function add_fotos($path) 
		{							
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_equipo_foto' => $this->input->post('hddId'),
					'fk_id_user_ef' => $idUser,
					'descripcion' => $this->input->post('descripcion'),
					'equipo_foto' => $path,
					'fecha_foto' => date("Y-m-d")
				);			

				$query = $this->db->insert('equipos_fotos', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
						
		/**
		 * Lista de localizacion por equipo
		 * @since 17/12/2020
		 */
		public function get_localizacion($arrData) 
		{		
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_user_localizacion', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_localizacion', $arrData["idEquipo"]);
				}
				if (array_key_exists("idEquipoLocalizacion", $arrData)) {
					$this->db->where('A.id_equipo_localizacion', $arrData["idEquipoLocalizacion"]);
				}
				
				$this->db->order_by('A.id_equipo_localizacion', 'desc');
				$query = $this->db->get('equipos_localizacion A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
	
		/**
		 * Guardar localizacion
		 * @since 17/12/2020
		 */
		public function guardarLocalizacion() 
		{
				$idLocalizacion = $this->input->post('hddId');
				$idEquipo = $this->input->post('hddIdEquipo');
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_equipo_localizacion' => $idEquipo,
					'localizacion' => $this->input->post('localizacion'),
					'fecha_localizacion' => $this->input->post('fecha')
				);	

				//revisar si es para adicionar o editar
				if ($idLocalizacion == '') 
				{
					$data['fk_id_user_localizacion'] = $idUser;
					$query = $this->db->insert('equipos_localizacion', $data);
				} else {
					$this->db->where('id_equipo_localizacion', $idLocalizacion);
					$query = $this->db->update('equipos_localizacion', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de control combustile por equipo
		 * @since 17/12/2020
		 */
		public function get_control_combustible($arrData) 
		{		
				$this->db->select('A.*, CONCAT(first_name, " ", last_name) name');				
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_operador_combustible', 'INNER');
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_combustible', $arrData["idEquipo"]);
				}
				if (array_key_exists("idControlCombustible", $arrData)) {
					$this->db->where('A.id_equipo_control_combustible', $arrData["idControlCombustible"]);
				}
				
				$this->db->order_by('A.id_equipo_control_combustible', 'desc');
				$query = $this->db->get('equipos_control_combustible A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
	
		/**
		 * Guardar localizacion
		 * @since 17/12/2020
		 */
		public function guardarControlCombustible() 
		{
				$idControlCombustible = $this->input->post('hddidControlCombustibler');
				$cantidad = $this->input->post('cantidad');
				$valorGalon = $this->input->post('valor_x_galon');
				$valorTotal = $valorGalon * $cantidad;
			
				$data = array(
					'kilometros_actuales' => $this->input->post('kilometros_actuales'),
					'fk_id_operador_combustible' => $this->input->post('id_operador'),
					'tipo_consumo' => $this->input->post('tipo_consumo'),
					'cantidad' => $cantidad,
					'valor_x_galon' => $valorGalon,
					'valor_total' => $valorTotal,
					'lugar' => $this->input->post('lugar'),
					'labor_realizada' => $this->input->post('labor_realizada')
				);	

				//revisar si es para adicionar o editar
				if ($idControlCombustible == '') 
				{
					$data['fk_id_equipo_combustible'] = $this->input->post('hddidEquipo');
					$data['fecha_combustible'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('equipos_control_combustible', $data);
				} else {
					$this->db->where('id_equipo_control_combustible', $idControlCombustible);
					$query = $this->db->update('equipos_control_combustible', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de Documentos por equipo
		 * @since 6/1/2021
		 */
		public function get_documento($arrData) 
		{		
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name, T.tipo_documento");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_user_d', 'INNER');
				$this->db->join('param_tipo_documento T', 'T.id_tipo_documento = A.fk_id_tipo_documento', 'INNER');		

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_d', $arrData["idEquipo"]);
				}
				if (array_key_exists("idDocumento", $arrData)) {
					$this->db->where('A.id_equipo_documento', $arrData["idDocumento"]);
				}
				
				$this->db->order_by('A.id_equipo_documento', 'desc');
				$query = $this->db->get('equipos_documento A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
	
		/**
		 * Guardar Documento
		 * @since 6/1/2021
		 */
		public function guardarDocumento($archivo) 
		{
				$idDocumento = $this->input->post('hddidDocumento');
				$idUser = $this->session->userdata("id");
			
				$data = array(
					'fk_id_tipo_documento' => $this->input->post('tipo_documento'),
					'fk_id_equipo_d' => $this->input->post('hddIdEquipo'),
					'aplica_fechas' => $this->input->post('noAplica'),
					'fecha_inicio' => formatear_fecha($this->input->post('fecha_inicio')),
					'fecha_vencimiento' => formatear_fecha($this->input->post('fecha_vencimiento')),
					'numero_documento' => $this->input->post('numero_documento'),
					'descripcion' => $this->input->post('descripcion')
				);

				if($archivo != 'xxx'){
					$data['url_documento'] = $archivo;
				}

				//revisar si es para adicionar o editar
				if ($idDocumento == '') 
				{
					$data['fk_id_user_d'] = $idUser;
					$query = $this->db->insert('equipos_documento', $data);
					$idDocumento = $this->db->insert_id();
				} else {
					$this->db->where('id_equipo_documento', $idDocumento);
					$query = $this->db->update('equipos_documento', $data);
				}
				if ($query) {
					return $idDocumento;
				} else {
					return false;
				}
		}

		/**
		 * Lista de Diagnostico
		 * @since 20/3/2021
		 */
		public function get_diagnostico($arrData) 
		{		
				$this->db->select("I.*, CONCAT(first_name, ' ', last_name) name, D.dependencia");
				$this->db->join('usuarios U', 'U.id_user = I.fk_id_user_responsable', 'INNER');
				$this->db->join('param_dependencias D', 'D.id_dependencia = U.fk_id_dependencia_u', 'INNER');		

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('I.fk_id_equipo_vehiculo', $arrData["idEquipo"]);
				}
				if (array_key_exists("idInspeccion", $arrData)) {
					$this->db->where('I.id_inspection_vehiculos', $arrData["idInspeccion"]);
				}
				if (array_key_exists("from", $arrData)) {
					$this->db->where('I.fecha_registro >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData)) {
					$this->db->where('I.fecha_registro <=', $arrData["to"]);
				}
				
				$this->db->order_by('I.id_inspection_vehiculos', 'desc');
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('inspection_vehiculos I', $arrData["limit"]);
				}else{
					$query = $this->db->get('inspection_vehiculos I');
				}

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit ONTRATOS MANTENIINETO
		 * @since 8/7/2021
		 */
		public function saveContrato() 
		{
				$idContrato = $this->input->post('hddId');
				$valorContrato = $this->input->post('valor_contrato');
				
				$data = array(
					'numero_contrato' => $this->input->post('numero_contrato'),
					'objeto_contrato' => $this->input->post('objeto_contrato'),
					'fk_id_supervisor ' => $this->input->post('id_supervidor'),
					'fk_id_proveedor ' => $this->input->post('id_proveedor'),
					'fecha_desde' => formatear_fecha($this->input->post('fecha_desde')),
					'fecha_hasta' => formatear_fecha($this->input->post('fecha_hasta')),
					'valor_contrato' => $valorContrato
				);
				
				//revisar si es para adicionar o editar
				if ($idContrato == '') {
					$data['gastos_contrato'] = 0;
					$data['saldo_contrato'] = $valorContrato;
					$data['estado_contrato'] = 1;
					$query = $this->db->insert('contratos_mantenimiento', $data);
					$idContrato = $this->db->insert_id();				
				} else {
					$gastoContrato = $this->input->post('hddGastoContrato');
					$saldoContrato = $valorContrato - $gastoContrato;
					$data['saldo_contrato'] = $saldoContrato;
					$data['estado_contrato'] = $this->input->post('estado');
					$this->db->where('id_contrato_mantenimiento ', $idContrato);
					$query = $this->db->update('contratos_mantenimiento', $data);
				}
				if ($query) {
					return $idContrato;
				} else {
					return false;
				}
		}

		/**
		 * Add Auditoria Contratos
		 * @since 13/8/2021
		 */
		public function saveAuditoriaContrato($idContrato) 
		{
				$idUser = $this->session->userdata("id");

				$data = array(
					'fk_id_contrato_mantenimiento' => $idContrato,
					'numero_contrato' => $this->input->post('numero_contrato'),
					'objeto_contrato' => $this->input->post('objeto_contrato'),
					'fk_id_supervisor ' => $this->input->post('id_supervidor'),
					'fk_id_proveedor ' => $this->input->post('id_proveedor'),
					'fecha_desde' => formatear_fecha($this->input->post('fecha_desde')),
					'fecha_hasta' => formatear_fecha($this->input->post('fecha_hasta')),
					'valor_contrato' => $this->input->post('valor_contrato'),
					'estado_contrato' => $this->input->post('estado'),
					'fk_id_usuario' => $idUser,
					'fecha_registro' => date("Y-m-d G:i:s")
				);	
				$query = $this->db->insert('auditoria_contratos_mantenimiento', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit RECORRIDO
		 * @since 9/7/2021
		 */
		public function saveRecorrido() 
		{
				$idRecorrido = $this->input->post('hddidRecorrido');
				
				$data = array(
					'fk_id_equipo_r' => $this->input->post('idEquipo'),
					'fk_id_coductor_recorrido' => $this->input->post('idConductor'),
					'fk_id_mes_recorrido' => $this->input->post('idMes'),
					'fecha_recorrido' => date('Y-m-d'),
					'recorrido' => $this->input->post('recorrido'),
					'area' => $this->input->post('area'),
					'usuario_nombre' => $this->input->post('usuario_nombre'),
					'usuario_correo' => $this->input->post('usuario_correo')
				);
				
				//revisar si es para adicionar o editar
				if ($idRecorrido == '') {
					$query = $this->db->insert('equipos_recorrido', $data);			
				} else {
					$this->db->where('id_equipo_recorrido', $idRecorrido);
					$query = $this->db->update('equipos_recorrido', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Guardar consumo recorrido
		 * @since 27/7/2021
		 */
		public function guardarConsumoRecorrido() 
		{
				$idConsumo = $this->input->post('hddidConsumo');
				$cantidad = $this->input->post('cantidad');
				$valorGalon = $this->input->post('valor_x_galon');
				$valorTotal = $valorGalon * $cantidad;

				$idUser = $this->session->userdata("id");
			
				$data = array(
					'fk_id_conductor_consumo' => $idUser,
					'fecha_consumo' => $this->input->post('fecha_consumo'),
					'valor_x_galon_consumo' => $valorGalon,
					'numero_galones' => $cantidad,
					'valor_total_consumo' => $valorTotal,
					'kilometraje' => $this->input->post('Kilometraje')
				);	

				//revisar si es para adicionar o editar
				if ($idConsumo == '') 
				{
					$data['fk_id_equipo_recorrido'] = $this->input->post('hddidRecorrido');
					$query = $this->db->insert('equipos_recorrido_consumo', $data);
				} else {
					$this->db->where('id_equipo_recorrido_consumo', $idConsumo);
					$query = $this->db->update('equipos_recorrido_consumo', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Add Auditoria Documentos
		 * @since 6/8/2021
		 */
		public function saveAuditoriaDocumentos($idDocumento, $archivo) 
		{
				$idUser = $this->session->userdata("id");
				$idDocumentoInfo = $this->input->post('hddidDocumento');

				if($archivo != 'xxx'){
					$url = $archivo;
				}else{
					$url = '';
				}
				
				$data = array(
					'fk_id_documento' => $idDocumento,
					'fk_id_equipo' => $this->input->post('hddIdEquipo'),
					'fk_id_tipo_documento' => $this->input->post('tipo_documento'),
					'fk_id_usuario' => $idUser,
					'fecha_inicio' => formatear_fecha($this->input->post('fecha_inicio')),
					'fecha_vencimiento' => formatear_fecha($this->input->post('fecha_vencimiento')),
					'numero_documento' => $this->input->post('numero_documento'),
					'descripcion' => $this->input->post('descripcion'),
					'url_documento' => $url,
					'fecha_registro' => date("Y-m-d G:i:s")
				);	
				$query = $this->db->insert('auditoria_documentos', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Consultar registros de historial de documentos
		 * @since 6/8/2021
		 */
		public function get_documentos_historial($arrData)
		{
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name, T.tipo_documento");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_usuario', 'INNER');
				$this->db->join('param_tipo_documento T', 'T.id_tipo_documento = A.fk_id_tipo_documento', 'INNER');	
				if (array_key_exists("idDocumento", $arrData)) {
					$this->db->where('A.fk_id_documento', $arrData["idDocumento"]);
				}
				$this->db->order_by('A.id_auditoria_documento', 'desc');

				$query = $this->db->get('auditoria_documentos A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consultar registros de historial de CONTRATOS
		 * @since 13/8/2021
		 */
		public function get_contratos_historial($arrData)
		{
				$this->db->select("A.*, P.nombre_proveedor, CONCAT(U.first_name, ' ', U.last_name) name, CONCAT(X.first_name, ' ', X.last_name) supervisor");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_usuario', 'INNER');
				$this->db->join('usuarios X', 'X.id_user = A.fk_id_supervisor', 'LEFT');
				$this->db->join('param_proveedores P', 'P.id_proveedor = A.fk_id_proveedor', 'LEFT');
				if (array_key_exists("idContrato", $arrData)) {
					$this->db->where('A.fk_id_contrato_mantenimiento', $arrData["idContrato"]);
				}
				$this->db->order_by('A.id_auditoria_contrato_mantenimiento', 'desc');

				$query = $this->db->get('auditoria_contratos_mantenimiento A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Guardar Comparendos Conductores
		 * @since 29/5/2022
		 */
		public function guardarComparendos() 
		{
				$idComparendo = $this->input->post('hddidComparendo');
			
				$data = array(
					'fk_id_conductor' => $this->input->post('hddidConductor'),
					'fk_id_equipo' => $this->input->post('hddidEquipo'),
					'fecha_revision' => $this->input->post('fecha_revision'),
					'verificacion_runt' => $this->input->post('verificacion_runt'),
					'verificacion_simit' => $this->input->post('verificacion_simit')
				);	

				//revisar si es para adicionar o editar
				if ($idComparendo == '') 
				{
					$query = $this->db->insert('comparendos_conductor', $data);
				} else {
					$this->db->where('id_comparendo', $idComparendo);
					$query = $this->db->update('comparendos_conductor', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Lista de Comparendos Conductor
		 * @since 17/12/2020
		 */
		public function get_comparendos($arrData) 
		{		
				$this->db->select('C.*, CONCAT(U.first_name, " ", U.last_name) name, U.numero_cedula');				
				$this->db->join('usuarios U', 'U.id_user = C.fk_id_conductor', 'INNER');
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('C.fk_id_equipo', $arrData["idEquipo"]);
				}
				if (array_key_exists("idComparendo", $arrData)) {
					$this->db->where('C.id_comparendo', $arrData["idComparendo"]);
				}
				
				$this->db->order_by('C.id_comparendo', 'desc');
				$query = $this->db->get('comparendos_conductor C');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Add Auditoria Equipos
		 * @since 16/06/2022
		 */
		public function saveAuditoriaEquipo($idEquipo) 
		{
				$data = array(
					'fk_id_equipo' => $idEquipo,
					'numero_inventario' => $this->input->post('numero_inventario'),
					'fk_id_dependencia' => $this->input->post('id_dependencia'),
					'marca' => $this->input->post('marca'),
					'modelo' => $this->input->post('modelo'),
					'numero_serial' => $this->input->post('numero_serial'),
					'fk_id_tipo_equipo' => $this->input->post('id_tipo_equipo'),
					'estado_equipo' => $this->input->post('estado'),
					'observacion' => $this->input->post('observacion'),
					'fecha_adquisicion' => $this->input->post('fecha_adquisicion'),
					'valor_comercial' => $this->input->post('valor_comercial'),
					'placa' => $this->input->post('placa'),
					'fk_id_contrato_mantenimiento' => $this->input->post('id_contrato'),
					'fk_id_responsable' => $this->input->post('id_responsable'),
					'profesional_asignado' => $this->input->post('profesional_asignado'),
					'fk_id_persona' => $this->session->userdata("id"),
					'fecha_diligenciamiento' => date("Y-m-d G:i:s")
				);	
				$query = $this->db->insert('auditoria_equipos', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Contar encuestas de satisfaccióm
		 * @author BMOTTAG
		 * @since  23/06/2022
		 */
		public function countEncuestas($arrData)
		{

				$sql = "SELECT count(id_encuesta_vehiculos) CONTEO";
				$sql.= " FROM   encuesta_vehiculos";
				$sql.= " WHERE 1=1 ";
				if (array_key_exists("preguntaSatisfaccion", $arrData)) {
					$sql.= " AND " . $arrData["preguntaSatisfaccion"] . " <= 1";
				}
				if (array_key_exists("preguntaSeguridad", $arrData)) {
					$sql.= " AND " . $arrData["preguntaSeguridad"] . " = 0";
				}
				if (array_key_exists("from", $arrData)) {
					$sql.= " AND fecha_registro >='". $arrData["from"]. "'";
				}				
				if (array_key_exists("to", $arrData)) {
					$sql.= " AND fecha_registro <='". $arrData["to"]. "'";
				}

				$query = $this->db->query($sql);
				$row = $query->row();
				return $row->CONTEO;
		}

		
		
	    
	}