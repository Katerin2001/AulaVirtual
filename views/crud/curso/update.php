<?php

include "../../../model/middleware.php";

$ID_Curso = intval($_GET['ID']);
$consultaCurso = $conexion->query("SELECT * FROM curso WHERE ID_Curso = '$ID_Curso'")->fetch_object();

if (isset($_POST['submit'])) {

    //Comprueba si se seleccionó una ASIGNATURA
    if ($_POST['asignatura'] !== "") {
        $curso = $_POST['curso'];
        $ID_Asignatura = intval($_POST['asignatura']);

        /* $comprobarCurso = $conexion->query("SELECT * FROM curso WHERE Nombre = '$curso'")->fetch_object(); */

        //Consulta si el CURSO ya se encuentra Registrada y Comprueba si el ID_Curso es del mismo.
        /* if (intval($comprobarCurso->ID_Curso) === $ID_Curso || $comprobarCurso === null) { */
        $updateCurso = $conexion->query("UPDATE `curso`
          SET `ID_Asignatura`='$ID_Asignatura',`Nombre`='$curso'
          WHERE `ID_Curso` = '$ID_Curso'");

        //Comprueba si el CURSO se actualizo correctamente.
        if ($updateCurso != null) {
            $message = "¡Curso Actualizado Correctamente!";
            $class = "success";
        } else {
            $message = "¡Error al Actualizar el Curso!";
            $class = "danger";
        }
        /*  } else {
    $message = "¡Nombre de Curso ya Existente!";
    $class = "danger";
    } */
    } else {
        $message = "¡Seleccione una ASIGNATURA para poder Actualizar!";
        $class = "danger";
    }
    header("location: index.php?message=$message&class=$class");
}

$arrayAsignaturas = $conexion->query("SELECT * FROM `asignatura`")->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Actualizar Curso | CRUD</title>
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
         <div class="row rounded rounded-top">
            <div class="col-lg-12 bg-primary-blue text-white text-center grid p-3">
               <i class="fa-solid fa-user-pen icono my-1"></i>
               <h1 class="text-black mt-4 signature">Editar Curso</h1>
            </div>
            <div class="col-lg-12 px-5">
               <form action="" method="post">
                  <div class="row my-4">
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="curso" class="form-label text-white fs-4">Nombre:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="curso" name="curso"
                           placeholder="Ingrese el Nombre del Curso" value="<?php echo $consultaCurso->Nombre; ?>"
                           required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="asignatura" class="form-label text-white fs-4">Asignatura:</label>
                        <select name="asignatura" class="form-select form-control form-control-lg p-3 fs-4">
                           <option value="" selected>Seleccione una Asignatura</option>
                           <?php
if (isset($arrayAsignaturas)) {
    for ($i = 0; $i < count($arrayAsignaturas); $i++) {
        //Comprueba si el ID_Asignatura de la Asignatura coincide con un ID_Asignatura de un Curso
        if ($arrayAsignaturas[$i][0] == $consultaCurso->ID_Asignatura) {
            echo
                '
            <option value="' . $arrayAsignaturas[$i][0] . '" selected="selected">'
                . $arrayAsignaturas[$i][2] .
                '</option>
            ';
        } else {
            echo
                '
    <option value="' . $arrayAsignaturas[$i][0] . '" >'
                . $arrayAsignaturas[$i][2] .
                '</option>
    ';
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
                        <button class="btn btn-primary fs-2" id="submit__button" type="submit" name="submit">Actualizar
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