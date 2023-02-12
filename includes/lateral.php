
<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar Entrada</h3>

        <form action="buscar.php" method="POST">
            <label for="busqueda"></label>
            <input type="text" name="busqueda" />
            <input type="submit" name = "submit" value="Buscar"/>
        </form>
    </div>

    <?php if(isset($_SESSION["usuario"])): ?>
    <div id="usuario-logueado" class="bloque">
        <h3>Bienvenido, <?=$_SESSION["usuario"]["nombre"].' '.$_SESSION["usuario"]["apellidos"];?></h3>
    
        <a href="crear_entradas.php" class="boton">Crear entrada</a>
        <a href="crear_categoria.php" class="boton">Crear categoria</a>
        <a href="mis_datos.php" class="boton">Mis datos</a>
        <a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>

    </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION["usuario"])): ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>

            <?php if(isset($_SESSION["error_login"])): ?>
            <div class="alerta alerta-error" class="bloque">
                <?=$_SESSION["error_login"];?>
            </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />
                
                <label for="password">Contraseña</label>
                <input type="password" name="password"/>

                <input type="submit" name = "submit" value="Entrar"/>
            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Registrate</h3>

            <!--mostrar errores-->
            <?php if(isset($_SESSION["completado"])): ?>
                <div class="alerta">
                    <?= $_SESSION["completado"]?> 
                </div>
            <?php elseif(isset($_SESSION["errores"]["general"])): ?>
                <div class="alerta">
                    <?= $_SESSION["errores"]["general"]?> 
                </div>
            <?php endif; ?>

            <!--insercion de datos-->
            <form action="register.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "nombre") : "";?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos"/>
                <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "apellidos") : "";?>

                <label for="email">Email</label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "email") : "";?>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>
                <?php echo isset($_SESSION["errores"]) ? mostrarError($_SESSION["errores"] , "password") : "";?>

                <input type="submit" name = "submit" value="Entrar"/>
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>