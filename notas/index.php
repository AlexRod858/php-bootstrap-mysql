<?php include('../database/db.php') ?>
<?php include('../partials/header.php') ?>

<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>


<p >Hola: <?php echo $_SESSION['nombre']; ?></p>

<!-- ------------------------ -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body  bg-light">
                    <h4 class="card-title">Nuevo consejo</h4>
                    <form method="post" action="save_task.php">
                        <div class="mb-3">
                            <input name="titulo" type="text" class="form-control" id="tituloInput" placeholder="Escribe una nueva nota">
                        </div>
                        <button name="boton" type="submit" class="btn btn-success">Crear</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="row">
                <?php
                $query = "SELECT * FROM notas";
                $resultado = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_array($resultado)) {
                    $titulo = $row['titulo'];
                    $creado = $row['created_at'];
                    $id = $row['id'];
                    $id_usuario = $row['id_usuario']; // Obtener el ID de usuario de la tabla notas

                    $query2 = "SELECT * FROM usuarios WHERE id = $id_usuario";
                    $resultado2 = mysqli_query($conexion, $query2);

                    if (mysqli_num_rows($resultado2) > 0) {
                        $row2 = mysqli_fetch_assoc($resultado2);
                        $nombre_autor = $row2['nombre'];
                    } else {
                        $nombre_autor = "Desconocido";
                    }

                    // ----------------------------------------
                ?>
                    <div class="col-md-6">
                        <div class="card mb-4   shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $titulo ?></h5>

                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $creado ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Autor: <?php echo $nombre_autor ?></h6>
                                <a class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $id ?>">Ver</a>
                                <?php
                                if ($id_usuario == $_SESSION['id']) {
                                ?>
                                    <a href="./edit_task.php?id=<?php echo $id ?>" class="btn btn-warning shadow-sm">Editar</a>
                                    <a href="./delete_task.php?id=<?php echo $id ?>" class="btn btn-danger shadow-sm">Eliminar</a>
                                <?php
                                };
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal-<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel-<?php echo $id ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel-<?php echo $id ?>"><?php echo $titulo ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <pre class="card-subtitle mb-2">Autor: <?php echo $nombre_autor ?></pre>
                                    <pre class="card-subtitle mb-2">Id: <?php echo $id ?></pre>
                                    <pre class="card-subtitle mb-2">Creado: <?php echo $creado ?></pre>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include('../partials/footer.php') ?>