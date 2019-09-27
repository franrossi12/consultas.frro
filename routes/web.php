<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('login', 'Auth\LoginController@login')->name('auth.login-submit');
Route::get('login', function () { return view('pages.auth.login');})->name('auth.login');
Route::get('logout',  'Auth\LoginController@logout')->name('auth.logout');
Route::get('register', function () { return view('pages.auth.register');})->name('auth.register');


/* RUTAS ADMIN */
Route::prefix('admin')->group(function () {
    Route::get('home', function () {
        return view('pages.admin.home');
    })->name('admin.home');

    Route::get('profesores', function () {
        return view('pages.admin.profesores.listado');
    })->name('admin.profesores');

    Route::get('materias', function () {
        return view('pages.admin.materias.listado');
    })->name('admin.materias');

    Route::get('consultas', function () {
        return view('pages.admin.consultas.listado');
    })->name('admin.consultas');


    Route::get('eventos', function () {
        return view('pages.admin.queries.query');
    })->name('admin.eventos');

});
/* RUTAS ADMIN */

Route::prefix('profesor')->group(function () {
    Route::get('home', function () {
        return view('pages.profesor.home');
    })->name('profesor.home');
});

Route::prefix('alumno')->group(function () {
    Route::get('home', function () {
        return view('pages.alumno.home');
    })->name('alumno.home');
});
