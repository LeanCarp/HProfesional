<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PruebaCampeonato extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}

	function index($ident){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
        	//$ident = $this->uri->segment(3);
			$crud = new grocery_CRUD();
			$crud->set_language('spanish');
			$crud->set_table('prueba');
			// Agrega acción.
			$crud->add_action('<>', '+','cronometro/Campeonato');
			//
			$crud->where('CampeonatoID', $ident);
			$crud->columns('TiempoMin', 'Masculino', 'CantidadSeries', 'CategoriaID', 'tamaniopiletaID', 'DistanciaID', 'EstiloID');
			$crud->fields('TiempoMin', 'Masculino', 'CantidadSeries', 'CategoriaID', 'tamaniopiletaID', 'DistanciaID', 'EstiloID', 'CampeonatoID');
			$crud->set_relation('CategoriaID','categoria','{Nombre}');
			$crud->set_relation('tamaniopiletaID','tamaniopileta','{Tamanio}');
			$crud->set_relation('DistanciaID','distanciatotal','{Distancia}');
			$crud->set_relation('EstiloID','estilo','{Nombre}');
			$crud->field_type('CampeonatoID', 'hidden', $ident);
			$crud->field_type('EntrenamientoID', 'hidden');
			
			$crud->display_as('Masculino','Sexo');
			$crud->field_type('Masculino','true_false',
	       						 array('1' => 'Masculino', '0' => 'Femenino'));
			$crud->display_as('CantidadSeries','N° Serie');
			$crud->field_type('CantidadSeries','dropdown',
									array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
			$crud->display_as('TiempoMin','Tiempo Mínimo');
			$crud->display_as('CategoriaID','Categoria');
			$crud->display_as('tamaniopiletaID','Tamaño de pileta');
			$crud->display_as('EstiloID','Estilo');
			$crud->display_as('DistanciaID','Distancia');


			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_add();
			//$crud->unset_operations();

			$this->load->model('campeonato_model');
			$titulo=$this->campeonato_model->getNombre($ident);

			$output = (array)$crud->render();
			//Se carga el titulo a la vista.
			$output['titulo']='pruebas del campeonato: ' .$titulo;
			$this->load->view('headers');
			$this->load->view('gestion', $output);
		}
	}

}