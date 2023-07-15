<?php include('../database/db.php') ?>

<?php 
session_start();

if(isset($_POST['boton'])){

    $id = $_SESSION['id'];
    $titulo= $_POST['titulo'];


    $query = "INSERT INTO notas (id_usuario, titulo) VALUES ('$id','$titulo')";
    $resultado = mysqli_query($conexion, $query);

    header('Location: ./');

}
?>