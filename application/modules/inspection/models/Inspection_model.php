<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Inspection_model extends CI_Model {

			
		/**
		 * Add vehicle next oil change
		 * @since 18/1/2017
		 */
		public function saveVehicleNextOilChange($idVehicle, $state, $idInspection) 
		{
				$idUser = $this->session->userdata("id");
				
				$data = array(
					'fk_id_vehicle' => $idVehicle,
					'fk_id_user' => $idUser,
					'current_hours' => $this->input->post('hours'),
					'next_oil_change' => $this->input->post('oilChange'),
					'state' => $state,
					'current_hours_2' => $this->input->post('hours2'),
					'next_oil_change_2' => $this->input->post('oilChange2'),
					'current_hours_3' => $this->input->post('hours3'),
					'next_oil_change_3' => $this->input->post('oilChange3'),
					'fk_id_inspection' => $idInspection
				);	


				$query = $this->db->insert('vehicle_oil_change', $data);
				$idVehicleNextOilChange = $this->db->insert_id();
				$fecha = date("Y-m-d G:i:s");

				//actualizo fecha del registo
				$sql = "UPDATE vehicle_oil_change SET date_issue = '$fecha' WHERE id_oil_change=$idVehicleNextOilChange";
				$query = $this->db->query($sql);

				if ($query) {
					
					$data = array(
						'hours' => $this->input->post('hours'),
						'hours_2' => $this->input->post('hours2'),
						'hours_3' => $this->input->post('hours3')
					);

					$this->db->where('id_vehicle', $idVehicle);
					$query = $this->db->update('param_vehicle', $data);
	
					if ($query) {
						return true;
					}else{
						//se debe borrar el registro en la tabla vehicle_oil_change
						return false;
					}
				} else {
					return false;
				}
		}



		
		

		
	    
	}