    <!--cabecera-->
    <?php
        require_once "includes/cabecera.php";
        ?>


            <!--obtener categoria por id-->
        <?php
            $categoria_actual = conseguirCategoria($db, $_GET['id']);
            if (!isset($categoria_actual['id'])) {
                # code...
                header('Location: index.php');
            }
        ?>

        <!--menu-->
        <!--menu lateral-->
        <?php
            require_once "includes/lateral.php";
        ?>

        <!--caja principal-->

        <div id="principal">

            <h1>Entradas de <?= $categoria_actual['nombre'];?></h1>

            <?php
                $entradas = conseguirEntradas($db, null, $_GET['id']);
                if (!empty($entradas)):
                    while($entrada = mysqli_fetch_assoc($entradas)):
            ?>
            <artticle class="entrada">
                <a href="entrada.php?id_entrada=<?= $entrada['id'];?>">
                    <h2><?= $entrada['titulo'];?></h2>
                    <p class="fecha"><?=substr($entrada['categoria'], 0 , 20)." | ".
                    $entrada['fecha'];?>
                    </p>
                    <p>
                        <?= substr($entrada['descripcion'], 0 , 200);?> ...
                    </p>
                </a>
            </artticle>

            <?php endwhile;
                  endif;?>

            <?php
                if (empty($entradas)):?>
                <h2>No hay entradas existentes :(</h2>
            <?php endif;?>
        </div>
    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>