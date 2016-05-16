<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::get('letmein', 'LoginController@getLogin');
    Route::get('byebye', 'LoginController@getLogout');
    Route::post('letmein', 'LoginController@postLogin');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('general_setting/clear_cache','SettingController@clear_cache');
        Route::get('general_setting/clear_cache_data','SettingController@clear_cache_data');
        Route::get('general_setting/email_setting','SettingController@email_setting');
        Route::get('general_setting/translation','SettingController@translation');
        Route::get('general_setting/removetranslation/{folder}','SettingController@removetranslation');

        Route::get('module/manage_permission/{id}','ModuleController@manage_permission')->where('id', '[0-9]+');

        Route::post('changePassword','AdminController@changePassword');
        Route::post('module/save_user_permission/{id}/{module_id}','ModuleController@save_user_permission')->where(['id' => '[0-9]+', 'module_id' => '[0-9]+']);
        Route::post('general_setting/addtranslation','SettingController@addtranslation');
        Route::post('general_setting/savetranslation','SettingController@savetranslation');
        Route::post('general_setting/email_server_data','SettingController@email_server_data');

        Route::resource('admin','AdminController');
        Route::resource('dashboard','DashboardController');
        Route::resource('role','RoleController');
        Route::resource('module','ModuleController');

    });

});
