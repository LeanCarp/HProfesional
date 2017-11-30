<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LineaAsistencia_model extends CI_Model{
	function __contruct(){
		parent::__construct();
		$this->load->database();
	}

	function insertarLineaAsistencia($data){
		$this->db->insert('lineaasistencia', $data);
		return $this->db->insert_id();
    }
    
}

?>