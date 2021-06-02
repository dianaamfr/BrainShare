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

// MODULE 01 - Authentication and User Profile

// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// Profile
Route::get('/user/{id}/profile', "UserController@showProfile")->name('show-profile');
Route::get('/api/user/{id}/questions', 'UserController@paginateQuestions');
Route::get('/api/user/{id}/answers', 'UserController@paginateAnswers');

Route::delete('/user/{id}/profile', "UserController@deleteUserOnProfile")->name('delete-user');
Route::get('/user/{id}/profile/edit', "UserController@showEditProfile")->name('show-edit-profile');
Route::put('/user/{id}/profile/edit', "UserController@editProfile")->name('edit-profile');

// Notifications
Route::post('/api/notification/{id}', 'NotificationController@read');
Route::delete('/api/notification/{id}', 'NotificationController@delete');
Route::get('/api/notification', 'NotificationController@load');

// Report
Route::post('api/report/user/{id}', 'ReportController@reportUser');

// MODULE 02 - Questions

// Search Questions
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/api/search', 'SearchController@advancedSearch')->name('api/search');

// Add Question
Route::get('/question/add', 'QuestionController@showQuestionForm');
Route::post('/question/add', 'QuestionController@create')->name('question');

// Question Page
Route::get('/question/{id}', 'QuestionController@show')->name('show-question');
Route::delete('/question/{id}', 'QuestionController@delete')->name('delete-question');

// Edit Question
Route::get('/question/{id}/edit', 'QuestionController@showEditQuestionForm');
Route::put('/question/{id}/edit', 'QuestionController@updateQuestion')->name('edit-question');

// Answer
Route::get('/api/question/{id}/scroll', 'AnswerController@appendInfiniteScroll');
Route::post('/api/question/{id}/answer','AnswerController@newAnswer');
Route::put('/api/answer/{id}','AnswerController@editAnswer')->name('edit-answer');
Route::delete('/api/answer/{id}','AnswerController@deleteAnswer')->name('delete-answer');

// Comment
Route::get('/api/answer/{id}/comments','CommentController@showMoreComments');
Route::post('/api/answer/{id}/comment','CommentController@addComment')->name('add-comment');
Route::put('/api/comment/{id}','CommentController@editComment')->name('edit-comment');
Route::delete('/api/comment/{id}','CommentController@deleteComment')->name('delete-comment');

// Mark Answer as Valid
// TODO: mudar idAnswer para id?
// TODO: meter '/' no ínicio do path
Route::post('api/answer/valid/{idAnswer}', 'AnswerController@markValid');

// Vote Question and Answer
// TODO: meter '/' no ínicio dos paths
Route::post('api/question/{id}/vote', 'QuestionController@voteQuestion')->name('vote-question');
Route::post('api/question/{idQuestion}/answer/{idAnswer}', 'QuestionController@voteAnswer')->name('vote-answer');



// Make Report
// TODO: Remover status?
// TODO: meter '/' no ínicio dos paths
Route::get('api/report/status', 'ReportController@isReported');
Route::post('/api/report/question/{id}', 'ReportController@reportQuestion');
Route::post('api/report/answer/{id}', 'ReportController@reportAnswer');
Route::post('api/report/comment/{id}', 'ReportController@reportComment');

// Search Tags
// TODO: Remover search?
// TODO: meter '/' no ínicio dos paths
Route::get('api/tag/search', 'TagController@search');
Route::get('api/tag/{id}', 'TagController@find');


// MODULE 03 - Management

// Manage Tags
Route::get('/admin/tags', 'CategoriesController@showTags')->name('manage-tags');
Route::get('/api/admin/tags', 'CategoriesController@searchTags')->name('manage-tags-search');
Route::post('/api/admin/tags/add', 'CategoriesController@addTag')->name('manage-tags-add');
Route::delete('/api/admin/tags/delete', 'CategoriesController@deleteTag')->name('manage-tags-delete');

// Manage Courses
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
Route::put('api/admin/reports/undiscard', 'ManageReportsController@undiscard');
Route::put('api/admin/reports/discard', 'ManageReportsController@discard');
Route::put('api/admin/reports/delete', 'ManageReportsController@delete');
Route::put('api/admin/reports/revert', 'ManageReportsController@revert');
Route::get('api/admin/reports', 'ManageReportsController@search');

// Password Reset
Route::get('/forgot-password', 'Auth\PasswordResetController@show')->name('password.request');
Route::post('/forgot-password', 'Auth\PasswordResetController@requestRecovery')->name('password.email');
Route::get('/reset-password/{token}', 'Auth\PasswordResetController@showResetPassword')->name('password.reset');
Route::post('/reset-password', 'Auth\PasswordResetController@resetPassword')->name('password.update');

Route::fallback(function() {
    return view('errors.404');
});