<?php

define("KEY", "Alex093020");
define("COD", "AES-128-ECB");

session_start();

include("carrito.php");
?>

<!doctype html>
<html lang="es">

<head>
    <title>Arc Technology</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=+573005673702&text=Hola! Quisiera más información sobre Arc Technology." class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="nav navbar-nav active">

            <img src="img/logo-negro.jpeg" width="50" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="productos.php">Tienda</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="servicios.php">Servicios</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="contacto.php">Contactanos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Acceder</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="mostrarCarrito.php">Carrito(<?php

                                                                        echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']);


                                                                        ?>)</a>
            </li>

        </ul>
    </nav>


    <div class="container">
        <br>

        <?php if ($mensaje != "") { ?>
            <div class="alert alert-success" role="alert">

                <?php echo $mensaje; ?>
                <a href="mostrarCarrito.php" class="badge badge-success">Ver Carrito</a>

            </div>
        <?php } ?>