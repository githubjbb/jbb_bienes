<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class External_model extends CI_Model {
		
		/**
		 * Add/Edit Vehicle Inspection
		 * @since 25/6/2022
		 */
		public function saveVehicleInspection() 
		{
				$idUser = $this->input->post('id_conductor');
				$idVehicleInspection = $this->input->post('hddId');

				$data = array(
					'fk_id_equipo_vehiculo' => $this->input->post('hddIdVehicle'),
					'activo' => addslashes($this->security->xss_clean($this->input->post('activo'))),
					'razon_inactivo' => addslashes($this->security->xss_clean($this->input->post('razon'))),
					'razon_cual' => addslashes($this->security->xss_clean($this->input->post('cual'))),
					'horas_actuales_vehiculo' => addslashes($this->security->xss_clean($this->input->post('hours'))),
					'licencia' => addslashes($this->security->xss_clean($this->input->post('licencia'))),
					'soat' => addslashes($this->security->xss_clean($this->input->post('soat'))),
					'tarjeta_propiedad' => addslashes($this->security->xss_clean($this->input->post('tarjeta_propiedad'))),
					'seguro' => addslashes($this->security->xss_clean($this->input->post('seguro'))),
					'observacion_documentos' => addslashes($this->security->xss_clean($this->input->post('observacion_documentos'))),
					'dir_delanteras' => addslashes($this->security->xss_clean($this->input->post('dir_delanteras'))),
					'dir_traseras' => addslashes($this->security->xss_clean($this->input->post('dir_traseras'))),
					'observacion_dir' => addslashes($this->security->xss_clean($this->input->post('observacion_dir'))),
					'luces_altas' => addslashes($this->security->xss_clean($this->input->post('luces_altas'))),
					'luces_bajas' => addslashes($this->security->xss_clean($this->input->post('luces_bajas'))),
					'luces_stops' => addslashes($this->security->xss_clean($this->input->post('luces_stops'))),
					'luces_reversa' => addslashes($this->security->xss_clean($this->input->post('luces_reversa'))),
					'luces_parqueo' => addslashes($this->security->xss_clean($this->input->post('luces_parqueo'))),
					'observacion_luces' => addslashes($this->security->xss_clean($this->input->post('observacion_luces'))),
					'limpiabrizas' => addslashes($this->security->xss_clean($this->input->post('limpiabrizas'))),
					'observacion_limpia' => addslashes($this->security->xss_clean($this->input->post('observacion_limpia'))),
					'freno_princiapal' => addslashes($this->security->xss_clean($this->input->post('freno_princiapal'))),
					'freno_emergencia' => addslashes($this->security->xss_clean($this->input->post('freno_emergencia'))),
					'observacion_freno' => addslashes($this->security->xss_clean($this->input->post('observacion_freno'))),
					'llantas_delanteras' => addslashes($this->security->xss_clean($this->input->post('llantas_delanteras'))),
					'llantas_traseras' => addslashes($this->security->xss_clean($this->input->post('llantas_traseras'))),
					'llantas_repuesto' => addslashes($this->security->xss_clean($this->input->post('llantas_repuesto'))),
					'observacion_llantas' => addslashes($this->security->xss_clean($this->input->post('observacion_llantas'))),
					'espejos_laterales' => addslashes($this->security->xss_clean($this->input->post('espejos_laterales'))),
					'espejos_retrovisor' => addslashes($this->security->xss_clean($this->input->post('espejos_retrovisor'))),
					'observacion_espejos' => addslashes($this->security->xss_clean($this->input->post('observacion_espejos'))),
					'pito' => addslashes($this->security->xss_clean($this->input->post('pito'))),
					'observacion_pito' => addslashes($this->security->xss_clean($this->input->post('observacion_pito'))),
					'nivel_frenos' => addslashes($this->security->xss_clean($this->input->post('nivel_frenos'))),
					'nivel_aceite' => addslashes($this->security->xss_clean($this->input->post('nivel_aceite'))),
					'nivel_refrigerante' => addslashes($this->security->xss_clean($this->input->post('nivel_refrigerante'))),
					'nivel_caja' => addslashes($this->security->xss_clean($this->input->post('nivel_caja'))),
					'observacion_niveles' => addslashes($this->security->xss_clean($this->input->post('observacion_niveles'))),
					'apoyo_delantero' => addslashes($this->security->xss_clean($this->input->post('apoyo_delantero'))),
					'apoyo_trasero' => addslashes($this->security->xss_clean($this->input->post('apoyo_trasero'))),
					'observacion_apoyo' => addslashes($this->security->xss_clean($this->input->post('observacion_apoyo'))),
					'cinturon_delantero' => addslashes($this->security->xss_clean($this->input->post('cinturon_delantero'))),
					'cinturon_trasero' => addslashes($this->security->xss_clean($this->input->post('cinturon_trasero'))),
					'observacion_cinturon' => addslashes($this->security->xss_clean($this->input->post('observacion_cinturon'))),
					'observacion_seguridad' => addslashes($this->security->xss_clean($this->input->post('observacion_seguridad'))),
					'extintor' => addslashes($this->security->xss_clean($this->input->post('extintor'))),
					'herramientas' => addslashes($this->security->xss_clean($this->input->post('herramientas'))),
					'cruceta' => addslashes($this->security->xss_clean($this->input->post('cruceta'))),
					'gato' => addslashes($this->security->xss_clean($this->input->post('gato'))),
					'tacos' => addslashes($this->security->xss_clean($this->input->post('tacos'))),
					'triangulo' => addslashes($this->security->xss_clean($this->input->post('triangulo'))),
					'chaleco' => addslashes($this->security->xss_clean($this->input->post('chaleco'))),
					'botiquin' => addslashes($this->security->xss_clean($this->input->post('botiquin'))),
					'observacion_botiquin' => addslashes($this->security->xss_clean($this->input->post('observacion_botiquin')))
				);
								
				//revisar si es para adicionar o editar
				if ($idVehicleInspection == '') 
				{
					$data['fk_id_user_responsable'] = $idUser;
					$data['fecha_registro'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('inspection_vehiculos', $data);
					$idVehicleInspection = $this->db->insert_id();
				} else {
					$this->db->where('id_inspection_vehiculos', $idVehicleInspection);
					$query = $this->db->update('inspection_vehiculos', $data);
				}
				if ($query) {
					return $idVehicleInspection;
				} else {
					return false;
				}
		}
		
		/**
		 * Add encuesta de satisfaccion
		 * @since 18/1/2021
		 */
		public function saveVehicleEncuesta() 
		{
				$data = array(
					'fk_id_equipo_vehiculo' => $this->input->post('id_equipo'),
					'fecha_registro' => date("Y-m-d"),
					'recorrido' => addslashes($this->security->xss_clean($this->input->post('recorrido'))),
					'amabilidad' => addslashes($this->security->xss_clean($this->input->post('amabilidad'))),
					'presentacion' => addslashes($this->security->xss_clean($this->input->post('presentacion'))),
					'limpieza' => addslashes($this->security->xss_clean($this->input->post('limpieza'))),
					'calidad' => addslashes($this->security->xss_clean($this->input->post('calidad'))),
					'normas' => addslashes($this->security->xss_clean($this->input->post('normas'))),
					'velocidad' => addslashes($this->security->xss_clean($this->input->post('velocidad'))),
					'cinturon' => addslashes($this->security->xss_clean($this->input->post('cinturon'))),
					'aparatos' => addslashes($this->security->xss_clean($this->input->post('aparatos')))
				);
				$query = $this->db->insert('encuesta_vehiculos', $data);
				$idEncuesta = $this->db->insert_id();

				if ($query) {
					return $idEncuesta;
				} else {
					return false;
				}
		}
		
	    
	}