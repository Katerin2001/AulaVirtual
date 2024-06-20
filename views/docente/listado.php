<?php

include "../../model/middleware.php";

$ID_Asignatura = intval($_GET['ID']);
$ID_Curso = intval($_GET['ID_Curso']);

$cursoActual = $conexion->query("SELECT * FROM curso WHERE ID_Asignatura = '$ID_Asignatura' AND ID_Curso = '$ID_Curso'")->fetch_object();
$asignaturaActual = $conexion->query("SELECT * FROM asignatura WHERE ID_Asignatura = '$cursoActual->ID_Asignatura'")->fetch_object();

$arrayEstudianteAsignatura = $conexion->query("SELECT * FROM `estudiante-asignatura` WHERE ID_Asignatura = '$asignaturaActual->ID_Asignatura'
AND ID_Curso = '$cursoActual->ID_Curso'")->fetch_all();
$arrayEstudiantes = $conexion->query("SELECT * FROM usuario WHERE ID_Rol = 2")->fetch_all();
$arrayPersonas = $conexion->query("SELECT * FROM persona")->fetch_all();

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
                     <h1 class=" text-black mt-4 signature">Lista de Estudiantes</h1>
                     <p>Estudiantes Matrículados en el Curso</p>
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
                                 <th scope="col" width="5%"><input id="global_check" class="form-check-input"
                                       type="checkbox"></th>
                                 <th scope="col" width="5%">ID</th>
                                 <th scope="col" width="25%">Nombre Completo</th>
                                 <th scope="col" width="25%">Email</th>
                                 <th scope="col" width="10%">Rol</th>
                                 <th scope="col" width="10%">Grupo</th>
                                 <th scope="col" width="10%">Estado</th>
                              </tr>
                           </thead>

                           <tbody>
                              <?php

if (isset($arrayEstudianteAsignatura)) {
    for ($i = 0; $i < count($arrayEstudianteAsignatura); $i++) {
        for ($j = 0; $j < count($arrayEstudiantes); $j++) {
            if ($arrayEstudianteAsignatura[$i][3] == $arrayEstudiantes[$j][0]) {
                for ($h = 0; $h < count($arrayPersonas); $h++) {
                    if ($arrayPersonas[$h][0] == $arrayEstudiantes[$j][1]) {
                        echo
                            '
                   <tr >
                      <th scope="col" width="5%"><input class="form-check-input" type="checkbox"></th>
                      <td >
                      ' . $arrayEstudiantes[$j][0] . '
                      </td>
                      <td class="flex justify-content-start">
                      <img loading="lazy" id="navbar__image" class="navbar__image" src="../../images/background/background.jpg" alt="">
                      ' . $arrayPersonas[$h][1] . ' ' . $arrayPersonas[$h][2] . '</td>

                      <td >
                         <a href="mailto:' . $arrayEstudiantes[$i][4] . '">
                         ' . $arrayEstudiantes[$i][4] . '
                         </a>
                      </td>
                      <td class="bg-primary text-white fw-bold" >Estudiante</td>
                      <td class="text-black fw-bold" >Sin Grupo</td>
                      <td class="bg-success text-white fw-bold" >Activo</td>
                </tr>
                   ';
                    }
                }
            }
        }
    }
}

?>
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

   })
   </script>
</body>

</html>