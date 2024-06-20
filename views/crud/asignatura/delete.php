<?php

include "../../../model/middleware.php";

$ID_Asignatura = intval($_GET['ID']);

if (isset($_POST['submit'])) {
    $consultaAsignatura = $conexion->query("SELECT * FROM curso WHERE ID_Asignatura = '$ID_Asignatura'")->fetch_object();
    //Consulta si la ASIGNATURA se encuentra asociada a un CURSO
    if ($consultaAsignatura === null) {
        $consultaAsignatura = $conexion->query("DELETE FROM asignatura WHERE ID_Asignatura = '$ID_Asignatura'");
        //Comprueba si la ASIGNATURA se eliminó correctamente.
        if ($consultaAsignatura) {
            $message = "¡Asignatura Eliminada Correctamente!";
            $class = "success";
        } else {
            $message = "¡Error al Eliminar la Asignatura!";
            $class = "danger";
        }
    } else {
        $message = "¡La Asignatura se encuentra Asociado a uno o más Cursos!";
        $class = "danger";
    }
    header("location: index.php?message=$message&class=$class");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Eliminar Asignatura | CRUD</title>
   <?php include "../resources.php" ?>
   <style>
   .icono {
      font-size: 7rem;
   }
   </style>
</head>

<body>
   <?php include "../header.php" ?>

   <main class="p-4">
      <div class="container-lg">
         <div class="row rounded bg-primary-dark rounded-top">

            <div class="col-lg-12 bg-warning  text-center grid p-3">
               <i class="fa fa-exclamation-triangle icono my-1" aria-hidden="true"></i>
               <h1 class="text-black mt-4 signature">¿Esta Seguro de Eliminar la Asignatura?</h1>
               <p>Esta acción es irreversible.</p>
            </div>
            <div class="col-lg-12 px-5">
               <form action="" method="post">
                  <div class="row my-4">
                     <div class="col-lg-12 col-sm-12 mb-3 text-center mt-4 mb-0">
                        <a class="btn btn-danger fs-2" href="index.php">
                           Cancelar
                        </a>
                        <button class="btn btn-primary fs-2" id="submit__button" type="submit"
                           name="submit">Eliminar</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </main>

   <?php include "../scripts.php"; ?>

</body>

</html>