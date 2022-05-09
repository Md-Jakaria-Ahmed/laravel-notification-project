<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\EmailNotification;
use App\User;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('users', function() {
    return User::all();
});

Route::get('users/{id}', function($id) {
    $user = User::findOrFail($id);
    return $user;
});
Route::get('users/{id}/send', function($id) {
   $user = User::find($id);
   $user->notify(new EmailNotification());
   return view('welcome');
})->name('notification'); 