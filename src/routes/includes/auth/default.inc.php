<?php

# Redirection
Route::get('/portfolio', 'HomeController@portfolio')->name('portfolio');

# Announcement
Route::get('/announcement', 'HomeController@announcement')->name('announcement');

# Profile
Route::get('/profile', 'ProfileController@show')->name('profile.show');

# Search
Route::get('/search/{query}', 'SearchController@show')->name('search.show');

# Collection
Route::resource('/collection', 'Collection\CollectionController')->only(['create', 'store'])->parameters([
  'collection' => 'collection:slug',
]);
