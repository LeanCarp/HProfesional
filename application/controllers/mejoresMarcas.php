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
				$this->db->from('resultado a');
				$this->db->join('prueba b', 'b.ID = a.PruebaID');
				$this->db->where('a.DNI', $nadador->DNI);
				$this->db->where('b.CategoriaID', $categoria);
				$this->db->where('b.EstiloID', $estilo);
				$resultados = $this->db->get();

				echo '<h4>'. $nadador->DNI .' | '. $nadador->Apellido .' '. $nadador->Nombre.'</h4>';
				echo $resultados->num_rows();

				if ($resultados->num_rows() == 0)
				{
					echo '<p>No hay resultados</p>';
					echo '<br>';
				}
				else
				{					
					foreach ($resultados->result() as $resultado)
					{
						//var_dump($resultado);
						
	
						$this->db->select('*');
						$this->db->from('parcial a');
						$this->db->where('a.ResultadoID', $resultado->ID);
						$this->db->join('resultado b', 'a.ResultadoID=b.ID');
						$this->db->join('prueba c', 'b.PruebaID=c.ID');
						$this->db->where('c.CategoriaID', $categoria);
						$this->db->where('c.EstiloID', $estilo);
						echo $resultado->ID;
						$parciales = $this->db->get();
						if ($parciales->num_rows() == 0)
						{
							
						}
						else
						{	
							echo '<p>'.'Resultados de la fecha: '. $resultado->Fecha .'</p>';
							foreach($parciales->result() as $parcial)
							{
								echo '<li class="list-group-item li-contenido">'. $parcial->Tiempo .'</li>';
							}
							echo '<br>';
						}
					}
	
					echo '<br>';
				}
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

	function ObtenerMarcasPor()
	{
		$seleccionado = $this->input->post("select");
		
		$nadadores = $this->nadador_model->getAll();

		switch($seleccionado)
		{
			case 1: // Categorías
				$categorias = $this->categoria_model->getAll();

				$this->obtenerMarcasPorCategoria($categorias, $nadadores);
				break;
			case 2: // Estilo
				$estilos = $this->estilo_model->getAll();

				$this->obtenerMarcasPorEstilo($estilos, $nadadores);
				break;
			case 3: // Absoluto
				$this->obtenerMarcasAbsoluto($nadadores);
				break;
		}
	}

	function obtenerMarcasAbsoluto($nadadores)
	{
		echo "<h4>Mejores marcas absolutas: </h4>";

		foreach ($nadadores as $nadador)
		{
			$mejorTiempo = "00:00:00";
			$this->db->select('a.ID');
			$this->db->from('resultado a');
			$this->db->where('a.DNI', $nadador->DNI);
			$resultados = $this->db->get();

			$parciales = $this->obtenerUltimosParciales($resultados);

			$mejorTiempo = $this->obtenerMejorTiempo($parciales);		
			
			if ($mejorTiempo != "00:00:00")
			{
				echo '<li class="list-group-item li-contenido">'.$nadador->Apellido.', '.$nadador->Nombre.'</li>';
				echo '<li class="list-group-item li-contenido">'.$mejorTiempo.'</li>';
			}
		}
	}

	function obtenerMarcasPorEstilo($estilos, $nadadores)
	{
		foreach ($estilos->result() as $estilo)
		{
			echo '<h4>Mejores marcas por estilo: '.$estilo->Nombre.'</h4>';

			foreach ($nadadores as $nadador)
			{
				$mejorTiempo = "00:00:00";
				/* foreach ($categorias as $categoria)
				{ */
				$this->db->select('a.ID, c.Nombre');
				$this->db->from('resultado a');
				$this->db->join('prueba b', 'b.ID=a.PruebaID', 'left');
				$this->db->join('estilo c', 'c.ID=b.EstiloID', 'left');
				$this->db->where('b.EstiloID', $estilo->ID);
				$this->db->where('a.DNI', $nadador->DNI);
				//$this->db->group_by('a.ID');
				$resultados = $this->db->get();

				$parciales = $this->obtenerUltimosParciales($resultados);

				foreach ($parciales as $parcial)
				{
					echo '<li class="list-group-item li-contenido">'.$nadador->Apellido.', '.$nadador->Nombre.'</li>';
					//echo '<li class="list-group-item li-contenido">'.$mejorTiempo[0].'<input type="submit" id="'.$mejorTiempo[1].'" value=">"></li>';
					//echo '<li class="list-group-item li-contenido">'.$mejorTiempo[0].'<a href="mejoresMarcas/mostrar/'.$mejorTiempo[1].'">></a></li>';
					echo '<li class="list-group-item li-contenido">'.$parcial[0].'<a href="mejoresMarcas/mostrar/'.$parcial[1].'">></a></li>';
				}

				/* $mejorTiempo = $this->obtenerMejorTiempo($parciales);		
				
				if ($mejorTiempo != "00:00:00")
				{
					echo '<li class="list-group-item li-contenido">'.$nadador->Apellido.', '.$nadador->Nombre.'</li>';
					//echo '<li class="list-group-item li-contenido">'.$mejorTiempo[0].'<input type="submit" id="'.$mejorTiempo[1].'" value=">"></li>';
					echo '<li class="list-group-item li-contenido">'.$mejorTiempo[0].'<a href="mejoresMarcas/mostrar/'.$mejorTiempo[1].'">></a></li>';
				} */
			}
		}
	}

	function obtenerMarcasPorCategoria($categorias, $nadadores)
	{
		foreach ($categorias as $categoria)
		{
			echo '<h4>Mejores marcas por estilo: '.$categoria->Nombre.'</h4>';

			foreach ($nadadores as $nadador)
			{
				$mejorTiempo = "00:00:00";
				/* foreach ($categorias as $categoria)
				{ */
				$this->db->select('a.ID, c.Nombre');
				$this->db->from('resultado a');
				$this->db->join('prueba b', 'b.ID=a.PruebaID', 'left');
				$this->db->join('categoria c', 'c.ID=b.CategoriaID', 'left');
				$this->db->where('b.CategoriaID', $categoria->ID);
				$this->db->where('a.DNI', $nadador->DNI);
				//$this->db->group_by('a.ID');
				$resultados = $this->db->get();

				$parciales = $this->obtenerUltimosParciales($resultados);

				$mejorTiempo = $this->obtenerMejorTiempo($parciales);		
				
				if ($mejorTiempo != "00:00:00")
				{
					echo '<li class="list-group-item li-contenido">'.$nadador->Apellido.', '.$nadador->Nombre.'</li>';
					echo '<li class="list-group-item li-contenido">'.$mejorTiempo.'</li>';
				}
				
			}
		}
	}

	function obtenerMejorTiempo($parciales)
	{
		$mejorTiempo = ["00:00:00",0];
		foreach ($parciales as $parcial)
		{
			if (strtotime($mejorTiempo[0]) <= strtotime($parcial[0]))
			{
				$mejorTiempo = $parcial;
			}
		}

		return $mejorTiempo;
	}

	function obtenerUltimosParciales($resultados)
	{
		$ultimosParciales = [];
		foreach ($resultados->result() as $resultado)
		{
			$this->db->select('*');
			$this->db->from('parcial a');
			$this->db->where('a.ResultadoID', $resultado->ID);
			$parciales = $this->db->get();
			$ultimo = ($parciales->num_rows()-1);
			$parciales = $parciales->result();
			if ($ultimo > 0)
			{		
				//$ultimosParciales[] = $parciales[$ultimo]->Tiempo;
				$ultimosParciales[] = [$parciales[$ultimo]->Tiempo, $parciales[$ultimo]->ID];
			}
		}
		return $ultimosParciales;
	}

	function mostrar($ident)
	{
		$parcial = $this->parcial_model->getByID($ident);

		$resultado = $this->resultado_model->getByID($parcial[0]->ResultadoID);

		$nadador = $this->nadador_model->getByID($resultado[0]->DNI);

		$this->load->database();
		$this->db->select('*');
		$this->db->from('parcial');
		$this->db->where('ResultadoID', $parcial[0]->ResultadoID);
		$parciales = $this->db->get()->result();

		/* foreach ($parciales as $parcial)
		{
			echo $parcial->Tiempo;
			echo '<br>';
		} */

		$this->load->database();
		$this->db->select('b.Nombre, c.Nombre, d.Distancia, e.Tamanio, a.EntrenamientoID, a.CampeonatoID');
		$this->db->from('prueba a');
		$this->db->join('categoria b', 'b.ID=a.CategoriaID');
		$this->db->join('estilo c', 'c.ID=a.EstiloID');
		$this->db->join('distanciatotal d', 'd.ID=a.DistanciaID');
		$this->db->join('tamaniopileta e', 'e.ID=a.tamaniopiletaID');
		$this->db->where('a.ID', $resultado[0]->PruebaID);
		$prueba = $this->db->get()->result();

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

		/* foreach ($parciales2->result() as $parcial)
		{
			echo $parcial->Distancia;
			echo '<br>';
			echo $parcial->Nombre;
			echo '<br>';
			echo $parcial->Tamanio;
			echo '<br>';
		} */


	
		
		
	}

}