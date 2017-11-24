<!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/styles.css"> -->
<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script> -->
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<style type="text/css">
.selects{
	font-size: 14px;
}
.configuracion{
	margin-top: 25px;
}
.competidores{
	display: flex;
	flex-direction: row;
	flex-wrap: wrap;
}

.box1{
	display: flex;
	flex-direction: column;
	background-color: #3D8BCD;
	margin: 5px;
	padding: 20px;
	font-size: 20px;
}

.nadadores{
	margin-top: 70px;
}

@media screen and (max-width:800px){
	.nadadores{
		margin-top: 110px;
	}
	.selects{
	display: flex;
	flex-direction: column;
	}

	.competidores{
		width: 100%;
		display: flex;
		flex-direction: column;
		flex-wrap: wrap;
	}

	.cronometro{
		width: 100%;
	}

	.reloj{
		margin: 0 auto;
		/*float: left;*/
		font-size: 60px;
		/*	font-family: Courier,sans-serif;*/
		color: #363431;
	}

	.botones
	{
		flex-direction: column;
	}

	.botonesCronometro{
		margin: 3px;
		cursor: pointer;
		font-size: 15px;
	}

	.box1{
		margin-top: 5px;
		font-size: 15px;
	}
}

</style>

<script src="<?= base_url(); ?>/assets/js/cronometro.js"></script>

		<div onload="configurando()">
			<!-- <div>
				<a href="<?php echo base_url(); ?>cronometro/insercionManual" class="btn-primary" style="padding: 5px; text-decoration: none;">Ingresar tiempo manualmente</a>
			</div> -->	
			<div class="configuracion">
					<div class="selects">
						<h3>Configuración del cronómetro:</h4>
						<!-- <label>Seleccione: </label> -->
						<select id="selectEntrenamiento" name="selectEntrenamiento">
							<option value="0">Entrenamiento</option>
							<?php foreach($entrenamientos->result() as $entrenamiento) { ?>
								<option value="<?= $entrenamiento->ID ?>"><?= $entrenamiento->nombre ?></option>
							<?php } ?>
						</select>
						
						<!-- <label>Sexo: </label> -->
						<select id="selectSexo" name="selectSexo">
							<option value="0">Sexo</option>
							<option value="1">Masculino</option>
							<option value="2">Femenino</option>
						</select>

					<!-- 	<label>Series: </label> -->
						<input type="number" id="inputSeries" name="inputSeries" value="0">

						<!-- <label>Categoría: </label> -->
						<select id="selectCategoria" name="selectCategoria">
						<option value="0">Categoría</option>
						<?php foreach($categorias->result() as $categoria) { ?>
								<option value="<?= $categoria->ID ?>"><?= $categoria->Nombre ?></option>
							<?php } ?>
						</select>

						<!-- <label>Pileta: </label> -->
						<select id="selectPileta" name="selectPileta">
						<option value="0">Tamaño de pileta</option>
						<?php foreach($piletas->result() as $pileta) { ?>
								<option value="<?= $pileta->ID ?>"><?= $pileta->Tamanio ?></option>
							<?php } ?>
						</select>

						<!-- <label>Distancia: </label> -->
						<select id="selectDistancia" name="selectDistancia">
						<option value="0">Distancia</option>
						<?php foreach($distancias->result() as $distancia) { ?>
								<option value="<?= $distancia->ID ?>"><?= $distancia->Distancia ?></option>
							<?php } ?>
						</select>

						<!-- <label>Estilo: </label> -->
						<select id="selectEstilo" name="selectEstilo">
						<option value="0">Estilo</option>
						<?php foreach($estilos->result() as $estilo) { ?>
								<option value="<?= $estilo->ID ?>"><?= $estilo->Nombre ?></option>
							<?php } ?>
						</select>
						<!-- <label>Cantidad de parciales: </label> --> <input id="cantidadParciales" value="" hidden>
						
					</div>
			</div>

			<div id="contenedor">
				<div class="cronometro">
					<div class="reloj">
						<!-- <div class="reloj" id="Horas">00</div> -->
						<div class="" id="Minutos">00</div>
						<div class="" id="Segundos">:00</div>
						<div class="" id="Centesimas">:00</div>
					</div>
					<div class="botones">
						<input type="button" class="btn-success botonesCronometro" id="inicio" value="Comenzar &#9658;" onclick="inicio();">
						<input type="button" class="btn-warning botonesCronometro" id="parar" value="Detener &#8718;" onclick="parar();" disabled>
						<input type="button" class="btn-info botonesCronometro" id="continuar" value="Resumir &#8634;" onclick="inicio();" disabled>
						<input type="button" class="btn-danger botonesCronometro" id="reinicio" value="Reiniciar &#8635;" onclick="reinicio();" disabled>
						<input type="button" class="btn-danger botonesCronometro" id="limpiar" value="Limpiar" onclick="limpiar();">
					</div>
				</div>
				
				<div class="nadadores">
					<label>Nadadores: </label>
					<select name="selectNadadores" id="selectNadadores">
						<?php foreach($nadadores as $nadador) { ?>
							<option id="<?= $nadador->DNI ?>" value="<?= $nadador->DNI ?>"><?= $nadador->Nombre ?> <?= $nadador->Apellido ?></option>
						<?php } ?>
					</select>	
					<input type="button" class="btn-primary" id="agregarNadador" value="Agregar" onclick="agregarNadador()">
				</div>
				<?php echo form_open("cronometro/guardarEntrenamiento");  ?>			
				<div class="competidores" id="competidores">
				
				</div>	

				<input id="inputEntrenamiento" name="inputEntrenamiento" value="0" type="text" hidden>
				<input id="inputSexo" name="inputSexo" value="0" type="text" hidden>
				<input id="inputSerie" name="inputSerie" value="0" type="text" hidden>
				<input id="inputCategoria" name="inputCategoria" value="0" type="text" hidden>
				<input id="inputPileta" name="inputPileta" value="0" type="text" hidden>
				<input id="inputDistancia" name="inputDistancia" value="0" type="text" hidden>
				<input id="inputEstilo" name="inputEstilo" value="0" type="text" hidden>

				<input id="botonGuardar" class="btn-primary" type="submit" value="Guardar" style="margin: 40px 0 20px;" disabled>

				<!-- <?php echo form_submit('submit', 'Guardar', 'class="btn-primary"'); ?> -->
				<?php echo form_close();  ?>
			</div>

	
	
</form> 
		</div>	
	</div>
</body>
</html>


<!-- 		<div id="competidores">
			<input type="button" class="boton" id="agregarParcial" value="Agregar +" onclick="agregarDiv();">
			<div id="tiempoParcial" style="margin-top:60px;" class="box1" onclick="parcial()"></div>
			<input type="text" id="parcialito" value="" onclick="parcial()" disabled>
		</div> -->