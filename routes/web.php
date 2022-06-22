<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('admin.home');
});
Route::get('/user/verify/{token}', 'App\Http\Controllers\Api\Auth\RegisterController@verifyUser');
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

    Route::post('excel/export', 'UserController@excelExport' )->name('user.excelExport');
    Route::post('all-users', 'UserController@allUsers' )->name('allUsers');
    Route::resource('user', 'UserController');
    Route::any('user/{id}/ban', 'UserController@ban')->name('user.ban');
    Route::any('user/{id}/activate', 'UserController@activate')->name('user.activate');
    Route::post('user/{id}/approve', 'UserController@approve')->name('user.approve');

    Route::resource('company', 'CompanyController');
    Route::post('company/{id}/ban', 'CompanyController@ban')->name('company.ban');
    Route::post('company/{id}/activate', 'CompanyController@activate')->name('company.activate');
    Route::post('company/{id}/approve', 'CompanyController@approve')->name('company.approve');
    Route::post('company/{id}/site_show', 'CompanyController@siteShow')->name('company.site_show');
    Route::post('company/{id}/site_disappear', 'CompanyController@siteDisappear')->name('company.site_disappear');

    Route::resource('salary', 'SalaryController');
    Route::resource('major', 'MajorController');
    Route::post('major/{id}/ban', 'MajorController@ban')->name('major.ban');
    Route::post('major/{id}/activate', 'MajorController@activate')->name('major.activate');

    Route::resource('sector', 'SectorController');
    Route::post('sector/{id}/ban', 'SectorController@ban')->name('sector.ban');
    Route::post('sector/{id}/activate', 'SectorController@activate')->name('sector.activate');

    Route::resource('nationality', 'NationalityController');
    Route::post('nationality/{id}/ban', 'NationalityController@ban')->name('nationality.ban');
    Route::post('nationality/{id}/activate', 'NationalityController@activate')->name('nationality.activate');

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
    Route::post('job/{id}/ban', 'JobController@ban')->name('job.ban');
    Route::post('job/{id}/activate', 'JobController@activate')->name('job.activate');

    Route::resource('hear_by', 'HearByController');
    Route::post('hear_by/{id}/ban', 'HearByController@ban')->name('hear_by.ban');
    Route::post('hear_by/{id}/activate', 'HearByController@activate')->name('hear_by.activate');

    Route::resource('contact_type', 'ContactTypeController');
    Route::post('contact_type/{id}/ban', 'ContactTypeController@ban')->name('contact_type.ban');
    Route::post('contact_type/{id}/activate', 'ContactTypeController@activate')->name('contact_type.activate');

    Route::resource('hiring_agent', 'HiringAgentController');
    Route::post('hiring_agent/{id}/ban', 'HiringAgentController@ban')->name('hiring_agent.ban');
    Route::post('hiring_agent/{id}/activate', 'HiringAgentController@activate')->name('hiring_agent.activate');

    Route::get('page/{type}/{for}', 'PageController@page')->name('page.edit');
    Route::put('page/{id}', 'PageController@update')->name('page.update');

    Route::get('blog_type/new', 'BlogController@news')->name('blogs.new');
    Route::get('blog_type/new/create', 'BlogController@createNew')->name('blogs.create-new');

    Route::get('blog_type/blog', 'BlogController@blogs')->name('blogs.blog');
    Route::get('blog_type/blog/create', 'BlogController@createBlog')->name('blogs.create-blog');

    Route::resource('blog', 'BlogController');
    Route::resource('hiring_law', 'HiringLawController');

});
