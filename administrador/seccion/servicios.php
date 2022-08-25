<?php include("../template/cabecera.php");
include("../config/db.php");



$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtTitulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
$txtDes = (isset($_POST['txtDes'])) ? $_POST['txtDes'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
$txtImg = (isset($_FILES['txtImg']['name'])) ? $_FILES['txtImg']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

switch ($accion) {

    case ("Agregar"):

        //Agregar Productos

        $sentenciaSQL = $conexion->prepare("INSERT INTO servicios (Titulo, Descripcion, Precio, Imagen) VALUES (:Titulo, :Descripcion, :Precio, :Imagen);");

        $sentenciaSQL->bindParam(':Titulo', $txtTitulo);
        $sentenciaSQL->bindParam(':Descripcion', $txtDes);
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImg']['name'] : "imagen.jpg";

        $tmpImagem = $_FILES['txtImg']['tmp_name'];

        if ($tmpImagem != "") {

            move_uploaded_file($tmpImagem, "../../img/" . $nombreArchivo);
        }


        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL->execute();

        header('Location:servicios.php');

        break;
    case ("Cancelar"):

        header('Location:servicios.php');

        break;
    case ("Modificar"):

        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Titulo=:Titulo WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Titulo', $txtTitulo);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Descripcion=:Descripcion WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Descripcion', $txtDes);
        $sentenciaSQL->execute();
        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Precio=:Precio WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);
        $sentenciaSQL->execute();

        if ($txtImg != "") {

            $fecha = new DateTime();
            $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImg']['name'] : "imagen.jpg";

            $tmpImagem = $_FILES['txtImg']['tmp_name'];

            move_uploaded_file($tmpImagem, "../../img/" . $nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM servicios WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $items = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($items["Imagen"]) && ($items["Imagen"] != "imagen.jpg")) {

                if (file_exists("../../img/" . $items["Imagen"])) {

                    unlink("../../img/" . $items["Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Imagen=:Imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        header('Location:servicios.php');

        break;
    case ("Seleccionar"):

        $sentenciaSQL = $conexion->prepare("SELECT * FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $items = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtTitulo = $items['Titulo'];
        $txtDes = $items['Descripcion'];
        $txtPrecio = $items['Precio'];
        $txtImg = $items['Imagen'];

        break;
    case ("Borrar"):

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $items = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($items["Imagen"]) && ($items["Imagen"] != "imagen.jpg")) {

            if (file_exists("../../img/" . $items["Imagen"])) {

                unlink("../../img/" . $items["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        header('Location:servicios.php');
        break;
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
$listaServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Informacion Servicio Tecnico
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID">
                </div>

                <div class="form-group">
                    <label>Titulo del Servicio:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtTitulo; ?>" name="txtTitulo" id="txtTitulo" placeholder="Ingrese un Titulo del Servicio">
                </div>

                <div class="form-group">
                    <label>Descripcion:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtDes; ?>" name="txtDes" id="txtDes" placeholder="Ingrese la Descripcion del servicio a ofrecer">
                </div>

                <div class="form-group">
                    <label>Precio del Servicio:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Ingrese el precio del servicio ofrecido">
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
                <th>Titulo del Servicio</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Accion</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach ($listaServicios as $servicio) { ?>
                <tr>
                    <td><?php echo $servicio['ID']; ?></td>
                    <td><?php echo $servicio['Titulo']; ?></td>
                    <td><?php echo $servicio['Descripcion']; ?></td>
                    <td><?php echo $servicio['Precio']; ?></td>
                    <td>

                        <img class="img-thumbnail rounded" src="../../img/<?php echo $servicio['Imagen']; ?>" width="50" alt="">

                    </td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $servicio['ID']; ?>">
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

