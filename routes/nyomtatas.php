<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('termeks.vnNyomtatas', 'termekController@vnNyomtatas');
Route::get('termeks.vnSzolgaltatasNyomtatas', 'termekController@vnSzolgaltatasNyomtatas');
Route::get('termeks.vnTermekNyomtatas', 'termekController@vnTermekNyomtatas');
Route::get('termeks.mindenTermekNyomtatas', 'termekController@mindenTermekNyomtatas');
Route::get('termeks.vnPekaruNyomtatas', 'termekController@vnPekaruNyomtatas');

