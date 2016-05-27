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

Route::group(['middleware' => 'checkinstall'], function () {

    Route::auth();

    Route::get('lang/{name}', function ($lang = 'en') {
        Session::forget('lang');
        Session::put('lang', $lang);
        return  Redirect::back();
    });

    Route::get('/', 'HomeController@index');

});

//Installer Route
Route::group(['prefix' => 'install','middleware'=>'checkfile'], function () {

    Route::get('/','InstallerController@welcome');
    Route::get('welcome', 'InstallerController@welcome');

    Route::get('environment', 'InstallerController@environment');
    Route::post('environmentSave','InstallerController@environmentSave');

    Route::get('user', 'InstallerController@user');
    Route::post('userSave', 'InstallerController@userSave');

    Route::get('setting','InstallerController@setting');
    Route::post('saveSetting','InstallerController@saveSetting');

    Route::get('finished', 'InstallerController@finished');

});

//Admin Route
Route::group(['namespace' => 'Admin'], function () {

    Route::get('letmein', 'LoginController@getLogin');
    Route::post('letmein', 'LoginController@postLogin');

    Route::get('byebye', 'LoginController@getLogout');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('documentation','DashboardController@documentation');

        //Setting
        Route::get('general_setting/email_setting','EmailController@index');
        Route::get('general_setting/site_setting','SettingController@site_setting');
        Route::get('general_setting/clear_cache','SettingController@clear_cache');
        Route::get('general_setting/clear_cache_data','SettingController@clear_cache_data');
        Route::get('general_setting/translation','SettingController@translation');
        Route::get('general_setting/removetranslation/{folder}','SettingController@removetranslation');

        Route::post('general_setting/addtranslation','SettingController@addtranslation');
        Route::post('general_setting/savetranslation','SettingController@savetranslation');
        Route::post('general_setting/save_site_setting','SettingController@save_site_setting');
        Route::post('general_setting/email_server_data','EmailController@email_server_data');


        Route::get('module/manage_permission/{id}','ModuleController@manage_permission')->where('id', '[0-9]+');

        Route::post('changePassword','AdminController@changePassword');
        Route::post('module/save_user_permission/{id}/{module_id}','ModuleController@save_user_permission')->where(['id' => '[0-9]+', 'module_id' => '[0-9]+']);

        Route::resource('admin','AdminController');
        Route::resource('dashboard','DashboardController');
        Route::resource('role','RoleController');
        Route::resource('module','ModuleController');
        Route::resource('blogs','BlogController');
        Route::resource('menu','MenuController');

        Route::resource('cms','CmsController');
        Route::get('cms/{theme}/page_list','CmsController@page_list');
        Route::get('cms/removetheme/{folder}','CmsController@removetheme');
        Route::post('cms/addtheme','CmsController@addtheme');

        Route::post('menu/saveorder','MenuController@saveorder');

        //Created Module Route
        include ('module_routes.php');
    });

});
