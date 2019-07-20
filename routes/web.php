<?php


Route::get('/users', function () {
    return view('users.index');
});

Route::get('/','StaticPagesController@index')->name('home');
Route::get('/about','StaticPagesController@about')->name('about');
Route::get('/help','StaticPagesController@help')->name('help');

Route::get('signup','UsersController@create')->name('signup');

