<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
|{{ Auth::user()->name }}
| contains the "web" middleware group. Now create something great!|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'companyController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/addcomapny', 'companyController@create');
Route::post('/newcompany', 'companyController@store');
Route::post('/newclient', 'companyController@storeclient');
Route::post('/newcampaign', 'companyController@campaignstore');

Route::post('/createcampign', 'companyController@createcampign');
Route::post('/editDetails', 'companyController@editDetails');
Route::get('/deleteemails/{id}', 'companyController@deleteemails');



//  ADmin 
Route::get('/admins','admincontoroller@index')->middleware('role:Admin');
Route::post('/admins/createlist','admincontoroller@createlist')->middleware('role:Admin');

Route::post('/admins/key', 'admincontoroller@addkey');

Route::post('/admins/campaign', 'admincontoroller@campaignstore');
Route::post('/adminnewclient', 'admincontoroller@storeclient');
Route::get('/viewcomapny/{id}', 'admincontoroller@viewcomapny');

Route::get('/admins/destroy/{id}', 'admincontoroller@destroy_campaign');

Route::get('/authorized/{id}', 'admincontoroller@authorized');

Route::get('/roles/{id}', 'admincontoroller@roles');