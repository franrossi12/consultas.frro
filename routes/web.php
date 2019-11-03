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

Route::get('/', function () {return view('welcome');})->name('welcome');

// login
Route::post('login', 'Auth\LoginController@login')->name('auth.login-submit');
Route::get('login', function () { return view('pages.auth.login');})->name('auth.login');
// logout
Route::get('logout',  'Auth\LoginController@logout')->name('auth.logout');
// register
Route::get('register', function () { return view('pages.auth.register');})->name('auth.register');
Route::post('register', 'Auth\RegisterController@create')->name('auth.register-submit');
// confirm - reset password
Route::get('confirmar-contraseña/{token}', 'Auth\VerificationController@verify')->name('auth.confirmar');
Route::get('olvide-contraseña',  function () { return view('pages.auth.forgot');})->name('auth.forgot');
Route::post('olvide-contraseña',  'Auth\ForgotPasswordController@send')->name('auth.forgot-submit');
Route::get('olvide-contraseña/{token}',  'Auth\ForgotPasswordController@form');
Route::post('resetear-contraseña',  'Auth\ResetPasswordController@resetPassword')->name('auth.reset-submit');


/* RUTAS ADMIN */
Route::prefix('admin')->group(function () {
    Route::get('home', function () {
        return view('pages.admin.home');
    })->name('admin.home');

    Route::resource('profesores', 'ProfesorController');

    Route::resource('materias', 'MateriaController');

    Route::resource('diasSinClase', 'DiaSinClaseController');

    Route::resource('consultas', 'ConsultaController');

    Route::get('eventos', function () {
        return view('pages.admin.queries.query');
    })->name('admin.eventos');

});
/* RUTAS ADMIN */

/* RUTAS PROFESOR */
Route::prefix('profesor')->group(function () {
    Route::get('home', function () {
        return view('pages.profesor.home');
    })->name('profesor.home');
});
/* RUTAS PROFESOR */

/* RUTAS ALUMNO */
Route::prefix('alumno')->group(function () {
    Route::get('home', function () {
        return view('pages.alumno.home');
    })->name('alumno.home');

    Route::get('perfil', 'PerfilController@index')->name('alumno.perfil');

});
/* RUTAS ALUMNO */
