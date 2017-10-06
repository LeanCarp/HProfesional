<html>
<head>
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles.css">
</head>
<body class="login-body">
  <div class="col-md-4 login-container">
      <h1 style="text-align:center">Iniciar sesión</h1>
      <p>Por favor, inicie sesión con su email/usuario y contraseña.</p>
      <?php echo form_open("auth/login");?>
      <div class="row">

        <div class="col"><?php echo lang('login_identity_label', 'identity');?></div>
        <div class="col"><?php echo form_input($identity);?></div>
        <div class="w-100"></div>
        <div class="col"><?php echo lang('login_password_label', 'password');?></div>
        <div class="col"><?php echo form_input($password);?></div>
      </div>

      <div class="row login-opciones">
        <div class="col"><?php echo form_submit('submit', 'Ingresar');?></div>
        <div class="col"><?php echo 'Recordar';?>
           <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?></div>    
                 <?php echo form_close();?>
      </div>

      <p><a class="row login-opciones login-container" href="forgot_password"><?php echo '¿Olvidaste tu contraseña?';?></a></p>
    

  </div>
</body>
</html>