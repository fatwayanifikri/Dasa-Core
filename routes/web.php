<?php
use App\Product;
use Illuminate\Http\Request;//supaya bisa upload background image login crudbooster
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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', function () {
    return view('welcome');
});

//Approve PKWT
Route::get('/admin/getSetStatus/{id}','AdminApprovalPKWTController@getSetStatus');

//Hpus CMS USERS
Route::get('/admin/delete_user/{id}','AdminCreateUserController@delete_user');

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

Route::get('/admin/getEdit/{id}','AdminFormLemburControler@getEdit');



//UpdateApprovebySM form cuti
Route::get('/admin/ApprovecutiSM/{id}','AdminApprovalformcutiController@ApprovecutiSM');
//UpdateRejectSM form cuti
Route::get('/admin/RejectSM/{id}','AdminApprovalformcutiController@RejectSM');
//UpdateApprovebyMNG form cuti
Route::get('/admin/Approvecutikabag/{id}','AdminApprovalformcutiController@Approvecutikabag');
//UpdateRejectbyMNG form cuti
Route::get('/admin/RejectMng/{id}','AdminApprovalformcutiController@RejectMng');
//Delete Cuti Yang sudah di approve
Route::get('/admin/hapuscuti/{id}','AdminApprovalformcutiController@hapuscuti');

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
Route::get('/admin/cari/{id}','AdminInfostockcutiController@cari');


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

//Print Management Lembur (For Admin Unit)
Route::get('/admin/printlemburpdf','AdminExportLemburController@printlemburpdf');
Route::get('/admin/importExportLembur','AdminExportLemburController@importExportLembur');
Route::get('/admin/downloadExcelLembur/{type}','AdminExportLemburController@downloadExcelLembur');
Route::post('/admin/importExcellembur','AdminExportLemburController@importExcellembur');

//Hapus Lembur
Route::get('/admin/hapus_lembur/{id}','AdminManagementLemburController@hapus_lembur');

//Print Employee
Route::get('/admin/importExport2', 'AdminEmployee1Controller@importExport2');
Route::get('/admin/downloadExcel2/{type}', 'AdminEmployee1Controller@downloadExcel2');
Route::post('/admin/importExcel2', 'AdminEmployee1Controller@importExcel2');

//Print Rekap Lembur
Route::get('/admin/importExport3', 'AdminT112DetaillemburController@importExport3');
Route::get('/admin/downloadExcel3/{type}', 'AdminT112DetaillemburController@downloadExcel3');
Route::post('/admin/importExcel3', 'AdminT112DetaillemburController@importExcel3');

//Print Mutasi Karyawan
Route::get('/admin/importExport4', 'AdminP101Mutation1Controller@importExport4');
Route::get('/admin/downloadExcel4/{type}', 'AdminP101Mutation1Controller@downloadExcel4');
Route::post('/admin/importExcel4', 'AdminP101Mutation1Controller@importExcel4');

//Delete Mutasi Karyawan
Route::get('/admin/delete_mutasi_karyawan/{id}','AdminMutasiKaryawanController@delete_mutasi_karyawan');

//Print Newcomers
Route::get('/admin/importExport5', 'AdminP102NewcomersController@importExport5');
Route::get('/admin/downloadExcel5/{type}', 'AdminP102NewcomersController@downloadExcel5');
Route::post('/admin/importExcel5', 'AdminP102NewcomersController@importExcel5');

//Print Employee Resign
Route::get('/admin/downloadExcel6/{type}', 'AdminP103ExportResignemployeeController@downloadExcel6');


Route::get('/admin/getEdit/{id}', 'AdminEditcmsUsersController@getEdit');

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
Route::get('/admin/inputasetid','AdminAssetLogistikController@inputasetid');

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
Route::get('/admin/PrintBBM_pdf','AdminRequestBbmExportController@PrintBBM_pdf');
Route::get('/admin/downloadExcelReqBBM/{type}', 'AdminRequestBbmExportController@downloadExcelReqBBM');

//End Time Lemburan
Route::get('/admin/endtime/{id}','AdminLemburIndividuKpController@endtime');
Route::get('/admin/endtimecb/{id}','AdminLemburIndividucbController@endtimecb');

//----------------------------------------ABSENSI-------------------------------------
//route tambah data (Input jam masuk)
Route::get('/admin/tambah','AdminAbsensiKaryawanController@tambah')->name('tambah');
Route::post('/admin/masuk','AdminAbsensiKaryawanController@masuk')->name('masuk');
Route::get('/admin/tambahdatalain','AdminAbsensiKaryawanController@tambahdatalain');

//route tambah data (Input jam keluar istirahat)
Route::get('/admin/keluaristirahat','AdminAbsensiKaryawanController@keluaristirahat')->name('tambah2');
Route::post('/admin/addjamistirahat','AdminAbsensiKaryawanController@addjamistirahat')->name('masuk2');
Route::get('/admin/copykeluaristirahat','AdminAbsensiKaryawanController@copykeluaristirahat');
Route::get('/admin/deletekeluaristirahat','AdminAbsensiKaryawanController@deletekeluaristirahat');

//route tambah data (Input jam masuk istirahat)
Route::get('/admin/tambahistirahat','AdminAbsensiKaryawanController@tambahistirahat')->name('tambah3');
Route::post('/admin/masukistirahat','AdminAbsensiKaryawanController@masukistirahat')->name('masuk3');
Route::get('/admin/copyistirahat','AdminAbsensiKaryawanController@copyistirahat');
Route::get('/admin/deletemasukistirahat','AdminAbsensiKaryawanController@deletemasukistirahat');

//route tambah data (Input jam masuk pulang)
Route::get('/admin/tambahpulang','AdminAbsensiKaryawanController@tambahpulang')->name('tambah4');
Route::post('/admin/pulang','AdminAbsensiKaryawanController@pulang')->name('pulang');
Route::get('/admin/copypulang','AdminAbsensiKaryawanController@copypulang');
Route::get('/admin/deletepulang','AdminAbsensiKaryawanController@deletepulang');

//route tambah data (Input jam Mulai Lembur)
Route::get('/admin/tambahlembur','AdminAbsensiKaryawanController@tambahlembur')->name('tambahlembur');
Route::post('/admin/mulailembur','AdminAbsensiKaryawanController@mulailembur')->name('mulailembur');
Route::get('/admin/copylembur','AdminAbsensiKaryawanController@copylembur');
Route::get('/admin/deletelembur','AdminAbsensiKaryawanController@deletelembur');

//route tambah data (Input jam Selesai Lembur)
Route::get('/admin/addselesailembur','AdminAbsensiKaryawanController@addselesailembur')->name('addselesailembur');
Route::post('/admin/selesailembur','AdminAbsensiKaryawanController@selesailembur')->name('selesailembur');
Route::get('/admin/copyselesailembur','AdminAbsensiKaryawanController@copyselesailembur');
Route::get('/admin/deleteselesailembur','AdminAbsensiKaryawanController@deleteselesailembur');

//route hitung jumlah jam telat
Route::get('/admin/telat_masuk','AdminAbsensiKaryawanController@telat_masuk');
Route::get('/admin/telat_istirahat','AdminAbsensiKaryawanController@telat_istirahat');
Route::get('/admin/kecepatan_pulang','AdminAbsensiKaryawanController@kecepatan_pulang');

//-------------------------------------END ABSENSI-------------------------------------

//Print Form Request Maintenance Kendaraan
Route::get('/admin/printmainkenpdf','AdminMaintenanceKendaraanPrintController@printmainkenpdf');
Route::get('/admin/printallmainkenpdf','AdminMaintenanceKendaraanPrintController@printallmainkenpdf');
Route::get('/admin/printdetailmainkenpdf','AdminMaintenanceKendaraanPrintController@printdetailmainkenpdf');
Route::get('/admin/importExportmainken','AdminMaintenanceKendaraanPrintController@importExportmainken');
Route::get('/admin/downloadExcelmainken/{type}', 'AdminMaintenanceKendaraanPrintController@downloadExcelmainken');

//Print Export Cuti
Route::get('/admin/printcutipdf','AdminExportCutiController@printcutipdf');
Route::get('/admin/importExportCuti', 'AdminExportCutiController@importExportCuti');
Route::get('/admin/downloadExcelCuti/{type}', 'AdminExportCutiController@downloadExcelCuti');

//Hapus Cuti
Route::get('/admin/hapus_cuti/{id}','AdminManagementCutiController@hapus_cuti');

//Hapus Stock Cuti
Route::get('/admin/hapus_stock_cuti/{id}','AdminStockcutiController@hapus_stock_cuti');

//Print Form Exit Interview
Route::get('/admin/print_exit/{id}','AdminFormExitController@print_exit');

//Delete Form Exit 
Route::get('/admin/delete_form_exit/{id}','AdminFormExitController@delete_form_exit');

//Delete Employee Resign
Route::get('/admin/delete_resign/{id}','AdminP103ResignemployeeController@delete_resign');

//Print Export Voucher Lembur
Route::get('/admin/printvoucherpdf','AdminExportVoucherLemburController@printvoucherpdf');
Route::get('/admin/importExportVoucher','AdminExportVoucherLemburController@importExportVoucher');
Route::get('/admin/downloadExcelVoucher/{type}','AdminExportVoucherLemburController@downloadExcelVoucher');

//Print Export Voucher Lembur Finance
Route::get('/admin/printvoucher2pdf','AdminExportVoucherFinanceController@printvoucher2pdf');
Route::get('/admin/importExportVoucher2','AdminExportVoucherFinanceController@importExportVoucher2');
Route::get('/admin/downloadExcelVoucher2/{type}','AdminExportVoucherFinanceController@downloadExcelVoucher2');

//Print Export Voucher Lembur HC
Route::get('/admin/printvoucher3pdf','AdminExportPengajuanVoucherController@printvoucher3pdf');
Route::get('/admin/importExportVoucher3','AdminExportPengajuanVoucherController@importExportVoucher3');
Route::get('/admin/downloadExcelVoucher3/{type}','AdminExportPengajuanVoucherController@downloadExcelVoucher3');

//Print Export Monitoring Voucher
Route::get('/admin/printvoucher4pdf','AdminMonitoringVoucherLemburController@printvoucher4pdf');
Route::get('/admin/downloadExcelVoucher4/{type}','AdminMonitoringVoucherLemburController@downloadExcelVoucher4');

//Print Export Data Kendaraan
Route::get('/admin/printkendaraanpdf','AdminExportKendaraanController@printkendaraanpdf');
Route::get('/admin/importExportKendaraan', 'AdminExportKendaraanController@importExportKendaraan');
Route::get('/admin/downloadExcelKendaraan/{type}', 'AdminExportKendaraanController@downloadExcelKendaraan');


//Test Input
Route::post('/admin/input_employee','AdminTestInputController@input_employee')->name('input_employee');
Route::get('/admin/delete_session/{id}','AdminTestInputController@delete_session');
Route::get('/admin/add_to_main','AdminTestInputController@add_to_main');
Route::get('/admin/truncate_session','AdminTestInputController@truncate_session');
Route::get('/admin/delete_merger','AdminTestMergerController@delete_merger');

//--------------------------FORM TIDAK ABSEN-----------------------------

//Print Form Tidak Absen
Route::get('/admin/print_tidakabsen/{id}','AdminFormTidakAbsenController@print_tidakabsen');

//Delete Form Tidak Absen
Route::get('/admin/delete_form1/{id}','AdminMonitoringTidakAbsenController@delete_form1');

//Print Form Tidak Absen (HRD)
Route::get('/admin/print_tidakabsenALL','AdminMonitoringTidakAbsenController@print_tidakabsenALL');
Route::get('/admin/downloadExcelTidakAbsen/{type}', 'AdminMonitoringTidakAbsenController@downloadExcelTidakAbsen');

//Approve Form Tidak Absen
Route::get('/admin/Approve_takabsen/{id}','AdminApproveFormtidakabsenController@Approve_takabsen');

//--------------------------END FORM TIDAK ABSEN-----------------------------


//--------------------------FORM MENINGGALKAN PEKERJAAN-----------------------------


//Print Form Meninggalkan Pekerjaan
Route::get('/admin/print_tinggalkerjaALL','AdminMonitoringTinggalKerjaController@print_tinggalkerjaALL');
Route::get('/admin/downloadExcelTinggalKerja/{type}', 'AdminMonitoringTinggalKerjaController@downloadExcelTinggalKerja');

//Print Form Meninggalkan Pekerjaan (HRD)
Route::get('/admin/print_meninggalkan_kerjaan/{id}','AdminFormMeninggalkanKerjaanController@print_meninggalkan_kerjaan');

//Delete Form Meninggalkan Pekerjaan
Route::get('/admin/delete_form2/{id}','AdminMonitoringTinggalKerjaController@delete_form2');

//Approve Form Meninggalkan Pekerjaan
Route::get('/admin/approve_tinggal_kerja/{id}','AdminApprovalTinggalKerjaController@approve_tinggal_kerja');

//--------------------------END FORM MENINGGALKAN PEKERJAAN---------------------------

//Dump & Hapus Employee
Route::get('/admin/employee_gotodump/{id}','AdminEmployeeCustomController@employee_gotodump');
Route::get('/admin/get_employeeID/{id}','AdminEmployeeCustomController@get_employeeID');
Route::get('/admin/hapus_employee/{id}','AdminEmployeeCustomController@hapus_employee');


//--------------------------FORM PENAWARAN---------------------------

//Input Penawaran
Route::post('/admin/input_penawaran','AdminFormAddPenawaranController@input_penawaran')->name('input_penawaran');
Route::post('/admin/input_penawarandetail','AdminFormAddPenawaranController@input_penawarandetail')->name('input_penawarandetail');
Route::get('/admin/update_detail','AdminFormAddPenawaranController@update_detail')->name('update_detail');
Route::get('/admin/status_pajak','AdminFormAddPenawaranController@status_pajak')->name('status_pajak');

//Delete data
Route::get('/admin/delete_child/{id}','AdminFormAddPenawaranController@delete_child');
Route::get('/admin/delete_penawaran/{id}','AdminPenawaranHargaController@delete_penawaran');

//Print Data Penawaran
Route::get('/admin/Printpenawaran_pdf','AdminExportPenawaranController@Printpenawaran_pdf');

//Print Lembar PO
Route::get('/admin/print_po/{id}','AdminFormAddPenawaranController@print_po');

//Print Faktur
Route::get('/admin/cutoff_faktur/{id}','AdminPenawaranHargaController@cutoff_faktur');
Route::get('/admin/complete_faktur','AdminPenawaranHargaController@complete_faktur');
Route::get('/admin/print_faktur/{id}','AdminPenawaranHargaController@print_faktur');

//Approve PO
Route::get('/admin/approvePO_SM/{id}','AdminApprovalPenawaranController@approvePO_SM');
Route::get('/admin/approvePO_cust/{id}','AdminPenawaranCustomerDashboardController@approvePO_cust');

//Hapus Employee Request
Route::get('/admin/hapus_request/{id}','AdminEmployeerequestController@hapus_request');
Route::get('/admin/hapus_request_detail/{id}','AdminEmployeerequestController@hapus_request_detail');

//--------------------------PURCHASING & LOGISTIC---------------------------

Route::get('/admin/ApproveMngPR/{id}','AdminPurcPurchaserequestController@ApproveMngPR');
Route::get('/admin/BatalMngPR/{id}','AdminPurcPurchaserequestController@BatalMngPR');

Route::get('/admin/complete_penerimaan_barang','AdminPenerimaanbarangController@complete_penerimaan_barang');

Route::get('/admin/view_penerimaan_detail/{id}','AdminPenerimaanbarangController@view_penerimaan_detail');

Route::get('/admin/tambah_inventory_stock','AdminPenerimaanbarangController@tambah_inventory_stock');

//--------------------------MAINTENANCE AC---------------------------
Route::get('/admin/printACdetailpdf/{id}','AdminMaintenanceAcController@printACdetailpdf');
Route::get('/admin/printACallpdf','AdminMaintenanceAcExportController@printACallpdf');


//------------------------------PELAMAR-----------------------------
//Delete Pelamar
Route::get('/admin/delete_pelamar/{id}','AdminPelamarController@delete_pelamar');
//Print Pelamar
Route::get('/admin/PrintPelamar/{id}','AdminPelamarController@PrintPelamar');

//--------------------------INBOX INTERVIEW---------------------------
Route::get('/admin/laporan_interview/{id}','AdminInboxInterviewController@laporan_interview');
Route::get('/admin/penilaian_praktik/{id}','AdminInboxInterviewController@penilaian_praktik');

//--------------------------FORM PURCHASEORDER---------------------------

//Input tbl copy purchase request
Route::post('/admin/input_copyrequest','AdminPurchaseOrderAddController@input_copyrequest')->name('input_copyrequest');

//Input tbl copy purchase order detail (get karena foreach dari tbl PR detail)
Route::get('/admin/input_podetail','AdminPurchaseOrderAddController@input_podetail')->name('input_podetail');

//Hapus data table
Route::get('/admin/delete_copyrequest/{id}','AdminPurchaseOrderAddController@delete_copyrequest');

Route::get('/admin/delete_podetail/{id}','AdminPurchaseOrderAddController@delete_podetail');


//Input data PO dan update po_id di table PO Detail

Route::post('/admin/input_data_po','AdminPurchaseOrderAddController@input_data_po')->name('input_data_po');

Route::get('/admin/input_id_po','AdminPurchaseOrderAddController@input_id_po')->name('input_id_po');

//FORM HARGA BARANG DAN HARGA BB/BOM

Route::post('/admin/input_BB_detail','AdminHargaBbAddController@input_BB_detail')->name('input_BB_detail');

Route::get('/admin/delete_hargabb/{id}','AdminHargaBbAddController@delete_hargabb');
Route::get('/admin/submit_confirm','AdminHargaBbAddController@submit_confirm');

//FORM MESIN PRODUKSI
Route::post('/admin/input_produksi','AdminProduksiInputController@input_produksi')->name('input_produksi');
Route::post('/admin/input_mesin','AdminProduksiInputController@input_mesin')->name('input_mesin');

Route::get('/admin/cek_kapasitas','AdminProduksiInputController@cek_kapasitas')->name('cek_kapasitas');
Route::get('/admin/edit_detail','AdminProduksiInputController@edit_detail')->name('edit_detail');
Route::get('/admin/add_unit','AdminProduksiInputController@add_unit')->name('add_unit');

Route::get('/admin/delete_mesin/{id}','AdminProduksiInputController@delete_mesin');
Route::get('/admin/update_status_to_proses/{id}','AdminProduksiViewController@update_status_to_proses');
Route::get('/admin/update_status_to_selesai/{id}','AdminProduksiViewController@update_status_to_selesai');

Route::get('/admin/update_status_to_proses2/{id}','AdminProduksiOperatorController@update_status_to_proses2');
Route::get('/admin/update_status_to_selesai2/{id}','AdminProduksiOperatorController@update_status_to_selesai2');

// Route::get('/admin/edit_mesin/{id}','AdminProduksiInputController@edit_mesin');
Route::post('/admin/update_mesin','AdminProduksiInputOverloadController@update_mesin')->name('update_mesin');
Route::get('/admin/back_button','AdminProduksiInputController@back_button');

Route::get('/admin/delete_mesin_overload/{id}','AdminProduksiInputOverloadController@delete_mesin_overload');

Route::get('/admin/update_qtyprocess','AdminProduksiInputOverloadController@update_qtyprocess')->name('update_qtyprocess');