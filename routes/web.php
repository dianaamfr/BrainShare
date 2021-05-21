<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home and Static
Route::get('/', 'HomeController@show')->name('home');
Route::get('/about', 'StaticController@showAbout')->name('about');
Route::get('/notfound', 'StaticController@showNotFound')->name('notfound');

// Search Questions
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/api/search', 'SearchController@advancedSearch')->name('api/search');

// Search Tags
Route::get('api/tag/search', 'TagController@search');
Route::get('api/tag/{id}', 'TagController@find');

// Add Question
Route::get('/question/add', 'QuestionController@showQuestionForm');
Route::post('/question/add', 'QuestionController@create')->name('question');

// Show Question
Route::get('/question/{id}', 'QuestionController@show')->name('show-question');

// Vote Question and Answer
Route::post('api/question/{id}/vote', 'QuestionController@voteQuestion')->name('vote-question');
Route::post('api/question/{idQuestion}/answer/{idAnswer}', 'QuestionController@voteAnswer')->name('vote-answer');

// Mark Answer as Valid
Route::post('api/answer/valid/{idAnswer}', 'AnswerController@markValid');

// Edit Question
Route::get('/question/{id}/edit', 'QuestionController@showEditQuestionForm');
Route::put('/question/{id}/edit', 'QuestionController@updateQuestion')->name('edit-question');

// Deletes
Route::delete('question/{id}', 'QuestionController@delete')->name('delete-question');
//Route::delete('/question/{id-q}/answer/{id-a}','QuestionController@deleteComment')->name('delete-comment');
//Route::delete('user/{id}/delete', 'UserController@deleteUser')->name('delete-user');

// Answer
Route::post('/api/question/{id}/answer','AnswerController@newAnswer');

Route::put('/api/question/{id-q}/answer/{id-a}','AnswerController@editAnswer')->name('edit-answer');
Route::delete('/api/question/{id-q}/answer/{id-a}','AnswerController@deleteAnswer')->name('delete-answer');

// Comment
Route::post('/api/question/{id-q}/{id-a}/comment/add','CommentController@addComment')->name('add-comment');
Route::put('/api/question/{id-q}/comment/{id-c}','CommentController@editComment')->name('edit-comment');
Route::delete('/api/question/{id-q}/comment/{id-c}','CommentController@deleteComment')->name('delete-comment');

// Module M01: Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Profile: change in A9
Route::get('/user/{id}/profile', "UserController@showProfile")->name('show-profile');
Route::get('/api/user/{id}/questions', 'UserController@paginateQuestions');
Route::get('/api/user/{id}/answers', 'UserController@paginateAnswers');

Route::put('/user/{id}/profile', "UserController@deleteUserOnProfile")->name('delete-user');
Route::get('/user/{id}/profile/edit', "UserController@showEditProfile")->name('show-edit-profile');
Route::put('/user/{id}/profile/edit', "UserController@editProfile")->name('edit-profile');

// Management: change in A9 when we implement this user stories
Route::get('/admin/reports', 'StaticController@showReports')->name('manage-reports');

// Manage categories
Route::get('/admin/tags', 'CategoriesController@showTags')->name('manage-tags');
Route::get('/api/admin/tags', 'CategoriesController@searchTags')->name('manage-tags-search');
// TODO: adicionar o id da tag e tirar o add.
Route::post('/api/admin/tags/add', 'CategoriesController@addTag')->name('manage-tags-add');
Route::delete('/api/admin/tags/delete', 'CategoriesController@deleteTag')->name('manage-tags-delete');

Route::get('/admin/courses', 'CategoriesController@showCourses')->name('manage-courses');
Route::get('/api/admin/courses', 'CategoriesController@searchCourses')->name('manage-courses-search');
Route::post('/api/admin/courses/add', 'CategoriesController@addCourse')->name('manage-courses-add');
Route::delete('/api/admin/courses/delete', 'CategoriesController@deleteCourse')->name('manage-courses-delete');

// Manage Users
Route::get('/admin/user', 'ManageUsersController@show')->name('manage-users');
Route::put('api/admin/user/{id}', 'ManageUsersController@update');
Route::get('api/admin/user', 'ManageUsersController@search');

// Manage Reports
Route::get('/admin/reports', 'ManageReportsController@show')->name('manage-reports');
Route::put('api/admin/reports/discard', 'ManageReportsController@discard');
Route::put('api/admin/reports/delete', 'ManageReportsController@delete');
Route::get('api/admin/reports', 'ManageReportsController@search');

// Password Reset
Route::get('/forgot-password', 'Auth\PasswordResetController@show')->name('password.request');
Route::post('/forgot-password', 'Auth\PasswordResetController@requestRecovery')->name('password.email');
Route::get('/reset-password/{token}', 'Auth\PasswordResetController@showResetPassword')->name('password.reset');
Route::post('/reset-password', 'Auth\PasswordResetController@resetPassword')->name('password.update');


// Report
Route::get('api/report/status', 'ReportController@isReported');
Route::post('/api/report/question/{id}', 'ReportController@reportQuestion');
Route::post('api/report/answer/{id}', 'ReportController@reportAnswer');
Route::post('api/report/comment/{id}', 'ReportController@reportComment');
