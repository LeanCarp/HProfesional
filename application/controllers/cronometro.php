<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cronometro extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		//$this->load->helper('mihelper'); // Primero busca en helper de Application, sino va a System.
		$this->load->database();
		$this->load->model('prueba_model');
		$this->load->model('distanciaTotal_model');
		$this->load->model('tamanoPileta_model');
		$this->load->model('entrenamiento_model');
		$this->load->model('campeonato_model');
		$this->load->model('nadador_model');
		$this->load->model('categoria_model');
		$this->load->model('estilo_model');
		
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
	}

	function index(){
    
		$data['estilos'] = $this->estilo_model->getAll();
		$data['distancias'] = $this->distanciaTotal_model->getAll();
		$data['piletas'] = $this->tamanoPileta_model->getAll();
		$data['categorias'] = $this->categoria_model->getAll();
		$data['entrenamientos'] = $this->entrenamiento_model->getAll();
		//$data['nadadores'] = $this->nadador_model->getAll();

		$this->load->view('headers');
		$this->load->view('cronometro', $data);
		
	}

	function obtenerNadadores()
	{
		$sexo = $this->input->post('sexo');
		$categoria = $this->input->post('categoria');
		$nadadores;
		switch ($sexo)
		{
			case 1:
				$nadadores = $this->nadador_model->obtenerNadadoresMasculinos();
				break;
			case 2:
				$nadadores = $this->nadador_model->obtenerNadadoresFemeninos();
				break;
			case 3:
				$nadadores = $this->nadador_model->getAll();
				break;
		}

		if (count($nadadores) == 0)
		{
			echo '<option id="0" value="0">No hay nadadores</option>';
		}

		if ($categoria == 0)
		{
			foreach ($nadadores as $nadador)
			{
				echo '<option id="'.$nadador->DNI.'" value="'.$nadador->DNI.'">'.$nadador->Nombre.', '.$nadador->Apellido.'</option>';
			}
		}
		else
		{
			$categ = $this->categoria_model->getByID($categoria);
			$cont = 0;
			foreach ($nadadores as $nadador)
			{
				$edadNadador = $this->CalculaEdad($nadador->FechaNacimiento);
				if ($categ[0]->EdadMinima <= $edadNadador && $edadNadador <= $categ[0]->EdadMaxima)
				{
					$cont++;
					echo '<option id="'.$nadador->DNI.'" value="'.$nadador->DNI.'">'.$nadador->Nombre.', '.$nadador->Apellido.'</option>';
				}
			}
			if ($cont == 0)
			{
				echo '<option id="0" value="0">No hay nadadores</option>';
			}
		}

	}

	function CalculaEdad( $fecha ) {
		list($Y,$m,$d) = explode("-",$fecha);
		return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	function Campeonato($ident){
		$data['idPrueba'] = $ident;
		$data['cantParciales'] = $this->cantidadParciales($ident);
		$data['nadadores'] = $this->nadador_model->getAll();
		

		$this->load->view('headers');
		$this->load->view('cronometroCampeonato', $data);
	    
	}

	public function cantidadParciales($idPrueba)
	{
		if($idPrueba <> 0) {
			$prueba = $this->prueba_model->getById($idPrueba);
			$prueba = $prueba->row();

			$distancia = $this->distanciaTotal_model->getById($prueba->DistanciaID);
			$distancia = $distancia->row();

			$tamañoPileta = $this->tamanoPileta_model->getById($prueba->tamaniopiletaID);
			$tamañoPileta = $tamañoPileta->row();
	
			$cantidadParciales = $distancia->Distancia/$tamañoPileta->Tamanio;
			return $cantidadParciales;
		} 
		else 
		{
            return 0;
        }
	}

	function guardarCampeonato(){
		$inputs = $this->input->post('inputFinal', true);
		$idPrueba = $this->input->post('inputPrueba');
		$cantParciales = $this->input->post('cantidadParciales');


		foreach ($inputs as $input)
		{
			$valor = explode(",", $input);
			if (empty($valor[0]))
			{
				$data['mensaje'] = "Hubo algún resultado erróneo";
				$this->db->delete('prueba', array('id' => $idPrueba));
			}
			else
			{
				$fechaHoy = date("Y-m-d");
				$data = array('PruebaID' => $idPrueba, 'DNI' => $valor[0], 'Fecha' => $fechaHoy, 'TiempoTotal' => $this->calcularTotal($valor));
				$this->db->insert('resultado', $data);
				$idResultado = $this->db->insert_id();

				$cantParciales = count($valor)-1;

				for ($i=1; $i<=$cantParciales; $i++)
				{
					$data = array('ResultadoID' => $idResultado, 'Tiempo' => $valor[$i]);
					$this->db->insert('parcial', $data);
				}
				$data['mensaje'] = "Parciales guardados correctamente";
			}
		}

		$this->load->view('headers');
		$this->load->view('mensaje', $data);
	}

	public function guardarEntrenamiento(){
		$inputs = $this->input->post('inputFinal', true);
		$entrenamiento = $this->input->post('inputEntrenamiento');
		$sexo = $this->input->post('inputSexo');
		if ($sexo == 1)
		{
			$sexo = 1;
		}
		else if ($sexo == 2)
		{
			$sexo = 0;
		}
		/* $series = $this->input->post('inputSerie'); */
		$categoria = $this->input->post('inputCategoria');
		$pileta = $this->input->post('inputPileta');
		$distancia = $this->input->post('inputDistancia');
		$estilo = $this->input->post('inputEstilo');
		if ($entrenamiento == 0 || $sexo == 0 || /* $series == 0 ||  */$categoria == 0 || $pileta == 0 || $distancia == 0 || $estilo == 0)
		{
			$data['mensaje'] = "Debe configurar de manera completa el entrenamiento";
			$this->load->view('headers');
			$this->load->view('mensaje', $data);
			//$this->load->view('cronometro');
		}
		else
		{
			$data = array('Masculino' => $sexo, /* 'CantidadSeries' => $series, */ 'CategoriaID' => $categoria, 
			'DistanciaID' => $distancia, 'EstiloID' => $estilo, 'EntrenamientoID' => $entrenamiento, 'tamaniopiletaID' => $pileta);
			$this->db->insert('prueba', $data);
			$idPrueba = $this->db->insert_id();

			foreach ($inputs as $input)
			{
				$valor = explode(",", $input);
				$fechaHoy = date("Y-m-d");
				if (empty($valor[0]))
				{
					$data['mensaje'] = "Hubo algún resultado erróneo";
					$this->db->delete('prueba', array('id' => $idPrueba));
				}
				else
				{
					$data = array('PruebaID' => $idPrueba, 'DNI' => $valor[0], 'Fecha' => $fechaHoy, 'TiempoTotal' => $this->calcularTotal($valor));
					$this->db->insert('resultado', $data);
					$idResultado = $this->db->insert_id();
					
					$cantParciales = count($valor)-1;
	
					for ($i=1; $i<=$cantParciales; $i++)
					{
						$parcial = array('ResultadoID' => $idResultado, 'Tiempo' => $valor[$i]);
						$this->db->insert('parcial', $parcial);
					}
					$data['mensaje'] = "Parciales guardados correctamente";
				}
			}
			
			$this->load->view('headers');
			$this->load->view('mensaje', $data);
		}
	}

	function calcularTotal($parciales)
	{
		$total = 0;
		for ($i=1; $i <= count($parciales)-1; $i++)
		{
			$tiempo = $this->timeToSeconds($parciales[$i]);
			$total += $tiempo;
		}
		return $this->SecondsToTime($total);
	}

	function timeToSeconds($time) {
		$valor = explode(":", $time);
		return intval($valor[0]) * 60 + intval($valor[1]) + intval($valor[2]) * 0.01;
	}

	function SecondsToTime($seconds){
		$result = $seconds / 60;
		$min = floor($result);
		if ($min < 10) {$min = '0'.$min; }
		$result = ($result-$min) * 60;
		$seg = floor($result);
		if ($seg < 10) {$seg = '0'.$seg; }
		$result = (($result-$seg) * 100);
		$cent = ($result);
		if ($cent < 10) {$cent = '0'.$cent; }
		return $min.':'.$seg.':'.$cent;
	
	}

	public function insercionManual($ident){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {     	
			$valor = explode('-',$ident);
			$data['nadadores'] = $this->nadador_model->getAll();

			$data['idPrueba'] = $valor[0];
			$data['cantParciales'] = $valor[1];

			$this->load->view('headers');
			$this->load->view('cronometroManualCamp', $data);
		}

	}

	function cronometroManual(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        { 			
			$data['estilos'] = $this->estilo_model->getAll();
			$data['distancias'] = $this->distanciaTotal_model->getAll();
			$data['piletas'] = $this->tamanoPileta_model->getAll();
			$data['categorias'] = $this->categoria_model->getAll();
			$data['entrenamientos'] = $this->entrenamiento_model->getAll();
			$data['nadadores'] = $this->nadador_model->getAll();

			$this->load->view('headers');
			$this->load->view('cronometroManual', $data);
		}
	}

}