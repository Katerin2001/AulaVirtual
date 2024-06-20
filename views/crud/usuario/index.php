<?php

include "../../../model/middleware.php";

$arrayUsuarios = $conexion->query("SELECT * FROM `usuario`")->fetch_all();
$arrayPersonas = $conexion->query("SELECT * FROM `persona`")->fetch_all();
$arrayRoles = $conexion->query("SELECT * FROM `rol`")->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Módulo de Usuarios | CRUD</title>
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
               <h1 class=" text-black mt-4 signature">Módulo de Usuario</h1>
               <p>Creación de Usuarios, Docentes y Estudiantes.</p>
            </div>
            <div class="col-lg-3 flex flex-align-center mt-3 mb-3">
               <a href="../../../views/admin.php" class="btn btn-danger fw-bold text-white fs-3">
                  Regresar
               </a>
               <a href="create.php" class="btn btn-primary fw-bold text-white fs-3 mx-3   ">
                  Nuevo Usuario
               </a>
            </div>
            <div class="col-lg-9 mt-3 mb-3">
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
                           <th scope="col">Usuario</th>
                           <th scope="col">Nombre</th>
                           <th scope="col">Apellidos</th>
                           <th scope="col">Email</th>
                           <th scope="col">Rol</th>
                           <th scope="col">Acciones</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
if (isset($arrayPersonas) && isset($arrayUsuarios) && isset($arrayRoles)) {
    for ($i = 0; $i < count($arrayUsuarios); $i++) {
        for ($j = 0; $j < count($arrayPersonas); $j++) {
            //Comprueba si el ID_Persona del Usuario coincide con un ID_Persona de una Persona
            if ($arrayUsuarios[$i][1] == $arrayPersonas[$j][0]) {
                for ($h = 0; $h < count($arrayRoles); $h++) {
                    //Comprueba si el ID_Rol del Usuario coincide con un ID_Rol de una Rol
                    if ($arrayUsuarios[$i][2] == $arrayRoles[$h][0]) {
                        echo
                        '
              <tr >
                 <th scope="col">' . $arrayUsuarios[$i][0] . '</th>
                 <td >' . $arrayUsuarios[$i][3] . '</td>
                 <td >' . $arrayPersonas[$j][1] . '</td>
                 <td >' . $arrayPersonas[$j][2] . '</td>
                 <td >
                     <a href="mailto:' . $arrayUsuarios[$i][4] . '">
                     ' . $arrayUsuarios[$i][4] . '
                     </a>
                 </td>
                 <td class="bg-primary text-white fw-bold" >' . strtoupper($arrayRoles[$h][1]) . '</td>
                 <td class="bg-success fw-bold" >
                    <a href="update.php?ID=' . $arrayUsuarios[$i][0] . '" class="text-white mx-3">
                       <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="delete.php?ID=' . $arrayUsuarios[$i][0] . '" class="text-white mx-3">
                       <i class="fas fa-trash-alt"></i>
                    </a>
                 </td>
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