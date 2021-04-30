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
Route::get('/tags/search', 'TagController@search')->name('tagSearch');
Route::get('/user/{id}/edit', 'StaticController@showEditProfile')->name('edit-profile');
Route::get('/admin/tag', 'StaticController@showTags')->name('manage-tags');
Route::get('/admin/course', 'StaticController@showCourses')->name('manage-courses');
Route::get('/admin/reports', 'StaticController@showReports')->name('manage-reports');
Route::get('/admin/user', 'StaticController@showReports')->name('manage-users');


// Add Question
Route::get('/question/add', 'QuestionController@showQuestionForm')->name('question-show');
Route::post('/question/add', 'QuestionController@create')->name('question');

// Show Question
Route::get('/question/{id}', 'QuestionController@show')->name('showQuestion');

// Edit Question
Route::get('/question/{id}/edit', 'QuestionController@showEditQuestionForm');
Route::put('/question/{id}/edit', 'QuestionController@updateQuestion')->name('edit-question');

// Deletes
Route::delete('question/{id}', 'QuestionController@delete')->name('delete-question');
//Route::delete('/question/{id-q}/answer/{id-a}','QuestionController@deleteComment')->name('delete-comment');
Route::delete('user/{id}/delete', 'UserController@deleteUser')->name('delete-user');

// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/user/{id}/profile', "UserController@showProfile")->name('showProfile');

// API
/*
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');
*/

