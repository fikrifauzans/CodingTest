<?php

use Illuminate\Support\Facades\Route;

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


// $router->get('/', function () use ($router) {
//     return ['data' => $router->app->version()];
// });


// $router->get('/test', function () use ($router) {
//     $user = new Users();
//     dd($user->searchable);
// });

Route::get('/', function () {
    return view('welcome');
});
