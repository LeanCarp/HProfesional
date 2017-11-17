<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grafica_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}
	//Funciones para el calendario de inicio.
	public function get_events($start, $end)
	{
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

	function obtenerResultados($fromHere, $toHere,$idNadador,$distancia,$tamañoPileta)
	{
        $fromHere= $fromHere->format('Y-m-d');
        $toHere= $toHere->format('Y-m-d');
		$this->load->database();
		$this->db->select('b.ResultadoID , a.Fecha , b.ID ,b.Tiempo, d.Distancia, e.Tamanio');
		$this->db->from('resultado a'); 
        $this->db->join('parcial b', 'b.ResultadoID=a.ID');
        $this->db->join('prueba c', 'a.PruebaID=c.ID');
        $this->db->join('distanciatotal d', 'c.DistanciaID=d.ID');
        $this->db->join('tamaniopileta e', 'c.tamaniopiletaID=e.ID');
     //   $this->db->where('a.DNI', $idNadador);
      	$this->db->where('d.Distancia', $distancia);
        $this->db->where('e.Tamanio', $tamañoPileta);
        $this->db->where('a.fecha >=', $fromHere);
        $this->db->where('a.fecha <=', $toHere);
		$query = $this->db->get();
		return $query->result();
	}
	
	

}



?>