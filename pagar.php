<?php

include("template/cabecera.php");
include("administrador/config/db.php");

?>

<?php




if ($_POST) {

    $total = 0;
    $SID = session_id();
    $paypalDatos = "";
    $email = "alex626_7@hotmail.com";
    $direccion = "calle 30 ·# 33-29 b/ victoria";
    $telefono = 6022241446;
    $nombre = "Alexander Rengifo Cardona";
    $dni = 1116254510;
    $status = "pendiente";
    foreach ($_SESSION['CARRITO'] as $indice => $producto) {

        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $sentenciaSQL = $conexion->prepare("INSERT INTO `tblventas` 
            (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Direccion`, `Telefono`, `Nombre`, `DNI`, `Total`, `status`) 
    VALUES (NULL, :ClaveTransaccion, :PaypalDatos, NOW(), :Correo, :Direccion, :Telefono, :Nombre, :DNI, :Total, :status);");

    $sentenciaSQL->bindParam(':ClaveTransaccion', $SID);
    $sentenciaSQL->bindParam(':PaypalDatos', $paypalDatos);
    $sentenciaSQL->bindParam(':Correo', $email);
    $sentenciaSQL->bindParam(':Direccion', $direccion);
    $sentenciaSQL->bindParam(':Telefono', $telefono);
    $sentenciaSQL->bindParam(':Nombre', $nombre);
    $sentenciaSQL->bindParam(":DNI", $dni);
    $sentenciaSQL->bindParam(":Total", $total);
    $sentenciaSQL->bindParam(":status", $status);
    $sentenciaSQL->execute();
    $idVenta = $conexion->lastInsertId();

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {

        $sentenciaSQL = $conexion->prepare("INSERT INTO `tbldetalleventa`
        (`ID`, `IDPRODUCTO`, `IDVENTA`, `PRECIO_UNITARIO`, `CANTIDAD`, `DESCARGADO`) 
        VALUES (NULL, :IDPRODUCTO, :IDVENTA, :PRECIO_UNITARIO, :CANTIDAD, '0');");

        $sentenciaSQL->bindParam(':IDPRODUCTO', $producto['ID']);
        $sentenciaSQL->bindParam(":IDVENTA", $idVenta);
        $sentenciaSQL->bindParam(":PRECIO_UNITARIO", $producto['PRECIO']);
        $sentenciaSQL->bindParam(":CANTIDAD", $producto['CANTIDAD']);
        $sentenciaSQL->execute();
    }
}



?>

<script src="https://www.paypal.com/sdk/js?client-id=AeHClc5ofXHi_-ZpxKJFbeFtzHFdI9jV3uHwALyNJhUnZyJeKnbGBHyA_Y4kRSQMtL3TYO-OTyQWAMeD&currency=USD"></script>

<style>
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }

    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 300px;
            display: inline-block;
        }
    }
</style>

<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-2">
    <p class="lead">Estas a punto de pagar la cantidad de: </p>

    <h4>$ <?php echo number_format($total, 2); ?></h4>


    <div id="paypal-button-container"></div>


</div>

<p>Tretaremos de enviar tu paquete lo mas pronto posiblle</p>

<strong>escribenos a arctechnologyoficial@gmail.com</strong> <br /><br />


</div>

<script>
    paypal.Buttons({

        

        style: {
            label: 'pay', // checkout | credit | pay | buynow | generic
            size: 'responsive', // small | medium | large | responsive
            shape: 'pill', // pill | rect
            color: 'blue' // gold | blue | silver | black
        },

        createOrder: function(data, actions) {
            return actions.order.create({

                purchase_units: [{
                    amount: {
                        value: <?php echo $total; ?>
                        
                    },
                   
                }]

            });
        },

        onApprove: function(data, actions) {
            actions.order.capture().then(function(detalles) {

                console.log(detalles);
                console.log(data);
               // window.location.href="verificador.php"
            });
        },

        onCancel: function(data) {
            alert("Pago Cancelado");
            console.log(data);
        },

    }).render('#paypal-button-container');
</script>




<?php include("template/pie.php"); ?>