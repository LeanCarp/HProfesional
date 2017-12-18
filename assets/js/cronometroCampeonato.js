var centesimas = 0;
var segundos = 0;
var minutos = 0;
function inicio () {

	if ($("#competidores div").size() == 0)
		{
			alert("¡Debe seleccionar al menos un nadador!");
		}
		else
		{
			$("#competidores div").each(function (){
				this.childNodes[3].disabled=false;
			});

			control = setInterval(cronometro,10);
			document.getElementById("inicio").disabled = true;
			document.getElementById("parar").disabled = false;
			document.getElementById("continuar").disabled = true;
			document.getElementById("reinicio").disabled = false;
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

	$("#competidores div input").each(
		function () {
			if (this.type != "button"){
				this.value = "";
			}
	});
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

function limpiar() {
	reinicio();
	$("#competidores div").each(
		function () {
			divPadre = document.getElementById("competidores");
			eliminarNadador(this.lastChild);
		}
	)

	//reinicio();
}

function timeToSeconds(time) {
	time = time.split(/:/);
    return parseInt(time[0]) * 60 + parseInt(time[1]) + parseInt(time[2]) * 0.01;
}

function SecondsToTime(seconds){
	result = seconds / 60;
	min = Math.trunc(result);
	if (min < 10) {min = '0'+min.toString();}
	result = (result-min) * 60;
	seg = Math.trunc(result);
	if (seg < 10) {seg = '0'+seg.toString();}
	result = Math.round((result-seg) * 100);
	cent = Math.trunc(result);
	if (cent < 10) {cent = '0'+cent.toString();}
	return min.toString()+':'+seg.toString()+':'+Math.round(cent).toString();
}

function inputar(e) {
	var cantParciales = document.getElementById("cantidadParciales").value;

	var inputTiempoTotal = document.getElementById(e.id.substring(0, e.id.length-1)+'tt');
	inputTiempoTotal.innerHTML = "Tiempo total: "+minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();

	var inputAnterior = document.getElementById(e.id.substring(0, e.id.length-1)+'t');
	var siguienteDiv = parseInt(e.id.substring(e.id.length-1, e.id.length))+1;
	var inputSiguiente = document.getElementById(e.id.substring(0, e.id.length-1)+(siguienteDiv.toString()));

	tiempo = timeToSeconds(minutos.toString()+':'+segundos.toString()+':'+centesimas.toString());
	e.value = SecondsToTime(tiempo - inputAnterior.value);
	inputAnterior.value = tiempo;

	e.setAttribute("disabled", true);

	if (e.id.substring(e.id.length-1, e.id.length) == cantParciales)
	{
		inputarFinal(e.id.substring(0, e.id.length-1), cantParciales);
	}
	else
	{
		inputSiguiente.removeAttribute("disabled");
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
}

function eliminarNadador(input) {
	if ($("#competidores div").size() == 1)
	{
		document.getElementById("botonGuardar").hidden = true;
	}

	divPadre = document.getElementById("competidores");
	divHijo = document.getElementById(input.id.substring(0, input.id.length-1));
	divPadre.removeChild(divHijo);

	var miOption = document.createElement("option");
	miOption.setAttribute("value",input.id.substring(0, input.id.length-1));
	miOption.text = divHijo.childNodes[2].innerHTML;

	var selectNadadores = document.getElementById("selectNadadores");
	selectNadadores.appendChild(miOption);
}

function agregarNadador() {
		document.getElementById("botonGuardar").hidden = false;
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

		var inputAnterior = document.createElement("input");
			inputAnterior.setAttribute("name", "inputAnterior");
			inputAnterior.setAttribute("type", "hidden");
			inputAnterior.setAttribute("id", pro+'t');
			inputAnterior.value = 0;
			divNadador.appendChild(inputAnterior);

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

		var inputTiempoTotal = document.createElement("h6");
			inputTiempoTotal.setAttribute("id", pro+'tt');
			inputTiempoTotal.innerHTML="Tiempo total: 00:00:00";

		var inputSubmit = document.createElement("input");
			inputSubmit.setAttribute("type", "button");
			inputSubmit.setAttribute("id", pro+0);
			inputSubmit.setAttribute("onclick", "eliminarNadador(this);");
			inputSubmit.setAttribute("value", "Eliminar");
			inputSubmit.className += "btnEliminar";
			//inputSubmit.setAttribute("style", "background: #ba2020; color: white; width:50%; margin: 0 auto; font-size: 17px;");


		divNadador.className = 'box1';
		divNadador.appendChild(titulo);
		//divNadador.setAttribute('onclick', 'parcialito(this);');

		var inputParcial = document.createElement("input");
		inputParcial.setAttribute('name', 'inputs[]');
		inputParcial.setAttribute('id', pro+1);
		//inputParcial.setAttribute('value', '0:0:0');
		console.log(inputParcial.id);
		inputParcial.readOnly  = true;
		inputParcial.setAttribute('onclick', 'inputar(this);');
		inputParcial.setAttribute('style', 'margin-bottom: 15px;');
		inputParcial.setAttribute("disabled", true);
		divNadador.appendChild(inputParcial);

		for (i=2; i <= cantParciales; i++)
		{
			var inputParcial = document.createElement("input");
			inputParcial.setAttribute('name', 'inputs[]');
			inputParcial.setAttribute('id', pro+i);
			//inputParcial.setAttribute('value', '0:0:0');
			console.log(inputParcial.id);
			inputParcial.readOnly  = true;
			inputParcial.setAttribute('onclick', 'inputar(this);');
			inputParcial.setAttribute('style', 'margin-bottom: 15px;');
			inputParcial.setAttribute("disabled", true);
			divNadador.appendChild(inputParcial);
		}

		divNadador.appendChild(inputTiempoTotal);
		divNadador.appendChild(inputSubmit);

		divPadre = document.getElementById("competidores");
		divPadre.appendChild(divNadador);

		idSeleccionado.remove(idSeleccionado.selectedIndex);

		/* for (i=1; i <= cantParciales; i++)
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

		idSeleccionado.remove(idSeleccionado.selectedIndex); */
}