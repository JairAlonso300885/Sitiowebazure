<?php
session_start();
include("config/db.php");

if ($_POST) {

    $txtCorreo = $_POST['correo'];
    $txtPass = $_POST['contraseña'];

    $sentenciaSQL = $conexion->prepare("SELECT * FROM tblusuarios WHERE Correo=:Correo AND Password=:Password");
    $sentenciaSQL->bindParam(':Correo', $txtCorreo, PDO::PARAM_STR);
    $sentenciaSQL->bindParam(':Password', $txtPass, PDO::PARAM_STR);
    $sentenciaSQL->execute();
    
    

    $numeroRegistros = $sentenciaSQL->rowCount();

    if ($numeroRegistros >= 1) {
        
        $_SESSION['Acceso'] = "ok";
          
        header('Location:inicio.php');
    } else {

        $mensaje = "Usuario o Contraseña incorrecto";
    }

    

}

?>

<!doctype html>
<html lang="es">

<head>
    <title>Ingreso a Administracion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>

    <div class="btn btn-secondary col-md-12">
        <h1 class="display-5">Bienvenido a la pagina administracion de Arc Technology</h1>
        <p class="lead">Debe Ingresar su correo y contraseña para acceder</p>

    </div>
    <div class="container">


        <br />

        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Accesos a Administracion
                    </div>
                    <div class="card-body">

                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje; ?>
                            </div>
                         <?php } ?>

                        <form method="POST">
                            <div class="form-group">
                                <label>Correo Electronico</label>
                                <input type="email" required name="correo" class="form-control" aria-describedby="emailHelp" placeholder="Ingrese su Correo">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" required name="contraseña" class="form-control" placeholder="Ingrese su Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar al Administrador</button>
                            <br>

                            <a href="registro.php">Registrate</a>
                        </form>



                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>