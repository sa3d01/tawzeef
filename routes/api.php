<?php

use \App\Http\Middleware\JwtTokenIsValid;
use \App\Http\Middleware\JwtTokenIsCompany;
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
        // AuthedUser
        Route::group([
            'middleware' => JwtTokenIsValid::class,
        ], function () {
            Route::post('logout', 'LoginController@logout');
        });
    });
    // USER
    Route::group(['namespace' => 'User', 'prefix' => 'user','middleware'=>JwtTokenIsValid::class], function () {
        Route::get('simple-profile', 'UserController@simpleProfile');
        Route::get('profile', 'UserController@profile');
        Route::post('update-avatar', 'UserController@updateAvatar');

        Route::get('personal-info', 'UserController@personalInfo');
        Route::post('update-personal-info', 'UserController@updateProfile');
        Route::get('personal-socials', 'UserController@personalSocials');
        Route::post('update-socials', 'UserController@updateSocials');
        Route::get('personal-contacts', 'UserController@personalContacts');
        Route::post('update-contacts', 'UserController@updateContacts');
        Route::get('personal-qualifications', 'UserController@personalQualifications');
        Route::post('update-qualifications', 'UserController@updateQualifications');
        Route::get('personal-sub-majors', 'UserController@personalSubMajors');
        Route::post('update-sub-majors', 'UserController@updateSubMajors');
        Route::get('personal-job-required', 'UserController@personalJobRequired');
        Route::post('update-job-required', 'UserController@updateJobRequired');
        Route::get('personal-training-courses', 'UserController@personalTrainingCourses');
        Route::post('update-training-courses', 'UserController@updateTrainingCourses');
        Route::get('personal-experience', 'UserController@personalExperience');
        Route::post('update-experience', 'UserController@updateExperience');
        Route::get('personal-memberships', 'UserController@personalMemberships');
        Route::post('update-memberships', 'UserController@updateMemberships');
        Route::get('personal-skills', 'UserController@personalSkills');
        Route::post('update-skills', 'UserController@updateSkills');
    });
    // COMPANY
    Route::group(['namespace' => 'Company', 'prefix' => 'company','middleware'=>JwtTokenIsCompany::class], function () {
        Route::post('job', 'JobController@store');
        Route::get('active-job', 'JobController@activeJobs');
        Route::get('expired-job', 'JobController@expiredJobs');
        Route::post('find-employee', 'EmployeeController@findEmployee');
        Route::get('employee/{id}', 'EmployeeController@showEmployee');
        Route::post('employee/{id}/message', 'EmployeeController@messageEmployee');

    });
});
