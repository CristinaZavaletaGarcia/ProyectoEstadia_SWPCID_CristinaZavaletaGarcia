<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio de sesión</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/Estilos.css">
</head>

<body>
  <?php
  $id= $_GET['id'];
  ?>
  <div class="registration-form">
    <form action="../Modelo/GenerarNuevoUsuario.php" method="POST">
      <div class="container" align="Center">
        <h1>Recuperación de contraseña</h1>
      </div>
      <div class="form-icon">
        <span><i class="icon icon-user"></i></span>
      </div>
      <div class="form-group">
      <input class="form-control" type="hidden" name="id" value="<?=$id?>">
        <input type="text" class="form-control item" id="Codigo" name="Codigo" placeholder="Codigo" required>
        <input type="text" class="form-control item" id="NewUser" name="NewUser" placeholder="Nuevo usuario" required>
        <button type="submit" class="btn btn-block create-account">Recuperar contraseña</button>
      </div>
    </form>
    <div class="social-media">
      <h5>Ma opciones</h5>
      <div class="social-icons">
        <a href="#">Inicio de sesión</a>
        </a>
      </div>
    </div>
    <!-- Button trigger modal -->
  </div>

  <footer align="Center">
    Derechos reservados © Cristina Zavaleta Garcia
  </footer>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>
  <script src="../Vista/js/modal.js"></script>
</body>

</html>