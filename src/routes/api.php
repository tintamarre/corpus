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
//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//
// Route::middleware('auth:api')->get('/test', function () {
//     // http://localhost/api/test?api_token=r5Vhv6NoZed8AUbo39ArVAgEXCYPv8DUWmzPOnOmJxpLNNNABJS51hQquDTh
//     return 'test';
// });
Route::group(['middleware' => ['auth:api', 'verified']], function () {
    require base_path('routes/includes/api/default.inc.php');

    Route::group(['middleware' => [
    'can:view-collection,collection',
  ],
], function () {
    require base_path('routes/includes/api/can-view-collection.inc.php');
});
});
