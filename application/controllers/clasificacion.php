<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clasificacion extends CI_Controller {
	function __construct(){
		parent::__construct(); /*Ejecuta el constructor del padre*/
		$this->load->database();
		$this->load->library(array('ion_auth','grocery_crud'));
		$this->load->helper('url');
        $this->load->helper('form'); // Viene por defecto con CI. Crear formularios con ese helper.
        $this->load->model('resultado_model');
        $this->load->model('campeonato_model');
        $this->load->model('prueba_model');
        $this->load->model('nadador_model');
	}

	function index(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
        else
        {
            $output['campeonatos'] = $this->campeonato_model->getAll();

			$this->load->view('headers');
			$this->load->view('clasificacion', $output);
		}
    }
    
    function obtenerPruebas()
    {
        $idCampeonato = $this->input->post('campeonato');

        $campeonato = $this->campeonato_model->getByID($idCampeonato);

        echo '<li class="list-group-item li-contenido nombres">'.$campeonato[0]->nombre.' | Fecha inicio: '.$campeonato[0]->inicio.' - Fecha fin: '.$campeonato[0]->fin.'</li>';

        $pruebas = $this->resultado_model->obtenerResultadosPorCampeonato($idCampeonato);

        if (count($pruebas) == 0)
        {
            echo "No hay pruebas registradas";
        }
        else
        {

            foreach ($pruebas as $prueba)
            {
                echo '<li class="list-group-item li-contenido">'.$prueba->ID.' Estilo: '.$prueba->Nombre.' - Distancia: '.$prueba->Distancia.' - Tamaño: '.$prueba->Tamanio.'<input type="button" value=">" id="'.$prueba->ID.'" onclick="obtenerClasificados(this)"></li>';
            }
        }
    }

    function obtenerClasificados()
    {
        $idPrueba = $this->input->post('idPrueba');
        $prueba = $this->prueba_model->getByID($idPrueba);
        $prueba = $prueba->result();

        $resultados = $this->resultado_model->obtenerResultadoPorPrueba($prueba[0]);

        if (count($resultados) == 0)
        {
            echo "No hay resultados.";
        }
        else
        {
            echo '<li class="list-group-item li-contenido nombres">Nadadores clasificados:</li>';
            
            foreach ($resultados as $resultado)
            {
                if ($this->timeToSeconds($resultado->TiempoTotal) <=  $this->timeToSeconds("00:06:00"))
                {
                    $nadador = $this->nadador_model->getByID($resultado->DNI);
                    echo '<li class="list-group-item li-contenido">'.$resultado->DNI.' | '.$nadador[0]->Apellido.', '.$nadador[0]->Nombre.'<p>Tiempo: '.$resultado->TiempoTotal.'</p></li>';
                }
            }
        }
    }

    function timeToSeconds($time) {
		$valor = explode(":", $time);
		return intval($valor[0]) * 60 + intval($valor[1]) + intval($valor[2]) * 0.01;
	}

}