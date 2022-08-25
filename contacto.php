<?php include("template/cabecera.php"); ?>


<main>

    <div class="container py-3">

        <header class="mb-4 border-bottom">

            <h1 class="fs-4">Contacto</h1>

        </header>

        <div class="row">

            <div class="col-lg-6 col-md-12">

                <form action="" method="post" autocomplete="off">



                    <div class="mb-3">

                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre" name="nombre" autofocus>

                    </div>

                    <div class="mb-3">

                        <label for="email" class="form-label">Correo Electronico</label>
                        <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo electronico" name="correo" required>

                    </div>
                    <div class="mb-3">

                        <label for="asunto" class="form-label">Asunto</label>
                        <input type="text" class="form-control" id="asunto" placeholder="Ingresa aqui asunto para tu consulta" name="asunto" required>

                    </div>
                    <div class="mb-3">

                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-secondary">Enviar</button>

                </form>

            </div>

        </div>


    </div>
</main>





<?php include("template/pie.php"); ?>