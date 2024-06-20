<?php

include "../../../model/middleware.php";

$arrayCursos = $conexion->query("SELECT * FROM `curso`")->fetch_all();
$arrayAsignaturas = $conexion->query("SELECT * FROM `asignatura`")->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Módulo de Cursos | CRUD</title>
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
         <div class="row">
            <div class="col-lg-12 bg-primary-dark text-white text-center grid py-3">
               <i class="fa-solid fa-circle-user icono my-1"></i>
               <h1 class=" text-black mt-4 signature">Módulo de Cursos</h1>
               <p>Creación de Cursos y asignación de Asignaturas.</p>
            </div>
            <div class="col-lg-3 flex flex-align-center mt-3 mb-3">
               <a href="../../../views/admin.php" class="btn btn-danger fw-bold text-white fs-3">
                  Regresar
               </a>
               <a href="create.php" class="btn btn-primary fw-bold text-white fs-3 mx-3   ">
                  Nuevo Curso
               </a>
            </div>
            <div class="col-lg-9 mt-3">
               <div class="input-group ">
                  <input type="text" class="form-control fs-3" name="buscador" id="buscador">
                  <button class="btn btn-primary fs-3" type="button" id="button-addon2">Buscar</button>
               </div>
            </div>
            <div class="col-lg-12 mt-1">
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
            <div class="col-lg-12 bg-dark">
               <div class="table-responsive">
                  <table id="tabla" class=" table table-light table-bordered text-center w-100">
                     <thead>
                        <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Curso</th>
                           <th scope="col">Asignatura</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
if (isset($arrayCursos) && isset($arrayAsignaturas)) {
    for ($i = 0; $i < count($arrayCursos); $i++) {
        for ($j = 0; $j < count($arrayAsignaturas); $j++) {
            //Comprueba si el ID_Asignatura del Curso coincide con un ID_Asignatura de una Asignatura
            if ($arrayCursos[$i][1] == $arrayAsignaturas[$j][0]) {
                echo
                    '
                    <tr >
                    <th scope="col">' . $arrayCursos[$i][0] . '</th>
                    <td >' . $arrayCursos[$i][2] . '</td>
                    <td >' . $arrayAsignaturas[$j][2] . '</td>
                    </td>
                    <td class="bg-success fw-bold" >
                    <a href="update.php?ID=' . $arrayCursos[$i][0] . '" class="text-white mx-3">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="delete.php?ID=' . $arrayAsignaturas[$j][0] . '&ID_Curso=' . $arrayCursos[$i][0] . '" class="text-white mx-3">
                    <i class="fas fa-trash-alt"></i>
                    </a>
                    </td>
                    </tr>
                    ';
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
   </main>

   <?php include "../scripts.php"; ?>
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
   })
   </script>

</body>

</html>