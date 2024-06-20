<?php

function mostrarAsignaturas($asignatura, $curso, $ID_Asignatura, $ID_Curso, $class)
{
    echo
        '<li class="' . $class . '">
            <a href="docente/docente.php?ID=' . $ID_Asignatura . '&ID_Curso=' . $ID_Curso . '">' . $asignatura . ' - ' . $curso . '</a>
         </li>';
}

function mostrarAsignaturasMatriculadas($curso, $asignatura, $asignaturasMatriculadas)
{
    for ($i = 0; $i < count($asignaturasMatriculadas); $i++) {
        if (intval($asignatura[0]) == intval($asignaturasMatriculadas[$i][2]) && $curso[0] == intval($asignaturasMatriculadas[$i][1])) {
            mostrarAsignaturas($asignatura[2], $curso[2], $asignatura[0], $curso[0], null);
        }
    }
}

//Consulta en cuales Cursos el Estudiante se encuentra Matrículado
$asignaturasMatriculadas = $conexion->query("SELECT * FROM `estudiante-asignatura` WHERE ID_Estudiante = " . $_SESSION['USUARIO']->ID_Usuario . "")->fetch_all();

for ($i = 0; $i < count($asignaturas); $i++) {
    for ($j = 0; $j < count($cursos); $j++) {
        if ($cursos[$j][1] == $asignaturas[$i][0]) {
            //Consulta si el ID_Docente de la Asignatura coincide con el ID_Usuario de un Docente y además si el Rol es de Docente
            if (intval($asignaturas[$i][1]) == intval($_SESSION['USUARIO']->ID_Usuario) && $_SESSION['ROL']->Nombre == "Docente") {
                mostrarAsignaturas($asignaturas[$i][2], $cursos[$j][2], $asignaturas[$i][0], $cursos[$j][0], null);
                //Consulta si el Rol es de Invitado
            } elseif ($_SESSION['ROL']->Nombre == "Invitado") {
                mostrarAsignaturas($asignaturas[$i][2], $cursos[$j][2], $asignaturas[$i][0], $cursos[$j][0], null);
                //Consulta si el Rol es de Estudiante
            } elseif ($_SESSION['ROL']->Nombre == "Estudiante") {
                mostrarAsignaturasMatriculadas($cursos[$j], $asignaturas[$i], $asignaturasMatriculadas);
            }
        }
    }
}