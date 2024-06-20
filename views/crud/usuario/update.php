<?php

include "../../../model/middleware.php";

$ID_Usuario = intval($_GET['ID']);
$consultaUsuario = $conexion->query("SELECT * FROM usuario WHERE ID_Usuario = '$ID_Usuario'")->fetch_object();

if ($consultaUsuario !== null) {
    $consultaPersona = $conexion->query("SELECT * FROM persona WHERE ID_Persona = '$consultaUsuario->ID_Persona'")->fetch_object();
}

if (isset($_POST['submit'])) {
    //Comprueba que se seleccione un ROL.
    if ($_POST['rol'] !== "") {
        $usuario = $_POST['usuario'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $rol = intval($_POST['rol']);

        $comprobarUsuario = $conexion->query("SELECT * FROM usuario WHERE Usuario = '$usuario'")->fetch_object();

        //Consulta si el USUARIO ya se encuentra Registrado y Comprueba si el ID_Usuario es del mismo.
        if (intval($comprobarUsuario->ID_Usuario) === $ID_Usuario || $comprobarUsuario === null) {
            $updateUsuario = $conexion->query("UPDATE `usuario`
        SET `ID_Rol`='$rol',`Usuario`='$usuario',`Email`='$email'
        WHERE `ID_Usuario` = '$consultaUsuario->ID_Usuario'");

            $updatePersona = $conexion->query("UPDATE `persona`
        SET `Nombre`='$nombres',`Apellidos`='$apellidos',`Direccion`='$direccion'
        WHERE `ID_Persona`='$consultaPersona->ID_Persona'");

            //Comprueba si el USUARIO y la PERSONA se actualizaron correctamente.
            if ($updatePersona != null && $updateUsuario != null) {
                $message = "¡Usuario Actualizado Correctamente!";
                $class = "success";
            } else {
                $message = "¡Error al Actualizar el Usuario!";
                $class = "danger";
            }
        } else {
            $message = "¡Nombre de Usuario ya Existente!";
            $class = "danger";
        }
    } else {
        $message = "¡Seleccione un ROL para poder Actualizar!";
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
   <title>Actualizar Usuario | CRUD</title>
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
               <h1 class="text-black mt-4 signature">Editar Usuario</h1>
            </div>
            <div class="col-lg-12 px-5">
               <form action="" method="post">
                  <div class="row my-4">
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="usuario" class="form-label text-white fs-4">Usuario:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="usuario" name="usuario"
                           placeholder="Nombre de Usuario" value="<?php echo $consultaUsuario->Usuario; ?>" required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="nombres" class="form-label text-white fs-4">Nombres:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="nombres" name="nombres"
                           placeholder="Ingrese sus Nombres" value="<?php echo $consultaPersona->Nombre; ?>" required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="apellidos" class="form-label text-white fs-4">Apellidos:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="apellidos" name="apellidos"
                           placeholder="Ingrese sus Apellidos" value="<?php echo $consultaPersona->Apellidos; ?>"
                           required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="direccion" class="form-label text-white fs-4">Dirección:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="direccion" name="direccion"
                           placeholder="Ingrese su Dirección Domiciliaria"
                           value="<?php echo $consultaPersona->Direccion; ?>" required>
                     </div>
                     <div class="col-lg-12 col-sm-6 mb-3">
                        <label for="email" class="form-label text-white fs-4">Email:</label>
                        <input type="email" class="form-control form-control-lg p-3 fs-4" id="email" name="email"
                           placeholder="Ingrese su Correo Electrónico" value="<?php echo $consultaUsuario->Email; ?>"
                           required>
                     </div>
                     <div class="col-lg-12 col-sm-6 mb-3">
                        <label for="rol" class="form-label text-white fs-4">Rol:</label>
                        <select name="rol" class="form-select form-control form-control-lg p-3 fs-4">
                           <option value="" selected>Seleccione</option>
                           <option value="1" <?php if ($consultaUsuario->ID_Rol == '1') {
    echo ' selected="selected"';
}
?>>Administrador</option>
                           <option value="2" <?php if ($consultaUsuario->ID_Rol == '2') {
    echo ' selected="selected"';
}
?>>Estudiante</option>
                           <option value="3" <?php if ($consultaUsuario->ID_Rol == '3') {
    echo ' selected="selected"';
}
?>>Docente</option>
                           <option value="4" <?php if ($consultaUsuario->ID_Rol == '4') {
    echo ' selected="selected"';
}
?>>Invitado</option>
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