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
        Route::get('hear_by', 'DropDownController@hearBy');
        Route::get('nationalities', 'DropDownController@nationalities');
        Route::get('countries', 'DropDownController@countries');
        Route::get('countries/{countryId}/cities', 'DropDownController@cities');
        Route::get('majors', 'DropDownController@majors');
        Route::get('majorsAverageSalary', 'DropDownController@majorsAverageSalary');
        Route::get('majorsAverageSalary/AverageSalary', 'DropDownController@AverageSalary');
        Route::get('sectors', 'DropDownController@sectors');
        Route::get('majors/{id}/subs', 'DropDownController@subMajors');
        Route::get('sectors/{id}/subs', 'DropDownController@subSectors');
        Route::get('pages/{user_type}/{type}', 'PageController@getPage');
    });
    // AUTH
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('user/register', 'RegisterController@userRegister');
        Route::post('company/register', 'RegisterController@companyRegister');

        Route::post('forget-password','ForgotPasswordController@sendResetLink');
        Route::get('reset-password/{token}','ForgotPasswordController@validateToken');
        Route::post('reset-password/{token}','ForgotPasswordController@setPassword');

        Route::post('verify-email','RegisterController@verifyUser');



        Route::post('login', 'LoginController@login');
        // AuthedUser
        Route::group([
            'middleware' => JwtTokenIsValid::class,
        ], function () {
            Route::post('logout', 'LoginController@logout');

            Route::post('update-password','ForgotPasswordController@updatePassword');
        });
    });
    // USER
    Route::group(['namespace' => 'User', 'prefix' => 'user','middleware'=>JwtTokenIsValid::class], function () {
        Route::get('simple-profile', 'UserController@simpleProfile');
        Route::get('profile', 'UserController@profile');
        Route::post('update-avatar', 'UserController@updateAvatar');
        Route::get('cv', 'UserController@userCv');
        Route::post('upload-cv', 'UserController@uploadCv');
        Route::any('delete-cv/{id}', 'UserController@deleteCv');
        Route::post('premium', 'UserController@premium');

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
    //Contact
    Route::group([
        'namespace' => 'Contact',
//        'middleware'=>JwtTokenIsValid::class
    ], function () {
        Route::get('contact-types', 'ContactController@contactTypes');
        Route::post('contact', 'ContactController@store');

    });
    // NOTIFICATIONS
    Route::group(['namespace' => 'Notification', 'prefix' => 'notification','middleware'=>JwtTokenIsValid::class], function () {
        Route::get('/', 'NotificationController@index');
        Route::get('/{id}', 'NotificationController@show');
    });
    // Visitor
    Route::group(['namespace' => 'Visitor', 'prefix' => 'visitor'], function () {
        Route::post('job-email', 'JobController@emailNewJob');
        Route::get('majors', 'JobController@majors');
        Route::get('majors/{id}/jobs', 'JobController@majorJobs');
        Route::get('job/{id}', 'JobController@show');
        Route::get('hiring-agents', 'JobController@hiringAgents');
        Route::get('active-companies', 'JobController@activeCompanies');
        Route::get('hiring-laws', 'JobController@hiringLaws');

        Route::get('news', 'BlogController@news');
        Route::get('news/{id}', 'BlogController@show');
        Route::get('news/{id}/comments', 'BlogController@comments');
        Route::get('news/{id}/related', 'BlogController@related');
        Route::post('news/{id}/comment', 'BlogController@storeComment')->middleware(JwtTokenIsValid::class);

        Route::get('blogs', 'BlogController@blogs');
        Route::get('blogs/{id}', 'BlogController@show');
        Route::get('blogs/{id}/comments', 'BlogController@comments');
        Route::get('blogs/{id}/related', 'BlogController@related');
        Route::post('blogs/{id}/comment', 'BlogController@storeComment')->middleware(JwtTokenIsValid::class);

        Route::get('update-location', 'BlogController@updateLocation');

    });
    // COMPANY
    Route::group(['namespace' => 'Company', 'prefix' => 'company','middleware'=>JwtTokenIsCompany::class], function () {
        Route::post('job', 'JobController@store');
        Route::put('job/{id}', 'JobController@update');
        Route::delete('job/{id}', 'JobController@delete');
        Route::get('active-job', 'JobController@activeJobs');
        Route::get('expired-job', 'JobController@expiredJobs');
        Route::get('job/{id}', 'JobController@show');
        Route::get('job/{id}/subscribes', 'JobController@subscribes');
        Route::get('find-employee', 'EmployeeController@findEmployee');
        Route::any('employee/{id}', 'EmployeeController@showEmployee');
        Route::post('employee/{id}/message', 'EmployeeController@messageEmployee');
        Route::get('message', 'EmployeeController@messages');

        Route::get('find-major-salary', 'JobController@findJobSalary');
        Route::get('find-average-salary', 'JobController@findAverageSalary');

        Route::get('profile', 'CompanyController@profile');
        Route::post('update-profile', 'CompanyController@updateProfile');



    });
    // employer
    Route::group(['namespace' => 'Employer', 'prefix' => 'employer','middleware'=>JwtTokenIsValid::class], function () {
        Route::get('active-job', 'JobController@activeJobs');
        Route::get('expired-job', 'JobController@expiredJobs');
        Route::post('job-alert', 'JobController@notifyNewJob');
        Route::get('seen/company', 'CompanyController@seenCompany');
        Route::post('subscribe-job', 'JobController@subscribeJob');
        Route::get('company/{id}', 'CompanyController@showCompany');
        Route::post('company/{id}/message', 'CompanyController@messageCompany');
        Route::get('message', 'CompanyController@messages');
        Route::get('job/{id}', 'JobController@show');
    });
    Route::get('employer/find-job', 'Employer\JobController@findJob');
});
