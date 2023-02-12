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
        <?php if(isset($_SESSION["completado"])): ?>
            <div class="alerta" class="bloque">
                <?=$_SESSION["completado"];?>
            </div>
        <?php endif; ?>
        <?php borrarErrores();?>
            <h1>Ultimas Entradas</h1>

            <?php
                $entradas = conseguirEntradas($db , true);
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

            <div id="ver-todas">
                <a href="entradas.php">Ver todas las entradas</a>
            </div>

        </div>
    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>