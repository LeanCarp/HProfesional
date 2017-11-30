<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GestionUsuario extends CI_Controller {
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
            $user = $this->ion_auth->user()->row();

            $crud = new grocery_CRUD();
        	$crud->set_language('spanish');
            $crud->set_table('users');
            $crud->columns('username', 'first_name', 'last_name');
            $crud->fields('username', 'first_name', 'last_name', 'password', 'email');  
            $crud->where('id', $user->id);  
            $crud->unset_add();
            $crud->unset_delete();
            $crud->field_type('password', 'invisible');
           // $crud->field_type('', 'invisible');

            $output = (array)$crud->render();
			$output['titulo']="Usuarios";
            
            $this->load->view('headers');
            $this->load->view('gestion', $output);
        }
	}

}