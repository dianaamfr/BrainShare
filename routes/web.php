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

// Edit Question
Route::get('/question/{id}/edit', 'QuestionController@showEditQuestionForm');
Route::put('/question/{id}/edit', 'QuestionController@updateQuestion')->name('edit-question');

// Deletes
Route::delete('question/{id}', 'QuestionController@delete')->name('delete-question');
//Route::delete('/question/{id-q}/answer/{id-a}','QuestionController@deleteComment')->name('delete-comment');
//Route::delete('user/{id}/delete', 'UserController@deleteUser')->name('delete-user');

// Answer
Route::post('/api/question/{id}/answer/add','AnswerController@addAnswer')->name('add-answer');
Route::put('/api/question/{id-q}/answer/{id-a}','AnswerController@EditAnswer')->name('edit-answer');
Route::delete('/api/question/{id-q}/answer/{id-a}','AnswerController@DeleteAnswer')->name('delete-answer');

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
Route::get('/user/{id}/profile', "StaticController@showProfile");
Route::get('/user/profile/edit', "StaticController@showEditProfile")->name('edit-profile');

// Management: change in A9 when we implement this user stories

//Route::get('/admin/tag', 'StaticController@showTags')->name('manage-tags');
//Route::get('/admin/course', 'StaticController@showCourses')->name('manage-courses');
Route::get('/admin/reports', 'StaticController@showReports')->name('manage-reports');
Route::get('/admin/users', 'ManageUsersController@show')->name('manage-users');

// Manage categories
Route::get('/admin/categories/tags', 'CategoriesController@showTags')->name('manage-tags');
Route::get('/api/admin/categories/tags', 'CategoriesController@searchTags')->name('manage-tags-search');
Route::post('/api/admin/categories/tags/add', 'CategoriesController@addTag')->name('manage-tags-add');
Route::delete('/api/admin/categories/tags/delete', 'CategoriesController@deleteTag')->name('manage-tags-delete');

Route::get('/admin/categories/courses', 'CategoriesController@showCourses')->name('manage-courses');
Route::get('/api/admin/categories/courses', 'CategoriesController@searchCourses')->name('manage-courses-search');
Route::post('/api/admin/categories/courses/add', 'CategoriesController@addCourse')->name('manage-courses-add');
Route::delete('/api/admin/categories/courses/delete', 'CategoriesController@deleteCourse')->name('manage-courses-delete');
