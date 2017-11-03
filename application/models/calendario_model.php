<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class calendario_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}
	//Funciones para el calendario de inicio.
	public function get_events($start, $end)
	{
		//return $this->obtenerEntrenamientos();
		$query=array_merge($this->obtenerEntrenamientos(),$this->obtenerCampeonatos());
		return $query;
	}

	function obtenerEntrenamientos()
	{
		$this->load->database();
		$this->db->select('*');
		$query = $this->db->get("entrenamiento");
		/*foreach($query->result() as $r) 
		{
			$r->nombre="E: ".$r->nombre;
		}*/

		return $query->result();
	}

	function obtenerCampeonatos()
	{
		$this->load->database();
		$this->db->select('*');
		$query = $this->db->get("campeonato");
		return $query->result();
	}

	

}



?>