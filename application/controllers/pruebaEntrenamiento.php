<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PruebaEntrenamiento extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
	}

	function index($idEntrenamiento){
		
		$crud = new grocery_CRUD();
		$crud->set_language('spanish');
		$crud->set_table('prueba');
		$crud->columns( 'Sexo', 'CantidadSeries', 'CategoriaID', 'tamaniopiletaID', 'DistanciaID', 'EstiloID');
		$crud->fields( 'Sexo', 'CantidadSeries', 'CategoriaID', 'tamaniopiletaID', 'DistanciaID', 'EstiloID', 'EntrenamientoID');
		// Agrega acción.
		//$crud->add_action('<>', '+','cronometro/Entrenamiento');

		$crud->where('EntrenamientoID', $idEntrenamiento);
		$crud->set_relation('CategoriaID','categoria','{Nombre}');
		$crud->set_relation('tamaniopiletaID','tamaniopileta','{Tamanio}');
		$crud->set_relation('DistanciaID','distanciatotal','{Distancia}');
		$crud->set_relation('EstiloID','estilo','{Nombre}');
		$crud->field_type('EntrenamientoID', 'hidden', $idEntrenamiento);
		$crud->field_type('CampeonatoID', 'hidden');
		
		$crud->field_type('Sexo','dropdown',
		array('m' => 'Masculino', 'f' => 'Femenino', 'a' => 'Mixto'));

		/* $crud->display_as('Masculino','Sexo');
		$crud->field_type('Masculino','true_false',
								array('1' => 'Masculino', '0' => 'Femenino')); */
		$crud->display_as('CantidadSeries','Repeticiones');
		$crud->field_type('CantidadSeries','dropdown',
								array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		$crud->display_as('CategoriaID','Categoria');
		//$crud->display_as('TamañoPiletaID','Tamaño de pileta');
		$crud->display_as('EstiloID','Estilo');
		$crud->display_as('DistanciaID','Distancia');
		$crud->display_as('tamaniopiletaID','Tamaño de pileta');
		// $crud->display_as('EntrenamientoID','Entrenamiento');
		$crud->set_subject('Prueba');
		//$crud->unset_add();
		//$crud->unset_delete();
		$crud->unset_read();
		$crud->unset_edit_fields('TiempoMin');
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_add();
		//$crud->unset_operations();

		$this->load->model('entrenamiento_model');
		$titulo=$this->entrenamiento_model->getNombre($idEntrenamiento);

		$output = (array)$crud->render();
		//Se carga el titulo a la vista.
		$output['titulo']='pruebas del entrenamiento ' .$titulo;
		$this->load->view('headers');
		$this->load->view('gestion', $output);
		}


}