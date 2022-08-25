<?php include("../template/cabecera.php");
include("../config/db.php");



$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtRef = (isset($_POST['txtRef'])) ? $_POST['txtRef'] : "";
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca'] : "";
$txtDes = (isset($_POST['txtDes'])) ? $_POST['txtDes'] : "";
$txtPrecioV = (isset($_POST['txtPrecioV'])) ? $_POST['txtPrecioV'] : "";
$txtPrecioC = (isset($_POST['txtPrecioC'])) ? $_POST['txtPrecioC'] : "";
$txtCant = (isset($_POST['txtCant'])) ? $_POST['txtCant'] : "";
$txtImg = (isset($_FILES['txtImg']['name'])) ? $_FILES['txtImg']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {

    case ("Agregar"):

        //Agregar Productos

        $sentenciaSQL = $conexion->prepare("INSERT INTO tienda (Referencia, Marca, Descripcion, Precio_Venta, Precio_Costo, Cantidad, Imagen) VALUES (:Referencia, :Marca, :Descripcion, :Precio_Venta, :Precio_Costo, :Cantidad, :Imagen);");

        $sentenciaSQL->bindParam(':Referencia', $txtRef);
        $sentenciaSQL->bindParam(':Marca', $txtMarca);
        $sentenciaSQL->bindParam(':Descripcion', $txtDes);
        $sentenciaSQL->bindParam(':Precio_Venta', $txtPrecioV);
        $sentenciaSQL->bindParam(':Precio_Costo', $txtPrecioC);
        $sentenciaSQL->bindParam(':Cantidad', $txtCant);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImg']['name'] : "imagen.jpg";

        $tmpImagem = $_FILES['txtImg']['tmp_name'];

        if ($tmpImagem != "") {

            move_uploaded_file($tmpImagem, "../../img/" . $nombreArchivo);
        }


        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL->execute();

        header('Location:productos.php');

        break;
    case ("Cancelar"):

        header('Location:productos.php');

        break;
    case ("Modificar"):

        $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Referencia=:Referencia WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Referencia', $txtRef);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Marca=:Marca WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Marca', $txtMarca);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Descripcion=:Descripcion WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Descripcion', $txtDes);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Precio_Venta=:Precio_Venta WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Precio_Venta', $txtPrecioV);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Precio_Costo=:Precio_Costo WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Precio_Costo', $txtPrecioC);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Cantidad=:Cantidad WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Cantidad', $txtCant);
        $sentenciaSQL->execute();

        if ($txtImg != "") {

            $fecha = new DateTime();
            $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImg']['name'] : "imagen.jpg";

            $tmpImagem = $_FILES['txtImg']['tmp_name'];

            move_uploaded_file($tmpImagem, "../../img/" . $nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM tienda WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $items = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($items["Imagen"]) && ($items["Imagen"] != "imagen.jpg")) {

                if (file_exists("../../img/" . $items["Imagen"])) {

                    unlink("../../img/" . $items["Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE tienda SET Imagen=:Imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        header('Location:productos.php');

        break;
    case ("Seleccionar"):

        $sentenciaSQL = $conexion->prepare("SELECT * FROM tienda WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $items = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtRef = $items['Referencia'];
        $txtMarca = $items['Marca'];
        $txtDes = $items['Descripcion'];
        $txtPrecioV = $items['Precio_Venta'];
        $txtPrecioC = $items['Precio_Costo'];
        $txtCant = $items['Cantidad'];
        $txtImg = $items['Imagen'];

        break;
    case ("Borrar"):

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM tienda WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $items = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($items["Imagen"]) && ($items["Imagen"] != "imagen.jpg")) {

            if (file_exists("../../img/" . $items["Imagen"])) {

                unlink("../../img/" . $items["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM tienda WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header('Location:productos.php');
        break;
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM tienda");
$sentenciaSQL->execute();
$listaTienda = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Informacion Productos
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID">
                </div>

                <div class="form-group">
                    <label>Referencia:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtRef; ?>" name="txtRef" id="txtRef" placeholder="Ingrese Referencia del producto">
                </div>


                <div class="form-group">
                    <label>Marca:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtMarca; ?>" name="txtMarca" id="txtMarca" placeholder="Ingresa la Marca del producto">
                </div>


                <div class="form-group">
                    <label>Descripcion:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtDes; ?>" name="txtDes" id="txtDes" placeholder="Ingrese la Descripcion del producto">
                </div>

                <div class="form-group">
                    <label>Precio Venta:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtPrecioV; ?>" name="txtPrecioV" id="txtPrecioV" placeholder="Ingrese el precio de venta del pruducto">
                </div>

                <div class="form-group">
                    <label>Precio Costo:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtPrecioC; ?>" name="txtPrecioC" id="txtPrecioC" placeholder="Ingrese el precio de costo del pruducto">
                </div>


                <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtCant; ?>" name="txtCant" id="txtCant" placeholder="Ingrese Cantidad de productos a la venta">
                </div>

                <div class="form-group">

                    <label>Imagen:</label>
                    <br>

                    <?php if ($txtImg != "") { ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImg; ?>" width="50" alt="">
                    <?php   }   ?>


                    <input type="file" class="form-control" name="txtImg" id="txtImg" placeholder="Ingrese una imagen del producto">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>




            </form>

        </div>

    </div>





</div>

<div class="col-md-7">

    <table class="table table-secondary table-bordered">
        <thead>

            <tr>
                <th>ID</th>
                <th>Referencia</th>
                <th>Marca</th>
                <th>Descripcion</th>
                <th>Precio Venta</th>
                <th>Precio Costo</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <th>Accion</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach ($listaTienda as $tienda) { ?>
                <tr>
                    <td><?php echo $tienda['ID']; ?></td>
                    <td><?php echo $tienda['Referencia']; ?></td>
                    <td><?php echo $tienda['Marca']; ?></td>
                    <td><?php echo $tienda['Descripcion']; ?></td>
                    <td><?php echo $tienda['Precio_Venta']; ?></td>
                    <td><?php echo $tienda['Precio_Costo']; ?></td>
                    <td><?php echo $tienda['Cantidad']; ?></td>
                    <td>

                        <img class="img-thumbnail rounded" src="../../img/<?php echo $tienda['Imagen']; ?>" width="50" alt="">

                    </td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $tienda['ID']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                        </form>

                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include("../template/pie.php"); ?>