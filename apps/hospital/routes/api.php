<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'prescriptions/v1'], function () {
    Route::get('/', 'Api\PrescriptionsController@index')
        ->name('api.prescriptions.index');
    Route::get('/by-patient/{id}', 'Api\PrescriptionsController@indexByPatient')
        ->name('api.prescriptions.indexByPatient');
});
