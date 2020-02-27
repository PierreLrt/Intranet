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

Route::get('/evenements', 'EvenementController@index')->name('evenements');
Route::get('/evenements/create', 'EvenementController@create')->name('evenementCreate');
Route::post('/evenements/create', 'EvenementController@store')->name('evenementStore');
Route::get('/evenements/edit/{id}', 'EvenementController@edit')->where(['id' => '[0-9]+'])->name('evenementEdit');
Route::post('/evenements/edit/{id}', 'EvenementController@update')->where(['id' => '[0-9]+'])->name('evenementUpdate');
Route::get('/evenements/delete/{id}', 'EvenementController@delete')->where(['id' => '[0-9]+'])->name('evenementDelete');

Route::get('/publications', 'PublicationController@index')->name('publication');
Route::post('/publications/create', 'PublicationController@store')->name('publicationStore');
Route::get('/publications/delete/{id}', 'PublicationController@delete')->where(['id' => '[0-9]+'])->name('publicationDelete');

Route::get('/profil/{id}', 'ProfilController@show')->where(['id' => '[0-9]+'])->name('profilShow');

Route::get('/follow/{id}', 'FollowController@follow')->where(['id' => '[0-9]+'])->name('followFollow');
Route::get('/unfollow/{id}', 'FollowController@unfollow')->where(['id' => '[0-9]+'])->name('followUnfollow');
