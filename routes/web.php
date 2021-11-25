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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('dictionaries', 'DictionaryController');
Route::resource('types', 'TypeController');
Route::resource('partners', 'PartnerController');
Route::get('partnerOssz','PartnerController@PartnerOssz')->name('PartnerOssz');

Route::get('HBK','PartnerController@HBK')->name('HBK');
Route::get('HaviBK','PartnerController@HaviBK')->name('HaviBK');

Route::resource('koltsegcsoports', 'KoltsegcsoportController');
Route::resource('koltsegfocsoports', 'KoltsegfocsoportController');
Route::resource('telepules', 'TelepulesController');
Route::resource('termekfocsoports', 'termekfocsoportController');
Route::resource('termekcsoports', 'termekcsoportController');
Route::resource('termeks', 'termekController');
Route::resource('szamlas', 'szamlaController');
Route::resource('szamlatetels', 'szamlatetelController');
Route::resource('todos', 'TodoController');
Route::resource('zaras', 'ZarasController');
Route::resource('pekaru', 'PekaruController');
Route::resource('mozgasfejs', 'MozgasfejController');
Route::resource('mozgastetels', 'MozgastetelController');
Route::resource('leltarFejs', 'LeltarFejController');
Route::resource('leltarTetels', 'LeltarTetelController');
Route::resource('moduls', 'ModulController');
Route::resource('listas', 'ListaController');
Route::resource('modulidoszaks', 'ModulidoszakController');
Route::resource('modulszuros', 'ModulszuroController');

Route::get('minkeszlet', 'PekaruController@minkeszlet')->name('Minkeszlet');
Route::get('koltsegfocsoports/destroyMe/{id}', 'KoltsegfocsoportController@destroyMe')->name('KtgFoCsoportTorles');
Route::get('koltsegcsoports/destroyMe/{id}', 'KoltsegcsoportController@destroyMe')->name('KtgCsoportTorles');
Route::get('partners/destroyMe/{id}', 'PartnerController@destroyMe')->name('PartnerTorles');
Route::get('telepules/destroyMe/{id}', 'TelepulesController@destroyMe')->name('TelepulesTorles');
Route::get('termeks/destroyMe/{id}', 'termekController@destroyMe')->name('TermekTorles');
Route::get('termekfocsoports/destroyMe/{id}', 'termekfocsoportController@destroyMe')->name('TermekFoCsoportTorles');
Route::get('termekcsoports/destroyMe/{id}', 'termekcsoportController@destroyMe')->name('TermekCsoportTorles');
Route::get('szamlatetels/destroyMe/{id}', 'szamlatetelController@destroyMe')->name('SzamlaTetelTorles');
Route::get('szamlas/destroyMe/{id}', 'szamlaController@destroyMe')->name('SzamlaTorles');
Route::get('leltarFejs/destroyMe/{id}', 'LeltarFejController@destroyMe')->name('LeltarTorles');

Route::get('todos/destroyMe/{id}', 'TodoController@destroyMe')->name('TodoTorles');
Route::get('todos/updateVege/{id}', 'TodoController@updateVege')->name('UpdateVege');
Route::get('zaras/destroyMe/{id}', 'ZarasController@destroyMe')->name('ZarasTorles');


Route::get('koltsegcsoports/createMe/{id}', 'KoltsegcsoportController@createMe')->name('KtgCsoportInsert');
Route::get('termekcsoports/createMe/{id}', 'termekcsoportController@createMe')->name('TermekCsoportInsert');
Route::get('dictionaries/createMe/{id}', 'DictionaryController@createMe')->name('SzotarInsert');
Route::get('szamlatetels/createMe/{id}', 'szamlatetelController@createMe')->name('SzamlaTetelInsert');
Route::get('mozgastetels/createMe/{id}', 'MozgastetelController@createMe')->name('BevetTetelInsert');

Route::get('termekcsoports/indexFocsoport/{id}', 'termekcsoportController@indexFocsoport')->name('TermekCsoportIndexFocsoport');

Route::get('atlagNapi','ZarasController@atlagNapi')->name('atlagNapi');
/* szótár karbantartás */
Route::get('types/destroyMe/{id}', 'TypeController@destroyMe')->name('TipusTorles');
Route::get('types/edit/{id}', 'TypeController@edit')->name('TipusEdit');
Route::get('dictionaries/createMe/{id}', 'DictionaryController@createMe')->name('SzotarInsert');
Route::post('dictionaries/destroyMe/{id}', 'DictionaryController@destroyMe')->name('SzotarTorles');
Route::get('dictionaries/torles/{id}', 'DictionaryController@torles')->name('SZT');
Route::get('mozgastetels/torles/{id}', 'MozgastetelController@torles')->name('MTT');
Route::post('mozgastetels/destroyMe/{id}', 'MozgastetelController@destroyMe')->name('MozgasTetelTorles');

Route::get('felhasznalasIndex', 'MozgasfejController@felhasznalasIndex')->name('felhasznalasIndex');
Route::get('felhasznalasCreate', 'MozgasfejController@felhasznalasCreate')->name('FC');
Route::post('felhasznalasStore', 'MozgasfejController@felhasznalasStore')->name('FS');
Route::post('felhasznalasUpdate/{id}', 'MozgasfejController@felhasznalasUpdate')->name('felhasznalasUpdate');
Route::post('felhasznalasTetelUpdate/{id}', 'MozgastetelController@felhasznalasTetelUpdate')->name('felhasznalasTetelUpdate');

Route::get('mozgastetels/createMe/{id}', 'MozgastetelController@createMe')->name('BevetTetelInsert');
Route::get('mozgastetels/tetelindex/{id}', 'MozgastetelController@tetelindex')->name('tetelIndex');
Route::get('mozgastetels/createFelhasznalas/{id}', 'MozgastetelController@createFelhasznalas')->name('createFelhasznalas');
Route::post('mozgastetels/felhasznalasTetelStore', 'MozgastetelController@felhasznalasTetelStore')->name('felhasznalasTetelStore');

Route::get('felhasznalasEdit/{id}', 'MozgasfejController@felhasznalasEdit')->name('felhasznalasEdit');
Route::resource('megrendelesfejs', 'MegrendelesfejController');
Route::resource('megrendelestetels', 'MegrendelestetelController');
Route::get('megrendelesfejs/destroyMe/{id}', 'MegrendelesfejController@destroyMe')->name('megrendelesTorles');
Route::get('megrendelestetels/create/{id}', 'MegrendelestetelController@create')->name('megrendelesTetelInsert');
Route::get('megrendelestetels/torles/{id}', 'MegrendelestetelController@torles')->name('megrendelesTetelTorles');
Route::post('megrendelestetels/destroyMe/{id}', 'MegrendelestetelController@destroyMe')->name('megrendelesTT');

Route::get('mozgasfejs/destroyMe/{id}', 'MozgasfejController@destroyMe')->name('BevetTorles');
Route::get('mozgasfejs/destroyFMe/{id}', 'MozgasfejController@destroyFMe')->name('felhasznalasTorles');
Route::get('mozgasfejs/fBevetel/{id}', 'MozgasfejController@fBevetel')->name('fB');

Route::get('megrendelesfejs/nyomtatas/{id}', 'MegrendelesfejController@nyomtatas')->name('megrendelesNyomtatas');

Route::resource('mozgaskods', 'MozgaskodController');

Route::resource('raktarKeszlets', 'RaktarKeszletController');
Route::get('termeks.raktarkeszlet/{id}', 'termekController@raktarkeszlet')->name('raktarkeszlet');
Route::get('termeks.createMe/{id}', 'termekController@createWithTermekcsoport')->name('createWithTermekcsoport');

Route::get('raktarKeszlets.rkindex/{id}', 'RaktarKeszletController@rkindex')->name('rkindex');
Route::get('mozgasfejs.mozgasKonyveles/{id}', 'MozgasfejController@mozgasKonyveles')->name('mozgasKonyveles');

Route::get('termeks.indexSzurt/{melyik}', 'termekController@indexSzurt')->name('indexSzurt');
Route::get('termeks.indexCsoport/{melyik}', 'termekController@indexCsoport')->name('termekIndexCsoport');

Route::get('termeks.indexFiltered/{focsoport}/{tipus}/{partner}', 'termekController@indexFiltered')->name('indexFiltered');
Route::get('termeks.indexUres', 'termekController@indexUres')->name('indexUres');
Route::get('termeks.termekKarton/{id}', 'termekController@termekKarton')->name('termekKarton');

Route::get('termeks.editBarcode/{id}', 'termekController@editBarcode')->name('editBarcode');
Route::post('termeks.updateBarcode/{id}', 'termekController@updateBarcode')->name('updateBarcode');

Route::get('mozgastetels/indexFejId/{id}', 'MozgastetelController@indexFejId');
Route::get('szamlatetels/indexFejId/{id}', 'szamlatetelController@indexFejId')->name('szTetelIndex');
Route::get('megrendelestetels/indexFejId/{id}', 'MegrendelestetelController@indexFejId')->name('megrTetelIndex');
Route::get('vevoirendelestetels/indexFejId/{id}', 'VevoirendelestetelController@indexFejId')->name('vrTetelIndex');


Route::get('szamlas.indexFeldolgozott', 'szamlaController@indexFeldolgozott')->name('szamlaFeldolgozott');
Route::get('szamlas.indexIdei', 'szamlaController@indexIdei')->name('szamlaIdei');
Route::get('szamlaFeldolgozas/szamlaFeldolgozas/{id}', 'szamlaFeldolgozasController@szamlaFeldolgozas')->name('szamlaFeldolgozas');


Route::resource('penztarFejs', 'PenztarFejController');
Route::get('penztarFejs.penztarIndit', 'PenztarFejController@penztarIndit')->name('penztarIndit');
Route::get('penztarFejs.penztarKovetkezo/{id}', 'PenztarFejController@penztarKovetkezo')->name('penztarKovetkezo');

Route::get('penztarFejs.penztarKilep/{id}', 'PenztarFejController@penztarKilep')->name('penztarKilep');

Route::resource('penztarTetels', 'PenztarTetelController');
Route::get('penztartetels/indexTetel/{id}', 'PenztarTetelController@indexTetel')->name('indexTetel');
Route::get('penztartetels/destroy/{id}', 'PenztarTetelController@destroy')->name('pentarTetelTorles');


Route::get('leltarTetels/indexLeltarTetel/{id}', 'LeltarTetelController@indexLeltarTetel')->name('indexLeltarTetel');
Route::get('leltarTetels/createMy/{id}', 'LeltarTetelController@createMy')->name('leltarTetelCreate');

Route::get('category-tree-view',['uses'=>'CategoryController@manageCategory']);
Route::post('add-category',['as'=>'add.category','uses'=>'CategoryController@addCategory']);

Route::get('pekaru.termekSzurt/{melyik}', 'PekaruController@termekSzurt')->name('pekaruSzurt');

Route::get('mozgasfejs.indexMozgasokTermek/{id}', 'MozgasfejController@indexMozgasokTermek')->name('indexMozgasokTermek');

Route::resource('keps', 'KepController');
Route::get('keps.indexParent/{id}/{melyik}', 'KepController@indexParent')->name('parentKep');
Route::get('keps/createFocsoportKep/{id}/{melyik}', 'KepController@createFocsoportKep')->name('createFocsoportKep');
Route::get('keps/createCsoportKep/{id}', 'KepController@createCsoportKep')->name('createCsoportKep');

Route::resource('vevoirendelesfejs', 'VevoirendelesfejController');

Route::get('vevoirendelestetels/createMe/{id}', 'VevoirendelestetelController@createMe')->name('vevoiRendelesTetelInsert');

Route::resource('vevoirendelestetels', 'VevoirendelestetelController');
