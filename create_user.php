<?php include('./database/db.php') ?>
<?php include('./partials/header.php') ?>

<?php 

   
    if(isset($_POST['nombre']) && ($_POST['email']) && ($_POST['password'])){
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasena = $_POST['password'];

        $query = "INSERT into usuarios (nombre, email, contrasena) VALUES ('$nombre','$email','$contrasena')";
        $resultado = mysqli_query($conexion, $query);

        header('Location: ./login.php');
    }
?>


<form method="post" action="create_user.php" class="col-md-3 mx-auto">
    <h1>Registrar</h1>
<div class="form-group">
    <label>Nombre</label>
    <input name="nombre" type="text" class="form-control">
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input name="email" type="email" class="form-control">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>




<?php include('./partials/footer.php') ?>