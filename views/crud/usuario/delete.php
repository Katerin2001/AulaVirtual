<?php

include "../../../model/middleware.php";

$ID_Usuario = intval($_GET['ID']);

if (isset($_POST['submit'])) {
    //Consulta si el USUARIO se encuentra Asociado a alguna ASIGNATURA
    $consultaAsignatura = $conexion->query("SELECT * FROM asignatura WHERE ID_Docente = '$ID_Usuario'")->fetch_object();

    if ($consultaAsignatura === null) {
        //Consulta si el USUARIO se eliminó correctamente.
        $consultaUsuario = $conexion->query("DELETE FROM usuario WHERE ID_Usuario = '$ID_Usuario'");

        if ($consultaUsuario) {
            //Consulta si la PERSONA asociada al USUARIO se eliminó correctamente.
            $consultaPersona = $conexion->query("DELETE FROM persona WHERE ID_Persona = '$consultaUsuario->ID_Persona'");
            if ($consultaPersona) {
                $message = "¡Usuario Eliminado Correctamente!";
                $class = "success";
            } else {
                $message = "¡Error al Eliminar el Usuario!";
                $class = "danger";
            }
        } else {
            $message = "¡Error al Eliminar el Usuario!";
            $class = "danger";
        }
    } else {
        $message = "¡El Usuario se encuentra Asociado a una o más Asignaturas!";
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
   <title>Eliminar Usuario | CRUD</title>
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
               <h1 class="text-black mt-4 signature">¿Esta Seguro de Eliminar el Usuario?</h1>
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