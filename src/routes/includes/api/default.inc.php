<?php

Route::prefix('v1')->name('api.')->group(function () {

  # Portfolio
    Route::get('portfolio', 'Api\ApiCollectionController@portfolio')->name('portfolio');

    Route::get('profile', 'Api\ApiProfileController@profile')->name('profile');

    Route::patch('profile/update', 'Api\ApiProfileController@update')->name('profile.update');

    Route::get('search/{query}', 'Api\ApiSearchController@query')->name('search');
});
