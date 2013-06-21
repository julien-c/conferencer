<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e) {
	return View::make('404')
		->with('e', $e);
});

// Aliases --------------------------------------------------------- /

Route::get('speaker/{slug}', 'Conferencer\Controllers\SpeakersController@getSpeaker');
//Route::get('talks/{slug}',   'Conferencer\Controllers\TalksController@getTalk');

// Additional routes ----------------------------------------------- /

Route::get(
	'admin/talks/{talk}/add-speaker/{speaker}',
	'Conferencer\Controllers\Admin\TalksResource@addSpeaker');
Route::get(
	'admin/talks/{talk}/add-tag/{tag}',
	'Conferencer\Controllers\Admin\TalksResource@addTag');

Route::delete(
	'admin/talks/{talk}/remove-speaker/{speaker}',
	'Conferencer\Controllers\Admin\TalksResource@removeSpeaker');
Route::delete(
	'admin/talks/{talk}/remove-tag/{tag}',
	'Conferencer\Controllers\Admin\TalksResource@removeTag');

// Controllers ----------------------------------------------------- /

Route::controller('articles', 'Conferencer\Controllers\ArticlesController');
Route::controller('speakers', 'Conferencer\Controllers\SpeakersController');
Route::controller('talks',    'Conferencer\Controllers\TalksController');

Route::resource('admin/articles', 'Conferencer\Controllers\Admin\ArticlesResource');
Route::resource('admin/speakers', 'Conferencer\Controllers\Admin\SpeakersResource');
Route::resource('admin/partners', 'Conferencer\Controllers\Admin\PartnersResource');
Route::resource('admin/tags',     'Conferencer\Controllers\Admin\TagsResource');
Route::resource('admin/talks',    'Conferencer\Controllers\Admin\TalksResource');

Route::controller('admin', 'Conferencer\Controllers\Admin\AdminController');