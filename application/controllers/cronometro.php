<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cronometro extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}

	function index(){
    	if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
			//$idPrueba = $this->input->post('selectPrueba');

			$this->load->database();
			$this->db->select('DNI, Apellido, Nombre');
			$this->db->from('nadador');
			$data['nadadores'] = $this->db->get();

	    	$this->load->view('headers');
	    	$this->load->view('cronometro', $data);
	    }
	}

	function Campeonato(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else
		{
			$idPrueba = $this->uri->segment(3);

			$this->load->database();
			
			$this->db->select('tamañopiletaID, DistanciaID');
			$this->db->from('prueba');
			$this->db->where('ID', $idPrueba);
			$prueba = $this->db->get();
			$prueba = $prueba->row();

			$this->db->select('Distancia');
			$this->db->from('distanciatotal');
			$this->db->where('ID', $prueba->DistanciaID);
			$distancia = $this->db->get();
			$distancia = $distancia->row();

			$this->db->select('Tamaño');
			$this->db->from('tamañopileta');
			$this->db->where('ID', $prueba->tamañopiletaID);
			$tamañoPileta = $this->db->get();
			$tamañoPileta = $tamañoPileta->row();
	

			$cantidadParciales = $distancia->Distancia/$tamañoPileta->Tamaño;

			$this->load->database();
			$this->db->select('DNI, Apellido, Nombre');
			$this->db->from('nadador');
			$data['nadadores'] = $this->db->get();

			$this->load->view('headers');
	    	$this->load->view('cronometro', $data);
		}
	}

	function cronometroConfig(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
			$this->load->view('headers');
	    	$this->load->view('cronometroConfig');
	    }
	}

	public function llenarEventos()
	{
		$eventoSeleccionado = $this->input->post('eventoSeleccionado');
		//echo '<option value="0">'. $eventoSeleccionado .'</option>';
		if($eventoSeleccionado <> 0) {
			$this->load->database();
			$this->db->select('ID, Nombre');
			$this->db->from('entrenamiento');
			$campeonatos = $this->db->get();
			
            echo '<option value="0">Seleccione entrenamiento/campeonato</option>';
            foreach($campeonatos->result() as $fila){
				echo '<option value="'. $fila->ID .'">'. $fila->Nombre .'</option>';
            } 
		} 
		else {
            echo '<option value="0">Seleccione entrenamiento/campeonato</option>';
        }
	}

	public function llenarPruebas()
	{
		$eventoSeleccionado = $this->input->post('eventoSeleccionado');
		//echo '<option value="0">'. $eventoSeleccionado .'</option>';
		if($eventoSeleccionado <> 0) {
			$this->load->database();
			$this->db->select('ID, DistanciaID');
			$this->db->from('prueba');
			$this->db->where('EntrenamientoID', $eventoSeleccionado);
			$pruebas = $this->db->get();
			
            echo '<option value="0">Seleccione una prueba</option>';
            foreach($pruebas->result() as $fila){
				echo '<option value="'. $fila->ID .'">'. $fila->ID .' '. $fila->DistanciaID .'</option>';
            } 
		} 
		else {
            echo '<option value="0">Seleccione una prueba</option>';
        }
	}

	public function cantidadParciales()
	{
		$eventoSeleccionado = $this->input->post('eventoSeleccionado');
		//echo '<option value="0">'. $eventoSeleccionado .'</option>';
		if($eventoSeleccionado <> 0) {
			$this->load->database();

			$this->db->select('tamañopiletaID, DistanciaID');
			$this->db->from('prueba');
			$this->db->where('ID', $eventoSeleccionado);
			$prueba = $this->db->get();
			$prueba = $prueba->row();

			$this->db->select('Distancia');
			$this->db->from('distanciatotal');
			$this->db->where('ID', $prueba->DistanciaID);
			$distancia = $this->db->get();
			$distancia = $distancia->row();

			$this->db->select('Tamaño');
			$this->db->from('tamañopileta');
			$this->db->where('ID', $prueba->tamañopiletaID);
			$tamañoPileta = $this->db->get();
			$tamañoPileta = $tamañoPileta->row();
	

			$cantidadParciales = $distancia->Distancia/$tamañoPileta->Tamaño;
			//echo '<input value="'. $cantidadParciales .'">';
			//echo '<option value="0">'. $cantidadParciales .'</option>';
			echo $cantidadParciales;
			//echo '<option value="'. $cantidadParciales .'">'. $cantidadParciales .'</option>';
		} 
		else {
            echo '<option value="0">Seleccione una prueba</option>';
        }
	}

	public function Hacerlo(){
		$inputs = $this->input->post('inputFinal', true); 
		$idPrueba = $this->input->post('inputPrueba');

		//echo $inputs[0];

		/////// ESTO LE CORRESPONDE AL MODELLLLLL
		$this->load->database();
		foreach ($inputs as $input)
		{
			$valor = explode(",", $input);
			
			$cantParciales = count($valor)-1;
			echo $cantParciales;

			/* for (i=1; i <= $cantParciaes; i++)
			{
				
			} */
			//echo $input;
			/* $data = array('Mañana' => $turno, 'Fecha' => $fecha, 'Presente' => 1, 'EntrenamientoID' => $entrenamiento, 'NadadorID' => $nadador);
			$this->db->insert('asistencia', $data); */
		}
		/////////////////////////////////////////
	}

	public function insercionManual(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {     	
			$crud = new grocery_CRUD();
			$crud->set_language('spanish');
			$crud->set_table('resultado');
			$crud->set_subject('resultado');
			$crud->columns('DNI', 'Tiempo', 'Fecha');
			$crud->fields('DNI', 'PruebaID', 'Tiempo', 'Fecha');
			$crud->unset_export();
			$crud->unset_print();
			$crud->set_relation('PruebaID','prueba','ID');
			$crud->set_relation('DNI','nadador','{DNI} | {Nombre}');
			$crud->display_as('PruebaID','Prueba');
			$crud->display_as('DNI','Nadador');

			//$crud->unset_add();
			//$crud->unset_operations();


			/* Generamos la tabla */
	    	$output = $crud->render();
			$this->load->view('headers');
			$this->load->view('cronometroManual', $output);
		}

	}

}