<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de sesión</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Estilos.css">
</head>
<body>
    <div class="registration-form">
        <form action="../Modelo/login.php" method="POST" style="text-align: center">
            <h1>Recuperar Contraseña</h1>
            <br>
            <div class="form-icon" >
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" name="email" placeholder="Correo Electronico" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Enviar</button>
            </div> 
        </form>   
        <div class="social-media">
            <div class="social-icons">
                <a href="../Vista/index_login.html">Iniciar sesión</a>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
