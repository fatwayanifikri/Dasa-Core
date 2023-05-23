<?php
use App\Product;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/admin/print_interview/{id}','AdminInterviewController@interviewPdf');
Route::get('/admin/print_interview/{id}','AdminInterviewController@PrintInterview');
//UpdateApprovebySM
Route::get('/admin/ApproveStoreManager/{id}','AdminApprovalRequestKaryawanController@ApproveStoreManager');
//UpdateApprovebyRecruitment
Route::get('/admin/ApproveRecruitment/{id}','AdminApprovalRequestKaryawanController@ApproveRecruitment');
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
Route::get('/admin/ApprovecutiSM/{id}','AdminApprovalformcutiController@ApprovecutiSM');
//UpdateApprovebyKabag form cuti
Route::get('/admin/Approvecutikabag/{id}','AdminApprovalformcutiController@Approvecutikabag');
//Delete Cuti Yang sudah di approve
Route::get('/admin/hapuscuti/{id}','AdminApprovalformcutiController@hapuscuti');
//UpdateRejectbyKabag form cuti
Route::get('/admin/RejectMng/{id}','AdminApprovalformcutiController@RejectMng');

// Buat voucher lembur
Route::get('/admin/VoucherBuat/{id}','AdminT112AbsenlemburvoucherController@VoucherBuat');
// Pengajuan voucher lembur
Route::get('/admin/VoucherPengajuan/{id}','AdminT112AbsenlemburvoucherController@VoucherPengajuan');
//  voucher lembur Cair
Route::get('/admin/vouchercair/{id}','AdminT112AbsenlemburvoucherController@VoucherCair');
//  Konfirmasi lemburan sudah diterima
Route::get('/admin/VoucherTerima/{id}','AdminT112AbsenlemburvoucherController@VoucherTerima');
Route::get('/admin/VoucherBuatHO/{id}','AdminVoucherLemburHoController@VoucherBuatHO');
Route::get('/admin/VoucherTerimaHO/{id}','AdminVoucherLemburHoController@VoucherTerimaHO');


//custom sama pickry print PKWT
Route::get('/admin/print_pkwt/{id}','AdminPkwtController@pkwtPdf');
//custom sama pickry print Nota Dinas
Route::get('/admin/print_notadinas/{id}','AdminPkwtController@notadinasPdf');
//custome Approved pada tabel t112_absenlembur
Route::get('/admin/lembur/{id}','AdminApprovallemburkaryawanController@formlembur');
//  voucher lembur diterima
Route::get('/admin/terimavoucher/{id}','AdminStatusvoucherlemburController@VoucherDiterima');


//range date rekap lembur
Route::get('/admin/list_lembur', 'AdminAbsenlemburController@index');
Route::post('/admin/list_lembur/fetch_data', 'AdminAbsenlemburController@fetch_data')->name('list_lembur.fetch_data');
Route::get('/admin/list_lembur','t112_absenlemburvoucher@list_lembur');
Route::get('/admin/cari','t112_absenlemburvoucher@cari');

//Print Monitoring Lembur
Route::get('/admin/printlemburpdf','AdminExportLemburController@printlemburpdf');
Route::get('/admin/importExportLembur','AdminExportLemburController@importExportLembur');
Route::get('/admin/downloadExcelLembur/{type}','AdminExportLemburController@downloadExcelLembur');
Route::post('/admin/importExcellembur','AdminExportLemburController@importExcellembur');

//Print Employee
Route::get('/admin/importExport2', 'AdminEmployee1Controller@importExport2');
Route::get('/admin/downloadExcel2/{type}', 'AdminEmployee1Controller@downloadExcel2');
Route::post('/admin/importExcel2', 'AdminEmployee1Controller@importExcel2');

//Print Rekap Lembur 
Route::get('/admin/importExport3', 'AdminT112DetaillemburController@importExport3');
Route::get('/admin/downloadExcel3/{type}', 'AdminT112DetaillemburController@downloadExcel3');
Route::post('/admin/importExcel3', 'AdminT112DetaillemburController@importExcel3');

//Print Mutasi
Route::get('/admin/importExport4', 'AdminP101Mutation1Controller@importExport4');
Route::get('/admin/downloadExcel4/{type}', 'AdminP101Mutation1Controller@downloadExcel4');
Route::post('/admin/importExcel4', 'AdminP101Mutation1Controller@importExcel4');

//Print Pelamar
Route::get('/admin/importExport5', 'AdminP102NewcomersController@importExport5');
Route::get('/admin/downloadExcel5/{type}', 'AdminP102NewcomersController@downloadExcel5');
Route::post('/admin/importExcel5', 'AdminP102NewcomersController@importExcel5');

//Print Resign
Route::get('/admin/importExport6', 'AdminP103ResignemployeesController@importExport6');
Route::get('/admin/downloadExcel6/{type}', 'AdminP103ResignemployeesController@downloadExcel6');
Route::post('/admin/importExcel6', 'AdminP103ResignemployeesController@importExcel6');

Route::get('/admin/edituser/{id}', 'AdminListUsers71Controller@edituser');

//UpdateApprovebySM form mutasi
Route::get('/admin/ApproveSM2/{id}','AdminMutasiKaryawanController@ApproveSM2');
Route::get('/admin/ApproveMNG/{id}','AdminMutasiKaryawanController@ApproveMNG');
//UpdateRejectSM form mutasi
Route::get('/admin/RejectSM2/{id}','AdminMutasiKaryawanController@RejectSM2');

//Print Facility Control
Route::get('/admin/PrintGS','AdminFacilityControlCustomController@PrintGS');
Route::get('/admin/importExportGS', 'AdminFacilityControlCustomController@importExportGS');
Route::get('/admin/downloadExcelGS/{type}', 'AdminFacilityControlCustomController@downloadExcelGS');

//Print Asset
Route::get('/admin/PrintAsset','AdminAssetLogistikCustomController@PrintAsset');
Route::get('/admin/importExportAsset', 'AdminAssetLogistikCustomController@importExportAsset');
Route::get('/admin/downloadExcelAsset/{type}', 'AdminAssetLogistikCustomController@downloadExcelAsset');

//UpdateApprovebySM form mutasi aset
Route::get('/admin/ApproveSMasal/{id}','AdminMutasiAssetLogistikController@ApproveSMasal');
Route::get('/admin/ApproveSMtujuan/{id}','AdminMutasiAssetLogistikController@ApproveSMtujuan');
//UpdateRejectSM form mutasiaset
Route::get('/admin/Rejectmutasiaset/{id}','AdminMutasiAssetLogistikController@Rejectmutasiaset');

//PINJAM & KEMBALIKAN ASET FOR USER(PEMINJAMAN ASSET)
Route::get('/admin/pinjamaset/{id}','AdminPeminjamanAssetController@pinjamaset');
Route::get('/admin/kembaliaset/{id}','AdminPeminjamanAssetController@kembaliaset');
//TERIMA ASET FOR ADMIN(PEMINJAMAN ASSET)
Route::get('/admin/terimaaset/{id}','AdminPeminjamanAssetAdmController@terimaaset');

//CutOff Asset
Route::get('/admin/cutoffasset','AdminCustomCutoffAssetController@cutoffasset');
Route::get('/admin/givetgl','AdminCustomCutoffAssetController@givetgl');
Route::get('/admin/StatusCutOff/{id}','AdminCutoffAssetController@StatusCutOff');
//Print CutOff Asset
Route::get('/admin/cutoffpdf','AdminPrintCutoffAssetController@cutoffpdf');
Route::get('/admin/importExportCutoff', 'AdminPrintCutoffAssetController@importExportCutoff');
Route::get('/admin/downloadExcelCutoff/{type}', 'AdminPrintCutoffAssetController@downloadExcelCutoff');


//Mencairkan Voucher Request BBM
Route::get('/admin/voucherBBM/{id}','AdminRequestBbmController@voucherBBM');

//Print Request BBM
Route::get('/admin/PrintBBM','AdminRequestBbmExportController@PrintBBM');

//Approve SM kunjungan sales ke konsumen
Route::get('/admin/ApproveSM/{id}','AdminKunjungansalesController@ApproveSM');

//Reject/Tolak SM kunjungan sales ke konsumen
Route::get('/admin/RejectApproveSM/{id}','AdminKunjungansalesController@RejectApproveSM');

//End Time Lemburan
Route::get('/admin/endtime/{id}','AdminLemburIndividuKpController@endtime');
Route::get('/admin/endtimecb/{id}','AdminLemburIndividucbController@endtimecb');

//----------------------------------------ABSENSI-------------------------------------
//route tambah data (Input jam masuk)
Route::get('/admin/tambah','AdminNewAbsenKaryawanController@tambah')->name('tambah');
Route::post('/admin/masuk','AdminNewAbsenKaryawanController@masuk')->name('masuk');
Route::get('/admin/tambahdatalain','AdminNewAbsenKaryawanController@tambahdatalain');

//route tambah data (Input jam keluar istirahat)
Route::get('/admin/keluaristirahat','AdminNewAbsenKaryawanController@keluaristirahat')->name('tambah2');
Route::post('/admin/addjamistirahat','AdminNewAbsenKaryawanController@addjamistirahat')->name('masuk2');
Route::get('/admin/copykeluaristirahat','AdminNewAbsenKaryawanController@copykeluaristirahat');
Route::get('/admin/deletekeluaristirahat','AdminNewAbsenKaryawanController@deletekeluaristirahat');

//route tambah data (Input jam masuk istirahat)
Route::get('/admin/tambahistirahat','AdminNewAbsenKaryawanController@tambahistirahat')->name('tambah3');
Route::post('/admin/masukistirahat','AdminNewAbsenKaryawanController@masukistirahat')->name('masuk3');
Route::get('/admin/copyistirahat','AdminNewAbsenKaryawanController@copyistirahat');
Route::get('/admin/deletemasukistirahat','AdminNewAbsenKaryawanController@deletemasukistirahat');

//route tambah data (Input jam masuk pulang)
Route::get('/admin/tambahpulang','AdminNewAbsenKaryawanController@tambahpulang')->name('tambah4');
Route::post('/admin/pulang','AdminNewAbsenKaryawanController@pulang')->name('pulang');
Route::get('/admin/copypulang','AdminNewAbsenKaryawanController@copypulang');
Route::get('/admin/deletepulang','AdminNewAbsenKaryawanController@deletepulang');

//route hitung jumlah jam telat
Route::get('/admin/telat_masuk','AdminNewAbsenKaryawanController@telat_masuk');
Route::get('/admin/telat_istirahat','AdminNewAbsenKaryawanController@telat_istirahat');
Route::get('/admin/kecepatan_pulang','AdminNewAbsenKaryawanController@kecepatan_pulang');

//-------------------------------------END ABSENSI-------------------------------------

//Print Form Request Maintenance Kendaraan
Route::get('/admin/printmainkenpdf','AdminMaintenanceKendaraanPrintController@printmainkenpdf');
Route::get('/admin/printallmainkenpdf','AdminMaintenanceKendaraanPrintController@printallmainkenpdf');
Route::get('/admin/importExportmainken','AdminMaintenanceKendaraanPrintController@importExportmainken');
Route::get('/admin/downloadExcelmainken/{type}', 'AdminMaintenanceKendaraanPrintController@downloadExcelmainken');

//Print Export Cuti
Route::get('/admin/printcutipdf','AdminExportCutiController@printcutipdf');
Route::get('/admin/importExportCuti', 'AdminExportCutiController@importExportCuti');
Route::get('/admin/downloadExcelCuti/{type}', 'AdminExportCutiController@downloadExcelCuti');

//Print Form Exit Interview
Route::get('/admin/print_exit/{id}','AdminFormExitController@print_exit');

//Print Export Voucher Lembur
Route::get('/admin/printvoucherpdf','AdminExportVoucherLemburController@printvoucherpdf');
Route::get('/admin/importExportVoucher','AdminExportVoucherLemburController@importExportVoucher');
Route::get('/admin/downloadExcelVoucher/{type}','AdminExportVoucherLemburController@downloadExcelVoucher');

//Print Export Voucher Lembur HC
Route::get('/admin/printvoucher3pdf','AdminExportPengajuanVoucherController@printvoucher3pdf');
Route::get('/admin/importExportVoucher3','AdminExportPengajuanVoucherController@importExportVoucher3');
Route::get('/admin/downloadExcelVoucher3/{type}','AdminExportPengajuanVoucherController@downloadExcelVoucher3');

//Print Export Voucher Lembur Finance
Route::get('/admin/printvoucher2pdf','AdminExportVoucherFinanceController@printvoucher2pdf');
Route::get('/admin/importExportVoucher2','AdminExportVoucherFinanceController@importExportVoucher2');
Route::get('/admin/downloadExcelVoucher2/{type}','AdminExportVoucherFinanceController@downloadExcelVoucher2');

//Print Export Data Kendaraan
Route::get('/admin/printkendaraanpdf','AdminExportKendaraanController@printkendaraanpdf');
Route::get('/admin/importExportKendaraan', 'AdminExportKendaraanController@importExportKendaraan');
Route::get('/admin/downloadExcelKendaraan/{type}', 'AdminExportKendaraanController@downloadExcelKendaraan');