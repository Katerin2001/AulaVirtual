<?php

include "../../model/middleware.php";

$ID_Asignatura = intval($_GET['ID']);
$ID_Curso = intval($_GET['ID_Curso']);

if (isset($_POST['submit'])) {

    $actividad = $_POST['actividad'];
    $descripcion = strip_tags($_POST['descripcion']);
    $documento = $_FILES['documento'];
    $finaliza = $_POST['finaliza'];

    $directorio = "../../images/documentos";

    move_uploaded_file($documento["tmp_name"], $directorio . '/' . $documento['name']);

    $nombreDocumento = $documento['name'];

    $consulta = $conexion->query("INSERT INTO `actividad` (`ID_Curso`, `ID_Asignatura`, `Nombre`, `Descripcion`, `Documento`, `Finaliza`)
    VALUES ('$ID_Curso', '$ID_Asignatura', '$actividad', '$descripcion', '$nombreDocumento', '$finaliza')");

    if ($consulta) {
        $message = "¡Actividad creada Correctamente!";
        $class = "success";
    } else {
        $message = "¡Error al Crear la Actividad!";
        $class = "danger";
    }
    header("location: docente.php?message=$message&class=$class&ID=$ID_Asignatura&ID_Curso=$ID_Curso");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menú Principal</title>
   <?php include "resources.php" ?>
</head>

<body>

   <?php include "header.php" ?>

   <main class="p-4">
      <div class="container-lg">
         <div class="row">
            <div class="navegation__bar col-lg-12 col-sm-12 p-4 border border-1 ">
               <h2 class="signature">
                  Crear nueva Actividad
               </h2>
               <div class="row">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="row my-4 flex align-items-center">
                        <div class="col-lg-3">
                           <label for="actividad" class="form-label fs-4">Nombre de la Actividad:</label>
                        </div>
                        <div class="col-lg-9 col-sm-12 mb-3">
                           <input type="text" class="form-control form-control-lg p-3 fs-4" id="actividad"
                              name="actividad" placeholder="Ingrese el Nombre de la Actividad" required>
                        </div>
                        <div class="col-lg-3">
                           <label for="descripcion" class="form-label fs-4">Descripción:</label>
                        </div>
                        <div class="col-lg-9 col-sm-12 mb-3">
                           <textarea type="text" class="form-control form-control-lg p-3 fs-4" id="descripcion"
                              name="descripcion" placeholder="Ingrese una Descripción">
</textarea>
                        </div>

                        <div class="col-lg-3">
                           <label for="formFileLg" class="form-label fs-4">Archivos Adicionales: </label>
                        </div>
                        <div class="col-lg-9 col-sm-12 mb-3">
                           <input class="form-control form-control-lg fs-4" id="formFileLg" type="file" name="documento"
                              accept="application/pdf" required>
                        </div>
                        <div class="col-lg-3">
                           <label for="finaliza">Finaliza:</label>
                        </div>
                        <div class="col-lg-9 col-sm-12 mb-3">
                           <input id="finaliza" name="finaliza" class="form-control fs-4" type="date" required />
                        </div>
                        <div class="col-lg-12 text-end my-2 ">
                           <a class="btn btn-danger fs-2"
                              href="docente.php?ID=<?php echo $ID_Asignatura; ?>&ID_Curso=<?php echo $ID_Curso; ?>">
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
      </div>
   </main>

   <?php include "scripts.php"; ?>
   <script>
   tinymce.init({
      selector: '#descripcion'
   });
   </script>
</body>

</html>