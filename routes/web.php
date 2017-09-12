<?php

use App\User;

Route::view('/', 'welcome')->name('index');

// Auth
Auth::routes();

// Page
Route::name('pages.home')->get('/home', 'PageController@home');

// Lesson
Route::name('lessons.create')->get('/lessons/{user}/create', 'LessonController@create');
Route::name('lessons.store')->post('/lessons/{user}', 'LessonController@store');