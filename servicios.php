<?php include("template/cabecera.php");

include("administrador/config/db.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
$listaServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<br/><br/>
<div class="row">


<?php foreach ($listaServicios as $servicio) { ?>


    
        <div class="col-md-3">

            <div class="card">
                <img height="317px" title="<?php echo $servicio['Titulo']; ?>" alt="<?php echo $servicio['Titulo']; ?>" class="card-img-top" src="./img/<?php echo $servicio['Imagen'] ?>" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="<?php echo $servicio['Descripcion']; ?>">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $servicio['Titulo']; ?></h4>

                    <p class="card-text"><?php echo $servicio['Precio']; ?> Pesos</p>

                    <a class="btn btn-secondary" target="_blank" href="https://api.whatsapp.com/send?phone=+573005673702&text=Hola! Quisiera más información sobre los servicios Arc Technology.">¡¡Quiero contratar este Servicio!!</a>


                </div>
            </div>
            <br />
            <br />
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