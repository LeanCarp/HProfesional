<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reporteGrafico_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		//$this->load->database();
	}

public function cargar(){

			$this->load->database();
			$this->db->select('DNI, Apellido, Nombre');
			$this->db->from('nadador');
			// $this->db->where('');
			$data['records'] = $this->db->get();

			$this->load->database();
			$this->db->select('*');
			$this->db->from('estilo');
			// $this->db->where('');
			$data['records1'] = $this->db->get();

			
			$this->load->database();
			$this->db->select('*');
			$this->db->from('tamañopileta');
			// $this->db->where('');
			$data['records2'] = $this->db->get();

			$this->load->database();
			$this->db->select('*');
			$this->db->from('distanciatotal');
			// $this->db->where('');
			$data['records3'] = $this->db->get();

			return $data;

}	

function getDatosGrafica($dni,$estilo,$tamañoPileta,$distancia,$fecha1,$fecha2){

		$this->load->database();

		//$this->db->select('parcial.Tiempo','resultado.Fecha');
		//$this->db->from('parcial');
		//$this->db->join('resultado', 'resultado.ID=parcial.ResultadoID');
		$this->db->select('resultado.ID','resultado.DNI','resultado.pruebaID','resultado.fecha');
		$this->db->from('resultado');
		$this->db->where('DNI', $DNI);
		$this->db->where('fecha1 >=', $fecha1);
		$this->db->where('fecha2 <=',$fecha2);
		$this->db->join('prueba', 'prueba.ID=resultado.pruebaID');
		$this->db->where('estiloID',$estilo);
		$this->db->where('tamañoPiletaID', $tamañoPileta);
		$this->db->where('distanciaID', $distancia);
		$query = $this->db->get();
		return $query->result();

	}

function getTiemposParcial($id){

	$this->load->database();
		$this->db->select('Tiempo');
		$this->db->from('parcial');
		$this->db->where('ResultadoID', $id);

		$query = $this->db->get();
		return $query->result();
}
/*public function getFechas($f1,$f2){

		$this->load->database();
		$this->db->select('ID');
		$this->db->from('resultado');
		$this->db->where('Fecha >=',$f1);
		$this->db->where('Fecha <=',$f2);

		$query = $this->db->get();
		return $query->result();
	}


function joinema($DNI,$estilo){

		$this->load->database();
		
		$this->db->select('resultado.pruebaID');
		$this->db->from('resultado');
		$this->db->where('DNI', $DNI);
		$this->db->join('prueba', 'prueba.ID=resultado.pruebaID');
		$this->db->where('estiloID',$estilo);
		$query = $this->db->get();
		return $query->result();
	} 
	*/

	public function lala($DNI,$fecha1,$fecha2,$estilo,$tamañoPileta,$distancia){

		/*
		$this->db->select('parcial.Tiempo','resultado.Fecha');
		$this->db->from('parcial');
		$this->db->join('resultado', 'resultado.ID=parcial.ResultadoID');
		//$this->db->select('resultado.ID','resultado.DNI','resultado.pruebaID','resultado.fecha');
		//$this->db->from('resultado');
		$this->db->join('prueba', 'prueba.ID=resultado.pruebaID');
		$this->db->where('DNI', $DNI);
		$this->db->where('fecha >=', $fecha1);
		$this->db->where('fecha <=',$fecha2);
		//$this->db->join('prueba', 'prueba.ID=resultado.pruebaID');
		$this->db->where('estiloID',$estilo);
		$this->db->where('tamañoPiletaID', $tamañoPileta);
		$this->db->where('distanciaID', $distancia);
		$query = $this->db->get();
		return $query->result();
	*/
		$this->db->select('parcial.Tiempo','resultado.Fecha');
		$this->db->from('prueba');
		$this->db->where('prueba.estiloID',$estilo);
		$this->db->where('prueba.tamañoPiletaID', $tamañoPileta);
		$this->db->where('prueba.distanciaID', $distancia);
		$this->db->join('resultado', 'prueba.ID=resultado.pruebaID');
				$this->db->where('resultado.DNI', $DNI);
		$this->db->where('resultado.fecha >=', $fecha1);
		$this->db->where('resultado.fecha <=',$fecha2);
		$this->db->join('parcial', 'resultado.ID=parcial.resultadoID');

		$query = $this->db->get();
		return $query->result();


	}
}
?>