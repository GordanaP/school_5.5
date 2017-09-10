<?php

Route::view('/', 'welcome')->name('index');

Auth::routes();

Route::get('/home', 'PageController@home')->name('pages.home');
