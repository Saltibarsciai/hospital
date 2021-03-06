<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => ['doctor']], function () {
        Route::get('/', 'DoctorController@index')
            ->name('doctor-dashboard');
    });
    Route::group(['prefix' => 'receptionist', 'middleware' => ['receptionist']], function () {
        Route::get('/', 'ReceptionistController@index')
            ->name('receptionist-dashboard');
    });

    Route::group(['prefix' => 'appointment', 'middleware' => ['receptionist']], function () {
        Route::get('/', 'AppointmentController@index')
            ->name('appointment.index');
        Route::post('create', 'AppointmentController@create')
            ->name('appointment.create');
        Route::put('{id}', 'AppointmentController@update')
            ->name('appointment.update');
        Route::get('delete/{id}', 'AppointmentController@delete')
            ->name('appointment.delete');
        Route::get('update/{id}', 'AppointmentController@updateUi')
            ->name('appointment.update.ui');
        Route::get('create', 'AppointmentController@createUi')
            ->name('appointment.create.ui');
    });

    Route::group(['prefix' => 'reservation', 'middleware' => ['receptionist']], function () {
        Route::post('/', 'ReservationController@create')
            ->name('reservation.create');
    });

    Route::group(['prefix' => 'patients', 'middleware' => ['doctor']], function () {
        Route::get('/', 'PatientController@index')
            ->name('patients.index');
    });

    Route::group(['prefix' => 'prescriptions', 'middleware' => ['doctor']], function () {
        Route::get('/', 'PrescriptionController@index')
            ->name('prescriptions.index');
        Route::group(['prefix' => 'patient'], function () {
            Route::get('/{id}', 'PrescriptionController@indexByPatient')
                ->name('prescriptions.indexByPatient');
            Route::get('create/{id}', 'PrescriptionController@createByPatientUi')
                ->name('prescriptions.createByPatient.ui');
            Route::post('create', 'PrescriptionController@createByPatient')
                ->name('prescriptions.createByPatient');
            Route::get('delete/{id}', 'PrescriptionController@delete')
                ->name('prescriptions.delete');
        });
    });
});



