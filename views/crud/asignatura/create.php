<?php

include "../../../model/middleware.php";

if (isset($_POST['submit'])) {
    //Comprueba si se seleccionó un DOCENTE
    if ($_POST['docente'] !== "") {

        //Consulta si la ASIGNATURA Existe
        $asignatura = $_POST['asignatura'];
        $consulta = $conexion->query("SELECT * FROM asignatura WHERE Nombre = '$asignatura'")->fetch_object();

        if ($consulta === null) {
            $ID_Docente = intval($_POST['docente']);
            $consulta = $conexion->query("INSERT INTO `asignatura` (`ID_Docente`, `Nombre`)
     VALUES ('$ID_Docente','$asignatura')");

            //Consulta si la ASIGNATURA se creó correctamente.
            if ($consulta) {
                $_GET['message'] = "¡Asignatura creada Correctamente!";
                $_GET['class'] = "success";
            } else {
                $_GET['message'] = "¡Error al Crear la Asignatura!";
                $_GET['class'] = "danger";
            }

        } else {
            $_GET['message'] = "¡Asignatura ya Existente!";
            $_GET['class'] = "danger";
        }
    } else {
        $message = "¡Seleccione un DOCENTE para poder Crear!";
        $class = "danger";
        header("location: index.php?message=$message&class=$class");
    }

}

$arrayUsuarios = $conexion->query("SELECT * FROM `usuario` WHERE ID_ROL = 3")->fetch_all();
$arrayPersonas = $conexion->query("SELECT * FROM `persona`")->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Crear Asignatura | CRUD</title>
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
               <h1 class="text-black mt-4 signature">Crear Nueva Asignatura</h1>
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
                        <label for="asignatura" class="form-label text-white fs-4">Nombre:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="asignatura"
                           name="asignatura" placeholder="Ingrese el Nombre de la Asignatura" required>
                     </div>

                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="docente" class="form-label text-white fs-4">Docente:</label>
                        <select name="docente" class="form-select form-control form-control-lg p-3 fs-4">
                           <option value="" selected>Seleccione un Docente</option>
                           <?php
if (isset($arrayPersonas) && isset($arrayUsuarios)) {
    for ($i = 0; $i < count($arrayUsuarios); $i++) {
        for ($j = 0; $j < count($arrayPersonas); $j++) {
            //Comprueba si el ID_Persona del Usuario coincide con un ID_Persona de una Persona y que esta sea Docente
            if ($arrayUsuarios[$i][1] == $arrayPersonas[$j][0]) {
                echo
                    '
                   <option value="' . $arrayUsuarios[$i][0] . '">' . $arrayPersonas[$j][1] . ' ' . $arrayPersonas[$j][2] . '</option>
                   ';
            }
        }
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