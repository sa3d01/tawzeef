<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('admin.home');
});

Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function() {
    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('login.submit');
        Route::post('/logout','LoginController@logout')->name('logout');
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    });
    Route::get('clear-all-notifications', 'NotificationController@clearAdminNotifications')->name('clear-all-notifications');
    Route::get('read-notification/{id}', 'NotificationController@readNotification')->name('read-notification');
    Route::get('settings', 'SettingController@showConfig')->name('settings.edit');
    Route::put('settings', 'SettingController@updateConfing')->name('settings.update');


    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::put('/profile', 'AdminController@updateProfile')->name('profile.update');

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('user', 'UserController');
    Route::post('user/{id}/ban', 'UserController@ban')->name('user.ban');
    Route::post('user/{id}/activate', 'UserController@activate')->name('user.activate');

    Route::resource('company', 'CompanyController');
    Route::post('company/{id}/ban', 'CompanyController@ban')->name('company.ban');
    Route::post('company/{id}/activate', 'CompanyController@activate')->name('company.activate');

    Route::resource('major', 'MajorController');
    Route::post('major/{id}/ban', 'MajorController@ban')->name('major.ban');
    Route::post('major/{id}/activate', 'MajorController@activate')->name('major.activate');

    Route::resource('country', 'CountryController');
    Route::post('country/{id}/ban', 'CountryController@ban')->name('country.ban');
    Route::post('country/{id}/activate', 'CountryController@activate')->name('country.activate');

    Route::resource('city', 'CityController');
    Route::post('city/{id}/ban', 'CityController@ban')->name('city.ban');
    Route::post('city/{id}/activate', 'CityController@activate')->name('city.activate');


    Route::resource('notification', 'NotificationController');
    Route::post('reply-contact/{id}', 'ContactController@replyContact')->name('contact.reply');
    Route::resource('contact', 'ContactController');

    Route::resource('bank', 'BankController');
    Route::post('bank/{id}/ban', 'BankController@ban')->name('bank.ban');
    Route::post('bank/{id}/activate', 'BankController@activate')->name('bank.activate');

    Route::resource('job', 'JobController');

    Route::resource('contact_type', 'ContactTypeController');
    Route::post('contact_type/{id}/ban', 'ContactTypeController@ban')->name('contact_type.ban');
    Route::post('contact_type/{id}/activate', 'ContactTypeController@activate')->name('contact_type.activate');

    Route::get('page/{type}/{for}', 'PageController@page')->name('page.edit');
    Route::put('page/{id}', 'PageController@update')->name('page.update');

});
