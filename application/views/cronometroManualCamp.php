<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script src="<?= base_url(); ?>/assets/js/cronometroManualCamp.js"></script>

<style type="text/css">
.configuracion{
	margin-top: 25px;
}
.competidores{
	display: flex;
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
	text-align: center;
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
		font-size: 60px;
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


        <div class="configuracion">
        </div>

		<div id="contenedor">		
			<div class="nadadores">
				<label>Nadadores: </label>
				<select name="selectNadadores" id="selectNadadores">
					<?php foreach($nadadores as $nadador) { ?>
						<option id="<?= $nadador->DNI ?>" value="<?= $nadador->DNI ?>"><?= $nadador->Nombre ?> <?= $nadador->Apellido ?></option>
					<?php } ?>
				</select>	
				
				<input type="button" class="btn-primary" id="agregarNadador" value="Agregar" onclick="agregarNadador()">
				<input type="button" class="btn-danger" id="limpiar" value="Limpiar" onclick="limpiar();">

			</div>
			<?php echo form_open("cronometro/guardarCampeonato", "id='formCronometroManual'");  ?>	
			<input name="inputPrueba" id="inputPrueba" value="<?php echo $idPrueba ?>" type="text" hidden>
			<input name="cantidadParciales" id="cantidadParciales" value="<?php echo $cantParciales ?>" hidden>		
			<div class="competidores" id="competidores">
			
			</div>	

			<input id="botonGuardar" class="btn-primary" type="submit" value="Guardar" style="margin: 40px 0 20px;">

			<?php echo form_close();  ?>
		</div>	
	</div>
</body>
</html>