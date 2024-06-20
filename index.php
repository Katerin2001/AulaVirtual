<?php

include "model/conexion.php";

if (!empty($_SESSION['NOMBRES'])) {
    header('location: model/menu.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Facultad de Ingeniería en Sistemas, Electrónica e Industrial: Log in to the site</title>
   <link rel="shortcut icon" href="images/logo.png" type="image/png">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/login.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex justify-content-center align-items-center">
   <main class="h-100">
      <header class="container-pl">
         <div class="bg-white d-flex align-items-center ">
            <div>
               <img loading="lazy" class="image__logo" src="images/uta.png" alt="uta logo">
            </div>
            <div class="text-center d-flex flex-column align-items-center justify-content-center p-2 ">
               <h1 class="fs-4 mb-3 fw-bold">PLATAFORMA EDUCATIVA INSTITUCIONAL</h1>
               <h2 class="fs-6 m-0 fw-bold">FACULTAD DE INGENIERÍA EN SISTEMAS, ELECTRÓNICA E INDUSTRIAL</h2>
            </div>
            <div>
               <img loading="lazy" class="image__logo" src="images/logo.png"
                  alt="facultad de ingenieria en sistemas logo">
            </div>
         </div>
      </header>
      <div class="login__section">
         <div class="container-pl bg-white p-4 row justify-content-center">
            <div class="col-md-12">
               <?php include "controller/login/login.php"; ?>
            </div>
            <div class="col-md-8">
               <p>Log in using your account on:</p>
               <a href="https://login.microsoftonline.com/" class="login__btn btn btn-secondary btn-block w-100 mb-3"
                  target="_blank">
                  <img loading="lazy" src="https://www.microsoft.com/favicon.ico" alt="Microsoft Office 365" width="24"
                     height="24">
                  Microsoft Office 365
               </a>
               <a class="text-danger" href="https://sistemaseducaciononline.uta.edu.ec/login/forgot_password.php"
                  target="_blank">Forgotten
                  your
                  username or
                  password?</a>
            </div>
            <div class="col-md-8 mt-3">
               <p>Cookies must be enabled in your browser <i class="icon fa fa-question-circle text-info fa-fw "
                     title="Help with Cookies must be enabled in your browser" role="img"
                     aria-label="Help with Cookies must be enabled in your browser"></i></p>

               <a class="login__btn btn btn-secondary btn-block w-100 mb-3" id="test__button">
                  Test account log in
               </a>
               <div class="login__form" id="login__form">
                  <form action="" method="post">
                     <input type="text" class="form-control mb-3" id="username" name="username" placeholder="Username"
                        required>
                     <input type="password" class="form-control mb-3" id="password" name="password"
                        placeholder="Password" required>
                     <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember username</label>
                     </div>
                     <input type="submit" id="submit__button" name="submit__button"
                        class="login__btn btn btn-secondary btn-block w-100" value="Log in"></button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div>
         <div class="container-pl bg-white p-2">
            <a href="https://youtu.be/MFA-QCw0oBo" target="_blank">
               <img loading="lazy" class="img-fluid" src="images/background/01-plataforma.png" alt="">
            </a>
         </div>
      </div>
   </main>

   <?php include "model/scripts.php"; ?>

   <script>
   $(document).ready(() => {
      const toggleButton = $("#test__button");
      const loginForm = $("#login__form");

      toggleButton.click(function() {
         loginForm.toggle();
      });
   });
   </script>


</body>

</html>