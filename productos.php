<?php

include("template/cabecera.php");
include("administrador/config/db.php");



$sentenciaSQL = $conexion->prepare("SELECT * FROM tienda");
$sentenciaSQL->execute();
$listaTienda = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<br />



    

    <div class="row">

    <?php foreach ($listaTienda as $producto) { ?>
        <div class="col-md-3">

            <div class="card">

                <img height="317px"  title="<?php echo $producto['Referencia']; ?>" alt="<?php echo $producto['Referencia']; ?>" class="card-img-top" src="./img/<?php echo $producto['Imagen']; ?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="<?php echo $producto['Descripcion']; ?>">

                <div class="card-body">

                    <h5 class="card-title"><?php echo $producto['Referencia']; ?></h5>
                    <p class="card-text"><?php echo $producto['Marca']; ?></p>
                    <h5 class="card-title"><?php echo $producto['Precio_Venta']; ?> Pesos</h5>

                    <form action="" method="POST">

                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                        <input type="hidden" name="referencia" id="referencia" value="<?php echo openssl_encrypt($producto['Referencia'], COD, KEY); ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio_Venta'], COD, KEY); ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                        <button name="btnAccion" class="btn btn-primary" type="submit" value="Agregar">Agregar al Carrito</button>

                    </form>


                </div>

            </div>

        </div>
        <?php } ?>
    </div>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>




<?php include("template/pie.php"); ?>