<?php

session_start();

if (!empty($_POST["submit__button"])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $consulta = $conexion->query("SELECT *
  FROM usuario WHERE Usuario =
  '$username' AND Usuario =
  '$password'");

        if ($data = $consulta->fetch_object()) {

            var_dump($data);
            $persona = intval($data->ID_Persona);

            $consulta = $conexion->query("select *
  from persona where ID_Persona = '$persona'");

            if ($data = $consulta->fetch_object()) {
                $_SESSION['ID_persona'] = $data->ID_Persona;
                $_SESSION['NOMBRES'] = $data->Nombre . " " . $data->Apellidos;

                header("location: ../views/menu.php");
            } else {
                echo
                    '<p class="bg-danger text-white p-2 fw-bold">
            Usuario no Encontrado.
            </p>'
                ;
            }

        } else {
            echo
                '<p class="bg-danger text-white p-2 fw-bold">
            Usuario/Contraseña Inválidos.
            </p>'
            ;
        }
    }
}