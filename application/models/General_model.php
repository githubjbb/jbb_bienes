<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Clase para consultas generales a una tabla
 */
class General_model extends CI_Model {

    /**
     * Consulta BASICA A UNA TABLA
     * @param $TABLA: nombre de la tabla
     * @param $ORDEN: orden por el que se quiere organizar los datos
     * @param $COLUMNA: nombre de la columna en la tabla para realizar un filtro (NO ES OBLIGATORIO)
     * @param $VALOR: valor de la columna para realizar un filtro (NO ES OBLIGATORIO)
     * @since 8/11/2016
     */
    public function get_basic_search($arrData) {
        if ($arrData["id"] != 'x')
            $this->db->where($arrData["column"], $arrData["id"]);
        $this->db->order_by($arrData["order"], "ASC");
        $query = $this->db->get($arrData["table"]);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else
            return false;
    }
	
	/**
	 * Delete Record
	 * @since 25/5/2017
	 */
	public function deleteRecord($arrDatos) 
	{
			$query = $this->db->delete($arrDatos ["table"], array($arrDatos ["primaryKey"] => $arrDatos ["id"]));
			if ($query) {
				return true;
			} else {
				return false;
			}
	}
	
	/**
	 * Update field in a table
	 * @since 11/12/2016
	 */
	public function updateRecord($arrDatos) {
		$data = array(
			$arrDatos ["column"] => $arrDatos ["value"]
		);
		$this->db->where($arrDatos ["primaryKey"], $arrDatos ["id"]);
		$query = $this->db->update($arrDatos ["table"], $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Lista de menu
	 * Modules: MENU
	 * @since 30/3/2020
	 */
	public function get_menu($arrData) 
	{		
		if (array_key_exists("idMenu", $arrData)) {
			$this->db->where('id_menu', $arrData["idMenu"]);
		}
		if (array_key_exists("menuType", $arrData)) {
			$this->db->where('menu_type', $arrData["menuType"]);
		}
		if (array_key_exists("menuState", $arrData)) {
			$this->db->where('menu_state', $arrData["menuState"]);
		}
		if (array_key_exists("columnOrder", $arrData)) {
			$this->db->order_by($arrData["columnOrder"], 'asc');
		}else{
			$this->db->order_by('menu_order', 'asc');
		}
		
		$query = $this->db->get('param_menu');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}	

	/**
	 * Lista de roles
	 * Modules: ROL
	 * @since 30/3/2020
	 */
	public function get_roles($arrData) 
	{		
		if (array_key_exists("filtro", $arrData)) {
			$this->db->where('id_role !=', 99);
		}
		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('id_role', $arrData["idRole"]);
		}
		
		$this->db->order_by('role_name', 'asc');
		$query = $this->db->get('param_role');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	/**
	 * User list
	 * @since 30/3/2020
	 */
	public function get_user($arrData) 
	{			
		$this->db->select();
		$this->db->join('param_role R', 'R.id_role = U.fk_id_user_role', 'INNER');
		$this->db->join('param_dependencias D', 'D.id_dependencia = U.fk_id_dependencia_u', 'INNER');
		if (array_key_exists("state", $arrData)) {
			$this->db->where('U.state', $arrData["state"]);
		}
		//list without inactive users
		if (array_key_exists("filtroState", $arrData)) {
			$this->db->where('U.state !=', 2);
		}
		if (array_key_exists("idUser", $arrData)) {
			$this->db->where('U.id_user', $arrData["idUser"]);
		}
		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('U.fk_id_user_role', $arrData["idRole"]);
		}

		$this->db->order_by("first_name, last_name", "ASC");
		$query = $this->db->get("usuarios U");

		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else{
			return false;
		}
	}
	
	/**
	 * Lista de enlaces
	 * Modules: MENU
	 * @since 31/3/2020
	 */
	public function get_links($arrData) 
	{		
		$this->db->select();
		$this->db->join('param_menu M', 'M.id_menu = L.fk_id_menu', 'INNER');
		
		if (array_key_exists("idMenu", $arrData)) {
			$this->db->where('fk_id_menu', $arrData["idMenu"]);
		}
		if (array_key_exists("idLink", $arrData)) {
			$this->db->where('id_link', $arrData["idLink"]);
		}
		if (array_key_exists("linkType", $arrData)) {
			$this->db->where('link_type', $arrData["linkType"]);
		}			
		if (array_key_exists("linkState", $arrData)) {
			$this->db->where('link_state', $arrData["linkState"]);
		}
		
		$this->db->order_by('M.menu_order, L.order', 'asc');
		$query = $this->db->get('param_menu_links L');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	/**
	 * Lista de permisos
	 * Modules: MENU
	 * @since 31/3/2020
	 */
	public function get_role_access($arrData) 
	{		
		$this->db->select('P.id_access, P.fk_id_menu, P.fk_id_link, P.fk_id_role, M.menu_name, M.menu_order, M.menu_type, L.link_name, L.link_url, L.order, L.link_icon, L.link_type, R.role_name, R.style');
		$this->db->join('param_menu M', 'M.id_menu = P.fk_id_menu', 'INNER');
		$this->db->join('param_menu_links L', 'L.id_link = P.fk_id_link', 'LEFT');
		$this->db->join('param_role R', 'R.id_role = P.fk_id_role', 'INNER');
		
		if (array_key_exists("idPermiso", $arrData)) {
			$this->db->where('id_access', $arrData["idPermiso"]);
		}
		if (array_key_exists("idMenu", $arrData)) {
			$this->db->where('P.fk_id_menu', $arrData["idMenu"]);
		}
		if (array_key_exists("idLink", $arrData)) {
			$this->db->where('P.fk_id_link', $arrData["idLink"]);
		}
		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('P.fk_id_role', $arrData["idRole"]);
		}
		if (array_key_exists("menuType", $arrData)) {
			$this->db->where('M.menu_type', $arrData["menuType"]);
		}
		if (array_key_exists("linkState", $arrData)) {
			$this->db->where('L.link_state', $arrData["linkState"]);
		}
		if (array_key_exists("menuURL", $arrData)) {
			$this->db->where('M.menu_url', $arrData["menuURL"]);
		}
		if (array_key_exists("linkURL", $arrData)) {
			$this->db->where('L.link_url', $arrData["linkURL"]);
		}		
		
		$this->db->order_by('M.menu_order, L.order', 'asc');
		$query = $this->db->get('param_menu_access P');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	/**
	 * menu list for a role
	 * Modules: MENU
	 * @since 2/4/2020
	 */
	public function get_role_menu($arrData) 
	{		
		$this->db->select('distinct(fk_id_menu), menu_url,menu_icon,menu_name,menu_order');
		$this->db->join('param_menu M', 'M.id_menu = P.fk_id_menu', 'INNER');

		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('P.fk_id_role', $arrData["idRole"]);
		}
		if (array_key_exists("menuType", $arrData)) {
			$this->db->where('M.menu_type', $arrData["menuType"]);
		}
		if (array_key_exists("menuState", $arrData)) {
			$this->db->where('M.menu_state', $arrData["menuState"]);
		}
					
		//$this->db->group_by("P.fk_id_menu"); 
		$this->db->order_by('M.menu_order', 'asc');
		$query = $this->db->get('param_menu_access P');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
		/**
		 * Consulta lista de equipos
		 * @since 19/11/2020
		 */
		public function get_equipos_info($arrData) 
		{		
				$this->db->select("A.*, D.dependencia, T.*, C.*, CONCAT(U.first_name, ' ', U.last_name) name, U.numero_cedula");
				$this->db->join('param_dependencias D', 'D.id_dependencia = A.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = A.fk_id_tipo_equipo', 'INNER');
				$this->db->join('contratos_mantenimiento C', 'C.id_contrato_mantenimiento = A.fk_id_contrato_mantenimiento', 'LEFT');
				$this->db->join('usuarios U', 'A.fk_id_responsable = U.id_user', 'LEFT');				

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
		 * Consulta detalles de quipos tipo bombas
		 * @since 9/12/2020
		 */
		public function equipos_detalle_bomba($arrData) 
		{		
				$this->db->select();				

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_bomba', $arrData["idEquipo"]);
				}
				
				$query = $this->db->get('equipos_detalle_bomba A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de polizas
		 * Modules: Dashboard 
		 * @since 6/1/2021
		 */
		public function get_polizas($arrData) 
		{		
				$this->db->select();
				$this->db->join('equipos E', 'E.id_equipo = P.fk_id_equipo_poliza ', 'INNER');
				
				if (array_key_exists("from", $arrData) && $arrData["from"] != '') {
					$this->db->where('P.fecha_vencimiento >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData) && $arrData["to"] != '' && $arrData["from"] != '') {
					$this->db->where('P.fecha_vencimiento <', $arrData["to"]);
				}
				
				$this->db->order_by('P.id_equipo_poliza', 'desc');
				$query = $this->db->get('equipos_poliza P');

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
		 * Consulta lista de mantenimientos preventivos
		 * @since 1/2/2021
		 */
		public function get_mantenimiento_preventivo($arrData)
		{
				$this->db->select("P.*, T.tipo_equipo, CONCAT(U.first_name, ' ', U.last_name) name");
				$this->db->join('usuarios U', 'P.fk_id_user_mpp = U.id_user', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = P.fk_id_tipo_equipo_mpp', 'INNER');
				if (array_key_exists("idMantenimiento", $arrData)) {
					$this->db->where('P.id_preventivo_plantilla', $arrData["idMantenimiento"]);
				}
				if (array_key_exists("estado", $arrData)) {
					$this->db->where('P.estado', $arrData["estado"]);
				}
				if (array_key_exists("tipoEquipo", $arrData) && $arrData["tipoEquipo"] != '') {
					$this->db->like('P.fk_id_tipo_equipo_mpp', $arrData["tipoEquipo"]); 
				}
				if (array_key_exists("frecuencia", $arrData) && $arrData["frecuencia"] != '') {
					$this->db->like('P.fk_id_frecuencia', $arrData["frecuencia"]); 
				}
				$this->db->order_by('P.id_preventivo_plantilla', 'desc');
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('mantenimiento_preventivo_plantilla P', $arrData["limit"]);
				}else{
					$query = $this->db->get('mantenimiento_preventivo_plantilla P');
				}
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

	/**
	 * Lista de contratos
	 * @since 8/7/2021
	 */
	public function get_contratos($arrData) 
	{			
		$this->db->select("C.*, P.nombre_proveedor, CONCAT(U.first_name, ' ', U.last_name) name");
		$this->db->join('usuarios U', 'U.id_user = C.fk_id_supervisor', 'INNER');
		$this->db->join('param_proveedores P', 'P.id_proveedor = C.fk_id_proveedor', 'INNER');
		if (array_key_exists("idContrato", $arrData)) {
			$this->db->where('C.id_contrato_mantenimiento', $arrData["idContrato"]);
		}
		if (array_key_exists("estado", $arrData)) {
			$this->db->where('C.estado_contrato', $arrData["estado"]);
		}
		if (array_key_exists("filtroEstado", $arrData)) {
			$this->db->where('C.estado_contrato !=', 3);
		}
		$this->db->order_by("fecha_hasta", "ASC");
		$query = $this->db->get("contratos_mantenimiento C");

		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else{
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
	 * Lista de consumos de los recorridos
	 * @since 27/7/2021
	 */
	public function get_consumos($arrData) 
	{			
		$this->db->select();
		if (array_key_exists("idRecorrido", $arrData)) {
			$this->db->where('R.fk_id_equipo_recorrido', $arrData["idRecorrido"]);
		}
		if (array_key_exists("idConsumo", $arrData)) {
			$this->db->where('R.id_equipo_recorrido_consumo', $arrData["idConsumo"]);
		}
		$this->db->order_by("fecha_consumo ", "ASC");
		$query = $this->db->get("equipos_recorrido_consumo R");

		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else{
			return false;
		}
	}

	/**
	 * Consultar tipos de documentos
	 * @since 6/8/2021
	 */
	public function get_tipo_documento()
	{
			$this->db->select();
			$this->db->order_by('tipo_documento', 'asc');
			$query = $this->db->get('param_tipo_documento');
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return false;
			}
	}

	/**
	 * Informacion del contrato para un equipo
	 * @since 8/7/2021
	 */
	public function get_contratos_by_equipo($arrData) 
	{			
		$this->db->select("C.*, P.nombre_proveedor, CONCAT(U.first_name, ' ', U.last_name) name");
		$this->db->join('usuarios U', 'U.id_user = C.fk_id_supervisor', 'INNER');
		$this->db->join('param_proveedores P', 'P.id_proveedor = C.fk_id_proveedor', 'INNER');
		$this->db->join('equipos E', 'E.fk_id_contrato_mantenimiento = C.id_contrato_mantenimiento', 'LEFT');
		if (array_key_exists("idContrato", $arrData)) {
			$this->db->where('C.id_contrato_mantenimiento', $arrData["idContrato"]);
		}
		if (array_key_exists("idEquipo", $arrData)) {
			$this->db->where('E.id_equipo', $arrData["idEquipo"]);
		}
		$this->db->order_by("fecha_hasta", "ASC");
		$query = $this->db->get("contratos_mantenimiento C");

		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else{
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
	 * Add Auditoria Auditoria de mantenimiento preventivo
	 * @since 26/8/2021
	 */
	public function saveAuditoriaProximoMantenimientoPreventivo($idOT) 
	{
			$idUser = $this->session->userdata("id");

			$descripcion = "Ingreso desde una Orden de Trabajo Solucionada.";
			if(is_null($idOT)){
				$descripcion = "Ingreso desde el tablero de mantenimiento preventivo.";
			}

			$data = array(
				'fk_id_preventivo_equipo' => $this->input->post('hddIdMantenimiento'),
				'proximo_mantemiento_kilometros_horas' => $this->input->post('proximo_mantenimiento'),
				'fecha_registro' => date("Y-m-d G:i:s"),
				'fk_id_usuario' => $idUser,
				'fk_id_orden_trabajo ' => $idOT,
				'descripcion_auditoria' => $descripcion
			);	
			$query = $this->db->insert('auditoria_mantenimiento_preventivo_equipo', $data);

			if ($query) {
				return true;
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
		 * Consulta HIStorial de cambios del equipo
		 * @since 29/06/2022
		 */
		public function get_historial_equipo($arrData) 
		{		
				$this->db->select("A.*, D.dependencia, T.*, C.*, CONCAT(U.first_name, ' ', U.last_name) name, U.numero_cedula, CONCAT(X.first_name, ' ', X.last_name) name_diligencio");
				$this->db->join('param_dependencias D', 'D.id_dependencia = A.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = A.fk_id_tipo_equipo', 'INNER');
				$this->db->join('contratos_mantenimiento C', 'C.id_contrato_mantenimiento = A.fk_id_contrato_mantenimiento', 'LEFT');
				$this->db->join('usuarios U', 'A.fk_id_responsable = U.id_user', 'LEFT');
				$this->db->join('usuarios X', 'A.fk_id_persona = X.id_user', 'LEFT');			

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo', $arrData["idEquipo"]);
				}

				$this->db->order_by('id_auditoria_equipos', 'desc');
				$query = $this->db->get('auditoria_equipos A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}


}