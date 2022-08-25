<?php
include("config/db.php");

if($_POST){

$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellido = (isset($_POST['txtApellido'])) ? $_POST['txtApellido'] : "";
$txtTelefono = (isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : "";
$txtDocIden = (isset($_POST['txtDocIden'])) ? $_POST['txtDocIden'] : "";
$txtcorreo = (isset($_POST['txtcorreo'])) ? $_POST['txtcorreo'] : "";
$txtPass = (isset($_POST['txtPass'])) ? $_POST['txtPass'] : "";

$sentenciaSQL = $conexion->prepare("INSERT INTO tblusuarios (Nombre, Apellidos, Telefono, Documento, Correo, Password) VALUES 
(:Nombre, :Apellidos, :Telefono, :Documento, :Correo, :Password);");

$sentenciaSQL->bindParam(':Nombre', $txtNombre);
$sentenciaSQL->bindParam(':Apellidos', $txtApellido);
$sentenciaSQL->bindParam(':Telefono', $txtTelefono);
$sentenciaSQL->bindParam(':Documento', $txtDocIden);
$sentenciaSQL->bindParam(':Correo', $txtcorreo);
$sentenciaSQL->bindParam(':Password', $txtPass);
$sentenciaSQL->execute();

header('Location:registro.php');

}

?>

<!doctype html>
<html lang="es">

<head>
    <title>Registro de Usuarios</title>
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
        <h1 class="display-5">Bienvenido a la pagina registo de usuarios de la administracion de Arc Technology</h1>
        <p class="lead">Debe Ingresar todos sus datos personales</p>

    </div>
    <div class="container">


        <br />

        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Accesos a Administracion
                    </div>
                    <div class="card-body">

                        <form method="POST">

                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingresa tu Nombre Completo">
                            </div>

                            <div class="form-group">
                                <label>Apellidos:</label>
                                <input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Ingresa tus Apellidos">
                            </div>

                            <div class="form-group">
                                <label>Telefono de Contacto:</label>
                                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Puede ser Celular, fijo o ambos">
                            </div>

                            <div class="form-group">
                                <label>Documento Identidad:</label>
                                <input type="text" class="form-control" id="txtDocIden" name="txtDocIden" placeholder="Ingresa tu Documento Identidad">
                            </div>

                            <div class="form-group">
                                <label>Correo:</label>
                                <input type="email" class="form-control" id="txtcorreo" name="txtcorreo" placeholder="Ingresa tu correo electronico">
                            </div>

                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" id="txtPass" name="txtPass" placeholder="Ingresa tu contraseña">
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <br/>
                            <a href="index.php">Ingresar a la Administracion</a>
                            <br/>
                        </form>

                    </div>
                    
                </div>

            </div>

        </div>
        <br/><br/>
    </div>

</body>

</html>

