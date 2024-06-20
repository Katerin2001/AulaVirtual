<?php

include "../../../model/middleware.php";

if (isset($_POST['submit'])) {
    //Comprueba que se seleccionó una ASIGNATURA
    if ($_POST['asignatura'] !== "") {

        //Consulta si el CURSO existe
        $curso = $_POST['curso'];
/*         $consulta = $conexion->query("SELECT * FROM curso WHERE Nombre = '$curso'")->fetch_object();

if ($consulta === null) { */
        $ID_Asignatura = intval($_POST['asignatura']);

        $consulta = $conexion->query("INSERT INTO `curso` (`ID_Asignatura`, `Nombre`)
    VALUES ('$ID_Asignatura','$curso')");

        //Comprueba que el CURSO se creó correctamente.
        if ($consulta) {
            $_GET['message'] = "¡Curso creado Correctamente!";
            $_GET['class'] = "success";
        } else {
            $_GET['message'] = "¡Error al Crear el Curso!";
            $_GET['class'] = "danger";
        }

        /*      } else {
    $_GET['message'] = "¡Curso ya Existente!";
    $_GET['class'] = "danger";
    } */
    } else {
        $message = "¡Seleccione una ASIGNATURA para poder Crear!";
        $class = "danger";
        header("location: index.php?message=$message&class=$class");
    }

}

$arrayAsignaturas = $conexion->query("SELECT * FROM `asignatura`")->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Crear Curso | CRUD</title>
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
      <div class="container-lg bg-primary-dark">
         <div class="row  rounded   rounded-top">
            <div class="col-lg-12 bg-primary-blue text-white text-center grid p-3">
               <i class="fa-solid fa-chalkboard-user icono my-1"></i>
               <h1 class="text-black mt-4 signature">Crear Nuevo Curso</h1>
            </div>

            <div class="col-lg-12 px-5">
               <form action="" method="post">
                  <div class="row my-4">
                     <div class="col-lg-12 mt-2">
                        <?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $class = $_GET['class'];
    echo
        '
        <div class="alert alert-' . $class . ' alert-dismissible fade show fw-bold" role="alert">
      ' . $message . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
                         ';
}
?>
                     </div>

                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="curso" class="form-label text-white fs-4">Nombre:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="curso" name="curso"
                           placeholder="Ingrese el Nombre del Curso" required>
                     </div>

                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="asignatura" class="form-label text-white fs-4">Asignatura:</label>
                        <select name="asignatura" class="form-select form-control form-control-lg p-3 fs-4">
                           <option value="" selected>Seleccione una Asignatura</option>
                           <?php
if (isset($arrayAsignaturas)) {
    for ($i = 0; $i < count($arrayAsignaturas); $i++) {
        echo
            '
                   <option value="' . $arrayAsignaturas[$i][0] . '">' . $arrayAsignaturas[$i][2] . '</option>
                   ';
    }
}
?>
                        </select>
                     </div>
                     <div class="col-lg-12 text-end my-2 ">
                        <a class="btn btn-danger fs-2" href="index.php">
                           Cancelar
                        </a>
                        <button class="btn btn-primary fs-2" id="submit__button" type="submit" name="submit">Agregar
                        </button>
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