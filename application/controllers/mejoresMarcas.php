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
		$this->load->model('nadador_model');
		$this->load->model('parcial_model');
		$this->load->model('resultado_model');
		$this->load->model('prueba_model');
		$this->load->model('distanciaTotal_model');
		$this->load->model('tamanoPileta_model');
		$this->load->model('parcial_model');
	}

	function index(){
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
			$data['nadadores'] = $this->nadador_model->getAll();

			$this->load->view('headers');
			$this->load->view('mejoresMarcas', $data);
		}

	}

	function ObtenerMarcasPor()
	{
		$selectEstilo = $this->input->post("selectEstilo");
		$selectSexo = $this->input->post("selectSexo");
		$selectCategoria = $this->input->post("selectCategoria");
		$selectPileta = $this->input->post("selectPileta");
		$selectDistancia = $this->input->post("selectDistancia");
		$selectListado = $this->input->post("selectListado");
		$selectEvento = $this->input->post("selectEvento");
		
		$nadadores = $this->nadador_model->getAll();

		if ($selectListado == 1)
		{
			$resultados;
			foreach ($nadadores as $nadador)
			{	
				if ($selectEvento == 1)
				{
					$resultados = $this->resultado_model->obtenerResultadosPorNadadorYPruebaEntrenamiento($nadador->DNI, $selectEstilo, $selectSexo, $selectCategoria, $selectPileta, $selectDistancia);
					echo '<li class="list-group-item li-contenido nombres">'.$nadador->Apellido.', '.$nadador->Nombre.'</li>';
				}
				else
				{
					$resultados = $this->resultado_model->obtenerResultadosPorNadadorYPruebaCampeonato($nadador->DNI, $selectEstilo, $selectSexo, $selectCategoria, $selectPileta, $selectDistancia);
					echo '<li class="list-group-item li-contenido nombres">'.$nadador->Apellido.', '.$nadador->Nombre.'</li>';
				}

				if (count($resultados) == 0)
				{
					echo '<li class="list-group-item li-contenido">No hay resultados</li>';
				}
				else
				{
					$resultado = $this->obtenerMejorTiempo($resultados);
					echo '<li class="list-group-item li-contenido">'.$resultado->TiempoTotal.'<a class="botonDetalle" href="mejoresMarcas/mostrar/'.$resultado->ID.'">></a></li>';
				}
			}
		}
		else
		{
			$mejoresResultados = [];
			foreach ($nadadores as $nadador)
			{
				if ($selectEvento == 1)
				{
					$resultados = $this->resultado_model->obtenerResultadosPorNadadorYPruebaEntrenamiento($nadador->DNI, $selectEstilo, $selectSexo, $selectCategoria, $selectPileta, $selectDistancia);
					if (count($resultados) == 0)
					{
						
					}
					else
					{
						$mejoresResultados[] = $this->obtenerMejorTiempo($resultados);
					}
				}
				else
				{
					$resultados = $this->resultado_model->obtenerResultadosPorNadadorYPruebaCampeonato($nadador->DNI, $selectEstilo, $selectSexo, $selectCategoria, $selectPileta, $selectDistancia);
					if (count($resultados) == 0)
					{
						
					}
					else
					{
						$mejoresResultados[] = $this->obtenerMejorTiempo($resultados);
					}
				}

			}
			if (count($mejoresResultados) == 0)
			{
				echo '<li class="list-group-item li-contenido nombres">No hay récord</li>';
			}
			else
			{
				$record = $this->obtenerMejorTiempo($mejoresResultados);
				$nadador = $this->nadador_model->getByID($record->DNI);
				echo '<li class="list-group-item li-contenido nombres">'.$nadador[0]->Apellido.', '.$nadador[0]->Nombre.'</li>';
				echo '<li class="list-group-item li-contenido">'.$record->TiempoTotal.'<a class="botonDetalle" href="mejoresMarcas/mostrar/'.$record->ID.'">></a></li>';
			}		
		}
	}

	function obtenerMejorTiempo($resultados)
	{
		$mejorResultado = $resultados[0];

		foreach ($resultados as $resultado)
		{
			if ($this->timeToSeconds($mejorResultado->TiempoTotal) >= $this->timeToSeconds($resultado->TiempoTotal))
			{
				$mejorResultado = $resultado;
			}
		}
		return $mejorResultado;	
	}

	function timeToSeconds($time) {
		$valor = explode(":", $time);
		return intval($valor[0]) * 60 + intval($valor[1]) + intval($valor[2]) * 0.01;
	}


	function mostrar($ident)
	{
		$resultado = $this->resultado_model->getByID($ident);

		$nadador = $this->nadador_model->getByID($resultado[0]->DNI);

		$parciales = $this->parcial_model->getParcialesPorResultado($resultado[0]->ID);

		$prueba = $this->prueba_model->getPruebaConDatos($resultado[0]->PruebaID);

		$evento;
		if ($prueba[0]->CampeonatoID == null)
		{
			$this->load->model('entrenamiento_model');
			$evento = $this->entrenamiento_model->getByID($prueba[0]->EntrenamientoID);
		}
		else
		{
			$this->load->model('campeonato_model');
			$evento = $this->campeonato_model->getByID($prueba[0]->CampeonatoID);
		}

		$data['nadador'] = $nadador[0];
		$data['parciales'] = $parciales;
		$data['resultado'] = $resultado[0];
		$data['prueba'] = $prueba[0];
		$data['evento'] = $evento[0];

		$this->load->view('headers');
		$this->load->view('detalleMarca', $data);
	}

}