<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\StatusLiked;
use App\Events\CommentAdded;

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

Route::get('/', 'BoardController@index')->name('home');

Route::get('user/{user}', 'UserController@showProfile')->name('profil.show');
Route::post('user/{user}', 'UserController@editProfile')->name('profil.edit');
Route::put('user/{user}', 'UserController@uploadImage')->name('profil.upload');

Route::post('auth', 'UserController@authEndpoint')->name('authEndpoint');

Route::resource('board', 'BoardController');

Route::resource('liste', 'ListeController');

Route::resource('label', 'LabelController');

Route::resource('card', 'CardController');

Route::resource('comment', 'CommentController');

Route::post('liste/{board}', 'ListeController@store2')->name('storelist');
Route::put('listeposition/{board}', 'ListeController@updatePosition')->name('updateposition');

Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');
Route::post('/autocomplete/postmember/{board}', 'AutocompleteController@post')->name('autocomplete.post');

Route::put('cardposition', 'CardController@updatePosition')->name('updatecardposition');
Route::post('card-member/{card}', 'CardController@addMemberToCard')->name('addCardMember');

Route::post('card-label/{card}', 'CardController@addLabelToCard')->name('addLabelCard');

Route::get('/event', function() {

  event(new StatusLiked("Ahmed"));
  return view('test');
});
