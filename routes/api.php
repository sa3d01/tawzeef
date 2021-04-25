<?php

use \App\Http\Middleware\JwtTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'v1',
], function () {
    // General
    Route::group(['namespace' => 'General', 'prefix' => 'general'], function () {
        Route::get('settings', 'SettingController@getSettings');
        Route::get('banks', 'BankController@index');
        Route::get('countries', 'DropDownController@countries');
        Route::get('countries/{countryId}/cities', 'DropDownController@cities');
        Route::get('majors', 'DropDownController@majors');
        Route::get('majors/{id}/subs', 'DropDownController@subMajors');
        Route::get('pages/{user_type}/{type}', 'PageController@getPage');
    });
    // AUTH
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('user/register', 'RegisterController@useRegister');
        Route::post('company/register', 'RegisterController@companyRegister');
        Route::post('login', 'LoginController@login');
    });
    // USER
    Route::group(['namespace' => 'User', 'prefix' => 'user','middleware'=>JwtTokenIsValid::class], function () {
        Route::get('profile', 'UserController@profile');
        Route::post('update-avatar', 'UserController@updateAvatar');
        Route::post('update-personal-info', 'UserController@updateProfile');
        Route::post('update-socials', 'UserController@updateSocials');
    });
});
