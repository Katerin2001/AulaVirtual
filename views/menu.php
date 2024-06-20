<?php
include "../model/middleware.php";

$cursos = $conexion->query("select * from curso")->fetch_all();
$asignaturas = $conexion->query("select * from asignatura")->fetch_all();

if (empty($_SESSION['USUARIO']) || empty($_SESSION['PERSONA'] || empty($_SESSION['ROL']))) {
    $_SESSION['USUARIO'] = $conexion->query("select * from usuario where ID_Persona = " . $_SESSION['ID_persona'] . "")->fetch_object();
    $_SESSION['PERSONA'] = $conexion->query("select * from persona where ID_Persona = " . $_SESSION['USUARIO']->ID_Persona . "")->fetch_object();
    $_SESSION['ROL'] = $conexion->query("select * from rol where ID_Rol = " . $_SESSION['USUARIO']->ID_Rol . "")->fetch_object();
}

$key = false;

$_SESSION['NOMBRES'] = $_SESSION['PERSONA']->Nombre . " " . $_SESSION['PERSONA']->Apellidos;

switch ($_SESSION['ROL']->Nombre) {
    case "Admin":
        header("location: admin.php");
        break;
    default:
        break;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menú Principal</title>
   <?php include "../model/resources.php" ?>
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

            <aside class="col-lg-3 col-sm-12 p-4 bg-primary-dark">
               <h2 class="mb-5 mt-2 text-white">Navegación</h2>
               <ul class="list_type_one">
                  <li class="navegation__item">
                     <a href="menu.php">Inicio</a>
                     <ul class="list_type_two">
                        <?php include "../controller/menu/navegation.php" ?>
                     </ul>
                  </li>
               </ul>
            </aside>
            <div class="navegation__bar col-lg-9 col-sm-12 p-4 border border-1">
               <h2>Cursos</h2>
               <div class="grid grid-three-col mt-5 gap-4">
                  <?php include "../controller/menu/courses.php"; ?>
               </div>
            </div>
         </div>
      </div>
   </main>

   <?php include "../model/scripts.php"; ?>
</body>

</html>