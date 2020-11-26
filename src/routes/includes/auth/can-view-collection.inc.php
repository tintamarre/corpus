<?php

# Collection
Route::resource('collection', 'Collection\CollectionController')->only(['show', 'edit', 'update'])->parameters([
  'collection' => 'collection:slug',
]);

# Text
Route::resource('collection.texts', 'Collection\CollectionTextsController')
->only(['show', 'create', 'store'])
->parameters([
  'collection' => 'collection:slug',
  'texts' => 'text:slug',
]);

# Segments
Route::resource('collection.texts.segments', 'Collection\CollectionSegmentsController')->only(['store', 'update'])->parameters([
  'collection' => 'collection:slug',
  'texts' => 'text:slug',
  'segments' => 'segment:id',
]);

# Tag
Route::resource('collection.tags', 'Collection\CollectionTagsController')->only(['show'])->parameters([
  'collection' => 'collection:slug',
  'tags' => 'tag:id',
]);

# Labels
Route::resource('collection.labels', 'Collection\CollectionLabelsController')->only(['show'])->parameters([
  'collection' => 'collection:slug',
  'labels' => 'label:id',
]);
