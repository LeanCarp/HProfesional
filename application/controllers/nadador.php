<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nadador extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		$this->load->model('nadador_model');
	}

	function index(){

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
	    {
						
			$crud = new grocery_CRUD();
			$crud->set_language('spanish');
			$crud->set_table('nadador');
			$crud->columns('DNI', 'Apellido', 'Nombre', 'Sexo', 'FechaNacimiento','Edad','Categoria');
			$crud->fields('DNI', 'Apellido', 'Nombre', 'FechaNacimiento','Sexo');
			$crud->field_type('Sexo','true_false',
									array('1' => 'Masculino', '0' => 'Femenino'));
									
			$crud->display_as('FechaNacimiento','Fecha de Nacimiento');
			$crud->field_type('FechaNacimiento', 'integer');
			//$crud->callback_column ( 'Edad' ,  $this->CalculaEdad("1995-01-03")) ;
			$crud->callback_column('Edad' ,array($this,'obtenerEdad'));
			$crud->callback_column('Categoria' ,array($this,'obtenerCategoria'));

			$crud->unset_edit_fields('DNI');




			/* Generamos la tabla */
	    	$output = (array)$crud->render();
			//Se carga el titulo a la vista.
			$output['titulo']='Nadadores';
			$this->load->view('headers');
			$this->load->view('gestion', $output);
		}
	}
	public function obtenerEdad($value, $row)
	{
		return $this->CalculaEdad($row->FechaNacimiento);
	}
	public function obtenerCategoria($value, $row)
	{
		$this->load->model('categoria_model');
		return $this->categoria_model->getByEdad($this->CalculaEdad($row->FechaNacimiento));
	}

	function CalculaEdad( $fecha ) {
		list($Y,$m,$d) = explode("-",$fecha);
		return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}
}