<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript">
function realizarProceso(){
		var fecha = document.getElementById("fecha").value;
		var turno = document.getElementById("selectTurno").value;

		var parametros = {
				"fecha" : fecha,
				"turno" : turno
		};

        $.ajax({
                data:  parametros,
                url:   '<?php echo base_url(); ?>listarAsistencia/probador',
                type:  'post',
                success:  function (response) {
                        $("#output").html(response);
                }
        });
}
</script>

<style>
	.contenedor{
		display: flex;
	}

	.btnFiltrar{
		margin-left: 5px;
	}

@media screen and (max-width:800px){
	.contenedor{
		flex-direction: column;
		margin-left: 0px;
	}
}
</style>



		<?php echo form_open("listarAsistencia/Hacerlo");  ?>

		<div class="contenedor">
			<div>
				<label>Fecha: </label> <input id="fecha" name="fecha" type="date" value="<?php echo date("Y-m-d");?>">
			</div>
			
			<div>
				<label>Turno: </label>
				<select name="selectTurno" id="selectTurno">
					<option value="0">Mañana</option>
					<option value="1">Tarde</option>
				</select>
			</div>

			<div>
				<input type="button" class="btnFiltrar" id="Filtrar" value="Filtrar" onclick="realizarProceso()">
			</div>
		</div>
		
		<div id="output" style="margin-top: 25px;">

		</div>

		<!-- <?php echo form_submit('submit', 'Filtrar', 'class="btn-primary"'); ?> -->
		<?php echo form_close(); ?>

		<!-- <div class="">
			<h2>Listar asistencia:</h2>
			<div class="">	
				<?php echo $output; ?>
			</div>
		</div> -->
	</div>
</body>
</html>