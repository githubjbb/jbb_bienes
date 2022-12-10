<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reportes_model extends CI_Model {
	    
		/**
		 * Consulta lista de equipos
		 * @since 19/11/2020
		 */
		public function get_equipos_info($arrData) 
		{		
				$this->db->select("A.*, T.*, D.dependencia, C.numero_contrato, CONCAT(U.first_name, ' ', U.last_name) name, U.numero_cedula, U.numero_licencia, U.categoria, U.vigencia, U.numero_contrato, U.fecha_inicio_contrato, U.fecha_final_contrato, U.tiene_multas, U.codigo_multa, CONCAT(W.first_name, ' ', W.last_name) persona_diligencio");
				$this->db->join('param_dependencias D', 'D.id_dependencia = A.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = A.fk_id_tipo_equipo', 'INNER');
				$this->db->join('contratos_mantenimiento C', 'C.id_contrato_mantenimiento = A.fk_id_contrato_mantenimiento', 'INNER');
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_responsable', 'INNER');
				$this->db->join('usuarios W', 'W.id_user = A.fk_id_persona', 'LEFT');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.id_equipo', $arrData["idEquipo"]);
				}
				if (array_key_exists("estadoEquipo", $arrData)) {
					$this->db->where('A.estado_equipo', $arrData["estadoEquipo"]);
				}
				if (array_key_exists("encryption", $arrData)) {
					$this->db->where('A.qr_code_encryption ', $arrData["encryption"]);
				}
				if (array_key_exists("idTipoEquipo", $arrData) && $arrData["idTipoEquipo"] != '') {
					$this->db->like('A.fk_id_tipo_equipo', $arrData["idTipoEquipo"]); 
				}
				if (array_key_exists("numero_inventario", $arrData) && $arrData["numero_inventario"] != '') {
					$this->db->like('A.numero_inventario', $arrData["numero_inventario"]); 
				}
				if (array_key_exists("marca", $arrData) && $arrData["marca"] != '') {
					$this->db->like('A.marca', $arrData["marca"]); 
				}
				if (array_key_exists("modelo", $arrData) && $arrData["modelo"] != '') {
					$this->db->like('A.modelo', $arrData["modelo"]); 
				}
				if (array_key_exists("numero_serial", $arrData) && $arrData["numero_serial"] != '') {
					$this->db->like('A.numero_serial', $arrData["numero_serial"]); 
				}

				$this->db->order_by('id_equipo', 'desc');
				
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('equipos A', $arrData["limit"]);
				}else{
					$query = $this->db->get('equipos A');
				}

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta lista de equipos
		 * @since 24/05/2022
		 */
		public function get_vehiculos_info($arrData) 
		{		
				$this->db->select("A.*, K.*, T.*, CV.clase_vehiculo, Z.tipo_carroceria,  D.dependencia, C.numero_contrato, CONCAT(U.first_name, ' ', U.last_name) name, U.numero_cedula, U.numero_licencia, U.categoria, U.vigencia, U.numero_contrato, U.fecha_inicio_contrato, U.fecha_final_contrato, U.tiene_multas, U.codigo_multa, U.tipo_vinculacion, CONCAT(W.first_name, ' ', W.last_name) persona_diligencio");
				$this->db->join('equipos_detalle_vehiculo K', 'K.fk_id_equipo = A.id_equipo', 'INNER');
				$this->db->join('param_dependencias D', 'D.id_dependencia = A.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = A.fk_id_tipo_equipo', 'INNER');
				$this->db->join('contratos_mantenimiento C', 'C.id_contrato_mantenimiento = A.fk_id_contrato_mantenimiento', 'INNER');
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_responsable', 'INNER');
				$this->db->join('usuarios W', 'W.id_user = A.fk_id_persona', 'LEFT');
				$this->db->join('param_clase_vehiculo CV', 'CV.id_clase_vechiculo = K.fk_id_clase_vechiculo', 'LEFT');
				$this->db->join('param_tipo_carroceria Z', 'Z.id_tipo_carroceria = K.fk_id_tipo_carroceria', 'LEFT');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.id_equipo', $arrData["idEquipo"]);
				}
				if (array_key_exists("estadoEquipo", $arrData)) {
					$this->db->where('A.estado_equipo', $arrData["estadoEquipo"]);
				}
				if (array_key_exists("encryption", $arrData)) {
					$this->db->where('A.qr_code_encryption ', $arrData["encryption"]);
				}
				if (array_key_exists("idTipoEquipo", $arrData) && $arrData["idTipoEquipo"] != '') {
					$this->db->like('A.fk_id_tipo_equipo', $arrData["idTipoEquipo"]); 
				}
				if (array_key_exists("numero_inventario", $arrData) && $arrData["numero_inventario"] != '') {
					$this->db->like('A.numero_inventario', $arrData["numero_inventario"]); 
				}
				if (array_key_exists("marca", $arrData) && $arrData["marca"] != '') {
					$this->db->like('A.marca', $arrData["marca"]); 
				}
				if (array_key_exists("modelo", $arrData) && $arrData["modelo"] != '') {
					$this->db->like('A.modelo', $arrData["modelo"]); 
				}
				if (array_key_exists("numero_serial", $arrData) && $arrData["numero_serial"] != '') {
					$this->db->like('A.numero_serial', $arrData["numero_serial"]); 
				}

				$this->db->order_by('id_equipo', 'desc');
				
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('equipos A', $arrData["limit"]);
				}else{
					$query = $this->db->get('equipos A');
				}

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta detalles de quipos tipo vehiculos
		 * @since 3/12/2020
		 */
		public function equipos_detalle_vehiculo($arrData) 
		{		
				$this->db->select();				
				$this->db->join('param_clase_vehiculo C', 'C.id_clase_vechiculo = A.fk_id_clase_vechiculo', 'LEFT');
				$this->db->join('param_tipo_carroceria T', 'T.id_tipo_carroceria = A.fk_id_tipo_carroceria', 'LEFT');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo', $arrData["idEquipo"]);
				}
				
				$query = $this->db->get('equipos_detalle_vehiculo A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
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
				$query = $this->db->get('equipos_localizacion A', 1);


				if ($query->num_rows() > 0) {
					return $query->result_array();
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
				$fechaActual = date("Y-m-d");	
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name, T.tipo_documento");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_user_d', 'INNER');
				$this->db->join('param_tipo_documento T', 'T.id_tipo_documento = A.fk_id_tipo_documento', 'INNER');		
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_d', $arrData["idEquipo"]);
				}
				if (array_key_exists("idTipoDocumento", $arrData)) {
					$this->db->where('A.fk_id_tipo_documento', $arrData["idTipoDocumento"]);
					$this->db->where('A.fecha_inicio <=', $fechaActual);
					$this->db->where('A.fecha_vencimiento >=', $fechaActual);
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
		 * Lista de fotos por equipo
		 * @since 14/12/2020
		 */
		public function get_fotos_equipos($arrData) 
		{		
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_user_ef', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_foto', $arrData["idEquipo"]);
				}
				if (array_key_exists("idEquipoFoto", $arrData)) {
					$this->db->where('A.id_equipo_foto', $arrData["idEquipoFoto"]);
				}
				
				$this->db->order_by('A.id_equipo_foto', 'asc');
				$query = $this->db->get('equipos_fotos A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta orden de trabajo
		 * @since 27/1/2021
		 */
		public function get_orden_trabajo($arrData)
		{
				$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name, CONCAT(X.first_name, ' ', X.last_name) encargado, E.numero_inventario, T.tipo_equipo");
				$this->db->join('usuarios U', 'U.id_user = C.fk_id_user_orden', 'INNER');
				$this->db->join('usuarios X', 'X.id_user = C.fk_id_user_encargado', 'INNER');
				$this->db->join('equipos E', 'E.id_equipo = C.fk_id_equipo_ot ', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = E.fk_id_tipo_equipo', 'INNER');
				if (array_key_exists("idOrdenTrabajo", $arrData) && $arrData["idOrdenTrabajo"] != '') {
					$this->db->where('C.id_orden_trabajo ', $arrData["idOrdenTrabajo"]);
				}
				if (array_key_exists("idMantenimiento", $arrData) && array_key_exists("tipoMantenimiento", $arrData)) {
					$this->db->where('C.fk_id_mantenimiento', $arrData["idMantenimiento"]);
				}
				if (array_key_exists("tipoMantenimiento", $arrData)) {
					$this->db->where('C.tipo_mantenimiento ', $arrData["tipoMantenimiento"]);
				}
				if (array_key_exists("idEquipo", $arrData) && $arrData["idEquipo"] != '') {
					$this->db->where('C.fk_id_equipo_ot', $arrData["idEquipo"]);
				}
				if (array_key_exists("idTipoEquipo", $arrData) && $arrData["idTipoEquipo"] != '') {
					$this->db->where('E.fk_id_tipo_equipo', $arrData["idTipoEquipo"]);
				}
				if (array_key_exists("estado", $arrData) && $arrData["estado"] != '') {
					$this->db->where('C.estado_actual', $arrData["estado"]);
				}
				if (array_key_exists("from", $arrData) && $arrData["from"] != '') {
					$this->db->where('C.fecha_asignacion >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData) && $arrData["to"] != '' && $arrData["from"] != '') {
					$this->db->where('C.fecha_asignacion <=', $arrData["to"]);
				}

				$this->db->order_by('C.id_orden_trabajo', 'desc');
				$query = $this->db->get('orden_trabajo C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Lista de Documentos por OT
		 * @since 8/9/2021
		 */
		public function get_documento_ot($arrData) 
		{		
				$this->db->select();
				if (array_key_exists("idOrdenTrabajo", $arrData)) {
					$this->db->where('A.fk_id_orden_trabajo', $arrData["idOrdenTrabajo"]);
				}
				$this->db->order_by('A.id_ot_documento', 'desc');
				$query = $this->db->get('orden_trabajo_documento A');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Consulta estado orden de trabajo
		 * @since 29/1/2021
		 */
		public function get_estado_orden_trabajo($arrData)
		{
				$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name");
				$this->db->join('usuarios U', 'U.id_user = C.fk_id_user_ote', 'INNER');
				if (array_key_exists("idOrdenTrabajoEstado", $arrData)) {
					$this->db->where('C.id_orden_trabajo_estado', $arrData["idOrdenTrabajoEstado"]);
				}
				if (array_key_exists("idOrdenTrabajo", $arrData)) {
					$this->db->where('C.fk_id_orden_trabajo_estado', $arrData["idOrdenTrabajo"]);
				}

				$this->db->order_by('C.id_orden_trabajo_estado', 'desc');
				$query = $this->db->get('orden_trabajo_estado C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta lista de mantenimientos correctivo por equipo
		 * @since 26/1/2021
		 */
		public function get_mantenimiento_correctivo($arrData)
		{
				$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name, E.numero_inventario, T.tipo_equipo");
				$this->db->join('usuarios U', 'C.fk_id_user_correctivo = U.id_user', 'INNER');
				$this->db->join('equipos E', 'E.id_equipo = C.fk_id_equipo_correctivo', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = E.fk_id_tipo_equipo', 'INNER');
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('C.fk_id_equipo_correctivo', $arrData["idEquipo"]);
				}
				if (array_key_exists("idMantenimiento", $arrData)) {
					$this->db->where('C.id_correctivo', $arrData["idMantenimiento"]);
				}
				if (array_key_exists("idUser", $arrData)) {
					$this->db->where('C.fk_id_user_correctivo', $arrData["idUser"]);
				}
				if (array_key_exists("filtroFecha", $arrData)) {
					$this->db->where('C.fecha >=', $arrData["filtroFecha"]);
				}
				if (array_key_exists("estadoMantenimiento", $arrData)) {
					$this->db->where('C.estado', $arrData["estadoMantenimiento"]);
				}
				$this->db->order_by('C.id_correctivo', 'desc');
				$query = $this->db->get('mantenimiento_correctivo C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

	/**
	 * Consulta lista de mantenimientos preventivos para un equipo
	 * @since 24/8/2021
	 */
	public function get_mantenimiento_preventivo_equipo($arrData)
	{
			$this->db->select("M.*, P.*, T.tipo_equipo, CONCAT(U.first_name, ' ', U.last_name) name");
			$this->db->join('mantenimiento_preventivo_plantilla P', 'P.id_preventivo_plantilla  = M.fk_id_preventivo_plantilla', 'INNER');
			$this->db->join('usuarios U', 'P.fk_id_user_mpp = U.id_user', 'INNER');
			$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = P.fk_id_tipo_equipo_mpp', 'INNER');
			if (array_key_exists("idMantenimiento", $arrData)) {
				$this->db->where('M.id_preventivo_equipo', $arrData["idMantenimiento"]);
			}
			if (array_key_exists("idEquipo", $arrData)) {
				$this->db->where('M.fk_id_equipo_mpe', $arrData["idEquipo"]);
			}
			$this->db->order_by('P.descripcion', 'asc');

			$query = $this->db->get('mantenimiento_preventivo_equipo M');
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
	}

	/**
	 * Lista inspecciones
	 * @since 22/05/2022
	 */
	public function get_inspecciones($arrData) 
	{		
			$this->db->select("I.*, CONCAT(first_name, ' ', last_name) name, U.numero_cedula, D.dependencia");
			$this->db->join('usuarios U', 'U.id_user = I.fk_id_user_responsable', 'INNER');
			$this->db->join('param_dependencias D', 'D.id_dependencia = U.fk_id_dependencia_u', 'INNER');

			if (array_key_exists("idInspeccion", $arrData)) {
				$this->db->where('I.id_inspection_vehiculos', $arrData["idInspeccion"]);
			}
			$query = $this->db->get('inspection_vehiculos I');

			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
	}

	/**
	 * Lista encuestas
	 * @since 29/05/2022
	 */
	public function get_encuestas($arrData) 
	{		
			$this->db->select("S.*, CONCAT(first_name, ' ', last_name) name, U.numero_cedula, D.dependencia, E.numero_inventario, E.placa");
			$this->db->join('equipos E', 'E.id_equipo = S.fk_id_equipo_vehiculo ', 'INNER');
			$this->db->join('usuarios U', 'U.id_user = E.fk_id_responsable', 'INNER');
			$this->db->join('param_dependencias D', 'D.id_dependencia = U.fk_id_dependencia_u', 'INNER');

			if (array_key_exists("idEncuesta", $arrData)) {
				$this->db->where('S.id_encuesta_vehiculos', $arrData["idEncuesta"]);
			}
			if (array_key_exists("preguntaSatisfaccion", $arrData)) {
				$this->db->where('S.' . $arrData["preguntaSatisfaccion"] . '<= ', 1);
			}
			if (array_key_exists("preguntaSeguridad", $arrData)) {
				$this->db->where('S.' . $arrData["preguntaSeguridad"] . '= ', 0);
			}
			if (array_key_exists("from", $arrData)) {
				$this->db->where('S.fecha_registro >=', $arrData["from"]);
			}
			if (array_key_exists("to", $arrData)) {
				$this->db->where('S.fecha_registro <=', $arrData["to"]);
			}
			$query = $this->db->get('encuesta_vehiculos S');

			if ($query->num_rows() > 0) {
				return $query->result_array();
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
				$this->db->select('C.*, U.first_name, U.last_name, U.numero_cedula, T.tipo_equipo, E.placa');				
				$this->db->join('usuarios U', 'U.id_user = C.fk_id_conductor', 'INNER');
				$this->db->join('equipos E', 'E.id_equipo = C.fk_id_equipo', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = E.fk_id_tipo_equipo', 'INNER');
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
	 * Lista de recorridos
	 * @since 9/7/2021
	 */
	public function get_recorridos($arrData) 
	{			
		$this->db->select("R.*, T.tipo_equipo, E.numero_inventario, E.fk_id_tipo_equipo, CONCAT(U.first_name, ' ', U.last_name) conductor, D.dependencia, M.mes");
		$this->db->join('equipos E', 'E.id_equipo = R.fk_id_equipo_r', 'INNER');
		$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = E.fk_id_tipo_equipo', 'INNER');
		$this->db->join('usuarios U', 'U.id_user = R.fk_id_coductor_recorrido', 'INNER');
		$this->db->join('param_dependencias D', 'D.id_dependencia = U.fk_id_dependencia_u', 'INNER');
		$this->db->join('param_meses M', 'M.id_mes = R.fk_id_mes_recorrido', 'INNER');
		if (array_key_exists("idRecorrido", $arrData)) {
			$this->db->where('R.id_equipo_recorrido ', $arrData["idRecorrido"]);
		}
		if (array_key_exists("idEquipo", $arrData)) {
			$this->db->where('R.fk_id_equipo_r', $arrData["idEquipo"]);
		}
		if (array_key_exists("idMes", $arrData)) {
			$this->db->where('R.fk_id_mes_recorrido', $arrData["idMes"]);
		}
		if (array_key_exists("idConductor", $arrData)) {
			$this->db->where('R.fk_id_coductor_recorrdio', $arrData["idConductor"]);
		}
		$this->db->order_by("id_equipo_recorrido", "DESC");
		$query = $this->db->get("equipos_recorrido R");

		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else{
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
				$this->db->order_by('fecha_registro', 'asc');
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
		
	    
}