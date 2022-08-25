<?php

include("template/cabecera.php");
include("administrador/config/db.php");




?>
<br />
<div class="row">




    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <h3>Lista Carrito</h3>
        <?php if (!empty($_SESSION['CARRITO'])) { ?>
            <table class="table table-ligth table-bordered">


                <thead>

                    <tr>
                        <th width="40%">Descripcion</th>
                        <th width="5%" class="text-center">Cantidad</th>
                        <th width="20%" class="text-center">Precio</th>
                        <th width="30%" class="text-center">Total</th>
                        <th width="5%">--</th>
                    </tr>

                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
                        <tr>


                            <td width="40%"><?php echo $producto['REFERENCIA']; ?></td>
                            <td width="5%" class="text-center"><?php echo $producto['CANTIDAD']; ?></td>
                            <td width="20%" class="text-center"><?php echo $producto['PRECIO']; ?></td>
                            <td width="30%" class="text-center"><?php echo number_format($producto['CANTIDAD'] * $producto['PRECIO'], 2); ?></td>


                            <td width="5%">
                                <form action="" method="POST">

                                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                                    <button class="btn btn-danger" name="btnAccion" type="submit" value="Eliminar">Eliminar</button>
                                </form>
                            </td>


                            <?php $total = $total + $producto['CANTIDAD'] * $producto['PRECIO']; ?>
                        <?php } ?>



                        <tr>
                            <td colspan="3" align="right">
                                <h3>Total:</h3>
                            </td>
                            <td align="right">
                                <h3> $ <?php echo number_format($total, 2); ?></h3>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="5">

                                <form action="pagar.php" method="post">

                                <div class="alert alert-secondary" role="alert">

                                <div class="form-group">

                                        <label for="">Correo de Contacto:</label>
                                        <input required type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu correo Electronico">

                                        <label for="">Direccion de entrega:</label>
                                        <input required type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingresa la Direccion de entrega">

                                        <label for="">Telefono de contacto:</label>
                                        <input required type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingresa tu Telefono de contacto">

                                        <label for="">Nombre completo:</label>
                                        <input required type="text" name="nombreCliente" id="nombreCliente" class="form-control" placeholder="Ingresa tu Nombre completo">

                                        <label for="">Documento de Identidad:</label>
                                        <input required type="text" name="dni" id="dni" class="form-control" placeholder="Ingresa tu Documento de Identidad">

                                    </div>

                                    <small id="emailHelp" class="form-text text-muted" > Los productos seran enviados a la informacion que nos susministres</small>
                                    
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="btnAccion" value="proceder">Proceder Al pago</button>
                                    
                                </form>
                            </td>

                        </tr>


                </tbody>
            </table>
        <?php } else { ?>

            <div class="alert alert-success">
                no hay productos en el carrito
            </div>


    </div>

<?php } ?>
</div>


<?php include("template/pie.php"); ?>