<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipos extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("equipos_model");
        $this->load->model("general_model");
    }
	
	/**
	 * Listado de equipos
     * @since 19/11/2020
     * @author BMOTTAG
	 */
	public function index($estado=1)
	{
			$data['estadoEquipo'] = $estado;
			$data['tituloListado'] = FALSE;

			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);

			if(!$_POST)
			{
				$data['tituloListado'] = 'LISTA DE ÚLTIMOS 10 EQUIPOS REGISTRADOS';
				//busco los ultimos 10 equipos de la base de datos
				$arrParam = array(
							"estadoEquipo" => $estado,
							'limit' => 10
							);
				$data['info'] = $this->general_model->get_equipos_info($arrParam);
			}elseif($this->input->post('id_tipo_equipo') || $this->input->post('numero_inventario') || $this->input->post('marca') ||  $this->input->post('numero_serial'))
			{
				$data['tituloListado'] = 'LISTA DE EQUIPOS QUE COINCIDEN CON SU BUSQUEDA';
				
				$data['idTipoEquipo'] =  $this->input->post('id_tipo_equipo');
				$data['numero_inventario'] =  $this->input->post('numero_inventario');
				$data['marca'] =  $this->input->post('marca');
				$data['numero_serial'] =  $this->input->post('numero_serial');
						
				$arrParam = array(
					"idTipoEquipo" => $this->input->post('id_tipo_equipo'),
					"numero_inventario" => $this->input->post('numero_inventario'),
					"marca" => $this->input->post('marca'),
					"numero_serial" => $this->input->post('numero_serial'),
					"estadoEquipo" => $estado
				);

//////////////guardo la informacion en la base de datos para el boton de regresar
//////////////$this->workorders_model->saveInfoGoBack($arrParam);
	
				//informacion Work Order
				$data['info'] = $this->general_model->get_equipos_info($arrParam);
				
			}
			
			$data["view"] = 'equipos';
			$this->load->view("layout_calendar", $data);
	}
	
    /**
     * Cargo modal - formulario equipos
     * @since 19/11/2020
     */
    public function cargarModalEquipo() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$idEquipo = $this->input->post("idEquipo");
			
			$arrParam = array(
				"table" => "param_dependencias",
				"order" => "dependencia",
				"id" => "x"
			);
			$data['dependencias'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);

			$arrParam = array("filtroEstado" => TRUE);
			$data['contratosMantenimiento'] = $this->general_model->get_contratos($arrParam);

			//Lista de usuarios activos
			$arrParam = array("filtroState" => TRUE);
			$data['listaUsuarios'] = $this->general_model->get_user($arrParam);//workers list
							
			$this->load->view("equipos_modal", $data);
    }

	/**
	 * Guardar equipos
	 * @since 19/11/2020
	 * @review 10/12/2020
     * @author BMOTTAG
	 */
	public function guardar_equipos()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEquipo = $this->input->post('hddId');

			$pass = $this->generaPass();//clave para colocarle al codigo QR
		
			$msj = "Se adicionó equipo!";
			$flag = true;
			if ($idEquipo != '') {
				$msj = "Se actualizó equipo!";
				$flag = false;
			}
			
			$numeroInventario = $this->input->post('numero_inventario');
			
			$result_numero_inventario = false;
			
			//verificar si ya el numero de inventario
			$arrParam = array(
				"idEquipo" => $idEquipo,
				"column" => "numero_inventario",
				"value" => $numeroInventario
			);
			$result_numero_inventario = $this->equipos_model->verificarEquipo($arrParam);

			if ($result_numero_inventario)
			{
				$data["result"] = "error";
				$data["mensaje"] = " Error. El Número de Inventario ya existe.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El Número de Inventario ya existe.');
			} else {
				if ($idEquipo = $this->equipos_model->guardarEquipo($pass)) 
				{
					if($flag)
					{
						//si es un registro nuevo genero el codigo QR y subo la imagen
						//INCIO - genero imagen con la libreria y la subo 
						$this->load->library('ciqrcode');

						$valorQRcode = base_url("login/index/" . $idEquipo . $pass);
						$rutaImagen = "images/equipos/QR/" . $idEquipo . "_qr_code.png";
						
						$params['data'] = $valorQRcode;
						$params['level'] = 'H';
						$params['size'] = 10;
						$params['savename'] = FCPATH.$rutaImagen;
										
						$this->ciqrcode->generate($params);
						//FIN - genero imagen con la libreria y la subo
					}

					//guardo regitro en la tabla auditoria
					$this->equipos_model->saveAuditoriaEquipo($idEquipo);
					
					$data["idRecord"] = $idEquipo;
					$data["result"] = true;		
					$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
				} else {
					$data["result"] = "error";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
				}
			}
			echo json_encode($data);
    }	

	public function generaPass()
	{
			//Se define una cadena de caractares. Te recomiendo que uses esta.
			$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			//Obtenemos la longitud de la cadena de caracteres
			$longitudCadena=strlen($cadena);
			 
			//Se define la variable que va a contener la contraseña
			$pass = "";
			//Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
			$longitudPass=50;
			 
			//Creamos la contraseña
			for($i=1 ; $i<=$longitudPass ; $i++){
				//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
				$pos=rand(0,$longitudCadena-1);
			 
				//Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
				$pass .= substr($cadena,$pos,1);
			}
			return $pass;
	}	
	
	/**
	 * Listado de equipos INACTVOS
     * @since 23/11/2020
     * @author BMOTTAG
	 */
	public function inactivos($estado=2)
	{
			$data['estadoEquipo'] = $estado;

			$arrParam = array("estadoEquipo" => $estado);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			
			$data["view"] = 'equipos_inactivos';
			$this->load->view("layout_calendar", $data);
	}
	
	/**
	 * Detalle de un equipo
     * @since 23/11/2020
     * @author BMOTTAG
	 */
	public function detalle($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			//DESHABILITAR
			$data['deshabilitar'] = '';
			$userRol = $this->session->role;
			//si el rol es: Usuario Consulta; Encargado; Operador - Conductor
			if($userRol == 2 || $userRol == 3 || $userRol == 5)
			{
				$data['deshabilitar'] = 'disabled';
			}

			$arrParam = array(
				"table" => "param_dependencias",
				"order" => "dependencia",
				"id" => "x"
			);
			$data['dependencias'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);

			$arrParam = array("filtroEstado" => TRUE);
			$data['contratosMantenimiento'] = $this->general_model->get_contratos($arrParam);

			//Lista de usuarios activos
			$arrParam = array("filtroState" => TRUE);
			$data['listaUsuarios'] = $this->general_model->get_user($arrParam);//workers list
			
			$data["activarBTN1"] = true;//para activar el boton
			$data["view"] = 'equipos_detalle';
			$this->load->view("layout_calendar", $data);
	}
	
	/**
	 * Detalle de un equipo
     * @since 3/12/2020
     * @author BMOTTAG
	 */
	public function especifico($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			//DESHABILITAR
			$data['deshabilitar'] = '';
			$userRol = $this->session->role;
			//si el rol es: Usuario Consulta; Encargado; Operador - Conductor
			if($userRol == 2 || $userRol == 3 || $userRol == 5)
			{
				$data['deshabilitar'] = 'disabled';
			}
			
			$consulta = $data['info'][0]['formulario_especifico'];

			$data['infoEspecifica'] = $this->general_model->$consulta($arrParam);

			$arrParam = array(
				"table" => "param_clase_vehiculo",
				"order" => "clase_vehiculo",
				"id" => "x"
			);
			$data['claseVehiculo'] = $this->general_model->get_basic_search($arrParam);
			
			$arrParam = array(
				"table" => "param_tipo_carroceria",
				"order" => "tipo_carroceria",
				"id" => "x"
			);
			$data['tipoCarroceria'] = $this->general_model->get_basic_search($arrParam);

			$data["activarBTN2"] = true;//para activar el boton
			$data["view"] = $consulta;
			$this->load->view("layout_calendar", $data);
	}
	
	/**
	 * Guardar Informacion Especifica
	 * @since 3/12/2020
     * @author BMOTTAG
	 */
	public function guardar_info_especifica()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idInfoEspecificaEquipo = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
			$metodoGuardar = $this->input->post('hddMetodoGuardar');
		
			$msj = "Se guardo la información!";

			if ($idInfoEspecificaEquipo = $this->equipos_model->$metodoGuardar()) 
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
	 * Foto del equipo
	 * @since 12/12/2020
     * @author BMOTTAG
	 */
	public function foto($idEquipo, $error = '')
	{			
			//busco datos del equipo
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			//DESHABILITAR
			$data['deshabilitar'] = '';
			$userRol = $this->session->role;
			//si el rol es: Usuario Consulta; Encargado; Operador - Conductor
			if($userRol == 2 || $userRol == 3 || $userRol == 5)
			{
				$data['deshabilitar'] = 'disabled';
			}
			
			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
						
			$data['error'] = $error; //se usa para mostrar los errores al cargar la imagen 
			$data["activarBTN3"] = true;//para activar el boton
			$data["view"] = 'equipos_foto';
			$this->load->view("layout_calendar", $data);
	}
		
	/**
	 * Subir Foto del equipo
	 * @since 12/12/2020
     * @author BMOTTAG
	 */
    function do_upload_equipo() 
	{
		$config['upload_path'] = './images/equipos/';
        $config['overwrite'] = false;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '3200';
        $config['max_height'] = '2400';
		$idEquipo = $this->input->post('hddId');

        $this->load->library('upload', $config);
        //SI LA IMAGEN FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA 
        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
			$this->foto($idEquipo, $error);
        } else {
            $file_info = $this->upload->data();//subimos la imagen
			
			$data = array('upload_data' => $this->upload->data());
			$imagen = $file_info['file_name'];
			$path = "images/equipos/" . $imagen;
			
			//insertar datos
			if($this->equipos_model->add_fotos($path))
			{
				$this->session->set_flashdata('retornoExito', 'Se cargó la foto del Equipo.');
			}else{
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
						
			redirect('equipos/foto/' . $idEquipo);
        }
    }
	
	/**
	 * Eliminar foto
     * @since 16/12/2020
	 */
	public function eliminar_foto()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idEquipoFoto = $this->input->post('identificador');
			
			//busco el ID del equipo
			$arrParam = array("idEquipoFoto" => $idEquipoFoto);
			$fotosEquipos = $this->general_model->get_fotos_equipos($arrParam);
			
			$data["idRecord"] = $fotosEquipos[0]['fk_id_equipo_foto']; //$idEquipo
			
			unlink($fotosEquipos[0]['equipo_foto']);//elimino archivo 
			
			//elimino registro de la base de datos
			$arrParam = array(
				"table" => "equipos_fotos",
				"primaryKey" => "id_equipo_foto",
				"id" => $idEquipoFoto
			);
			
			if ($this->general_model->deleteRecord($arrParam))
			{				
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', 'Se eliminó la foto del equipo.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Contactarse con el Administrador.";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}				

			echo json_encode($data);
    }
	
	/**
	 * Localizacion del equipo
     * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function localizacion($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			$data['listadoLocalizacion'] = $this->equipos_model->get_localizacion($arrParam);
			
			$data["activarBTN4"] = true;//para activar el boton
			$data["view"] = 'equipos_localizacion';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal - formulario equipos
     * @since 19/1/2021
     */
    public function cargarModalLocalizacion() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idEquipo"] = $this->input->post("idEquipo");
			$data["idLocalizacion"] = $this->input->post("idLocalizacion");
			
			if ($data["idLocalizacion"] != 'x') 
			{
				$arrParam = array(
					"idEquipoLocalizacion" => $data["idLocalizacion"]
				);
				$data['information'] = $this->equipos_model->get_localizacion($arrParam);
				
				$data["idEquipo"] = $data['information'][0]['fk_id_equipo_localizacion'];
			}
			
			$this->load->view("localizacion_modal", $data);
    }
	
	/**
	 * Guardar Localizacion
	 * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function guardar_localizacion()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idLocalizacion = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
		
			$msj = "Se guardo la información!";

			if ($idLocalizacion = $this->equipos_model->guardarLocalizacion()) 
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
	 * Control de combustible del equipo
     * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function combustible($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			$data['listadoControlCombustible'] = $this->equipos_model->get_control_combustible($arrParam);
						
			$data["activarBTN5"] = true;//para activar el boton
			$data["view"] = 'equipos_combustible';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal- formulario de consumo combustible
     * @since 15/1/2021
     */
    public function cargarModalCombustible() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idEquipo"] = $this->input->post("idEquipo");
			$data["idControlCombustible"] = $this->input->post("idControlCombustible");

			//Lista de operadores activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 4
						);
			$data['listaOperadores'] = $this->general_model->get_user($arrParam);//workers list
			
			if ($data["idControlCombustible"] != 'x') {
				$arrParam = array("idControlCombustible" => $data["idControlCombustible"]);
				$data['information'] = $this->equipos_model->get_control_combustible($arrParam);//info bloques
				
				$data["idEquipo"] = $data['information'][0]['fk_id_equipo_combustible'];
			}
			
			$this->load->view("combustible_modal", $data);
    }
	
	/**
	 * Guardar Control del combustible
	 * @since 17/12/2020
     * @author BMOTTAG
	 */
	public function guardar_combustible()
	{		
			header('Content-Type: application/json');
			$data = array();

			$idControlCombustible = $this->input->post('hddidControlCombustibler');
			$data["idRecord"] = $this->input->post('hddidEquipo');
		
			$msj = "Se guardo la información!";

			if ($idControlCombustible = $this->equipos_model->guardarControlCombustible()) 
			{
				//actualizar campo de kilometraje actual en la tabla de equipos
				$arrParam = array(
					"table" => "equipos",
					"primaryKey" => "id_equipo",
					"id" => $data["idRecord"],
					"column" => "horas_kilometros_actuales",
					"value" => $this->input->post('kilometros_actuales')
				);
				$this->general_model->updateRecord($arrParam);

				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
		
			echo json_encode($data);
    }

	/**
	 * Control de documentos del equipo
     * @since 6/1/2021
     * @author BMOTTAG
	 */
	public function documento($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			//DESHABILITAR
			$data['deshabilitar'] = '';
			$userRol = $this->session->role;
			//si el rol es: Usuario Consulta; Encargado; Operador - Conductor
			if($userRol == 2 || $userRol == 3 || $userRol == 5)
			{
				$data['deshabilitar'] = 'disabled';
			}
			
			$data['listadoDocumentos'] = $this->equipos_model->get_documento($arrParam);
						
			$data["activarBTN6"] = true;//para activar el boton
			$data["view"] = 'equipos_documento';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal - formulario documento
     * @since 20/1/2021
     */
    public function cargarModalDocumento() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idEquipo"] = $this->input->post("idEquipo");
			$data["idDocumento"] = $this->input->post("idDocumento");
			$data['tiposDocumento'] = $this->general_model->get_tipo_documento();

			if ($data["idDocumento"] != 'x') 
			{
				$arrParam = array(
					"idDocumento" => $data["idDocumento"]
				);
				$data['information'] = $this->equipos_model->get_documento($arrParam);
				
				$data["idEquipo"] = $data['information'][0]['fk_id_equipo_d'];
			}
			
			$this->load->view("documento_modal", $data);
    }
	
	/**
	 * Guardar documento
	 * @since 6/1/2021
     * @author BMOTTAG
	 */
	public function guardar_documento()
	{			
			header('Content-Type: application/json');
			$data = array();

			$idDocumento = $this->input->post('hddId');
			$data["idRecord"] = $this->input->post('hddIdEquipo');
		
			$msj = "Se guardo la información!";

			$archivo = 'xxx';
			if ($idDocumento = $this->equipos_model->guardarDocumento($archivo)) 
			{				
				//guardo regitro en la tabla auditoria
				$this->equipos_model->saveAuditoriaDocumentos($idDocumento, $archivo);
				$data["result"] = true;		
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
			echo json_encode($data);
    }

	/**
	 * Listado de diagnosticos
     * @since 20/3/2021
     * @author BMOTTAG
	 */
	public function revision($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
			$data['listadoRevision'] = FALSE;

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			if($_POST){
				$from =  $this->input->post('fecha_inicio');
				$to =  $this->input->post('fecha_fin');
				$data['from'] = formatear_fecha($from);
				$data['to'] = formatear_fecha($to);
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$data['to'] = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( $data['to'] ) ) );

				$arrParam["from"] = $data['from'];
				$arrParam["to"] = $data['to'];
			}else{
				$arrParam["limit"] = 30;
			}
			$data['listadoRevision'] = $this->equipos_model->get_diagnostico($arrParam);
			
			$data["activarBTN10"] = true;//para activar el boton
			$data["view"] = 'equipos_revision';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Lista de contratos
     * @since 8/7/2021
     * @author BMOTTAG
	 */
	public function contratos($estado=1)
	{
			$data['estado'] = $estado;
			
			if($estado == 1){
				$arrParam = array("filtroEstado" => TRUE);
			}else{
				$arrParam = array("estado" => $estado);
			}
			$data['info'] = $this->general_model->get_contratos($arrParam);

			$data["view"] = 'contratos_mantenimiento';
			$this->load->view("layout_calendar", $data);
	}
	
    /**
     * Cargo modal - formulario contratos mantenimientos
     * @since 8/7/2021
     */
    public function cargarModalContratos() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idContrato"] = $this->input->post("idContrato");

			$arrParam = array(
				"table" => "param_proveedores",
				"order" => "nombre_proveedor",
				"id" => "x"
			);
			$data['proveedores'] = $this->general_model->get_basic_search($arrParam);
			//Lista de usuarios activos
			$arrParam = array("filtroState" => TRUE);
			$data['listaUsuarios'] = $this->general_model->get_user($arrParam);//workers list
			
			if ($data["idContrato"] != 'x') {
				$arrParam = array("idContrato" => $data["idContrato"]);
				$data['information'] = $this->general_model->get_contratos($arrParam);
			}
			
			$this->load->view("contratos_mantenimiento_modal", $data);
    }
	
	/**
	 * Guardar contratos mantenimiento
     * @since 8/7/2021
     * @author BMOTTAG
	 */
	public function save_contratos()
	{			
			header('Content-Type: application/json');
			$data = array();
	
			$idContrato = $this->input->post('hddId');
			
			$msj = "Se adicionó el Contrato de Mantenimiento!";
			if ($idContrato != '') {
				$msj = "Se actualizó el Contrato de Mantenimiento!";
			}

			if ($idContrato = $this->equipos_model->saveContrato()) 
			{
				//guardo regitro en la tabla auditoria
				$this->equipos_model->saveAuditoriaContrato($idContrato);
				$data["result"] = true;				
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";				
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}

			echo json_encode($data);	
    }

	/**
	 * Lista de recorridos
     * @since 9/7/2021
     * @author BMOTTAG
	 */
	public function recorridos()
	{
			//se filtra por company_type para que solo se pueda editar los subcontratistas
			$arrParam = array();
			if($_POST){
				$arrParam['idEquipo'] = $this->input->post('idEquipoSearch');
				$arrParam['idMes'] = $this->input->post('idMes');
			}
			$data['info'] = $this->general_model->get_recorridos($arrParam);

			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);

			$arrParam = array(
				"table" => "param_meses",
				"order" => "id_mes",
				"id" => "x"
			);
			$data['listaMeses'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'recorridos';
			$this->load->view("layout_calendar", $data);
	}
	
    /**
     * Cargo modal - formulario company
     * @since 15/12/2016
     */
    public function cargarModalRecorrido() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data['infoEquipos'] = FALSE;
			$data["idRecorrido"] = $this->input->post("idRecorrido");	

			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);

			//Lista de operadores activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 4
						);
			$data['listaOperadores'] = $this->general_model->get_user($arrParam);

			$arrParam = array(
				"table" => "param_meses",
				"order" => "id_mes",
				"id" => "x"
			);
			$data['listaMeses'] = $this->general_model->get_basic_search($arrParam);
			
			if ($data["idRecorrido"] != 'x') {
				$arrParam = array("idRecorrido" => $data["idRecorrido"]);
				$data['information'] = $this->general_model->get_recorridos($arrParam);
				
				$arrParam['idTipoEquipo'] = $data['information'][0]['fk_id_tipo_equipo'];
				$data['infoEquipos'] = $this->general_model->get_equipos_info($arrParam);
			}
			
			$this->load->view("recorrido_modal", $data);
    }
	
	/**
	 * Adicionar recorrido
     * @since 9/7/2021
     * @author BMOTTAG
	 */
	public function save_recorrido()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idRecorrido = $this->input->post('hddidRecorrido');
			
			$msj = "Se adicionó el Recorrido del Equipo!";
			if ($idRecorrido != '') {
				$msj = "Se actualizó el Recorrido del Equipo!";
			}

			if ($idRecorrido = $this->equipos_model->saveRecorrido()) {
				$data["result"] = true;				
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
			} else {
				$data["result"] = "error";				
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}

			echo json_encode($data);	
    }

	/**
	 * Lista de consumos 
	 * @param int $idRecorrido
	 * @since 27/7/2021
	 */
	public function consumos($idRecorrido)
	{
			if (empty($idRecorrido)) {
				show_error('ERROR!!! - You are in the wrong place.');
			}
						
			//busco datos del recorrido
			$arrParam = array("idRecorrido" => $idRecorrido);
			$data['infoRecorridos'] = $this->general_model->get_recorridos($arrParam);

			$data['listadoControlConsumos'] = $this->general_model->get_consumos($arrParam);

			$arrParam = array("idEquipo" => $data['infoRecorridos'][0]['fk_id_equipo_r']);
			$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			$data["view"] = 'recorridos_consumos';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal- formulario de consumo
     * @since 15/1/2021
     */
    public function cargarModalConsumo() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idConsumo"] = $this->input->post("idConsumo");
			$data["idRecorrido"] = $this->input->post("idRecorrido");
			
			if ($data["idConsumo"] != 'x') {
				$arrParam = array("idConsumo" => $data["idConsumo"]);
				$data['information'] = $this->general_model->get_consumos($arrParam);

				$data["idRecorrido"] = $data['information'][0]['fk_id_equipo_recorrido'];
			}
			
			$this->load->view("recorridos_consumos_modal", $data);
    }
	
	/**
	 * Guardar Consumo Recorrido
	 * @since 27/7/2021
     * @author BMOTTAG
	 */
	public function guardar_consumo()
	{		
			header('Content-Type: application/json');
			$data = array();

			$idConsumo = $this->input->post('hddidConsumo');
			$data["idRecord"] = $this->input->post('hddidRecorrido');

		
			$msj = "Se guardo la información!";

			if ($idConsumo = $this->equipos_model->guardarConsumoRecorrido()) 
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
	 * Lista de equipos por tipo de equipo
     * @since 9/7/2021
     * @author BMOTTAG
	 */
    public function listaEquiposInfo() {
        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
        $idTipoEquipo = $this->input->post('idTipoEquipo');
				
		//busco listado de links activos para un menu
		$arrParam = array(
			"idTipoEquipo" => $idTipoEquipo,
			"estadoEquipo" => 1
		);
		$listaEquipos = $this->general_model->get_equipos_info($arrParam);

        echo "<option value=''>Seleccione...</option>";
        if ($listaEquipos) {
            foreach ($listaEquipos as $fila) {
                echo "<option value='" . $fila["id_equipo"] . "' >No. Inventario: " . $fila["numero_inventario"] . "</option>";
            }
        }
    }

	/**
	 * Form Upload Documents 
     * @since 6/8/2021
     * @author BMOTTAG
	 */
	public function documents_form($idEquipo, $idDocumento='x', $error = '')
	{			
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			$data['tiposDocumento'] = $this->general_model->get_tipo_documento();

			$data['information'] = FALSE;

			if ($idDocumento != 'x' && $idDocumento != '') {
				$arrParam = array('idDocumento' => $idDocumento);
				$data['information'] = $this->equipos_model->get_documento($arrParam);
			}
			
			$data['error'] = $error; //se usa para mostrar los errores al cargar la imagen 			

			$data["view"] = "form_documentos";
			$this->load->view("layout", $data);
	}

	/**
	 * FUNCIÓN PARA SUBIR el archivo
	 */
    function do_upload_doc() 
	{
        $idEquipo = $this->input->post("hddIdEquipo");
        $nuevoDocumento = $idDocumento = $this->input->post("hddidDocumento");
 
		$config['upload_path'] = './files/equipos/';
        $config['overwrite'] = FALSE;
        $config['allowed_types'] = 'pdf|xls|xlsx|xltx|doc|docx';
        $config['max_size'] = '3000';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';
        $config['file_name'] = $idEquipo . "_" . $idDocumento;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload() && $_FILES['userfile']['name']!= "") {
        	//SI EL ARCHIVO FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA 
            $error = $this->upload->display_errors();
            $this->documents_form($idEquipo,$idDocumento,$error);
        }else{
			if($_FILES['userfile']['name']== ""){
				$archivo = 'xxx';
			}else{
	            $file_info = $this->upload->data();//subimos ARCHIVO
				
				$data = array('upload_data' => $this->upload->data());
				$archivo = $file_info['file_name'];			
			}
			//insertar datos
			if($idDocumento = $this->equipos_model->guardarDocumento($archivo))
			{
				//guardo regitro en la tabla auditoria
				$this->equipos_model->saveAuditoriaDocumentos($idDocumento, $archivo);
				$this->session->set_flashdata('retornoExito', 'Se guardó la información.');
			}else{
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			redirect('equipos/documento/' . $idEquipo);
        }
    }

	/**
	 * Historial de documentos
     * @since 6/8/2021
     * @author BMOTTAG
	 */
	public function historial_documentos($idDocumento)
	{
			$arrParam = array('idDocumento' => $idDocumento);
			$data['infoDocumento'] = $this->equipos_model->get_documento($arrParam);
			$data['infoDocumentoHistorial'] = $this->equipos_model->get_documentos_historial($arrParam);

			$data['view'] = 'documentos_historial';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Historial de Contratos
     * @since 13/8/2021
     * @author BMOTTAG
	 */
	public function historial_contratos()
	{
			$arrParam = array('idContrato' => $this->input->post('hddidContrato'));
			$data['information'] = $this->general_model->get_contratos($arrParam);
			$data['infoContratosHistorial'] = $this->equipos_model->get_contratos_historial($arrParam);

			$data['view'] = 'contratos_mantenimiento_historial';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Listado de diagnosticos
     * @since 20/3/2021
     * @author BMOTTAG
	 */
	public function encuesta($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);

			$arrParam = array(
				"table" => "encuesta_vehiculos",
				"order" => "id_encuesta_vehiculos",
				"column" => "fk_id_equipo_vehiculo",
				"id" => $idEquipo
			);
			$data['infoEncuestas'] = $this->general_model->get_basic_search($arrParam);

			//DESHABILITAR
			$data['deshabilitar'] = '';
			$userRol = $this->session->role;
			//si el rol es: Usuario Consulta; Encargado; Operador - Conductor
			if($userRol == 2 || $userRol == 3 || $userRol == 5)
			{
				$data['deshabilitar'] = 'disabled';
			}
			
			$data['listadoRevision'] = $this->equipos_model->get_diagnostico($arrParam);
						
			$data["activarBTN11"] = true;//para activar el boton
			$data["view"] = 'equipos_encuesta';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Comparendos Conductores
	 * @since 29/05/2022
     * @author BMOTTAG
	 */
	public function comparendos($idEquipo)
	{
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_equipos_info($arrParam);

			//Lista fotos de equipo
			$data['fotosEquipos'] = $this->general_model->get_fotos_equipos($arrParam);
			
			$data['listadoComparendos'] = $this->equipos_model->get_comparendos($arrParam);
						
			$data["activarBTN12"] = true;//para activar el boton
			$data["view"] = 'equipos_comparendos';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal- formulario de Comparendos Conductores
	 * @since 29/05/2022
     */
    public function cargarModalComparendos() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$arrParam = array("idEquipo" => $this->input->post("idEquipo"));
			$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);

			$data["idComparendo"] = $this->input->post("idComparendo");

			//Lista de operadores activos
			$arrParam = array(
						"filtroState" => TRUE,
						'idRole' => 4
						);
			$data['listaOperadores'] = $this->general_model->get_user($arrParam);//workers list
			
			if ($data["idComparendo"] != 'x') {
				$arrParam = array("idComparendo" => $data["idComparendo"]);
				$data['information'] = $this->equipos_model->get_comparendos($arrParam);//info bloques
				
				$arrParam = array("idEquipo" => $data['information'][0]['fk_id_equipo']);
				$data['infoEquipo'] = $this->general_model->get_equipos_info($arrParam);
			}
			
			$this->load->view("comparendos_modal", $data);
    }
	
	/**
	 * Guardar Comparendos Conductores
	 * @since 29/05/2022
     * @author BMOTTAG
	 */
	public function guardar_comparendos()
	{		
			header('Content-Type: application/json');
			$data = array();

			$idComparendo = $this->input->post('hddidComparendo');
			$data["idRecord"] = $this->input->post('hddidEquipo');
		
			$msj = "Se guardo la información!";

			if ($idComparendo = $this->equipos_model->guardarComparendos()) 
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
	 * Delete chequeo preoperacional
     * @since 13/6/2022
	 */
	public function delete_chequeo()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idInspeccion = $this->input->post('identificador');

			$arrParam = array(
				"idInspeccion" => $idInspeccion
			);
			$information = $this->general_model->get_inspecciones($arrParam);
			$data["idEquipo"] = $information[0]['fk_id_equipo_vehiculo'];

			$arrParam = array(
				"table" => "inspection_vehiculos",
				"primaryKey" => "id_inspection_vehiculos",
				"id" => $idInspeccion
			);
			
			if ($this->general_model->deleteRecord($arrParam)) 
			{
				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> Se eliminó el Chequeo Preoperacional.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Ask for help.";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
			echo json_encode($data);
    }

	/**
	 * Delete chequeo preoperacional
     * @since 13/6/2022
	 */
	public function delete_documento()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idDocumento = $this->input->post('identificador');

			$arrParam = array('idDocumento' => $idDocumento);
			$data['information'] = $this->equipos_model->get_documento($arrParam);
			$data["idEquipo"] = $data['information'][0]['fk_id_equipo_d'];

			$arrParam = array(
				"table" => "auditoria_documentos",
				"primaryKey" => "fk_id_documento",
				"id" => $idDocumento
			);
			if ($this->general_model->deleteRecord($arrParam)) 
			{
				$arrParam = array(
					"table" => "equipos_documento",
					"primaryKey" => "id_equipo_documento",
					"id" => $idDocumento
				);
				$this->general_model->deleteRecord($arrParam);

				$data["result"] = true;
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> Se eliminó el Chequeo Preoperacional.');
			} else {
				$data["result"] = "error";
				$data["mensaje"] = "Error!!! Ask for help.";
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
			echo json_encode($data);
    }

	/**
	 * Listado de equipos INACTVOS
     * @since 23/11/2020
     * @author BMOTTAG
	 */
	public function historial_equipos($idEquipo)
	{
			$data["idEquipo"] = $idEquipo;
			$arrParam = array("idEquipo" => $idEquipo);
			$data['info'] = $this->general_model->get_historial_equipo($arrParam);

			$data["view"] = 'equipos_historial';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Informacion encuestas
     * @since 9/7/2021
     * @author BMOTTAG
	 */
	public function consolidado_encuestas()
	{
			$arrParam = array(
				"table" => "param_meses",
				"order" => "id_mes",
				"id" => "x"
			);
			$data['listaMeses'] = $this->general_model->get_basic_search($arrParam);

			if($_POST){
				$data["idMes"] =  $this->input->post('idMes');
				$from = $this->data_first_month_day($data["idMes"]);
				$to = $this->data_last_month_day($data["idMes"]);


				//$from =  $this->input->post('fecha_inicio');
				//$to =  $this->input->post('fecha_fin');
				//$data['from'] = formatear_fecha($from);
				//$data['to'] = formatear_fecha($to);
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( $to ) ) );

				$arrParam["from"] = $from;
				$arrParam["to"] = $to;

				$data['numeroEncuestas'] = $this->equipos_model->countEncuestas($arrParam);

				$arrParam["preguntaSatisfaccion"] = 'amabilidad';
				$data['numeroAmabilidad'] = $this->equipos_model->countEncuestas($arrParam);
				$arrParam["preguntaSatisfaccion"] = 'presentacion';
				$data['numeroPresentacion'] = $this->equipos_model->countEncuestas($arrParam);
				$arrParam["preguntaSatisfaccion"] = 'limpieza';
				$data['numeroLimpieza'] = $this->equipos_model->countEncuestas($arrParam);
				$arrParam["preguntaSatisfaccion"] = 'calidad';
				$data['numeroCalidad'] = $this->equipos_model->countEncuestas($arrParam);

				$arrParam = array();
				$arrParam["preguntaSeguridad"] = 'normas';
				$data['numeroNormas'] = $this->equipos_model->countEncuestas($arrParam);
				$arrParam["preguntaSeguridad"] = 'velocidad';
				$data['numeroVelocidad'] = $this->equipos_model->countEncuestas($arrParam);
				$arrParam["preguntaSeguridad"] = 'cinturon';
				$data['numeroCinturon'] = $this->equipos_model->countEncuestas($arrParam);
				$arrParam["preguntaSeguridad"] = 'aparatos';
				$data['numeroAparatos'] = $this->equipos_model->countEncuestas($arrParam);
			}
			
			$data["view"] = 'consolidado_encuestas';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Lista de cehqueo preoperacional
     * @since 30/6/2022
     * @author BMOTTAG
	 */
	public function consolidado_chequeo_preoperacional()
	{
			//se filtra por company_type para que solo se pueda editar los subcontratistas
			$arrParam = array();
			if($_POST){
				$data["idEquipo"] = $arrParam['idEquipo'] = $this->input->post('idEquipoSearch');
				$data["idMes"] = $this->input->post('idMes');

				$from = $this->data_first_month_day($data["idMes"]);
				$to = $this->data_last_month_day($data["idMes"]);
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( $to ) ) );
				$arrParam["from"] = $from;
				$arrParam["to"] = $to;
			}
			$data['listadoRevision'] = $this->equipos_model->get_diagnostico($arrParam);

			$arrParam = array(
				"table" => "param_tipo_equipos",
				"order" => "tipo_equipo",
				"id" => "x"
			);
			$data['tipoEquipo'] = $this->general_model->get_basic_search($arrParam);

			$arrParam = array(
				"table" => "param_meses",
				"order" => "id_mes",
				"id" => "x"
			);
			$data['listaMeses'] = $this->general_model->get_basic_search($arrParam);
			
			$data["view"] = 'consolidado_chequeo_preoperacional';
			$this->load->view("layout_calendar", $data);
	}

	/** Actual month last day **/
	function data_last_month_day($month) {
	  $year = date('Y');
	  $day = date("d", mktime(0,0,0, $month+1, 0, $year));

	  return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
	}

	/** Actual month first day **/
	function data_first_month_day($month) {
	  $year = date('Y');
	  return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
	}
	
}