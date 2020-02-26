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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/actualites/create', 'ActualiteController@create')->name('actualiteCreate');
Route::post('/actualites/create', 'ActualiteController@store')->name('actualiteStore');
Route::get('/actualites/edit/{id}', 'ActualiteController@edit')->where(['id' => '[0-9]+'])->name('actualiteEdit');
Route::post('/actualites/edit/{id}', 'ActualiteController@update')->where(['id' => '[0-9]+'])->name('actualiteUpdate');
Route::delete('/actualites/{id}', 'ActualiteController@delete')->where(['id' => '[0-9]+'])->name('actualiteDelete');

Route::post('/commentaires/create', 'CommentaireController@store')->name('commentaireStore');
Route::get('/commentaires/delete/{id}', 'CommentaireController@delete')->where(['id' => '[0-9]+'])->name('commentaireDelete');

Route::get('/profil', 'ProfilController@index')->name('profil');
Route::get('/profil/email', 'ProfilController@email')->name('profilEmail');
Route::post('/profil/email', 'ProfilController@changeEmail')->name('profilChangeEmail');
Route::get('/profil/mdp', 'ProfilController@mdp')->name('profilMdp');
Route::post('/profil/mdp', 'ProfilController@changeMdp')->name('profilChangeMdp');
