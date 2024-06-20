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
               <div class="row  p-3" id="listado_estudiantes">
                  <div class="col-lg-12 text-center text-white">
                     <i class="fa-solid fa-circle-user icono my-1"></i>
                     <h1 class=" text-black mt-4 signature">Reporte de Calificaciones</h1>
                  </div>
                  <div class="flex justify-content-evenly my-3">
                     <a class="btn btn-danger fs-3 mb-2"
                        href="docente.php?ID=<?php echo $ID_Asignatura; ?>&ID_Curso=<?php echo $ID_Curso; ?>">Regresar
                     </a>
                  </div>
                  <div class="col-lg-12 mt-3 mb-3">
                     <div class="input-group ">
                        <input type="text" class="form-control fs-3" name="buscador" id="buscador">
                        <button class="btn btn-primary fs-3" type="button" id="button-addon2">Buscar</button>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="table-responsive">
                        <table id="tabla" class=" table table-light table-bordered text-center w-100">
                           <thead>
                              <tr>
                                 <th scope="col" width="10%">Item de Calificación</th>
                                 <th scope="col" width="1%">Ponderación</th>
                                 <th scope="col" width="1%">Calificación</th>
                                 <th scope="col" width="3%">Rango</th>
                                 <th scope="col" width="3%">Porcentaje</th>
                                 <th scope="col" width="5%">Retroalimentación</th>
                              </tr>
                           </thead>

                           <tbody>
                              <?php

for ($i = 0; $i < count($actividadesDisponibles); $i++) {
    echo
    '
                   <tr >
                      <td >
                      Tarea ' . $i + 1 . ' - ' . $asignaturaActual->Nombre . '
                      </td>
                      <td>
                        ' . floatval(rand(0.0, 2)) . '.' . floatval(rand(0.0, 5)) . '' . floatval(rand(0.0, 5)) . '
                      </td>
                      <td>
                        ' . floatval(rand(0.0, 9)) . '.' . floatval(rand(0.0, 9)) . '' . floatval(rand(0.0, 9)) . '
                      </td>
                      <td class="bg-primary text-white fw-bold" >0-10</td>
                      <td class="text-black fw-bold" >' . floatval(rand(0.0, 100.0)) . '%</td>
                      <td class=" fw-bold" >
                        Excelente
                      </td>
                </tr>
                   ';
}

?>
                              <tr>

                                 <td colspan="1" class="fw-bold">
                                    <i class="fa-solid fa-leaf"></i>
                                    Total del Curso
                                 </td>
                                 <td colspan="1" class="fw-bold">
                                    <?php echo floatval(rand(0.0, 10.0)) . '.' . floatval(rand(0.0, 9)) . '' . floatval(rand(0.0, 9)); ?>
                                 </td>
                                 <td colspan="1" class="fw-bold">
                                    <?php echo floatval(rand(5, 10.0)) . '.' . floatval(rand(5, 9)) . '' . floatval(rand(5, 9)); ?>
                                 </td>
                                 <td colspan="1" class="bg-info text-black fw-bold">
                                    0-10
                                 </td>
                                 <td colspan="1" class="fw-bold">
                                    100%
                                 </td>
                                 <td colspan="1" class="bg-success fw-bold text-white">
                                    Excelente
                                 </td>

                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
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