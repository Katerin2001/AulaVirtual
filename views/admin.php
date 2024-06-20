<?php

include "../model/middleware.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panel de Administración</title>
   <?php include "../model/resources.php" ?>
</head>

<body>

   <?php include "header.php" ?>


   <main class="p-4">
      <div class="container-lg">
         <div class="row">
            <div class="col-lg-12 p-0">
               <h1 class="text-center fs-1 bg-primary-dark py-2 text-white">Panel de Administración</h1>
            </div>
            <div class="col-lg-12 p-0">
               <div class="grid grid-three-col gap-4">
                  <?php include "../controller/admin/panel.php" ?>
               </div>
            </div>
         </div>
      </div>
   </main>

   <?php include "../model/scripts.php"; ?>

</body>

</html>