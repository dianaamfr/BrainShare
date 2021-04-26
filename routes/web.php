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
Route::get('/about', 'HomeController@showAbout')->name('about');
Route::get('/error', 'HomeController@showError')->name('error');

// Search Questions
Route::get('search', 'SearchController@search')->name('search');
// Search Tags
Route::get('tags/search', 'TagController@search')->name('tagSearch');


// Add Question
Route::get('question/add', 'QuestionController@showQuestionForm')->name('question');
Route::post('question/add', 'QuestionController@create')->name('question');
// Show Question
Route::get('question/{id}', 'QuestionController@show')->name('showQuestion');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// API
/*
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');
*/

// ROUTES TO DO
/*

Route::get('index', 'Auth\LoginController@showLoginForm')->name('add-question');
Route::get('index', 'Auth\LoginController@showLoginForm')->name('edit-profile');
Route::get('index', 'Auth\LoginController@showLoginForm')->name('edit-question');

Route::get('index', 'Auth\LoginController@showLoginForm')->name('manage-categories');
Route::get('index', 'Auth\LoginController@showLoginForm')->name('manage-reports');
Route::get('index', 'Auth\LoginController@showLoginForm')->name('profile');
*/