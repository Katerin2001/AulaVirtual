<?php

include "../../../model/middleware.php";

$ID_Asignatura = intval($_GET['ID']);
$ID_Curso = intval($_GET['ID_Curso']);

if (isset($_POST['submit'])) {
    $consultaEstudianteAsignatura = $conexion->query("DELETE FROM `estudiante-asignatura` WHERE ID_Asignatura = '$ID_Asignatura' AND ID_Curso = '$ID_Curso'");
    $consultaCurso = $conexion->query("DELETE FROM curso WHERE ID_Asignatura = '$ID_Asignatura' AND ID_Curso = '$ID_Curso'");

    //Consulta si el CURSO se eliminó correctamente.
    if ($consultaCurso) {
        $message = "¡Curso Eliminado Correctamente!";
        $class = "success";
    } else {
        $message = "¡Error al Eliminar el Curso!";
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
   <title>Eliminar Curso | CRUD</title>
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
               <h1 class="text-black mt-4 signature">¿Esta Seguro de Eliminar el Curso?</h1>
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