<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosttagController;
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
    //tags
    Route::get('/show-post', [PosttagController::class, 'index']);
    Route::post('/create-post', [PosttagController::class, 'store']);   
Route::get('/', function () {
    return view('welcome');
});
