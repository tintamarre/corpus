<?php

Route::prefix('v1')->name('api.')->group(function () {

  # Resource
    Route::get('collection/{collection:slug}/resources/labels', 'Api\ApiCollectionResourcesController@labels')
  ->name('collection.resources.labels');

    Route::get('collection/{collection:slug}/resources/tags', 'Api\ApiCollectionResourcesController@tags')
  ->name('collection.resources.tags');

    Route::get('collection/{collection:slug}/resources/tags/{tag:id}', 'Api\ApiCollectionResourcesController@parent_tags')
  ->name('collection.resources.parent_tags');

    # Collection
    Route::apiResource('collection', 'Api\ApiCollectionController')->only(['show', 'index', 'destroy'])->parameters([
    'collection' => 'collection:slug',
  ]);

    # Tag
    Route::apiResource('collection.tags', 'Api\ApiTagController')->parameters([
    'collection' => 'collection:slug',
    'tags' => 'tag:id',
  ]);

    # Tag Segment
    Route::apiResource('collection.segment_tag', 'Api\ApiSegmentTagController');

    # Text
    Route::apiResource('collection.texts', 'Api\ApiTextController')->parameters([
    'collection' => 'collection:slug',
    'texts' => 'text:slug',
  ]);

    # Users
    Route::apiResource('collection.users', 'Api\ApiCollectionUserController');

    Route::post('collection/{collection:slug}/users/{user}/detach', 'Api\ApiCollectionUserController@detach')
  ->name('collection.users.detach');

    # Users
    Route::apiResource('collection.segments', 'Api\ApiSegmentController')->only(['store', 'update', 'destroy'])->parameters([
    'collection' => 'collection:slug',
    'segments' => 'segment', // Warning segment doesn't directly belong to collection
  ]);

    # Label Chart
    Route::get('collection/{collection:slug}/chart-labels/{label:id}', 'Api\ApiLabelChartController@data')
  ->name('collection.chart.labels.data');

    # Label Text
    Route::apiResource('collection.label_text', 'Api\ApiLabelTextController')->only(['update', 'destroy'])->parameters([
    'collection' => 'collection:slug',
    'label_text' => 'label_text:id',
  ]);

    # Text Labels
    Route::apiResource('collection.texts.labels', 'Api\ApiTextLabelController')->only(['store'])->parameters([
    'collection' => 'collection:slug',
    'texts' => 'text:slug',
    'labels' => 'label:id',
  ]);

    # Text Tags
    Route::apiResource('collection.texts.tags', 'Api\ApiTextTagController')->only(['store'])->parameters([
    'collection' => 'collection:slug',
    'texts' => 'text:slug',
    'tags' => 'tag:id',
  ]);

    # Tag graph
    Route::get('collection/{collection:slug}/tag-graph/{tag:id}', 'Api\ApiTagGraphController@data')
  ->name('collection.tag-graph.data');
});
