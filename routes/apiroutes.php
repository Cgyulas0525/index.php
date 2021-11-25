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

Route::post('/api/getTelepulesList','ApiController@getTelepulesList');
Route::post('/api/getFocsoportFromCsoport','ApiController@getFocsoportFromCsoport');
Route::post('/api/getMaxSzolgaltatasCikkszam','ApiController@getMaxSzolgaltatasCikkszam');
Route::post('/api/getMaxTermekCikkszam','ApiController@getMaxTermekCikkszam');
Route::post('/api/getAfaSzazalek','ApiController@getAfaSzazalek');
Route::get('/api/mozgasBevet','ApiController@mozgasBevet')->name('BEVET');
Route::get('/api/mozgasKivet','ApiController@mozgasKivet')->name('KIVET');
Route::get('/api/vanEBarcode','ApiController@vanEBarcode');
Route::get('/api/getBarcodeTermek','ApiController@getBarcodeTermek');
Route::get('/api/getTermekCsoportFromTermek','ApiController@getTermekCsoportFromTermek');
Route::get('/api/getTermekCsoport','ApiController@getTermekCsoport');
Route::get('/api/getTermekAfaSzazalek','ApiController@getTermekAfaSzazalek');
Route::get('/api/getTermekAfaId','ApiController@getTermekAfaId');
Route::get('/api/getTermek','ApiController@getTermek');
Route::get('/api/getTermekaBoltban','ApiController@getTermekaBoltban');
Route::get('/api/vanLeltar','ApiController@vanLeltar');
Route::get('/api/getPartner','ApiController@getPartner');
Route::get('/api/getMaxModulszuroSorszam','ApiController@getMaxModulszuroSorszam');
Route::get('/api/getTermekRaktaron','ApiController@getTermekRaktaron');
Route::get('/api/getMozgasTermekMennyiseg','ApiController@getMozgasTermekMennyiseg');
Route::get('/api/getBarcodeTermek','ApiController@getBarcodeTermek');
Route::get('/api/vanMarFokep','ApiController@vanMarFokep');
Route::get('/api/masikFokep','ApiController@masikFokep');

