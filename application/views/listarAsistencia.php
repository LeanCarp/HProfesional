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




		<?php echo form_open("listarAsistencia/Hacerlo");  ?>
		<label>Fecha: </label> <input id="fecha" name="fecha" type="date">

		<label>Turno: </label>
		<select name="selectTurno" id="selectTurno">
			<option value="0">Mañana</option>
			<option value="1">Tarde</option>
		</select>

		<input type="button" class="" id="Filtrar" value="Filtrar" onclick="realizarProceso()">

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