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
        <h1>Crear Entrada</h1>

        <form action="guardar_entrada.php" method="post">
            <label for="titulo">Tiutlo de la Entrada</label>
            <input type="text" name="titulo" />
            <?php echo isset($_SESSION['error_entrada']) ? mostrarError($_SESSION['error_entrada'], 'titulo') : '';?>

            <label for="categoria">Categoria:</label>
            <select name="categoria" id="">
                <?php 
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)): 
                ?>
                        <option value="<?= $categoria['id']?>">
                            <?= $categoria['nombre']?>
                        </option>
                
                <?php endwhile; 
                endif; ?>
                <?php echo isset($_SESSION['error_entrada']) ? mostrarError($_SESSION['error_entrada'], 'categoria') : '';?>
            </select>

            <label for="descripcion">Descripcion de la Entrada</label>
            <textarea name="descripcion" ></textarea>
            <?php echo isset($_SESSION['error_entrada']) ? mostrarError($_SESSION['error_entrada'], 'descripcion') : '';?>

            <input type="submit" value="Guardar" />
        </form>
        <?php borrarErrores();?>
    </div>
    
    <!--pie de pagina-->
    
    <?php
        require_once "includes/pie.php";
    ?>