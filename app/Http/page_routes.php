<?php 
 
Route::group(['middleware' => 'checkinstall'], function () { 
    Route::get('home', 'HomeController@index');
    Route::get('about-us', 'HomeController@index');
    Route::get('blog', 'HomeController@index');
    Route::get('contact-us', 'HomeController@index');
});