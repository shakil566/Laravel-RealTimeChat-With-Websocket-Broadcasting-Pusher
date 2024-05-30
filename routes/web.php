<?php

use App\Events\PublicMessaging;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/public-messaging', function() {
//     return view('public_messaging.index');
// });

// Route::post('/send-message', function() {
//     // event(new PublicMessaging('hi'));
//     dd('Done');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/public-messaging', [App\Http\Controllers\MessagingController::class, 'index']);
Route::post('/public-message-send', [App\Http\Controllers\MessagingController::class, 'publicMessageSend']);
