<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parcial_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		$this->load->database();
	}

	function getByID($id){
		$this->db->select('*');
		$this->db->from('parcial');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result();
    }

    function getAll()
    {
        $this->db->select('*');
        $this->db->from('parcial');
        $query = $this->db->get();
		return $query->result();
	}

	function getParcialesPorResultado($ident)
    {
        $this->db->select('*');
		$this->db->from('parcial');
		$this->db->where('ResultadoID', $ident);
        $query = $this->db->get();
		return $query->result();
	}
}

?>