<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prueba extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library('grocery_crud');
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
	}

	function index(){
		$crud = new grocery_CRUD();
		$crud->set_language('spanish');
		$crud->set_table('prueba');
		$crud->columns('TiempoMin', 'Masculino');
		$crud->fields('TiempoMin', 'Masculino', 'CantidadSeries', 'CategoriaID', 'TamañoPiletaID', 'DistanciaID', 'EstiloID', 'EjercicioID', 'CampeonatoID');
		$crud->set_relation('CategoriaID','categoria','{ID} ({Nombre})');
		$crud->set_relation('TamañoPiletaID','tamañopileta','{ID} ({Tamaño})');
		$crud->set_relation('DistanciaID','distanciatotal','{ID} ({Distancia})');
		$crud->set_relation('EstiloID','estilo','{ID} ({Nombre})');
		$crud->set_relation('EjercicioID','ejercicio','{ID} ({TiempoTotal})');
		$crud->set_relation('CampeonatoID','campeonato','{ID} ({Nombre})');
		//$crud->unset_add();
		//$crud->unset_delete();
		//$crud->unset_read();
		//$crud->unset_edit_fields('DNI');
		$crud->unset_export();
		$crud->unset_print();
		//$crud->unset_add();
		//$crud->unset_operations();


		/* Generamos la tabla */
    	$output = $crud->render();
		$this->load->view('headers');
		$this->load->view('prueba', $output);
	}

}