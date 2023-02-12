    <!--cabecera-->
    <?php
        require_once "includes/cabecera.php";
        ?>


            <!--obtener categoria por id-->
        <?php
            $entrada_actual = conseguirEntrada($db, $_GET['id_entrada']);
            if (!isset($entrada_actual['id'])) {
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

        <div id="entrada">

            <h1><?= $entrada_actual['titulo'];?></h1>
            <a href="categoria.php?id=<?= $entrada_actual['categorias_id'];?>">
                <h2><?= $entrada_actual['categoria'];?></h2>
            </a>
            <h4><?= $entrada_actual['fecha'];?></h4>

            <p><?= $entrada_actual['descripcion'];?></p>
        
            <h5> Escrito por: <?= $entrada_actual['autor'];?>.</h5>

            <!--si existe el usuario aparecer botones de edicion-->
            <?php
                if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']):
            ?>

                <a href="editar_entrada.php?id_entrada=<?= $entrada_actual['id'];?>" class="boton boton-verde">Editar entrada</a>
                <a href="borrar_entrada.php?id_entrada=<?= $entrada_actual['id'];?>" class="boton boton-rojo">Borrar entrada</a>

            <?php endif; ?>
        </div>

    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>