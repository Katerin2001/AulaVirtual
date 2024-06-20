<?php
include "../model/middleware.php";

switch ($_SESSION['ROL']->Nombre) {
    case "Invitado":
        header("location: menu.php");
        break;
    default:
        break;
}

if (isset($_POST['submit__button'])) {
    if (!empty($_POST["nombres"]) && !empty($_POST["apellidos"])) {
        if (!empty($_POST["direccion"]) && !empty($_POST["email"])) {
            $data = [];

            $nombres = $_POST["nombres"];
            $apellidos = $_POST["apellidos"];
            $direccion = $_POST["direccion"];
            $email = $_POST["email"];

            $conexion->query("UPDATE usuario SET Email = '$email' where ID_Persona = " . $_SESSION['ID_persona'] . "");
            $conexion->query("UPDATE persona SET Nombre = '$nombres', Apellidos = '$apellidos', Direccion = '$direccion' where ID_Persona = " . $_SESSION['ID_persona'] . "");

            $_SESSION['USUARIO'] = $conexion->query("select * from usuario where ID_Persona = " . $_SESSION['ID_persona'] . "")->fetch_object();
            $_SESSION['PERSONA'] = $conexion->query("select * from persona where ID_Persona = " . $_SESSION['USUARIO']->ID_Persona . "")->fetch_object();
            $_SESSION['ROL'] = $conexion->query("select * from rol where ID_Rol = " . $_SESSION['USUARIO']->ID_Rol . "")->fetch_object();

            $data['nombres'] = $nombres;
            $data['apellidos'] = $apellidos;
            $data['direccion'] = $direccion;
            $data['email'] = $email;

            $_SESSION['NOMBRES'] = $data['nombres'] . ' ' . $data['apellidos'];
            json_encode($data);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
      <?php echo $_SESSION['NOMBRES']; ?> | Perfil de Usuario
   </title>
   <link rel="shortcut icon" href="../images/logo.png" type="image/png">
   <?php include "../model/resources.php" ?>
   <link rel="stylesheet" href="../css/profile.css">
</head>

<body>
   <?php include "header.php"; ?>

   <main class="p-4">
      <div class="container-lg">
         <div class="row">
            <div class="student col-lg-3 col-sm-12 grid grid-place-center grid-auto-rows bg-primary-dark">
               <div class="student__image">
                  <a href="webcam.php">
                     <?php
if (!empty($_SESSION['perfil'])) {
    echo '
                    <img class="student__profile" src="' . $_SESSION['perfil'] . '" alt="">
                    ';
} else {
    echo '
                    <img class="student__profile" src="../images/background/background-1.jpg" alt="">';
}
?>
                  </a>
               </div>
               <div class="student__content d-flex flex-column">
                  <h2 id="student__name" class="student__name">
                     <?php echo $_SESSION['NOMBRES']; ?>
                  </h2>
                  <div>
                     <h3 class=" student__field">Usuario</h3>
                     <p class="student__value">
                        <?php echo $_SESSION['USUARIO']->Usuario; ?>
                     </p>
                  </div>
                  <div>
                     <h3 class=" student__field">Dirección</h3>
                     <p id="student__direction" class=" student__value">
                        <?php echo $_SESSION['PERSONA']->Direccion; ?>
                     </p>
                  </div>
                  <div>
                     <h3 class=" student__field">Email</h3>
                     <p id="student__email" class=" student__value">
                        <?php echo $_SESSION['USUARIO']->Email; ?>
                     </p>
                  </div>
                  <div>
                     <h3 class="student__field">Rol</h3>
                     <p class="student__value">
                        <?php echo $_SESSION['ROL']->Nombre; ?>
                     </p>
                  </div>
               </div>

            </div>
            <div id="student__edit" class=" py-4 col-lg-9 col-sm-12 student__edit border border-1 rounded-right">
               <h1 class="text-black text-center signature  mt-4">Información de Usuario</h1>
               <form class="student__form px-5" action="" method="POST">
                  <div class="row">
                     <div class="col-lg-12 col-sm-12">
                        <label for="usuario">
                           Usuario:
                           <input class="bg-primary-red text-dark outline-none" type="email" name="usuario" id="usuario"
                              value="
                           <?php echo $_SESSION['USUARIO']->Usuario; ?>
                           " disabled>
                        </label>
                     </div>
                     <div class="col-lg-6 col-sm-12">
                        <label for="nombres">
                           Nombres:
                           <input type="text" name="nombres" id="nombres"
                              value="<?php echo $_SESSION['PERSONA']->Nombre; ?>" required>
                        </label>
                     </div>
                     <div class="col-lg-6 col-sm-12">
                        <label for="apellidos">
                           Apellidos:
                           <input type="text" name="apellidos" id="apellidos"
                              value="<?php echo $_SESSION['PERSONA']->Apellidos; ?>" required>
                        </label>
                     </div>
                     <div class="col-lg-6 col-sm-12">
                        <label for="direccion">
                           Dirección:
                           <input type="text" name="direccion" id="direccion"
                              value="<?php echo $_SESSION['PERSONA']->Direccion; ?>" required>
                        </label>
                     </div>
                     <div class="col-lg-6 col-sm-12">
                        <label for="email">
                           Email:
                           <input type="email" name="email" id="email" value="
                           <?php echo $_SESSION['USUARIO']->Email; ?>
                           ">
                        </label>
                     </div>
                     <div class="col-lg-12 col-sm-12">
                        <label for="rol">
                           Rol:
                           <select class="bg-primary-red text-dark outline-none" name="rol" id="rol" disabled>
                              <option value="">
                                 <?php echo $_SESSION['ROL']->Nombre; ?>
                              </option>
                           </select>
                        </label>
                     </div>
                     <div class="col-lg-12 col-sm-12">
                        <label for="rol">
                           <input name="submit__button" id="submit__button" class="button-dark outline-none"
                              type="submit" value="Actualizar">
                        </label>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>

   </main>


   <?php include "../model/scripts.php"; ?>
   <script>
   $(document).ready(function() {
      $("#submit__button").click(function(event) {
         $.ajax({
            url: "profile.php",
            type: "POST",
            data: {
               nombres: $('#nombres').val(),
               apellidos: $('#apellidos').val(),
               direccion: $('#direccion').val(),
               email: $('#email').val()
            },
            dataType: "json",
            success: function(data) {
               console.log("Entro");
               $('#student__name').text(data.nombres + '' + data.apellidos);
               $('#email').text(data.email);
               $('#student__direction').text(data.direccion);
            }
         });
      });
   });
   </script>

</body>

</html>