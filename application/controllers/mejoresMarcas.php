<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MejoresMarcas extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
        $this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
        $this->load->model('categoria_model');
		$this->load->model('estilo_model');
	}

	function index(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
            $data['estilos'] = $this->estilo_model->getAll();
            $data['categorias'] = $this->categoria_model->getAll();

			$this->load->view('headers');
			$this->load->view('mejoresMarcas', $data);
		}

	}

	function obtenerMarcas(){
		$categoria = $this->input->post("categoria");
		$estilo = $this->input->post("estilo");
		/* if (false)
		{
			echo '<li class="list-group-item li-contenido">Seleccione una fecha y un turno</li>';
		}
		else
		{ */
			$this->db->select('*');
			$this->db->from('nadador');
			$nadadores = $this->db->get();


			foreach ($nadadores->result() as $nadador)
			{

				$this->db->select('*');
				$this->db->from('resultado');
				$this->db->where('DNI', $nadador->DNI);
				//$this->db->join('prueba', 'prueba.ID = resultado.PruebaID');
				//$this->db->join('categoria', 'prueba.CategoriaID = categoria.ID');
				$resultados = $this->db->get();

				echo '<h4>'. $nadador->DNI .' | '. $nadador->Apellido .' '. $nadador->Nombre.'</h4>';

				foreach ($resultados->result() as $resultado)
				{
					//var_dump($resultado);
					

					$this->db->select('*');
					$this->db->from('parcial');
					$this->db->where('ResultadoID', $resultado->ID);
					$parciales = $this->db->get();
					if ($parciales->num_rows() == 0)
					{
						
					}
					else
					{	
						echo '<h5>'.'Resultados de la fecha: '. $resultado->Fecha .'</h5>';
						foreach($parciales->result() as $parcial)
						{
							echo '<li class="list-group-item li-contenido">'. $parcial->Tiempo .'</li>';
						}
						echo '<br>';
					}


					//echo '<li class="list-group-item li-contenido">Seleccione una fecha y un turno</li>';
					//echo $resultado->CategoriaID;
				}

				echo '<br>';
			}


			/* if (empty($data))
			{
				echo '<li class="list-group-item li-contenido">No se registraron asistencias</li>';
			}
			else
			{
				foreach ($data as $campo)
				{
					$this->load->database();
					$this->db->from('lineaasistencia');
					$this->db->where('AsistenciaID', $campo->ID);
					$query = $this->db->get();
					$query = $query->result();
	
					if (empty($query))
					{
						echo '<li class="list-group-item li-contenido">No se registraron asistencias</li>';
					}
					else
					{
						foreach($query as $row){
							$query2 = $this->nadador_model->getByID($row->NadadorID);
							echo '<li class="list-group-item li-contenido">'. $row->NadadorID .' | '. $query2[0]->Apellido .', '. $query2[0]->Nombre .' </li>';
						}
					}
				}
			} */
		/* } */
	}

}