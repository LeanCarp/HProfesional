<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/styles.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script> -->

<script type="text/javascript">
var centesimas = 0;
var segundos = 0;
var minutos = 0;
function inicio () {
	var valido = true;
	$(".selects select option:selected").each(
		function () {
			if ($(this).val() == 0)
			{
				valido = false;
			}

		}
	)

	if (valido)
	{
		control = setInterval(cronometro,10);
		document.getElementById("inicio").disabled = true;
		document.getElementById("parar").disabled = false;
		document.getElementById("continuar").disabled = true;
		document.getElementById("reinicio").disabled = false;
	}
	else
	{
		alert("¡Debe configurar el entrenamiento!");
	}

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

function eliminarNadador(input) {
	if ($("#competidores div").size() == 1)
	{
		document.getElementById("botonGuardar").disabled = true;
	}

	divPadre = document.getElementById("competidores");
	divHijo = document.getElementById(input.id.substring(0, input.id.length-1));
	divPadre.removeChild(divHijo);

	var miOption = document.createElement("option");
	miOption.setAttribute("value",input.id.substring(0, input.id.length-1));
	miOption.text = divHijo.childNodes[1].innerHTML;

	var selectNadadores = document.getElementById("selectNadadores");
	selectNadadores.appendChild(miOption);
}

function agregarNadador() {
	var valido = true;
	$(".selects select option:selected").each(
		function () {
			if ($(this).val() == 0)
			{
				valido = false;
			}
		}
	)

	if (valido)
	{
		document.getElementById("botonGuardar").disabled = false;
		var idSeleccionado = document.getElementById("selectNadadores");

		var cantParciales = document.getElementById("cantidadParciales").value;
		console.log(cantParciales);
		

		//idSeleccionado.remove(idSeleccionado.selectedIndex);
		var pro = idSeleccionado.options[idSeleccionado.selectedIndex].value;
		var pro2 = idSeleccionado.options[idSeleccionado.selectedIndex].text;
		console.log(pro);
		console.log(pro2);

	

		var divNadador = document.createElement("div");
		divNadador.setAttribute("id", pro);
		//var inputTotal = document.createElement("input");
		var inputResultado = document.createElement("input");
			inputResultado.setAttribute("name", "inputFinal[]");
			inputResultado.setAttribute("type", "hidden");
			inputResultado.setAttribute("id", pro+0);
			inputResultado.value = [];
			divNadador.appendChild(inputResultado);
		var titulo = document.createElement("h3");
			titulo.setAttribute("id", "titulo");
			titulo.innerHTML=pro2;
			titulo.value=pro2;
		var inputSubmit = document.createElement("input");
			inputSubmit.setAttribute("type", "button");
			inputSubmit.setAttribute("id", pro+0);
			inputSubmit.setAttribute("onclick", "eliminarNadador(this);");
			inputSubmit.setAttribute("value", "Eliminar nadador");
			inputSubmit.setAttribute("style", "background: #ba2020; color: white; width:50%; margin: 0 auto; font-size: 17px;");


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
			inputParcial.setAttribute('style', 'margin-bottom: 15px;');
			divNadador.appendChild(inputParcial);
		}

		divNadador.appendChild(inputSubmit);

		divPadre = document.getElementById("competidores");
		divPadre.appendChild(divNadador);

		idSeleccionado.remove(idSeleccionado.selectedIndex);
	}
	else
	{
		alert("¡Debe configurar el entrenamiento!");
	}
}

$(document).ready(function() {                       
                $("#selectEntrenamiento").change(function() {
					$("#selectEntrenamiento option:selected").each(function() {
						valor = $("#selectEntrenamiento option:selected").val()
						$("#inputEntrenamiento").val(valor)
                        });
                    });             
                });

$(document).ready(function() {                       
                $("#selectSexo").change(function() {
					$("#selectSexo option:selected").each(function() {
						valor = $("#selectSexo option:selected").val()
						$("#inputSexo").val(valor)
                        });
                    });             
                });

$(document).ready(function() {                       
                $("#inputSeries").change(function() {				
						valor = $("#inputSeries").val();
						$("#inputSerie").val(valor);
                        });          
                	//});
				});

$(document).ready(function() {                       
                $("#selectCategoria").change(function() {
					$("#selectCategoria option:selected").each(function() {
						valor = $("#selectCategoria option:selected").val()
						$("#inputCategoria").val(valor)
                        });
                    });             
                });


$(document).ready(function() {                       
                $("#selectPileta").change(function() {
					$("#selectPileta option:selected").each(function() {
						valor = $("#selectPileta option:selected").val()
						$("#inputPileta").val(valor)
                        });
                    });             
                });

$(document).ready(function() {                       
                $("#selectDistancia").change(function() {
					$("#selectDistancia option:selected").each(function() {
						valor = $("#selectDistancia option:selected").val()
						$("#inputDistancia").val(valor)
                        });
                    });             
                });

$(document).ready(function() {                       
                $("#selectEstilo").change(function() {
					$("#selectEstilo option:selected").each(function() {
						valor = $("#selectEstilo option:selected").val()
						$("#inputEstilo").val(valor)
                        });
                    });             
                });					

$(document).ready(function() {                       
                $("#selectDistancia").change(function() {
					$("#selectDistancia option:selected").each(function() {
						valor = $("#selectDistancia option:selected").html() / $("#selectPileta option:selected").html()
						$("#cantidadParciales").val(valor)
                        });
                    });             
                });

$(document).ready(function() {                       
$("#selectPileta").change(function() {
	$("#selectPileta option:selected").each(function() {
		valor = $("#selectDistancia option:selected").html() / $("#selectPileta option:selected").html()
		$("#cantidadParciales").val(valor)
		});
	});
	$("#contenedor").css('visibility', 'visible');            
});



</script>


<style type="text/css">
.selects{
	font-size: 14px;
}
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
</style>
		<div onload="configurando()">
			<!-- <div>
				<a href="<?php echo base_url(); ?>cronometro/insercionManual" class="btn-primary" style="padding: 5px; text-decoration: none;">Ingresar tiempo manualmente</a>
			</div> -->	
			<div class="configuracion">
					<div class="selects">
						<h4>Configuración del cronómetro:</h4>
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
								<option value="<?= $pileta->ID ?>"><?= $pileta->Tamaño ?></option>
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
					</div>
				</div>
				
				<div class="nadadores" style="margin-top: 70px;">
					<label>Nadadores: </label>
					<select name="selectNadadores" id="selectNadadores">
						<?php foreach($nadadores->result() as $nadador) { ?>
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