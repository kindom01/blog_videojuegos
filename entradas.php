    <!--cabecera-->
    <?php
        require_once "includes/cabecera.php";
    ?>

    <!--menu-->
        <!--menu lateral-->
        <?php
            require_once "includes/lateral.php";
        ?>

        <!--caja principal-->

        <div id="principal">
            <h1>Todas las entradas</h1>

            <?php
                $entradas = conseguirEntradas($db);
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

        </div>
    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>