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

Route::group(['middleware' => 'web'], function () {

  # Auth
    Auth::routes(['verify' => true]);

    require base_path('routes/includes/public.inc.php');

    Route::group(['middleware' => 'guest'], function () {
        require base_path('routes/includes/documentation.inc.php');
    });

    Route::group(['middleware' => ['auth', 'verified']], function () {
        require base_path('routes/includes/auth/default.inc.php');

        Route::group(['middleware' => [
      'can:access-root',
    ],
  ], function () {
      require base_path('routes/includes/auth/can-access-root.inc.php');
  });

        Route::group(['middleware' => [
    'can:view-collection,collection',
  ],
], function () {
    require base_path('routes/includes/auth/can-view-collection.inc.php');
});
    });
});
