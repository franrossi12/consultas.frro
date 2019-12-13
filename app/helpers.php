<?php

use App\Modelos\Dia;

function currentUser() {
    return auth()->user();
}

function redirectAfterLogin() {
    $u = currentUser();

    if (!empty($u)) {
        switch ($u->perfil->tag) {
            case 'ADMIN':
                return 'admin/home';
                break;
            case 'ALUMNO':
                return 'alumno/home';
                break;
            case 'PROFESOR':
                return 'profesor/home';
                break;
        }
    }
}

function homeRoute() {
    $u = currentUser();

    if (!empty($u)) {
        switch ($u->perfil->tag) {
            case 'ADMIN':
                return route('admin.home');
                break;
            case 'ALUMNO':
                return route('alumno.home');
                break;
            case 'PROFESOR':
                return route('profesor.home');
                break;
        }
    }
}

function mapsiteRoute() {
    $u = currentUser();

    if (!empty($u)) {
        switch ($u->perfil->tag) {
            case 'ADMIN':
                return route('admin.mapsite');
                break;
            case 'ALUMNO':
                return route('alumno.mapsite');
                break;
            case 'PROFESOR':
                return route('profesor.mapsite');
                break;
        }
    }
}






function getNumeroDia($numero) {
    $n = Dia::where('numero', $numero)->first();
    return $n->descripcion;
}
