<?php require_once "includes/cabecera.php";?>
    <!--cabecera-->
    <?php
        require_once "includes/redireccion.php";
    ?>

    <!--menu-->
        <!--menu lateral-->
        <?php
            require_once "includes/lateral.php";
        ?>
    
    <div id="principal">
        <h1>Crear Categoria</h1>

        <form action="guardar_categoria.php" method="post">
            <label for="nombre">Nombre de la Categoria</label>
            <input type="text" name="nombre" />

            <input type="submit" value="Guardar" />
        </form>
        <?php if(isset($_SESSION["error_categoria"])): ?>
            <div class="alerta alerta-error" class="bloque">
                <?=$_SESSION["error_categoria"];?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION["guardaro_completado"])): ?>
            <div class="alerta" class="bloque">
                <?=$_SESSION["guardaro_completado"];?>
            </div>
        <?php endif; ?>
        <?php borrarErrores();?>
    </div>
    
    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>