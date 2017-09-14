<?php

use App\User;

Route::view('/', 'welcome')->name('index');

// Auth
Auth::routes();

// Page
Route::name('pages.home')->get('/home', 'PageController@home');

// Lesson
Route::name('lessons.index')->get('/lessons/{user}', 'LessonController@index');
Route::name('lessons.store')->post('/lessons/{user}', 'LessonController@store');
Route::name('lessons.create')->get('/lessons/{user}/create', 'LessonController@create');
Route::name('lessons.update')->get('/lessons/{user}/{lesson}', 'LessonController@show');
Route::name('lessons.update')->put('/lessons/{user}/{lesson}', 'LessonController@update');
Route::name('lessons.destroy')->delete('/lessons/{user}/{lesson}', 'LessonController@destroy');
Route::name('lessons.edit')->get('/lessons/{user}/{lesson}/edit', 'LessonController@edit');


// Redirects all non-existing routes to index route
Route::any('{query}',
  function() { return redirect('/'); })
  ->where('query', '.*');