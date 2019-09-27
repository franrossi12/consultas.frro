<?php

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
