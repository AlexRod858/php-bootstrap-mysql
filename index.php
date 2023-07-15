<?php include('./database/db.php') ?>
<?php include('./partials/header.php') ?>

<?php
if (isset($_POST['email']) && ($_POST['password'])) {
    $email = $_POST['email'];
    $contrasena = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado); // Obtener la fila de resultados

        $idUsuario = $row['id'];
        $nombreUsuario = $row['nombre'];
        session_start();
        $_SESSION['id'] = $idUsuario;
        $_SESSION['nombre'] = $nombreUsuario;
        $_SESSION['loggedin'] = true;
        header('Location: ./notas/index.php');
    }
}
?>


<form class="col-md-4 mx-auto mt-3 p-5 shadow" method="post" action="index.php">
    <h1>
        LOGIN
    </h1>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="./create_user.php" class="btn btn-secondary">Crear cuenta</a>
    <div class="container">
        <pre>Ejemplo:</pre>
        <pre>Email: pepe@gmail.com</pre>
        <pre>Password: pepepepe</pre>
    </div>
</form>






<?php include('./partials/footer.php') ?>