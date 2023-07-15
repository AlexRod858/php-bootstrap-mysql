<?php include('../database/db.php') ?>
<?php include('../partials/header.php') ?>

<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}
?>




<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "SELECT * FROM notas WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_array($resultado);
        $titulo = $row['titulo'];
    }
};



?>
<form class="container col-sm-3 shadow p-4 mt-5" method="post" action="edit_task.php?id=<?php echo $_GET['id']; ?>">
    <div class="form-group">
        <h4 for="exampleInputEmail1">Actualizar título</h4>
        <input type="text" name="titulo" class="form-control" value="<?php echo $titulo ?>">
        <small id="emailHelp" class="form-text text-muted">¿De qué manera lo quieres renombrar?</small>
    </div>


    <button name="actualizar" type="submit" class="btn btn-primary">Renombrar</button>
</form>


<?php
if (isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $titulo = $_POST['titulo'];

    $query = "UPDATE notas set titulo = '$titulo' WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);
    header('Location: ./');
}

?>

<?php include('../partials/footer.php') ?>