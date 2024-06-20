<?php

session_start();
include "conexion.php";

if (empty($_SESSION['NOMBRES'])) {
    header('location: ../index.php');
}