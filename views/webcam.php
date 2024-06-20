<?php
include "../model/middleware.php";

switch ($_SESSION['ROL']->Nombre) {
    case "Invitado":
        header("location: menu.php");
        break;
    default:
        break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fotografía</title>
   <?php include "../model/resources.php" ?>

   <style>
   .col-lg-6 {
      height: 40rem;
   }

   .after_capture_frame,
   video {
      width: 350px !important;
      height: 250px;
      object-fit: cover;
      border-radius: 1rem;
      border: 4px solid var(--CL-primary-blue);
   }
   </style>
</head>

<body>

   <?php include "header.php"; ?>

   <main class="p-4">
      <div class="container-lg">
         <div id="webcam__content" class="row">
            <div class="col-lg-6 col-sm-12 grid grid-place-center bg-primary-dark text-white p-4 ml-2">
               <div id="my_camera" class="pre_capture_frame"></div>
               <input type="hidden" name="captured_image_data" id="captured_image_data">
               <br>
               <input type="button" class="btn btn-primary btn-round btn-file fs-3 text-white  p-3"
                  value="Capturar Imagen" onclick="tomarFoto()">
            </div>
            <div class="col-lg-6 col-sm-12 grid grid-place-center bg-primary-red text-white p-4">
               <div id="results">
                  <img class="after_capture_frame" src="../images/background/background-1.jpg" />
               </div>
               <br>
               <button type="button" class="btn btn-light fw-italic btn-round btn-file fs-3 text-black p-3"
                  onclick="guardarFoto()">Guardar Imagen</button>
            </div>

         </div>
      </div>
   </main>



   <?php include "../model/scripts.php"; ?>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>
   <script language="JavaScript">
   Webcam.set({
      width: 350,
      height: 250,
      image_format: 'jpeg',
      png_quality: 100
   });
   Webcam.attach('#my_camera');

   function tomarFoto() {
      Webcam.snap(function(data_uri) {
         console.log(data_uri[0]);
         document.getElementById('results').innerHTML =
            '<img   class="after_capture_frame" style="object-fit: cover;" src="' +
            data_uri + '"/>';
         $("#captured_image_data").val(data_uri);
      });
   }

   function guardarFoto() {
      var base64data = $("#captured_image_data").val();
      console.log(base64data);
      $.ajax({
         type: "POST",
         dataType: "json",
         url: "../controller/user/camera.php",
         data: {
            image: base64data
         },
         success: function(data) {
            $("#webcam__content").append(
               "<div class='col-lg-12 col-sm-12 grid grid-place-center bg-success text-white mt-3 p-4'> <h2>¡Imagen Guardada Correctamente!</h2> </div>"
            );
            $("#navbar_image").attr("src", data);
         },
         error: function(data) {
            $("#webcam__content").append(
               "<div class='col-lg-12 col-sm-12 grid grid-place-center bg-danger text-white mt-3 p-4'> <h2>¡Error al Guardar la Imagen!</h2> </div>"
            );
         }
      });
   }
   </script>
</body>

</html>