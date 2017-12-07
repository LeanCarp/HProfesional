<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resultado_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

	function crearResultado($data){
		$this->load->database();
		$this->db->insert('resultado', $data);
	}

	function eliminarResultado($id){
		$this->load->database();
		$this->db->where('ID', $id);
		$this->db->delete('resultado');
	}

	function getByID($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('resultado');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function getAll(){
		$this->load->database();
		$query = $this->db->get('resultado');
		return $query->result();
	}

	function obtenerResultadosPorNadadorYPruebaCampeonato($id, $Estilo, $Sexo, $Categoria, $Pileta, $Distancia)
	{
		$this->db->select('*');
		$this->db->from('resultado a');
		$this->db->join('prueba b', 'a.PruebaID=b.ID');
		$this->db->where('b.EstiloID', $Estilo);
		$this->db->where('b.Masculino', $Sexo);
		$this->db->where('b.CategoriaID', $Categoria);
		$this->db->where('b.tamaniopiletaID', $Pileta);
		$this->db->where('b.DistanciaID', $Distancia);
		$this->db->where('b.EntrenamientoID', null);
		$this->db->where('a.DNI', $id);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	function obtenerResultadosPorNadadorYPruebaEntrenamiento($id, $Estilo, $Sexo, $Categoria, $Pileta, $Distancia)
	{
		$this->db->select('*');
		$this->db->from('resultado a');
		$this->db->join('prueba b', 'a.PruebaID=b.ID');
		$this->db->where('b.EstiloID', $Estilo);
		$this->db->where('b.Masculino', $Sexo);
		$this->db->where('b.CategoriaID', $Categoria);
		$this->db->where('b.tamaniopiletaID', $Pileta);
		$this->db->where('b.DistanciaID', $Distancia);
		$this->db->where('b.CampeonatoID', null);
		$this->db->where('a.DNI', $id);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	
	function obtenerResultadosPorCampeonato($idCampeonato)
	{
		$this->db->select('b.ID, c.Nombre, d.Distancia, e.Tamanio');
		$this->db->from('prueba b');
		$this->db->join('categoria c', 'c.ID=b.CategoriaID');
		$this->db->join('distanciatotal d', 'd.ID=b.DistanciaID');
		$this->db->join('tamaniopileta e', 'e.ID=b.tamaniopiletaID');
		$this->db->join('estilo f', 'f.ID=b.EstiloID');
		$this->db->where('b.CampeonatoID', $idCampeonato);
		$pruebas = $this->db->get();
		return $pruebas->result();
	}

	function obtenerResultadoPorPruebaYNadador($prueba, $dni) // Para campeonatos
	{
		$this->db->select('*');
        $this->db->from('resultado a');
        $this->db->join('prueba b', 'b.ID=a.PruebaID');
        $this->db->where('b.CategoriaID', $prueba->CategoriaID);
        $this->db->where('b.EstiloID', $prueba->EstiloID);
        $this->db->where('b.tamanioPiletaID', $prueba->tamaniopiletaID);
		$this->db->where('b.DistanciaID', $prueba->DistanciaID);
		$this->db->where('b.EntrenamientoID', null);
		//$this->db->where('a.PruebaID', $prueba->ID);
		$this->db->where('a.DNI', $dni);
		$resultados = $this->db->get();
		return $resultados->result();
	}
}



?>