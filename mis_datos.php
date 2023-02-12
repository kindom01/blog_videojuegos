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
        <h1>Modificar Mis Datos</h1>

        <!--mostrar errores-->
        <?php if(isset($_SESSION["completado"])): ?>
                <div class="alerta">
                    <?= $_SESSION["completado"]?> 
                </div>
            <?php elseif(isset($_SESSION["errores"]["general"])): ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION["errores"]["general"]?> 
                </div>
        <?php endif; ?>

        <!--insercion de datos-->
        <form action="cambiar_datos.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']?>" />
            <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "nombre") : "";?>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?=$_SESSION['usuario']['apellidos']?>" />
            <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "apellidos") : "";?>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>" />
            <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "email") : "";?>

            <input type="submit" name = "submit" value="Enviar"/>
        </form>
        <?php borrarErrores(); ?>
    </div>
    
    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>