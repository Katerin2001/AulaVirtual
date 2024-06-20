<?php

function mostrarCursos($curso, $asignatura, $ID_Asignatura, $ID_Curso, $class)
{
    echo
        '<div >
                <a class="card ' . $class . '" href="docente/docente.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '">
                    <img style="max-height: 18rem;" src="../images/background/background.jpg" class="img-fluid w-100 p-0 " alt="...">
                    <div class="card-body">
                        <h3 class="card-title fs-4">
                            ' . $asignatura . ' - ' . $curso . '
                        </h3>
                    </div>
                </a>
        </div>';
}

function mostrarCursosMatriculados()
{
    include "../model/conexion.php";

    $ID_Estudiante = $_SESSION['USUARIO']->ID_Usuario;
    $asignaturasDisponibles = $conexion->query("SELECT * FROM asignatura")->fetch_all();
    $cursosDisponibles = $conexion->query("SELECT * FROM `curso`")->fetch_all();
    $asignaturasMatriculadas = $conexion->query("SELECT * FROM `estudiante-asignatura` WHERE ID_Estudiante = '$ID_Estudiante'")->fetch_all();

    if (isset($cursosDisponibles)) {
        for ($i = 0; $i < count($asignaturasMatriculadas); $i++) {
            for ($j = 0; $j < count($asignaturasDisponibles); $j++) {
                if ($asignaturasMatriculadas[$i][2] == $asignaturasDisponibles[$j][0]) {
                    for ($h = 0; $h < count($cursosDisponibles); $h++) {
                        if ($cursosDisponibles[$h][0] == $asignaturasMatriculadas[$i][1]) {
                            mostrarCursos($cursosDisponibles[$h][2], $asignaturasDisponibles[$j][2], $asignaturasDisponibles[$j][0], $cursosDisponibles[$h][0], "");
                        }
                    }
                }
            }
        }
    }
}

//Consulta en cuales Cursos el Estudiante se encuentra Matrículado
$asignaturasMatriculadas = $conexion->query("SELECT * FROM `estudiante-asignatura` WHERE ID_Estudiante = " . $_SESSION['USUARIO']->ID_Usuario . "")->fetch_all();

for ($i = 0; $i < count($asignaturas); $i++) {
    for ($j = 0; $j < count($cursos); $j++) {
        if ($cursos[$j][1] == $asignaturas[$i][0]) {
            //Consulta si el ID_Docente de la Asignatura coincide con el ID_Usuario de un Docente y además si el Rol es de Docente
            if (intval($asignaturas[$i][1]) == intval($_SESSION['USUARIO']->ID_Usuario) && ($_SESSION['ROL']->Nombre == "Docente")) {
                mostrarCursos($cursos[$j][2], $asignaturas[$i][2], $asignaturas[$i][0], $cursos[$j][0], null);
                //Consulta si el Rol es de Invitado
            } elseif ($_SESSION['ROL']->Nombre == "Invitado") {
                mostrarCursos($cursos[$j][2], $asignaturas[$i][2], $asignaturas[$i][0], $cursos[$j][0], null);
                //Consulta si el Rol es de Estudiante
            } elseif ($_SESSION['ROL']->Nombre == "Estudiante") {
                mostrarCursosMatriculados();
                return;
            }
        }
    }
}