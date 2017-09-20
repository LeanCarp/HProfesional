<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CrearNadador extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library('grocery_crud');
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		$this->load->model('nadador_model');
	}

	public function Index(){
		$data['titulo']= 'Pagina Principal para la clase nadador';
	$this->load->view('Plantilla/Headers',$data); // Permite cargar múltiples vistas. En este caso se cargó el head.
	$this->load->view('Nadador/Index'); // Permite cargar múltiples vistas. En este caso se cargó el head.	
	$this->load->view('Plantilla/Footer');
	}

	function nuevo(){
	//$this->load->view('headers'); // Permite cargar múltiples vistas. En este caso se cargó el head.
	//$this->load->view('insertarNadador'); // Permite cargar múltiples vistas. En este caso se cargó el head.
	
	/*	$data['titulo']= 'Pagina Principal para agregar un nadador';
	$this->load->view('Plantilla/Headers',$data); // Permite cargar múltiples vistas. En este caso se cargó el head.
	$this->load->view('Nadador/insertarNadador'); // Permite cargar múltiples vistas. En este caso se cargó el head.	
	$this->load->view('Plantilla/Footer');
	*/
	}

	function obtenerTodos(){
		/*$this->load->view('headers');
		$result = $this->nadador_model->getAll();
		return $result;*/
		/*foreach ($result as $nadador)
		{
			echo $nadador->DNI;
		}*/
		$crud = new grocery_CRUD();
		$crud->set_table('nadador');
		$crud->columns('DNI', 'Apellido');
		$crud->fields('Apellido');
		//$crud->unset_delete();
		//$crud->unset_read();
		//$crud->unset_edit();
		//$crud->unset_export();
		//$crud->unset_print();
		//$crud->unset_add();
		$crud->unset_operations();



		/* Generamos la tabla */
    	$output = $crud->render();
    	$this->load->view('headers', $output);
    	$this->load->view('inicio', $output);
	}

	function obtenerPorID()
	{
		$result = $this->nadador_model->getByID(38570658);
		//var_dump($result);
	}

	function eliminarNadador(){
		$this->nadador_model->eliminarNadador(); // ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ Hay que pasar como parámetro el ID
	}

	function recibirDatos(){
	$data = array(
		'DNI' => $this->input->post('dni'),
		'Nombre' => $this->input->post('nombre'),
		'Apellido' => $this->input->post('apellido'),
		'FechaNacimiento' => $this->input->post('fechaNacimiento')
		);
	$this->nadador_model->crearNadador($data);

	/*$this->load->view('codigofacilito/headers');
	$this->load->view('codigofacilito/bienvenido');*/
	}
}