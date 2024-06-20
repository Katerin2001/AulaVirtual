<?php

include "../../../model/middleware.php";

$ID_Asignatura = intval($_GET['ID']);
$consultaAsignatura = $conexion->query("SELECT * FROM asignatura WHERE ID_Asignatura = '$ID_Asignatura'")->fetch_object();

if (isset($_POST['submit'])) {
    //Comprueba si se selección un DOCENTE
    if ($_POST['docente'] !== "") {
        $asignatura = $_POST['asignatura'];
        $ID_Docente = intval($_POST['docente']);

        //Consulta si la ASIGNATURA ya se encuentra RegistradA y Comprueba si el ID_Asignatura es del mismo.
        $comprobarAsignatura = $conexion->query("SELECT * FROM asignatura WHERE Nombre = '$asignatura'")->fetch_object();
        var_dump($comprobarAsignatura);

        if (intval($comprobarAsignatura->ID_Asignatura) === $ID_Asignatura || $comprobarAsignatura === null) {
            $updateAsignatura = $conexion->query("UPDATE `asignatura`
          SET `ID_Docente`='$ID_Docente',`Nombre`='$asignatura'
          WHERE `ID_Asignatura` = '$ID_Asignatura'");

            //Comprueba si la ASIGNATURA se actualizó correctamente.
            if ($updateAsignatura != null) {
                $message = "¡Asignatura Actualizada Correctamente!";
                $class = "success";
            } else {
                $message = "¡Error al Actualizar la Asignatura!";
                $class = "danger";
            }
        } else {
            $message = "¡Nombre de Asignatura ya Existente!";
            $class = "danger";
        }
    } else {
        $message = "¡Seleccione un DOCENTE para poder Actualizar!";
        $class = "danger";
    }
    header("location: index.php?message=$message&class=$class");
}

$arrayUsuarios = $conexion->query("SELECT * FROM `usuario` WHERE ID_ROL = 3")->fetch_all();
$arrayPersonas = $conexion->query("SELECT * FROM `persona`")->fetch_all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Actualizar Asignatura | CRUD</title>
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
               <h1 class="text-black mt-4 signature">Editar Asignatura</h1>
            </div>
            <div class="col-lg-12 px-5">
               <form action="" method="post">
                  <div class="row my-4">
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="asignatura" class="form-label text-white fs-4">Nombre:</label>
                        <input type="text" class="form-control form-control-lg p-3 fs-4" id="asignatura"
                           name="asignatura" placeholder="Ingrese el Nombre de la Asignatura"
                           value="<?php echo $consultaAsignatura->Nombre; ?>" required>
                     </div>
                     <div class="col-lg-6 col-sm-6 mb-3">
                        <label for="docente" class="form-label text-white fs-4">Docente:</label>
                        <select name="docente" class="form-select form-control form-control-lg p-3 fs-4">
                           <option value="" selected>Seleccione un Docente</option>
                           <?php
if (isset($arrayPersonas) && isset($arrayUsuarios)) {
    for ($i = 0; $i < count($arrayUsuarios); $i++) {
        for ($j = 0; $j < count($arrayPersonas); $j++) {
            //Comprueba si el ID_Persona del Usuario coincide con un ID_Persona de una Persona y que esta sea Docente
            if ($arrayUsuarios[$i][1] == $arrayPersonas[$j][0]) {
                if ($arrayUsuarios[$i][0] == $consultaAsignatura->ID_Docente) {
                    echo
                        '
            <option value="' . $arrayUsuarios[$i][0] . '" selected="selected">'
                        . $arrayPersonas[$j][1] . ' ' . $arrayPersonas[$j][2] .
                        '</option>
            ';
                    break;
                } else {
                    echo
                        '
    <option value="' . $arrayUsuarios[$i][0] . '" >'
                        . $arrayPersonas[$j][1] . ' ' . $arrayPersonas[$j][2] .
                        '</option>
    ';
                }

            }
        }
    }
}
?>
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