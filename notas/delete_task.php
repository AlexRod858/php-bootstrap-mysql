<?php include('../database/db.php') ?>


<?php 

    if(isset($_GET['id'])){
        $id=  $_GET['id'];
        $query = "DELETE FROM notas WHERE id = $id";
        $resultado = mysqli_query($conexion, $query);
        header('Location: ./');
    }

?>