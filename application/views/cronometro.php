<script type="text/javascript">
var centesimas = 0;
var segundos = 0;
var minutos = 0;
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
	horas = 0;
	Centesimas.innerHTML = ":00";
	Segundos.innerHTML = ":00";
	Minutos.innerHTML = "00";
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
		Minutos.innerHTML = minutos;
	}
	if (minutos == 59) {
		minutos = -1;
	}
}

function parcial () {
	tiempoParcial.innerHTML = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
	input = document.getElementById("parcialito")
	input.value = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
}

function agregarDiv () {
	var midiv = document.createElement("div");
			midiv.className = 'box1';
			midiv.setAttribute(onclick, "parcial();");
			midiv.innerHTML = "00";
	otrodiv = document.getElementById("competidores")
	otrodiv.appendChild(midiv); // Lo pones en "body", si quieres ponerlo dentro de algún id en concreto usas document.getElementById('donde lo quiero poner').appendChild(midiv);
}

function agregarDiv () {
	var midiv = document.createElement("div");
			midiv.className = 'box1';
			midiv.setAttribute(id, '');
			midiv.setAttribute(onclick, "parcial();");
			midiv.innerHTML = "00";
	otrodiv = document.getElementById("competidores")
	otrodiv.appendChild(midiv); // Lo pones en "body", si quieres ponerlo dentro de algún id en concreto usas document.getElementById('donde lo quiero poner').appendChild(midiv);
}

</script>


<style type="text/css">
.box1{
	background-color: gray;
	margin: 5px;
	padding: 20px;
	font-size: 40px;
}
</style>

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

		<label>Nadadores: </label>
		<select name="selectNadadores">
			<?php foreach($nadadores->result() as $nadador) { ?>
				<option value="<?= $nadador->DNI ?>"><?= $nadador->Nombre ?> <?= $nadador->Apellido ?></option>
			<?php } ?>
		</select>
		<input type="button" class="btn-primary" id="agregarNadador" value="Agregar +" onclick="agregarNadador(selectNadadores);">
		<div id="competidores">
			<input type="button" class="boton" id="agregarParcial" value="Agregar +" onclick="agregarDiv();">
			<div id="tiempoParcial" style="margin-top:60px;" class="box1" onclick="parcial()"></div>
			<input type="text" id="parcialito" value="" onclick="parcial()" disabled>

		</div>
		
	</div>
</body>
</html>