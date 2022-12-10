<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenimiento extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model("mantenimientos_model");
        $this->load->model("general_model");
        $this->load->helper('form');
    }

	/**
	 * Mantenimiento preventivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function preventivo($tipoEquipo=1)
	{
		$data['tipoEquipo'] = $tipoEquipo;
		$arrParam = array(
			"tipoEquipo" => $tipoEquipo
		);
		$data['infoPreventivo'] = $this->general_model->get_mantenimiento_preventivo($arrParam);
		$arrParam = array(
			"table" => "param_tipo_equipos",
			"order" => "tipo_equipo",
			"id" => "x"
		);
		$data['listadoTipoEquipo'] = $this->general_model->get_basic_search($arrParam);

		$data["view"] = 'preventivo';
		$this->load->view("layout_calendar", $data);
	}

	/**
     * Cargo modal - formulario mantenimiento preventivo
     * @since 20/12/2020
     */
    public function cargarModalPreventivo() 
	{
		header("Content-Type: text/plain; charset=utf-8");
		$data['infoPreventivo'] = FALSE;
		$arrParam = array(
			"table" => "param_tipo_equipos",
			"order" => "tipo_equipo",
			"id" => "x"
		);
		$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);
		$data["idPreventivo"] = $this->input->post("idPreventivo");
		if ($data["idPreventivo"] != 'x')
		{
			$arrParam = array("idMantenimiento" => $data["idPreventivo"]);
			$data['infoPreventivo'] = $this->general_model->get_mantenimiento_preventivo($arrParam);
		}
		$this->load->view("preventivo_modal", $data);
    }

	/**
	 * Guardar mantenimiento preventivo
     * @since 16/12/2020
     * @author BMOTTAG
	 */
	public function guardar_preventivo()
	{
		header('Content-Type: application/json');
		$data = array();
		$msj = "Se guardo la información!";
		if ($this->mantenimientos_model->guardarPreventivo())
		{				
			$data["result"] = true;		
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
	}

	/**
	 * Mantenimiento correctivo
     * @since 10/12/2020
     * @author BMOTTAG
	 */
	public function correctivo($idEquipo)
	{
		$arrParam = array("idEquipo" => $idEquipo);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);

		//Lista fotos de equipo
		$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

		$data['listadoCorrectivos'] = $this->general_model->get_mantenimiento_correctivo($arrParam);

		$data["activarBTN7"] = true;//para activar el boton
		$data["view"] = 'correctivo';
		$this->load->view("layout_calendar", $data);
	}

	/**
     * Cargo modal - formulario correctivo
     * @since 19/01/2021
     * @author BMOTTAG
     */
    public function cargarModalCorrectivo() 
	{
		header("Content-Type: text/plain; charset=utf-8");
		$data['infoCorrectivo'] = FALSE;
		$data["idEquipo"] = $this->input->post("idEquipo");
		$data["idCorrectivo"] = $this->input->post("idCorrectivo");
		if ($data["idCorrectivo"] != 'x')
		{
			$arrParam = array(
				"idCorrectivo" => $data["idCorrectivo"]
			);
			$data['infoCorrectivo'] = $this->general_model->get_mantenimiento_correctivo($arrParam);
			$data["idEquipo"] = $data['infoCorrectivo'][0]['fk_id_equipo_correctivo'];

		}
		$this->load->view("correctivo_modal", $data);
    }

	/**
	 * Guardar mantenimiento correctivo
     * @since 20/12/2020
     * @author BMOTTAG
	 */
	public function guardar_correctivo()
	{
		header('Content-Type: application/json');
		$data = array();
		$idCorrectivo = $this->input->post('hddId');
		$data["idRecord"] = $this->input->post('hddIdEquipo');
		$msj = "Se guardo la información!";
		if ($this->mantenimientos_model->guardarCorrectivo())
		{				
			$data["result"] = true;		
			$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
		} else {
			$data["result"] = "error";
			$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
		}
		echo json_encode($data);
	}

	/**
	 * Foto del daño
	 * @since 20/01/2021
     * @author BMOTTAG
	 */
	public function foto_danio($idEquipo, $idCorrectivo, $error = '')
	{	
		$arrParam = array("idEquipo" => $idEquipo);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);
		$arrParam = array("idCorrectivo" => $idCorrectivo);
		$data['infoCorrectivo'] = $this->general_model->get_mantenimiento_correctivo($arrParam);
		$data['fotosDanios'] = $this->mantenimientos_model->get_fotos_danios($arrParam);
		$data['error'] = $error;
		$data["view"] = 'foto_danios';
		$this->load->view("layout_calendar", $data);
	}

	/**
	 * Subir Foto del daño
	 * @since 20/01/2021
     * @author BMOTTAG
	 */
    function do_upload_danio() 
	{
		$config['upload_path'] = './images/danios/';
        $config['overwrite'] = false;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '3200';
        $config['max_height'] = '2400';
		$idCorrectivo = $this->input->post('hddId');
		$idEquipo = $this->input->post('hddIdEquipo');
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
			$this->foto_danio($idEquipo, $idCorrectivo, $error);
        } else {
            $file_info = $this->upload->data();
			$data = array('upload_data' => $this->upload->data());
			$imagen = $file_info['file_name'];
			$path = "images/danios/" . $imagen;
			if($this->mantenimientos_model->add_fotoDanio($path))
			{
				$this->session->set_flashdata('retornoExito', 'Se cargó la foto del daño.');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			redirect('mantenimiento/foto_danio/' . $idEquipo . "/" . $idCorrectivo);
        }
    }
	
	/**
	 * Eliminar foto del daño
     * @since 20/01/2021
     * @author BMOTTAG
	 */
	public function eliminar_foto_danio()
	{			
		header('Content-Type: application/json');
		$data = array();
		$idEquipo = $this->input->post('hddIdEquipo');
		$idFotoDanio = $this->input->post('identificador');
		$arrParam = array("idFotoDanio" => $idFotoDanio);
		$fotosDanios = $this->mantenimientos_model->get_fotos_danios($arrParam);
		$data["idRecord"] = $fotosDanios[0]['fk_id_correctivo'];
		$data["idEquipo"] = $fotosDanios[0]['fk_id_equipo_correctivo'];
		unlink($fotosDanios[0]['ruta_foto']);
		$arrParam = array(
			"table" => "mantenimiento_correctivo_fotos",
			"primaryKey" => "id_foto_danio",
			"id" => $idFotoDanio
		);
		if ($this->general_model->deleteRecord($arrParam))
		{				
			$data["result"] = true;
			$this->session->set_flashdata('retornoExito', 'Se eliminó la foto del daño.');
		} else {
			$data["result"] = "error";
			$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
			$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
		}				
		echo json_encode($data);
    }

    /**
	 * Mantenimiento preventivo por equipo
     * @since 25/01/2021
     * @author BMOTTAG
	 */
	public function preventivo_equipo($idEquipo)
	{
		$arrParam = array("idEquipo" => $idEquipo);
		$data['info'] = $this->general_model->get_equipos_info($arrParam);

		//Lista fotos de equipo
		$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
		
		$data['infoPreventivoEquipo'] = $this->general_model->get_mantenimiento_preventivo_equipo($arrParam);

		$arrParam = array('tipoEquipo' => $data['info'][0]['fk_id_tipo_equipo']);
		$data['infoPreventivo'] = $this->general_model->get_mantenimiento_preventivo($arrParam);

		$arrParam2 = array(
			'tipoMantenimiento' => 2,
			'idEquipo' => $idEquipo
		);
		$data['infoOrdenesTrabajo'] = $this->general_model->get_orden_trabajo($arrParam2);

		$data["activarBTN8"] = true;//para activar el boton
		$data["view"] = 'preventivo_equipo';
		$this->load->view("layout_calendar", $data);
	}

	/**
	 * Fomulario para adicionar mantenimientos preventivos a un Equipo
     * @since 27/11/2017
     * @author BMOTTAG
	 */
	public function add_mantenimiento_preventivo($idEquipo, $tipoEquipo)
	{
			if (empty($idEquipo) || empty($tipoEquipo)) {
				show_error('ERROR!!! - You are in the wrong place.');
			}
			
			$arrParam = array('tipoEquipo' => $tipoEquipo);
			$data['infoPreventivo'] = $this->general_model->get_mantenimiento_preventivo($arrParam);
			
			$data["idEquipo"] = $idEquipo;
			$data["view"] = 'form_add_preventivo';
			$this->load->view("layout", $data);
	}

	/**
	 * Guardar mantenimientos preventivos para el equipo
     * @since 24/8/2021
     * @author BMOTTAG
	 */
	public function guardar_mantenimiento_preventivo_equipo()
	{			
			header('Content-Type: application/json');
			$data = array();
			$idEquipo = $this->input->post('hddId');

			if ($this->mantenimientos_model->guardarMantenimientoPreventivoEquipo($idEquipo)) {
				$data["result"] = true;
				$data["idEquipo"] = $idEquipo;
				$this->session->set_flashdata('retornoExito', 'Solicitud guardada correctamente.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error al guardar. Intente nuevamente o actualice la p\u00e1gina.";
				$data["idEquipo"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			echo json_encode($data);
    }

    /**
     * Guardar un manenimiento preventivo al equipo
     * @since 26/8/2021
     * @author BMOTTAG
     */
    public function guardar_un_mantenimiento_preventivo() 
	{
			$idEquipo = $this->input->post('hddIdEquipo');

			if ($this->mantenimientos_model->guardarUnMantenimientoPreventivo()) {
				$this->session->set_flashdata('retornoExito', 'Solicitud guardada correctamente.');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			redirect(base_url('mantenimiento/preventivo_equipo/' . $idEquipo), 'refresh');
    }

	/**
	 * Actualizar proximo mantenimiento preventivo del equipo
     * @since 26/8/2021
     * @author BMOTTAG
	 */
	public function actualizar_proximo_mantenimiento_preventivo()
	{			
		$solicutud = $this->input->post('btnSubmitProximoMantenimiento');

		//mostrar el historial 
		if($solicutud == 2){
			$arrParam = array('idMantenimientoPreventivoEquipo' => $this->input->post('hddIdMantenimiento'));
			$data['infoPreventivoHistorial'] = $this->mantenimientos_model->get_historial_mantenimiento_preventivo_equipos($arrParam);

			$data['view'] = 'preventivo_historial';
			$this->load->view("layout_calendar", $data);
		//guardar el proximo mantenimiento
		}else{
			$idEquipo = $this->input->post('hddIdEquipo');

			$arrParam = array(
				"table" => "mantenimiento_preventivo_equipo",
				"primaryKey" => "id_preventivo_equipo",
				"id" => $this->input->post('hddIdMantenimiento'),
				"column" => "proximo_mantemiento_kilometros_horas",
				"value" => $this->input->post('proximo_mantenimiento')
			);
	
			if($this->general_model->updateRecord($arrParam))
			{
				//guardo regitro en la tabla auditoria de mantenimiento preventivo
				$this->general_model->saveAuditoriaProximoMantenimientoPreventivo($idOT = NULL);
				$this->session->set_flashdata('retornoExito', 'Solicitud guardada correctamente.');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}

			redirect(base_url('mantenimiento/preventivo_equipo/' . $idEquipo), 'refresh');
		}
    }
}