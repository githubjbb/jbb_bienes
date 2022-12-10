<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class External extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("external_model");
        $this->load->model("general_model");
		$this->load->helper('form');
    }
	
	/**
	 * Info equipo
     * @since 22/1/2021
     * @author BMOTTAG
	 */
	public function buscar_equipo()
	{
			$arrParam = array("numero_inventario" => $this->security->xss_clean($this->input->post('numero_inventario')));
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
						
			$data["view"] = 'listado_equipos';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Form Add daily Inspection
     * @since 13/1/2022
     * @author BMOTTAG
	 */
	public function add_vehiculos_inspection($idEquipo, $idInspeccion = 'x')
	{
			$this->load->model("general_model");
			
			$data['information'] = FALSE;	
					
			//si envio el id, entonces busco la informacion 
			if ($idInspeccion != 'x') {
					$arrParam = array(
						"idInspeccion" => $idInspeccion
					);
					$data['information'] = $this->general_model->get_inspecciones($arrParam);//info inspection_heavy
					$idEquipo = $data['information'][0]['fk_id_equipo_vehiculo'];
			}else{
					if (!$idEquipo || empty($idEquipo) || $idEquipo == "x" ) { 
						show_error('ERROR!!! - You are in the wrong place.');	
					}
			}
			
			//busco datos del vehiculo
			$arrParam['idEquipo'] = $idEquipo;
			$data['vehicleInfo'] = $this->general_model->get_equipos_info($arrParam);//busco datos del vehiculo

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			//Lista de usuarios activos
			$arrParam = array("filtroState" => TRUE, "idRole" => ID_ROL_CONDUCTOR);
			$data['listaUsuarios'] = $this->general_model->get_user($arrParam);//workers list

			$data["view"] = $data['vehicleInfo'][0]['formulario_inspeccion'];
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Save vehiculos inspection
     * @since 18/1/2021
     * @author BMOTTAG
	 */
	public function save_inspection_vehiculos()
	{
			header('Content-Type: application/json');
			$data = array();

			$token = $this->input->post('token');
			if(isset($token) && !empty($token)) {
				$arrParam2 = array(
					"table" => "parametros",
					"order" => "id_parametro",
					"id" => "x"
				);
				$parametric = $this->general_model->get_basic_search($arrParam2);
				$secret_key = $parametric[7]["parametro_valor"];

			    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$token."&remoteip=" . $_SERVER['REMOTE_ADDR']);
			    $return = json_decode($response);
			    
				if($return->success && $return->action == 'validar' && $return->score >= 0.5) {
						$idInspection = $this->input->post('hddId');
						$data["idVehicle"] = $this->input->post('hddIdVehicle');
						
						$msj = "Se guardó la Inspección Cotidiana, por favor firmar!";
						$flag = true;
						if ($idInspection != '') {
							$msj = "Se actualizó la Inspección Cotidiana!";
							$flag = false;
						}
						
						if ($idInspection = $this->external_model->saveVehicleInspection()) 
						{
							$data["result"] = true;
							$data["idInspection"] = $idInspection;
							$this->session->set_flashdata('retornoExito', $msj);
						} else {
							$data["result"] = "error";
							$data["mensaje"] = "Error!!! Ask for help.";
							$data["idInspection"] = "";
							$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
						}
				} else {
						$data["result"] = "error";
						$data["mensaje"] = "Error!!! No pasó el reCAPTCHA.";
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
						//echo "<pre>";print_r($response);
				}
			}

			echo json_encode($data);
    }	

	/**
	 * Signature
     * @since 27/12/2016
     * @author BMOTTAG
	 */
	public function add_signature($typo, $idInspection)
	{
			if (empty($typo) || empty($idInspection) ) {
				show_error('ERROR!!! - You are in the wrong place.');
			}
		
			if($_POST)
			{
				//update signature with the name of de file
				$name = "images/signature/inspection/" . $typo . "_" . $idInspection . ".png";

				$arrParam = array(
					"idInspeccion" => $idInspection
				);
				$data['information'] = $this->general_model->get_inspecciones($arrParam);//info inspection_heavy
				$idEquipo = $data['information'][0]['fk_id_equipo_vehiculo'];
				
				$arrParam = array(
					"table" => "inspection_" . $typo,
					"primaryKey" => "id_inspection_" . $typo,
					"id" => $idInspection,
					"column" => "signature",
					"value" => $name
				);
				
				$data_uri = $this->input->post("image");
				$encoded_image = explode(",", $data_uri)[1];
				$decoded_image = base64_decode($encoded_image);
				file_put_contents($name, $decoded_image);

				$data['linkBack'] = "external/add_" . $typo . "_inspection/". $idEquipo . "/" . $idInspection;
				$data['titulo'] = "<i class='fa fa-life-saver fa-fw'></i>FIRMA";
				if ($this->general_model->updateRecord($arrParam)) {
					//$this->session->set_flashdata('retornoExito', 'You just save your signature!!!');
					
					$data['clase'] = "alert-success";
					$data['msj'] = "Se guardó la firma con éxito.";	
				} else {
					//$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
					
					$data['clase'] = "alert-danger";
					$data['msj'] = "Ask for help.";
				}
				
				$data["view"] = 'template/answer';
				$this->load->view("layout", $data);
				//redirect("/inspection/add_" . $typo . "_inspection/" . $idInspection,'refresh');
			}else{		
				$this->load->view('template/make_signature');
			}
	}

	/**
	 * Informacion del conductor
     * @since 25/5/2022
     * @author BMOTTAG
	 */
    public function infoConductor() {
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
		$conductor = $this->input->post('conductor');
		
		$arrParam = array("idUser" => $conductor);
		$infoUsuario = $this->general_model->get_user($arrParam);
		if ($infoUsuario) {
			echo "<b>Número de Identificación: </b>" . $infoUsuario[0]["numero_cedula"];
			echo "<br><b>Dependencia: </b>" . $infoUsuario[0]["dependencia"];
		}			

    }

	/**
	 * Form Encuesta de Satisfaccion
     * @since 25/5/2022
     * @author BMOTTAG
	 */
	public function add_encuesta($idEncuesta = 'x')
	{
			$data['information'] = FALSE;
			$data['idEncuesta'] = FALSE;
			if ($idEncuesta != 'x') {
					$data['idEncuesta'] = $idEncuesta;
			}
			$arrParam = array('estadoEquipo' => 1, 'idTipoEquipo' => ID_TIPO_EQUIPO_VEHICULOS);
			$data['listaVehiculos'] = $this->general_model->get_equipos_info($arrParam);//busco datos del vehiculo

			$data["view"] = "form_encuesta";
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Informacion del equipo
     * @since 26/5/2022
     * @author BMOTTAG
	 */
    public function infoEquipo() {
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
		$equipo = $this->input->post('equipo');
		
		$arrParam = array("idEquipo" => $equipo);
		$infoEquipo = $this->general_model->get_equipos_info($arrParam);
		if ($infoEquipo) {
			echo '<div class="col-lg-3">';	
			echo "<b>Placas del Vehículo: </b>" . $infoEquipo[0]["placa"];
			echo "<br><b>Número Inventario: </b>" . $infoEquipo[0]["numero_inventario"];
			echo "</div>";
			echo '<div class="col-lg-3">';	
			echo "<b>Número Serial: </b>" . $infoEquipo[0]["numero_serial"];
			echo "<br><b>Tipo Equipo: </b>" . $infoEquipo[0]["tipo_equipo"];
			echo "</div>";
			echo '<div class="col-lg-3">';	
			echo "<b>Marca: </b>" . $infoEquipo[0]["marca"];
			echo "<br><b>Modelo: </b>" . $infoEquipo[0]["modelo"];
			echo "</div>";
			echo '<div class="col-lg-3">';	
			echo "<b>Operador/Conductor: </b>" . $infoEquipo[0]["name"];
			echo "<br><b>Número de Identificación: </b>" . $infoEquipo[0]["numero_cedula"];
			echo "<br><b>Dependencia: </b>" . $infoEquipo[0]["dependencia"];
			echo "</div>";
		}			

    }
	
	/**
	 * Save encuesta de satisfaccion
     * @since 26/5/2022
     * @author BMOTTAG
	 */
	public function save_encuesta_vehiculos()
	{
			header('Content-Type: application/json');
			$data = array();

			$token = $this->input->post('token');
			if(isset($token) && !empty($token)) {
				$arrParam2 = array(
					"table" => "parametros",
					"order" => "id_parametro",
					"id" => "x"
				);
				$parametric = $this->general_model->get_basic_search($arrParam2);
				$secret_key = $parametric[7]["parametro_valor"];
				
			    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$token."&remoteip=" . $_SERVER['REMOTE_ADDR']);
			    $return = json_decode($response);
			    
				if($return->success && $return->action == 'validar' && $return->score >= 0.5) {
					$msj = "Se guardó la Información.! Gracias por responder la Encuesta de Satisfacción";
					if ($idEncuesta = $this->external_model->saveVehicleEncuesta()) 
					{
						$data["result"] = true;
						$data["idEncuesta"] = $idEncuesta;
						$this->session->set_flashdata('retornoExito', $msj);
					} else {
						$data["result"] = "error";
						$data["mensaje"] = "Error!!! Ask for help.";
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
					}
				} else {
						$data["result"] = "error";
						$data["mensaje"] = "Error!!! No pasó el reCAPTCHA.";
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
						//echo "<pre>";print_r($response);
				}
			}
			echo json_encode($data);
    }

	
	
}