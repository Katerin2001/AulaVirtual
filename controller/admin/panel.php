<?php

const modulos = [
    [
        'title' => 'Usuarios',
        'class' => 'bg-primary-dark',
        'anchor' => 'crud/usuario/index.php',
    ],
    [
        'title' => 'Asignaturas',
        'class' => 'bg-primary-dark',
        'anchor' => 'crud/asignatura/index.php',
    ],
    [
        'title' => 'Cursos',
        'class' => 'bg-primary-dark',
        'anchor' => 'crud/curso/index.php',
    ],
];

function mostrarModulos($title, $class, $anchor)
{
    echo
        '<div >
                <a class="card ' . $class . '" href="' . $anchor . '">
                    <img src="../images/background/background.jpg" class="img-fluid w-100 p-0 " alt="...">
                    <div class="card-body">
                        <h2 class="card-title text-center text-black">
                            ' . $title . '
                        </h2>
                    </div>
                </a>
        </div>';
}

for ($i = 0; $i < count(modulos); $i++) {
    mostrarModulos(modulos[$i]['title'], modulos[$i]['class'], modulos[$i]['anchor']);
}