		<script type="text/javascript">
			var centesimas = 0;
			var segundos = 0;
			var minutos = 0;
			//var horas = 0;
			function inicio () {
				control = setInterval(cronometro,10);
				document.getElementById("inicio").disabled = true;
				document.getElementById("parar").disabled = false;
				document.getElementById("continuar").disabled = true;
				document.getElementById("reinicio").disabled = false;
			}
			function parar () {
				clearInterval(control);
				document.getElementById("parar").disabled = true;
				document.getElementById("continuar").disabled = false;
			}
			function reinicio () {
				clearInterval(control);
				centesimas = 0;
				segundos = 0;
				minutos = 0;
				//horas = 0;
				Centesimas.innerHTML = ":00";
				Segundos.innerHTML = ":00";
				Minutos.innerHTML = "00";
				//Horas.innerHTML = "00";
				document.getElementById("inicio").disabled = false;
				document.getElementById("parar").disabled = true;
				document.getElementById("continuar").disabled = true;
				document.getElementById("reinicio").disabled = true;
			}
			function cronometro () {
				if (centesimas < 99) {
					centesimas++;
					if (centesimas < 10) { centesimas = "0"+centesimas }
					Centesimas.innerHTML = ":"+centesimas;
				}
				if (centesimas == 99) {
					centesimas = -1;
				}
				if (centesimas == 0) {
					segundos ++;
					if (segundos < 10) { segundos = "0"+segundos }
					Segundos.innerHTML = ":"+segundos;
				}
				if (segundos == 59) {
					segundos = -1;
				}
				if ( (centesimas == 0)&&(segundos == 0) ) {
					minutos++;
					if (minutos < 10) { minutos = "0"+minutos }
					Minutos.innerHTML = ":"+minutos;
				}
				if (minutos == 59) {
					minutos = -1;
				}
				// if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
				// 	horas ++;
				// 	if (horas < 10) { horas = "0"+horas }
				// 	Horas.innerHTML = horas;
				// }
			}
		</script>
			<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/styles.css">

			<div class="cronometro">
				<div class="reloj">
					<!-- <div class="reloj" id="Horas">00</div> -->
					<div class="" id="Minutos">00</div>
					<div class="" id="Segundos">:00</div>
					<div class="" id="Centesimas">:00</div>
				</div>
				<div class="botones">
					<input type="button" class="boton" id="inicio" value="Comenzar &#9658;" onclick="inicio();">
					<input type="button" class="boton" id="parar" value="Detener &#8718;" onclick="parar();" disabled>
					<input type="button" class="boton" id="continuar" value="Resumir &#8634;" onclick="inicio();" disabled>
					<input type="button" class="boton" id="reinicio" value="Reiniciar &#8635;" onclick="reinicio();" disabled>
				</div>

			</div>
			<div>
				
			</div>
	</div>
</body>
</html>