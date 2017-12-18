function limpiar() {
	$("#competidores div").each(
		function () {
			divPadre = document.getElementById("competidores");
			eliminarNadador(this.lastChild);
		}
	)
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

function inputarTodos(){
    var cantParciales = $('#cantidadParciales').val();
    $('#competidores div').each(
        function ()
        {
            var id = $(this).attr('id');
            var inputFinal = [];
            inputFinal[0] = id;

            for (i=1; i <= cantParciales; i++)
            {
                var inputID = document.getElementById(String(id+(i)));
                inputFinal[i] = inputID.value;
            }

            var inputResultado = document.getElementById(id+'res');
            inputResultado.value = inputFinal;
            console.log(document.getElementById(id+'res'));
        }
    );
}

function validarInput(input){
	if ($(input).val() == "mm:ss:cc")
	{
		return false;
	}
	else
	{
		return true;
	}
}

$(document).ready(function() {                       
            
	$("#botonGuardar").click(function(event){
		event.preventDefault();
		

		var opcion = confirm("¿Está seguro que desea guardar? \n Datos mal cargados podrían generar problemas.");
		if (opcion == true) 
		{
			valido = true;
			var cantParciales = $('#cantidadParciales').val();
			$('#competidores div').each(
				function ()
				{
					var id = $(this).attr('id');
					var inputFinal = [];
					inputFinal[0] = id;
	
					for (i=1; i <= cantParciales; i++)
					{
						var inputID = document.getElementById(String(id+(i)));
						valido = validarInput(inputID);
						inputFinal[i] = inputID.value;
					}
	
					var inputResultado = document.getElementById(id+'res');
					inputResultado.value = inputFinal;
				}
			);

			if (valido)
			{
				$("#formCronometroManual").submit();
			}
			else
			{
				alert("Existe algún dato erróneo");
			}
		} 
	});
});

function inputar(e) {
	var cantParciales = document.getElementById("cantidadParciales").value;

	var inputAnterior = document.getElementById(e.id.substring(0, e.id.length-1)+'t');
	var siguienteDiv = parseInt(e.id.substring(e.id.length-1, e.id.length))+1;
	var inputSiguiente = document.getElementById(e.id.substring(0, e.id.length-1)+(siguienteDiv.toString()));

	tiempo = timeToSeconds(minutos.toString()+':'+segundos.toString()+':'+centesimas.toString());
	e.value = SecondsToTime(tiempo - inputAnterior.value);
	inputAnterior.value = tiempo;

	e.setAttribute("disabled", true);

	/* if (inputAnterior.value == 0)
	{
		e.value = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
		inputAnterior.value = timeToSeconds(e.value);

		e.setAttribute("disabled", true);
		inputSiguiente.removeAttribute("disabled");
	}
	else
	{
		
	} */

	//var inputResultado = document.getElementById(e.id.substring(0, e.id.length-1)+0);
	//inputResultado.value[e.id.substring(e.id.length-1, e.id.length)] = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
	
	//e.value = minutos.toString()+':'+segundos.toString()+':'+centesimas.toString();
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
		var idSeleccionado = document.getElementById("selectNadadores");
		if (idSeleccionado.options[idSeleccionado.selectedIndex].value == 0)
		{
			alert("No hay nadadores para agregar");
		}
		else
		{
			document.getElementById("botonGuardar").hidden = false;
			var cantParciales = document.getElementById("cantidadParciales").value;
			
			var pro = idSeleccionado.options[idSeleccionado.selectedIndex].value;
			var pro2 = idSeleccionado.options[idSeleccionado.selectedIndex].text;

		

			var divNadador = document.createElement("div");
			divNadador.setAttribute("id", pro);

			var inputResultado = document.createElement("input");
				inputResultado.setAttribute("name", "inputFinal[]");
				inputResultado.setAttribute("type", "hidden");
				inputResultado.setAttribute("id", pro+'res');
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
				inputSubmit.setAttribute("value", "Eliminar");
				inputSubmit.setAttribute("style", "background: #ba2020; color: white; width:50%; margin: 0 auto; font-size: 17px;");


			divNadador.className = 'box1';
			divNadador.appendChild(titulo);

			var inputParcial = document.createElement("input");
			inputParcial.setAttribute('name', 'inputs[]');
			inputParcial.setAttribute('id', pro+1);
			inputParcial.setAttribute('value', 'mm:ss:cc');
			inputParcial.setAttribute('style', 'margin-bottom: 15px;');
			divNadador.appendChild(inputParcial);

			for (i=2; i <= cantParciales; i++)
			{
				var inputParcial = document.createElement("input");
				inputParcial.setAttribute('name', 'inputs[]');
				inputParcial.setAttribute('id', pro+i);
				inputParcial.setAttribute('value', 'mm:ss:cc');
				inputParcial.setAttribute('style', 'margin-bottom: 15px;');
				divNadador.appendChild(inputParcial);
			}

			divNadador.appendChild(inputSubmit);

			divPadre = document.getElementById("competidores");
			divPadre.appendChild(divNadador);

			idSeleccionado.remove(idSeleccionado.selectedIndex);
		}
	}
	else
	{
		alert("¡Debe configurar el entrenamiento!");
	}
}

/* function obtenerNadadoresPorSexo(){
	
		sexo = $("#selectSexo option:selected").val();
		categoria = $("#selectCategoria option:selected").val();
		console.log(categoria);
	
		var parametros = {
				"sexo" : sexo,
				"categoria" : categoria
		};
	
		$.ajax({
				data:  parametros,
				url:   'cronometro/obtenerNadadores',
				type:  'post',
				success:  function (response) {
					$("#selectNadadores").html(response);
				}
		});
	} */

$(document).on('change','#selectPileta',function(){
	limpiar();
});

$(document).on('change','#selectDistancia',function(){
	limpiar();
});

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
							valor = $("#selectSexo option:selected").val();
							$("#inputSexo").val(valor);
							obtenerNadadoresPorSexo();
							});
						});
						//obtenerNadadoresPorSexo();           
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
			$("#inputCategoria").val(valor);
			obtenerNadadoresPorSexo();
			});
		});  
		//obtenerNadadoresPorSexo();     
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