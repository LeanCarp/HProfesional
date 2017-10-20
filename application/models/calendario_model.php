<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class calendario_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	
	//Funciones para el calendario de inicio.
	public function get_events($start, $end)
	{
		$this->load->database();
		$this->db->select('*');
		$query = $this->db->get("entrenamiento");
		return $query;
	}



}



?>