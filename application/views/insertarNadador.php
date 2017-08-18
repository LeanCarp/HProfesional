<?= form_open('crearNadador/recibirDatos') ?>
<?=
	$dni = array(
		'name' => 'dni',
		'placeholder' => 'Escriba su DNI',
		);
	$nombre = array(
		'name' => 'nombre',
		'placeholder' => 'Escribe tu nombre',
		);

	$apellido = array(
		'name' => 'apellido',
		'placeholder' => 'Escriba su apellido',
		);
	$fechaNacimiento = array(
		'name' => 'fechaNacimiento',
		'placeholder' => 'Escriba su fecha de nacimiento',
		);
?>
<?= form_label('DNI: ', 'dni') ?>
<?= form_input($dni) ?>
<br>
<?= form_label('Nombre: ', 'nombre') ?>
<?= form_input($nombre) ?>
<br>
<?= form_label('Apellido: ', 'apellido') ?>
<?= form_input($apellido) ?>
<br>
<?= form_label('Fecha de Nacimiento: ', 'fechaNacimiento') ?>
<?= form_input($fechaNacimiento) ?>
<br>
<?= form_submit('', 'Subir nadador') ?>
<?= form_close() ?>
</body>
</html>