<?php

include "../../model/middleware.php";

$ID_Asignatura = intval($_GET['ID']);
$ID_Curso = intval($_GET['ID_Curso']);

$cursoActual = $conexion->query("SELECT * FROM curso WHERE ID_Asignatura = '$ID_Asignatura' AND ID_Curso = '$ID_Curso'")->fetch_object();
$asignaturaActual = $conexion->query("SELECT * FROM asignatura WHERE ID_Asignatura = '$cursoActual->ID_Asignatura'")->fetch_object();

$actividadesDisponibles = $conexion->query("SELECT * FROM actividad WHERE ID_Curso='$cursoActual->ID_Curso' AND ID_Asignatura='$cursoActual->ID_Asignatura'")->fetch_all();

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
      <?php echo $asignaturaActual->Nombre; ?>
   </title>
   <?php include "resources.php" ?>
</head>

<body>

   <?php include "header.php" ?>

   <main class="p-4">
      <div class="container-lg">
         <div class="row">

            <?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $class = $_GET['class'];
    echo
        '
        <div class="col-lg-12 col-sm-12 mx-0 p-0">
        <div class="alert alert-' . $class . ' alert-dismissible fade show fw-bold" role="alert">
      ' . $message . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>                   ';
}
?>

            <div class="navegation__bar col-lg-12 col-sm-12 p-4 border border-1 bg-primary-dark">
               <hr class="text-white">
               <h2 class="signature text-center text-white py-4">
                  <?php echo $asignaturaActual->Nombre; ?> - <?php echo $cursoActual->Nombre; ?>
               </h2>
               <hr class="text-white">

               <div class="mt-5">
                  <div class=" flex justify-content-evenly ">
                     <a class="btn btn-danger fs-3 mb-2" href="../menu.php">Menú
                        Principal</a>
                     <?php
if ($_SESSION['ROL']->ID_Rol == 3) {
    echo
        '
                        <a class="btn btn-primary fs-3 mb-2"
                        href="listado.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '">Listado de Estudiantes</a>
                        <a class="btn btn-secondary  fs-3 mb-2"
                        href="reporte.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '">Calificar Estudiantes</a>
                        <a class="btn btn-success fs-3 mb-2"
                        href="actividad.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '">Asignar
                        Actividad</a>
                     ';
}
?>
                     <?php
if ($_SESSION['ROL']->ID_Rol == 2) {
    echo
        '
                        <a class="btn btn-primary fs-3 mb-2"
                        href="calificaciones.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '">Ver Calificaciones</a>
                     ';
}
?>

                  </div>
               </div>
               <div class="row mt-5">
                  <div class="col-lg-12">
                     <hr>
                     <h3 class="signature text-white text-center">Actividades</h3>
                     <hr>
                  </div>
               </div>
               <div class="grid grid-three-col mt-5 gap-4">

                  <?php

function mostrarActividades($ID, $actividad, $descripcion, $documento, $finaliza)
{
    echo
        '<div >
                <a class="card " href="../../images/documentos/' . $documento . '" data-bs-toggle="modal" data-bs-target="#" target="_blank">
                    <img loading="lazy" style="max-height: 20rem;" src="https://random.imagecdn.app/500/400" class="img-fluid w-100 p-0 " alt="...">
                    <div class="card-body">
                        <h3 class="card-title fs-2">
                        Actividad ' . $ID . ' - ' . $actividad . '
                        </h3>
                        <h4 class="card-text fs-5">
                           Descripción: ' . $descripcion . '
                        </h4>
                        <h4 class="card-text fs-5 fw-bold">
                           Entrega Hasta: ' . $finaliza . '
                        </h4>
                    </div>
                </a>
        </div>

        ';
}

for ($i = 0; $i < count($actividadesDisponibles); $i++) {
    mostrarActividades($i + 1, $actividadesDisponibles[$i][3], $actividadesDisponibles[$i][4], $actividadesDisponibles[$i][5], $actividadesDisponibles[$i][6]);
}

?>

               </div>
            </div>
         </div>
      </div>
   </main>

   <?php include "scripts.php"; ?>
   <script>
   $(document).ready(function() {
      $('#buscador').keyup(function() {
         buscar($(this).val());
      });

      function buscar(value) {
         $('#tabla tbody tr').each(function() {
            let encontrado = false;
            $(this).each(function() {
               if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                  encontrado = true;
               };
            });
            if (encontrado) {
               $(this).show();
            } else {
               $(this).hide();
            }
         });
      }

      $('#global_check').click(function() {
         $('.form-check-input').each(function() {
            if ($(this).prop("checked") == true && $(this).prop("id") !== "global_check") {
               $(this).prop("checked", false);
            } else if ($(this).prop("id") !== "global_check") {
               $(this).prop("checked", true);
            }
         });
      });

      $('#mostrar_listado').click(function() {
         $('#listado_estudiantes').toggle();
      })
   })
   </script>
</body>

</html>