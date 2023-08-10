<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Settings_model extends CI_Model {

	    
		/**
		 * Verify if the user already exist by the social insurance number
		 * @author BMOTTAG
		 * @since  8/11/2016
		 * @review 10/12/2020
		 */
		public function verifyUser($arrData) 
		{
				if (array_key_exists("idUser", $arrData)) {
					$this->db->where('id_user !=', $arrData["idUser"]);
				}			

				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("usuarios");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
		/**
		 * Add/Edit USER
		 * @since 8/11/2016
		 */
		public function saveUser() 
		{
				$idUser = $this->input->post('hddId');
				
				$data = array(
					'first_name' => $this->input->post('firstName'),
					'last_name' => $this->input->post('lastName'),
					'numero_cedula' => $this->input->post('numeroCelular'),
					'log_user' => $this->input->post('user'),
					'movil' => $this->input->post('movilNumber'),
					'email' => $this->input->post('email'),
					'fk_id_user_role' => $this->input->post('id_role'),
					'fk_id_dependencia_u' => $this->input->post('idDependencia'),
					'numero_licencia' => $this->input->post('numero_licencia'),
					'categoria' => $this->input->post('categoria'),
					'vigencia' => $this->input->post('vigencia'),
					'numero_contrato' => $this->input->post('numero_contrato'),
					'fecha_inicio_contrato' => formatear_fecha($this->input->post('fecha_inicio')),
					'fecha_final_contrato' => formatear_fecha($this->input->post('fecha_final')),
					'tiene_multas' => $this->input->post('tiene_multas'),
					'codigo_multa' => $this->input->post('codigo_multa'),
					'tipo_vinculacion' => $this->input->post('tipoVinculacion')
				);	

				//revisar si es para adicionar o editar
				if ($idUser == '') {
					$data['state'] = 1;
					$data['password'] = 'be52d7c1a5e18013492be5fd8ff5f898';//Jardin2021
					$query = $this->db->insert('usuarios', $data);
				} else {
					$data['state'] = $this->input->post('state');
					$this->db->where('id_user', $idUser);
					$query = $this->db->update('usuarios', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
	    /**
	     * Reset user´s password
	     * @author BMOTTAG
	     * @since  20/3/2021
	     */
	    public function resetEmployeePassword($arrData)
		{
				$passwd = md5($arrData['passwd']);
				$data = array(
					'password' => $passwd,
					'state' => 0
				);
				$this->db->where('id_user', $arrData['idUser']);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }

	    /**
	     * Update user´s password
	     * @author BMOTTAG
	     * @since  8/11/2016
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Add/Edit COMPANY
		 * @since 13/12/2016
		 */
		public function saveCompany() 
		{
				$idCompany = $this->input->post('hddId');
				
				$data = array(
					'nombre_proveedor' => $this->input->post('company'),
					'contacto' => $this->input->post('contact'),
					'numero_celular' => $this->input->post('movilNumber'),
					'email' => $this->input->post('email')
				);
				
				//revisar si es para adicionar o editar
				if ($idCompany == '') {
					$query = $this->db->insert('param_proveedores', $data);
					$idCompany = $this->db->insert_id();				
				} else {
					$this->db->where('id_proveedor', $idCompany);
					$query = $this->db->update('param_proveedores', $data);
				}
				if ($query) {
					return $idCompany;
				} else {
					return false;
				}
		}
		
		
		
	    
	}