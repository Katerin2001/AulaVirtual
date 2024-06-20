<?php

include "../../../model/middleware.php";

if (isset($_POST['submit'])) {
    //Comprueba que se seleccione un ROL.
    if ($_POST['rol'] !== "") {
        $usuario = $_POST['usuario'];
        $consulta = $conexion->query("SELECT * FROM usuario WHERE Usuario = '$usuario'")->fetch_object();

        //Consulta si el USUARIO ya se encuentra Registrado.
        if ($consulta === null) {

            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];

            $persona = $conexion->query("INSERT INTO `persona` (`Nombre`, `Apellidos`, `Direccion`)
          VALUES ('$nombres', '$apellidos', '$direccion')");

            //Consulta si la PERSONA se creó correctamente.
            if ($persona) {
                $usuario = $_POST['usuario'];
                $email = $_POST['email'];
                $rol = intval($_POST['rol']);

                $persona = $conexion->query("SELECT ID_Persona FROM persona WHERE Nombre = '$nombres' AND Apellidos = '$apellidos' AND Direccion = '$direccion'")->fetch_object();
                $ID_Persona = intval($persona->ID_Persona);

                if ($persona !== null) {
                    $user = $conexion->query("INSERT INTO `usuario` (`ID_Persona`, `ID_Rol`, `Usuario`, `Email`)
          VALUES ('$ID_Persona', '$rol' , '$usuario', '$email')");

                    //Consulta si el USUARIO se creó correctamente.
                    if ($user) {
                        $_GET['message'] = "¡Usuario creado Correctamente!";
                        $_GET['class'] = "success";
                    } else {
                        $_GET['message'] = "¡Error al Crear el Usuario!";
                        $_GET['class'] = "success";
                    }
                }
            }

        } else {
            $_GET['message'] = "¡Usuario ya Existente!";
            $_GET['class'] = "danger";
        }
    } else {
        $message = "¡Seleccione un ROL para poder Crear!";
        $class = "danger";
        header("location: index.php?message=$message&class=$class");
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Crear nuevo Usuario | CRUD</title>
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
               <i class="fa-solid fa-user-plus icono my-1"></i>
               <h1 class="text-black mt-4 signature">Crear Nuevo Usuario</h1>
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
                        <label for="usuario" class="form-label text-white fs-4">Usuario:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="usuario" name="usuario"
                           placeholder="Nombre de Usuario" required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="nombres" class="form-label text-white fs-4">Nombres:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="nombres" name="nombres"
                           placeholder="Ingrese sus Nombres" required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="apellidos" class="form-label text-white fs-4">Apellidos:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="apellidos" name="apellidos"
                           placeholder="Ingrese sus Apellidos" required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="direccion" class="form-label text-white fs-4">Dirección:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="direccion" name="direccion"
                           placeholder="Ingrese su Dirección Domiciliaria" required>
                     </div>
                     <div class="col-lg-12 col-sm-6 mb-3">
                        <label for="email" class="form-label text-white fs-4">Email:</label>
                        <input type="email" class="form-control form-control-lg p-3 fs-4" id="email" name="email"
                           placeholder="Ingrese su Correo Electrónico" required>
                     </div>
                     <div class="col-lg-12 col-sm-6 mb-3">
                        <label for="rol" class="form-label text-white fs-4">Rol:</label>
                        <select name="rol" class="form-select form-control form-control-lg p-3 fs-4">
                           <option value="" selected>Seleccione un Rol:</option>
                           <option value="1">Administrador</option>
                           <option value="2">Estudiante</option>
                           <option value="3">Docente</option>
                           <option value="3">Invitado</option>
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