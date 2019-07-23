<?php

Route::get('/','StaticPagesController@index')->name('home');
Route::get('/about','StaticPagesController@about')->name('about');
Route::get('/help','StaticPagesController@help')->name('help');

Route::get('signup','UsersController@create')->name('signup');

Route::resource('users','UsersController');

//会话控制器
Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');

