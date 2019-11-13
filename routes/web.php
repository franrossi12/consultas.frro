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

use App\Mail\CancelacionAlumnoEmail;
use Illuminate\Support\Facades\Mail;

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


Route::get('test-email', function () {
    $turno = \App\Modelos\Turno::first();
    Mail::to('rossifrancisco12@gmail.com')
        ->send(new CancelacionAlumnoEmail($turno));
});

/* RUTAS ADMIN */
Route::middleware(['auth:web', 'is.perfil:ADMIN'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('profesores', 'ProfesorController');
        Route::resource('materias', 'MateriaController');
        Route::resource('diasSinClase', 'diaSinClaseController');
        Route::resource('consultas', 'ConsultaController');
        Route::get('eventos', function () {
            return view('pages.admin.queries.query');
        })->name('admin.eventos');

    Route::resource('profesores', 'ProfesorController');

    Route::resource('materias', 'MateriaController');

    Route::resource('diasSinClase', 'DiaSinClaseController');

    Route::resource('consultas', 'ConsultaController');

    Route::get('eventos', function () {
        return view('pages.admin.queries.query');
    })->name('admin.eventos');

    Route::get('home', 'AdminController@home')->name('admin.home');

    });
});
/* RUTAS ADMIN */

/* RUTAS PROFESOR */
Route::middleware(['auth:web', 'is.perfil:PROFESOR'])->group(function () {
    Route::prefix('profesor')->group(function () {
        Route::get('home', 'ProfesorController@home')->name('profesor.home');
        Route::get('consultas/listado', 'ProfesorController@listadoConsultas')->name('profesor.consultas.listado');

        Route::get('perfil', 'PerfilController@index')->name('profesor.perfil');
        Route::post('perfil', 'ProfesorController@update')->name('profesor.perfil.actualizar');
        Route::post('cancelar-consultas', 'ProfesorController@cancelarConsulta')->name('profesor.consultas.cancelar');
        Route::get('profesor/consultas/cancelar', 'ProfesorController@consultaCancelarIndex')->name('profesor.consultas.cancelar');

    });
});
/* RUTAS PROFESOR */

/* RUTAS ALUMNO */
Route::middleware(['auth:web', 'is.perfil:ALUMNO'])->group(function () {
    Route::prefix('alumno')->group(function () {
        Route::get('home', 'AlumnoController@home')->name('alumno.home');

        Route::get('perfil', 'PerfilController@index')->name('alumno.perfil');
        Route::post('perfil', 'AlumnoController@actualizarPerfil')->name('alumno.perfil.actualizar');

        Route::get('consultas/inscripcion', 'ConsultaController@inscripcionForm')->name('alumno.consultas.inscripcion');
        Route::get('consultas/listado', 'AlumnoController@listadoConsultas')->name('alumno.consultas.listado');

        Route::post('turnos-alumnos', 'TurnoAlumnoController@store')->name('alumno.turno.inscripcion');

        Route::get('materias/{id_carrera}', 'MateriaController@getByCarrera')->name('materias.get-por-carrera');
        Route::post('buscar-consultas', 'ConsultaController@buscarConsultas')->name('alumno.consultas.buscar');
        Route::post('cancelar-consultas', 'AlumnoController@cancelarConsulta')->name('alumno.consultas.cancelar');

    });
});
