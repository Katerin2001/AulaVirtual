<?php

include "../model/middleware.php";

$ID_Estudiante = intval($_SESSION['USUARIO']->ID_Usuario);

$asignaturasDisponibles = $conexion->query("SELECT * FROM asignatura")->fetch_all();
$cursosDisponibles = $conexion->query("SELECT * FROM `curso`")->fetch_all();
$asignaturasMatriculadas = $conexion->query("SELECT * FROM `estudiante-asignatura` WHERE ID_Estudiante = '$ID_Estudiante'")->fetch_all();

if (isset($_GET['ID'])) {
    $ID_Asignatura = intval($_GET['ID']);
    $ID_Curso = intval($_GET['ID_Curso']);

    $estudiante = $conexion->query("SELECT * FROM `usuario` WHERE ID_Usuario = '$ID_Estudiante'")->fetch_object();
    $asignatura = $conexion->query("SELECT * FROM `asignatura` WHERE ID_Asignatura = '$ID_Asignatura'")->fetch_object();
    $curso = $conexion->query("SELECT * FROM `curso` WHERE ID_Curso = '$ID_Curso'")->fetch_object();

    if ($estudiante !== null && $asignatura !== null && $curso !== null) {

        $consultaDisponibilidad = $conexion->query("SELECT * FROM `estudiante-asignatura`
        WHERE ID_Estudiante = '$estudiante->ID_Usuario' AND ID_Asignatura = '$ID_Asignatura' AND ID_Curso = '$ID_Curso'")->fetch_object();

        if ($consultaDisponibilidad === null) {

            $estudiante_asignatura = $conexion->query("INSERT INTO `estudiante-asignatura` (`ID_Curso`,`ID_Asignatura`, `ID_Estudiante`)
        VALUES ('$curso->ID_Curso','$asignatura->ID_Asignatura','$estudiante->ID_Usuario')");

            if ($estudiante_asignatura) {
                $message = "¡Matrícula creada Correctamente!";
                $class = "success";
            } else {
                $message = "¡Error al Matrícularse!";
                $class = "danger";
            }
        } else {
            $message = "¡Usted ya se encuentra Matrículado en ese CURSO!";
            $class = "danger";
        }
    }
    header("location: menu.php?message=$message&class=$class");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menú Principal</title>
   <link rel="shortcut icon" href="images/logo.png" type="image/png">
   <link rel="stylesheet" href="../css/matriculacion.css">
   <?php include "../model/resources.php" ?>
</head>

<body>
   <?php include "header.php"; ?>

   <main class="p-4">
      <div class="container-lg">
         <div class="row">
            <div class="navegation__bar col-lg-12 col-sm-12 p-4 border border-1">
               <h2>Cursos Disponibles</h2>

               <div class="grid grid-three-col mt-5 gap-4">
                  <?php

function mostrarCursos($curso, $asignatura, $ID_Asignatura, $ID_Curso, $class)
{
    echo
        '<div >
                <a class="card ' . $class . '" href="#" data-bs-toggle="modal" data-bs-target="#' . $curso . '' . $ID_Asignatura . '">
                    <img src="../images/background/background.jpg" class="img-fluid w-100 p-0 " alt="...">
                    <div class="card-body">
                        <h3 class="card-title fs-3">
                            ' . $asignatura . ' - ' . $curso . '
                        </h3>
                    </div>
                </a>
        </div>
        <div class="modal fade" id="' . $curso . '' . $ID_Asignatura . '" tabindex="-1" aria-labelledby="' . $asignatura . 'Label"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="' . $curso . '">Matriculación</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           ¿Desea Matricularse en este Curso?
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                           <a href="matriculacion.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '" type="button" class="btn btn-primary">Aceptar</a>
                        </div>
                     </div>
                  </div>
               </div>
        ';
}

if (isset($cursosDisponibles)) {
    for ($i = 0; $i < count($cursosDisponibles); $i++) {
        for ($j = 0; $j < count($asignaturasDisponibles); $j++) {
            //Comprueba si el ID_Asignatura de un Curso coincide con un ID_Asignatura de una Asignatura para envíar su Nombre.
            if ($cursosDisponibles[$i][1] == $asignaturasDisponibles[$j][0]) {
                mostrarCursos($cursosDisponibles[$i][2], $asignaturasDisponibles[$j][2], $asignaturasDisponibles[$j][0], $cursosDisponibles[$i][0], null);
            }
        }
    }
}
?>
               </div>
            </div>
         </div>
      </div>
   </main>

   <script src="../js/bootstrap.min.js"></script>
   <script src="../js/jquery.js"></script>
</body>

</html>