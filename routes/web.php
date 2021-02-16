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

//section "adit"
//Route::get('/admin/print_interview/{id}','AdminInterviewController@interviewPdf');
Route::get('/admin/print_interview/{id}','AdminInterviewController@PrintInterview');
//UpdateApprovebySM
Route::get('/admin/ApproveStoreManager/{id}','AdminEmployeerequestController@ApproveStoreManager');
//UpdateApprovebyRecruitment
Route::get('/admin/ApproveRecruitment/{id}','AdminEmployeerequestController@ApproveRecruitment');
//DitolakManagerHRD
Route::get('/admin/HRDManager/{id}','AdminEmployeerequestController@RejectedHRDManager');
//AJAX Call get Data pelamar 
Route::get('dataPelamar','AdminEmployeeCustomController@getListPelamar')->name('dataPelamar');
Route::get('pelamar/{id}','AdminEmployeeCustomController@selectPelamar');
//identitas
Route::get('identitasPelamarList/{id}','AdminEmployeeCustomController@dtIdentitas')->name('detailIdentitas');
Route::post('identitasPelamar','AdminEmployeeCustomController@saveIdentitas');
Route::post('updateIdentitasPelamar/{id}','AdminEmployeeCustomController@updateIdentitas');
Route::get('editIdentitasPelamar/{id}','AdminEmployeeCustomController@editIdentitas');
Route::post('hapusIdentitas/{id}','AdminEmployeeCustomController@DeleteIdentitas');
//pendidikan
Route::get('pendidikanPelamarList/{id}','AdminEmployeeCustomController@dtPendidikan')->name('detailPendidikan');
Route::post('pendidikanSave','AdminEmployeeCustomController@savePendidikan');
Route::get('pendidikanEdit/{id}','AdminEmployeeCustomController@editPendidikan');
Route::post('PendidikanDelete/{id}','AdminEmployeeCustomController@deletePendidikan');
Route::post('pendidikanUpdate/{id}','AdminEmployeeCustomController@updatePendidikan');
//pkwt
Route::get('PkwtList/{id}','AdminEmployeeCustomController@dtPkwt')->name('detailPkwt');
Route::post('PkwtSave','AdminEmployeeCustomController@savePkwt');
Route::get('PkwtEdit/{id}','AdminEmployeeCustomController@editPkwt');
Route::post('PkwtDelete/{id}','AdminEmployeeCustomController@deletePkwt');
Route::post('PkwtUpdate/{id}','AdminEmployeeCustomController@updatePkwt');
Route::get('PrintPkwt/{id}','AdminEmployeeCustomControler@pkwtPdf');


//UpdateApprovebySM form cuti
Route::get('/admin/ApproveSM/{id}','AdminPengajuanformcutiController@ApproveSM');
//UpdateApprovebyMNG form cuti
Route::get('/admin/ApproveMng/{id}','AdminPengajuanformcutiController@ApproveMng');


//endsection "Adit"

//section "pikri"

//custom sama pickry print PKWT
Route::get('/admin/print_pkwt/{id}','AdminPkwtController@pkwtPdf');
//custom sama pickry print Nota Dinas
Route::get('/admin/print_notadinas/{id}','AdminPkwtController@notadinasPdf');
//custome Approved pada tabel t112_absenlembur
Route::get('/admin/lembur/{id}','AdminFormLemburController@formlembur');
//EndSection"Pikri"

//range date rekap lembur
Route::get('/admin/list_lembur', 'AdminAbsenlemburController@index');
Route::post('/admin/list_lembur/fetch_data', 'AdminAbsenlemburController@fetch_data')->name('list_lembur.fetch_data');
