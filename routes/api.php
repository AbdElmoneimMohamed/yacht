<?php

use Illuminate\Http\Request;

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

Route::post('userLogin', 'UserAPIController@login');
Route::post('userRegister', 'UserAPIController@register');
Route::get('getPhoto/{name}', 'UserAPIController@getPhoto');
Route::get('cronjobs', 'BoatAPIController@cronjobs');
Route::post('resetPassword', 'UserAPIController@resetPassword');

Route::group(['middleware' => ['auth:api']], function () {
    // users
    Route::post('logout', 'UserAPIController@logout');
    Route::get('getUserDetails', 'UserAPIController@getDetails');
    Route::patch('editProfile', 'UserAPIController@editProfile');
    Route::patch('changePassword', 'UserAPIController@changePassword');

    Route::post('uploadPhoto', 'UserAPIController@uploadPhoto');
    Route::delete('deletePhoto', 'UserAPIController@deletePhoto');
    Route::get('getNotifications', 'UserAPIController@getNotifications');
    Route::delete('deleteNotification', 'UserAPIController@deleteNotification');
    // boats
    Route::get('boats', 'BoatAPIController@getAllBoats');
    Route::post('boats', 'BoatAPIController@createBoat');
    Route::patch('boats', 'BoatAPIController@editBoat');
    Route::delete('boats', 'BoatAPIController@deleteBoat');
    Route::get('getBoat', 'BoatAPIController@getBoat');
    Route::get('getImages', 'BoatAPIController@getImages');

    // Maintenances
    Route::get('maintenances', 'MaintenanceAPIController@getAllMaintenances');
    Route::post('maintenances', 'MaintenanceAPIController@createMaintenance');
    Route::patch('maintenances', 'MaintenanceAPIController@editMaintenance');
    Route::delete('maintenances', 'MaintenanceAPIController@deleteMaintenance');

    // Engines
    Route::get('engines', 'EngineAPIController@getAllEngines');
    Route::post('engines', 'EngineAPIController@createEngine');
    Route::patch('engines', 'EngineAPIController@editEngine');
    Route::delete('engines', 'EngineAPIController@deleteEngine');

    // Rpms
    Route::get('rpms', 'RpmAPIController@getAllRpms');
    Route::post('rpms', 'RpmAPIController@createRpm');
    Route::patch('rpms', 'RpmAPIController@editRpm');
    Route::delete('rpms', 'RpmAPIController@deleteRpm');

    // Trips
    Route::get('trips', 'TripAPIController@getAllTrips');
    Route::post('trips', 'TripAPIController@createTrip');
    Route::patch('trips', 'TripAPIController@editTrip');
    Route::delete('trips', 'TripAPIController@deleteTrip');
    Route::get('getTrip', 'TripAPIController@getTrip');

    // Stages
    Route::get('stages', 'StageAPIController@getAllStages');
    Route::post('stages', 'StageAPIController@createStage');
    Route::patch('stages', 'StageAPIController@editStage');
    Route::delete('stages', 'StageAPIController@deleteStage');
});
