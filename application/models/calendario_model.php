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
		//$ $this->obtenerEntrenamientos();
		$query=array_merge($this->obtenerEntrenamientos(),$this->obtenerCampeonatos());
		return $query;
	}

	function obtenerEntrenamientos()
	{
		$this->load->database();
		$this->db->select('*');
		$query = $this->db->get("entrenamiento");
		return $query->result();
	}

	function obtenerCampeonatos()
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('campeonato a'); 
		$this->db->join('club b', 'b.ID=a.ClubID', 'left');
		$query = $this->db->get();
		return $query->result();
	}
	
	

}



?>