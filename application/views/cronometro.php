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

function inputar(e) {
	var cantParciales = document.getElementById("cantidadParciales").value;
	//var inputResultado = document.getElementById(e.id.substring(0, e.id.length-1)+0);
	//inputResultado.value[e.id.substring(e.id.length-1, e.id.length)] = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
	e.value = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
	if (e.id.substring(e.id.length-1, e.id.length) == cantParciales)
	{
		inputarFinal(e.id.substring(0, e.id.length-1), cantParciales);
	}
	//e.value = [e.id, minutos.toString()+':'+segundos.toString()+':'+centesimas.toString()];
}

function inputarFinal(e, f) {
	var inputFinal = [];
	inputFinal[0] = e;
	idSeleccionado = document.getElementById("selectPrueba");
	//inputFinal[1] = idSeleccionado.options[idSeleccionado.selectedIndex].value;
	for (i=1; i <= f; i++)
	{
		var inputID = document.getElementById(String(e+(i)));
		inputFinal[i] = inputID.value;
	}

	var inputResultado = document.getElementById(String(e+0));
	inputResultado.value = inputFinal;

	console.log(inputFinal);
}

function agregarNadador() {
	var idSeleccionado = document.getElementById("selectNadadores");

	var cantParciales = document.getElementById("cantidadParciales").value;
	console.log(cantParciales);
	

	//idSeleccionado.remove(idSeleccionado.selectedIndex);
	var pro = idSeleccionado.options[idSeleccionado.selectedIndex].value;
	var pro2 = idSeleccionado.options[idSeleccionado.selectedIndex].text;
	console.log(pro);
	console.log(pro2);

	

	var divNadador = document.createElement("div");
	//var inputTotal = document.createElement("input");
	var inputResultado = document.createElement("input");
		inputResultado.setAttribute("name", "inputFinal[]");
		inputResultado.setAttribute("type", "hidden");
		inputResultado.setAttribute("id", pro+0);
		inputResultado.value = [];
		divNadador.appendChild(inputResultado);
	var titulo = document.createElement("h3");
		titulo.innerHTML=pro2;
		titulo.value=pro2;

		divNadador.className = 'box1';
		divNadador.appendChild(titulo);
		//divNadador.setAttribute('onclick', 'parcialito(this);');
		for (i=1; i <= cantParciales; i++)
		{
			var inputParcial = document.createElement("input");
			inputParcial.setAttribute('name', 'inputs[]');
			inputParcial.setAttribute('id', pro+i);
			console.log(inputParcial.id);
			inputParcial.readOnly  = true;
			inputParcial.setAttribute('onclick', 'inputar(this);');
			divNadador.appendChild(inputParcial);
		}

	divPadre = document.getElementById("competidores");
	divPadre.appendChild(divNadador);

	idSeleccionado.remove(idSeleccionado.selectedIndex);
}

$(document).ready(function() {                       
                $("#selectEvento").change(function() {
                    $("#selectEvento option:selected").each(function() {
                        eventoSeleccionado = $('#selectEvento').val();
                        $.post("<?php echo base_url(); ?>cronometro/llenarEventos", {
                            eventoSeleccionado : eventoSeleccionado
                        }, function(data) {
                            $("#selectEvento2").html(data);
                        });
                    });
                });

				div = document.getElementById("contenedor");
				div.hidden = true;
            });

            $(document).ready(function() {                       
                $("#selectEvento2").change(function() {
                    $("#selectEvento2 option:selected").each(function() {
                        eventoSeleccionado = $('#selectEvento2').val();
                        $.post("<?php echo base_url(); ?>cronometro/llenarPruebas", {
                            eventoSeleccionado : eventoSeleccionado
                        }, function(data) {
                            $("#selectPrueba").html(data);
                        });
                    });

					div = document.getElementById("contenedor");
					div.hidden = true;
                });
            });

			$(document).ready(function() {                       
                $("#selectPrueba").change(function() {
					$("#selectPrueba option:selected").each(function() {
						eventoSeleccionado = $('#selectPrueba').val();
                        $.post("<?php echo base_url(); ?>cronometro/cantidadParciales", {
                            eventoSeleccionado : eventoSeleccionado
                        }, function(data) {
							$("#cantidadParciales").val(data);
                        });
						div = document.getElementById("contenedor");
						div.hidden = false;

						idPrueba = document.getElementById("selectPrueba").value;
						inputPrueba = document.getElementById("inputPrueba");
						inputPrueba.value = idPrueba;
                    });             
                });
            });

</script>


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
	background-color: gray;
	margin: 5px;
	padding: 20px;
	font-size: 20px;
}
</style>

		<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/styles.css">
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

		<div>
			<a href="<?php echo base_url(); ?>cronometro/insercionManual" class="btn-primary" style="padding: 5px; text-decoration: none;">Ingresar tiempo manualmente</a>
		</div>

        <div class="configuracion">
                <div class="selects">
                    <h4>Configuración del cronómetro:</h4>

                    <label>Seleccione: </label>
                    <select id="selectEvento" name="selectEvento">
                        <option value="0">Seleccione un evento</option>
                        <option value="1">Campeonato</option>
                        <option value="2">Entrenamiento</option>
                    </select>

                    <select id="selectEvento2" name="selectEvento2">
                       <option value="0">Seleccione entrenamiento/campeonato</option>
                    </select>

                    <select id="selectPrueba" name="selectPrueba">
                       <option value="0">Seleccione prueba</option>
                    </select>
                </div>
        </div>

		<div id="contenedor" hidden>
			<label>Cantidad de parciales: </label> <input id="cantidadParciales" value="" readonly>
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
			
			<div class="nadadores" style="margin-top: 150px;">
				<label>Nadadores: </label>
				<select name="selectNadadores" id="selectNadadores">
					<?php foreach($nadadores->result() as $nadador) { ?>
						<option id="<?= $nadador->DNI ?>" value="<?= $nadador->DNI ?>"><?= $nadador->Nombre ?> <?= $nadador->Apellido ?></option>
					<?php } ?>
				</select>	
				
				<input type="button" class="btn-primary" id="agregarNadador" value="Agregar +" onclick="agregarNadador()">
			</div>
			<?php echo form_open("cronometro/Hacerlo");  ?>	
			<input name="inputPrueba" id="inputPrueba" value="0" type="text" hidden>			
			<div class="competidores" id="competidores">
			
			</div>	
			<?php echo form_submit('submit', 'Guardar', 'class="btn-primary"'); ?>
			<?php echo form_close();  ?>
		</div>	
	</div>
</body>
</html>


<!-- 		<div id="competidores">
			<input type="button" class="boton" id="agregarParcial" value="Agregar +" onclick="agregarDiv();">
			<div id="tiempoParcial" style="margin-top:60px;" class="box1" onclick="parcial()"></div>
			<input type="text" id="parcialito" value="" onclick="parcial()" disabled>
		</div> -->