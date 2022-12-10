<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ordentrabajo_model extends CI_Model {

		
		/**
		 * Guardar orden trabajo
		 * @since 27/1/2021
		 */
		public function guardarOrdentrabajo() 
		{
				$idOrdenTrabajo = $this->input->post('hddIdOrdenTrabajo');
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_user_encargado' => $this->input->post('id_encargado')
				);	

				//revisar si es para adicionar o editar
				if ($idOrdenTrabajo == '') 
				{
					$data['tipo_mantenimiento'] = $this->input->post('hddtipoMantenimiento');
					$data['fk_id_mantenimiento'] = $this->input->post('hddIdMantenimiento');
					$data['fk_id_equipo_ot '] = $this->input->post('hddIdEquipo');
					$data['fecha_asignacion'] = date("Y-m-d G:i:s");
					$data['fk_id_user_orden'] = $idUser;
					$data['estado_actual'] = $this->input->post('estado');
					$data['usar_contrato'] = $this->input->post('usar_contrato');
					$data['observacion'] = $this->input->post('informacion');
					$data['informacion_adicional'] = 'O.T. Creada y asignada';
					$data['fecha_ultima_actualizacion'] = date("Y-m-d G:i:s");
					$query = $this->db->insert('orden_trabajo', $data);
					$idOrdenTrabajo = $this->db->insert_id();
				} else {
					$this->db->where('id_orden_trabajo', $idOrdenTrabajo);
					$query = $this->db->update('orden_trabajo', $data);
				}
				if ($query) {
					return $idOrdenTrabajo;
				} else {
					return false;
				}
		}

		/**
		 * Guardar estado orden trabajo
		 * @since 29/1/2021
		 */
		public function guardarEstadoOrdentrabajo($idOrdenTrabajo) 
		{
				$idUser = $this->session->userdata("id");
		
				$data = array(
					'fk_id_orden_trabajo_estado' => $idOrdenTrabajo,
					'fk_id_user_ote' => $idUser,
					'fecha_registro_estado' => date("Y-m-d G:i:s"),
					'informacion_adicional_estado' => trim($this->security->xss_clean($this->input->post('informacion'))),
					'estado' => $this->input->post('estado')
				);	

				$query = $this->db->insert('orden_trabajo_estado', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar orden trabajo estado
		 * @since 29/1/2021
		 */
		public function updateOrdentrabajo() 
		{		
				$idOrdenTrabajo = $this->input->post("hddIdOrdenTrabajo");
				$estado = $this->input->post("estado");
				$tipoMantenimiento = $this->input->post("hddtipoMantenimiento");

				$data = array(
					'informacion_adicional' => $this->input->post('informacion'),
					'estado_actual' => $estado,
					'fecha_ultima_actualizacion' => date("Y-m-d G:i:s")
				);

				//si el estado es SOLUCIONADO entonces guardo el costo del mantenimiento
				if($estado == 2){
					$data['costo_mantenimiento'] = $this->input->post('costo_mantenimiento');
					//si el estado es SOLUCIONADO y el tipo de mantenimiento es PREVENTIVO entonces guardo el proximo mantenimiento
					if($tipoMantenimiento == 2){
						$data['proximo_mantemiento_kilometros_horas_ot'] = $this->input->post('proximo_mantenimiento');
					}
				}

				$this->db->where('id_orden_trabajo', $idOrdenTrabajo);
				$query = $this->db->update('orden_trabajo', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar Estado Mantenimiento Correctivo
		 * @since 31/1/2021
		 */
		public function updateEstadoMantenimientoCorrectivo($estado)
		{		
				$idMantenimiento = $this->input->post('hddIdMantenimiento');
				$data = array(
					'estado' => $estado
				);
				$this->db->where('id_correctivo', $idMantenimiento);
				$query = $this->db->update('mantenimiento_correctivo', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Add info boton go back
		 * @since 25/2/2021
		 */
		public function saveInfoGoBack($arrData) 
		{
			$idUser = $this->session->userdata("id");
			
			//delete datos anteriores del usuario
			$this->db->delete('orden_trabajo_go_back', array('fk_id_user_go_back' => $idUser));
			
			$data = array('fk_id_user_go_back' => $idUser);

			if (array_key_exists("idTipoEquipo", $arrData)) {
				$data['post_id_tipo_equipo'] = $arrData["idTipoEquipo"];
			}
			if (array_key_exists("idEquipo", $arrData)) {
				$data['post_id_equipo'] = $arrData["idEquipo"];
			}
			if (array_key_exists("OTNumber", $arrData)) {
				$data['post_id_orden_trabajo'] = $arrData["OTNumber"];
			}
			if (array_key_exists("estado", $arrData)) {
				$data['post_estado'] = $arrData["estado"];
			}
			if (array_key_exists("from", $arrData)) {
				$data['post_from'] = $arrData["from"];
			}
			if (array_key_exists("to", $arrData)) {
				$data['post_to'] = $arrData["to"];
			}
			
			$query = $this->db->insert('orden_trabajo_go_back', $data);

		}

		/**
		 * Add Auditoria Contratos - Saldo
		 * @since 23/8/2021
		 */
		public function saveAuditoriaContratoSaldo($idContrato) 
		{
				$idUser = $this->session->userdata("id");

				$saldoContrato = $this->input->post('hddSaldoContrato');
				$costoMantenimiento = $this->input->post('costo_mantenimiento');
				$saldoContrato = $saldoContrato - $costoMantenimiento;

				$data = array(
					'fk_id_contrato_mantenimiento' => $idContrato,
					'estado_contrato' => 1,
					'fk_id_usuario' => $idUser,
					'valor_contrato' => $this->input->post('hddValorContrato'),
					'saldo_contrato' => $saldoContrato,
					'fk_id_orden_trabajo' => $this->input->post('hddIdOrdenTrabajo'),
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
		 * Guardar Documento
		 * @since 31/8/2021
		 */
		public function guardarDocumentoOT($archivo) 
		{
				$idUser = $this->session->userdata("id");
			
				$data = array(
					'fk_id_orden_trabajo' => $this->input->post('hddIdOT'),
					'fk_id_tipo_documento' => $this->input->post('tipo_documento'),
					'fk_id_user ' => $idUser,
					'url_documento' => $archivo
				);
				$query = $this->db->insert('orden_trabajo_documento', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}


		
		

		
	    
	}