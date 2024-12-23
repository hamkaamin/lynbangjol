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
use Illuminate\Http\Request;
//use App\Http\Controllers\IcpController;

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registerSuccess', 'SuccessController@register');
Route::get('/register_user','HomeController@register_user')->name('register_user');
Route::POST('/simpan_register_user','HomeController@simpan_register_user')->name('simpan_register_user');

Route::get('lapPenelitian/advSearch', 'LapPenelitianController@advSearch')->name('lapPenelitian.advSearch');
Route::get('lapPenelitian/execAdvSearch', 'LapPenelitianController@execAdvSearch')->name('lapPenelitian.execAdvSearch');
Route::get('lapPenelitian/search', 'LapPenelitianController@search')->name('lapPenelitian.search');
Route::get('lapPenelitian/filter/kategori/{id}/{tahun}', 'LapPenelitianController@filterKategori');
Route::get('lapPenelitian/filter/{tipe}/{id}', 'LapPenelitianController@filter');
Route::get('lapPenelitian/detail/{id}', 'LapPenelitianController@detail');
Route::resource('lapPenelitian', 'LapPenelitianController');

Route::get('lapPenelitianEks/advSearch', 'LapPenelitianEksController@advSearch')->name('lapPenelitianEks.advSearch');
Route::get('lapPenelitianEks/execAdvSearch', 'LapPenelitianEksController@execAdvSearch')->name('lapPenelitianEks.execAdvSearch');
Route::get('lapPenelitianEks/search', 'LapPenelitianEksController@search')->name('lapPenelitianEks.search');
Route::get('lapPenelitianEks/filter/{tipe}/{id}', 'LapPenelitianEksController@filter');
Route::get('lapPenelitianEks/detail/{id}', 'LapPenelitianEksController@detail');
Route::get('lapPenelitianEks', 'LapPenelitianEksController@index');

Route::get('bukuView/search', 'BukuViewController@search');
Route::get('bukuView/filter/{tipe}/{id}', 'BukuViewController@filter');
Route::resource('bukuView', 'BukuViewController');

Route::get('jurnalView/search', 'JurnalViewController@search');
Route::get('jurnalView/filter/{tipe}/{id}', 'JurnalViewController@filter');
Route::get('jurnalView', 'JurnalViewController@index');

Route::get('majalahView/search', 'MajalahViewController@search');
Route::get('majalahView/filter/{tipe}/{id}', 'MajalahViewController@filter');
Route::get('majalahView', 'MajalahViewController@index');

Route::get('policyBrief/search', 'PolicyBriefViewController@search');
Route::get('policyBrief/filter/{tipe}/{id}', 'PolicyBriefViewController@filter');
Route::get('policyBrief', 'PolicyBriefViewController@index');

Route::get('icp', 'IcpController@index');

Route::group(['middleware' => 'auth'], function(){
    Route::get('laporan/report', 'LaporanController@report');
    Route::get('laporan/resetVersion', 'LaporanController@resetVersion');
    Route::get('laporan/generateReport', 'LaporanController@generateReport');
    Route::get('laporan/cancelDelete/{id}', 'LaporanController@cancelDelete');

    Route::get('laporan/deleteFile/{laporanId}/{tipeDokumen}', 'LaporanController@deleteFile');
    Route::resource('laporan', 'LaporanController');

    Route::get('author/cancelDelete/{id}', 'AuthorController@cancelDelete');
    Route::get('author/generateReport', 'AuthorController@generateReport');
    Route::resource('author', 'AuthorController');
    Route::resource('laporanAuthor', 'LaporanAuthorController');

    Route::resource('kategori', 'KategoriController');
    Route::resource('laporanKategori', 'LaporanKategoriController');

    Route::get('lokasi/generateReport', 'LokasiController@generateReport');
    Route::resource('lokasi', 'LokasiController');
    Route::resource('laporanLokasi', 'LaporanLokasiController');

    Route::get('lembaga/generateReport', 'LembagaController@generateReport');
    Route::get('lembaga/cancelDelete/{id}', 'LembagaController@cancelDelete');
    Route::resource('lembaga', 'LembagaController');
    Route::resource('laporanLembaga', 'LaporanLembagaController');

    Route::resource('jurnal', 'JurnalController');
    Route::get('jurnalArtikel/createArtikel/{jurnalId}', 'JurnalArtikelController@createArtikel');
    Route::resource('jurnalArtikel', 'JurnalArtikelController');
    Route::resource('jurnalAuthor', 'JurnalAuthorController');
    Route::resource('jurnalKategori', 'JurnalKategoriController');

    Route::resource('majalah', 'MajalahController');
    Route::get('majalahArtikel/createArtikel/{jurnalId}', 'MajalahArtikelController@createArtikel');
    Route::resource('majalahArtikel', 'MajalahArtikelController');
    Route::resource('majalahAuthor', 'MajalahAuthorController');
    Route::resource('majalahKategori', 'MajalahKategoriController');

    Route::resource('policy', 'PolicyBriefController');

    Route::resource('buku', 'BukuController');
    Route::resource('bukuAuthor', 'BukuAuthorController');
    Route::resource('bukuKategori', 'BukuKategoriController');

    Route::get('icp/panel', 'IcpController@panel');
    Route::get('icp/panel/{id}', 'IcpController@panel_view');
    Route::get('icp/reg', 'IcpController@register');
    Route::post('icp/regp', 'IcpController@registerPost');
    Route::post('icp/del', 'IcpController@panel_delete');
    Route::post('icp/update', 'IcpController@panel_update');
    Route::get('icp/edit/{id}', 'IcpController@panel_edit');
    Route::get('icp/delete/{id}', 'IcpController@panel_del');

    Route::get('laporan/download/{laporanId}/{tipeDokumen}', 'LaporanController@downloadFile');
});

Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function(){
    Route::match(['put', 'patch'], 'userView/{user}', 'UserViewController@update')->name('userView.update');
    Route::get('userView/{user}/edit', 'UserViewController@edit')->name('userView.edit');
    Route::delete('userView/{user}', 'UserViewController@destroy')->name('userView.destroy');;
    Route::get('userView/aktivasi/{id}', 'UserViewController@aktivasi');
    Route::get('userView', 'UserViewController@index');

    Route::get('homeSlide/aktif/{id}', 'HomeSlideController@ubahAktif');
    Route::resource('homeSlide', 'HomeSlideController');

    Route::resource('modul', 'ModulController');
    Route::resource('modulMajalah', 'ModulMajalahController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
