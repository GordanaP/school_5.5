<?php

use App\Http\Requests\LessonRequest;
use App\User;

// Test
Route::name('tests.index')->get('tests/{user}', 'TestController@index');

Route::view('/', 'welcome')->name('index');
Route::view('/invoice', 'pages.invoice')->name('invoice');

// Auth
Auth::routes();

// Page
Route::name('pages.home')->get('/home', 'PageController@home');

//Holiday
Route::resource('calendar/holidays', 'HolidayController');

// Event
Route::name('events.index')->get('calendar/{user}', 'EventController@index');
Route::name('events.store')->post('calendar/{user}', 'EventController@store');
Route::name('events.update')->put('calendar/{user}/{event}', 'EventController@update');
Route::name('events.destroy')->delete('calendar/{user}/{event}', 'EventController@destroy');


// Lesson
Route::name('lessons.index')->get('lessons/{user}', 'LessonController@index');
Route::name('lessons.store')->post('lessons/{user}', 'LessonController@store');
Route::name('lessons.create')->get('lessons/{user}/create', 'LessonController@create');
Route::name('lessons.update')->put('lessons/{user}/{lesson}', 'LessonController@update');
Route::name('lessons.destroy')->delete('lessons/{user}/{lesson}', 'LessonController@destroy');
Route::name('lessons.edit')->get('lessons/{user}/{lesson}/edit', 'LessonController@edit');
Route::name('lessons.show')->get('{user}/{lesson}', 'LessonController@show');

// Photo
Route::resource('photos', 'PhotoController');
Route::name('photos.store')->post('{user}/{lesson}/photos', 'PhotoController@store');

// Classroom
Route::resource('classrooms', 'ClassroomController', [
    'except' => 'index'
]);
Route::name('classrooms.subject')->get('classrooms/{param}/{user}/{event?}', 'ClassroomController@index');


// Subject
Route::get('subjects/{user}/{param}/{lesson?}', 'SubjectController@show');

// Redirects all non-existing routes to the index route
// Must be at the and of the page
Route::any('{query}',
  function() { return redirect('/'); })
  ->where('query', '.*');