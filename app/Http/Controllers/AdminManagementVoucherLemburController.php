<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;

	class AdminManagementVoucherLemburController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t112_absenlembur";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			//$this->col[] = ["label"=>"Departement Id","name"=>"Departement_id","join"=>"hrdm102_departement,DepartementName"];
			$this->col[] = ["label"=>"Karyawan","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Shift","name"=>"Shift"];
			//$this->col[] = ["label"=>"EmployeeName","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"StartTime","name"=>"StartTime"];
			$this->col[] = ["label"=>"EndTime","name"=>"EndTime"];
			$this->col[] = ["label"=>"Menit Lemburan","name"=>"AmountMinute"];
			$this->col[] = ["label"=>"Approve Lembur","name"=>"isApproved"];
			$this->col[] = ["label"=>"Status Voucher","name"=>"isVoucher"];
			$this->col[] = ["label"=>"Nomor Voucher","name"=>"NomerVoucher"];
			# END COLUMNS DO NOT REMOVE THIS LINE
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
		//	$this->form[] = ['label'=>'Departement','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm102_departement,DepartementName'];
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrde200_employee,EmployeeName','datatable_select_to'=>'EmployeeName:EmployeeName',"readonly"=>'true'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrdm101_unit,UnitName',"readonly"=>'true'];
			$this->form[] = ['label'=>'Perusahaan','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrdm100_company,CompanyName',"readonly"=>'true'];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'cms_privileges,Name',"readonly"=>'true'];
			//$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//dimatiin ga perlu 
			//$this->form[] = ['label'=>'Tanggal Lembur','name'=>'ExtraTimeDate','type'=>'date','validation'=>'required|date','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Shift','name'=>'shift','validation'=>'required|min:1|max:255','width'=>'col-sm-2','type'=>'select','dataenum'=>'Pagi;Malam;'];
			$this->form[] = ['label'=>'Mulai Lembur','name'=>'StartTime','type'=>'datetime','id'=>'StartTime','validation'=>'required','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Selesai Lembur','name'=>'EndTime','type'=>'datetime','id'=>'EndTime','validation'=>'required','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Menit Lembur','name'=>'AmountMinute','type'=>'number','id'=>'AmountMinute','validation'=>'required|integer|min:0','width'=>'col-sm-2','readonly'=>'true'];
			$this->form[] = ['label'=>'Nomer Voucher','name'=>'NomerVoucher','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			$this->form[] = ['label'=>'Jumlah Voucher','name'=>'JumlahVoucher','type'=>'number','id'=>'JumlahVoucher','validation'=>'required|integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Nilai Voucher','name'=>'NilaiVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-2',"readonly"=>'true'];
			$this->form[] = ['label'=>'Note','name'=>'Note','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Persetujuan','name'=>'isApproved','type'=>'hidden'];
			$this->form[] = ['label'=>'Voucher','name'=>'isVoucher','type'=>'hidden','value'=>'1'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Departement Id","name"=>"Departement_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Departement,id"];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"EmployeeName","name"=>"EmployeeName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"StartTime","name"=>"StartTime","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"EndTime","name"=>"EndTime","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"AmountMinute","name"=>"AmountMinute","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"NomerVoucher","name"=>"NomerVoucher","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Note","name"=>"Note","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"isApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();

			// if(CRUDBooster::MyPrivilegeId()==62){
			// 	$this->addaction[] = ['label'=>'Buat Voucher','url'=>('t112_absenlemburvoucher/edit').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 " ];
			// }
			// elseif(CRUDBooster::MyPrivilegeId()==63){
			// 	$this->addaction[] = ['label'=>'Buat Voucher','url'=>('t112_absenlemburvoucher/edit').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 " ];
			// }
			if(CRUDBooster::MyPrivilegeId()==64){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==1){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];

                $this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];

				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
            }
            elseif(CRUDBooster::MyPrivilegeId()==23){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==29){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
            elseif(CRUDBooster::MyPrivilegeId()==41){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
				elseif(CRUDBooster::MyPrivilegeId()==42){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
				elseif(CRUDBooster::MyPrivilegeId()==43){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
				elseif(CRUDBooster::MyPrivilegeId()==44){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
				elseif(CRUDBooster::MyPrivilegeId()==46){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==47){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==148){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==149){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==155){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId()==86){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			elseif(CRUDBooster::MyPrivilegeId()==12){
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 299 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] <> 'Malam'" ];
				$this->addaction[] = ['label'=>'Buat Voucher','url'=>('VoucherBuat').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[AmountMinute] > 239 & [isApproved] == 1 & [isVoucher] == 0 & [Shift] == 'Malam' " ];
				$this->addaction[] = ['label'=>'Diterima','url'=>('VoucherTerima').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=> "[isVoucher] == 3" ];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}
			
			// //-------------------------Button Cair---------------------------------//
			// if(CRUDBooster::MyPrivilegeId()==62){
			// 	$this->addaction[] = ['label'=>'Voucher Cair','url'=>('vouchercair').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isVoucher] == 1"];
			// }
			// elseif(CRUDBooster::MyPrivilegeId()==63){
			// 	$this->addaction[] = ['label'=>'Voucher Cair','url'=>('vouchercair').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isVoucher] == 1"];
			// }

			// elseif(CRUDBooster::MyPrivilegeId()==1){
			// 	$this->addaction[] = ['label'=>'Voucher Cair','url'=>('vouchercair').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isVoucher] == 1"];
			// }



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button[] = ['label'=>'Export','url'=>('export_voucher_lembur'),'icon'=>'fa fa-download','color'=>'primary'];



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          
			$this->table_row_color[] = ['condition'=>"[AmountMinute]>299","color"=>"success"];
			$this->table_row_color[] = ['condition'=>"[AmountMinute]>239 & [Shift] == 'Malam'","color"=>"success"];
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = "
				
			$(function(){

				setInterval(function(){

				var nilai1 = $('#JumlahVoucher').val();
				var nvoucher = $('12500').val();
				var calculate=Math.abs(12500 * nilai1);
				$('#NilaiVoucher').val(calculate);
			},500);

			// $(function(){
	        // 	setInterval(function(){

	        // 		var Cuti=$(cuti_saldo).val();
	        // 		var Lama=$(cuti_lama).val();

	        // 		var calculate=Math.abs(Cuti - Lama);
	        // 		$('#cuti_sisa').val(calculate);

	        // 		},500);

	        	})


	        ";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = "
.wrapper {
  position: relative;
  overflow: auto;
  border: 1px solid black;
  white-space: nowrap;
 
}
td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}

";


	           
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	   public function hook_query_index(&$query) {
		$EmployeeID=Crudbooster::myId();
		$EmpID=DB::table('cms_users')
				->where('id','=',$EmployeeID)
				->value('Employee_id');
		$getUnitID=CRUDBooster::myUnitIDKeep();
		$getJabatan=CRUDBooster::myPrivilegeId();

	//	dd($getJabatan);

 
   // TAMPILKAN 4 KONDISI 
   // - SHIFT Malam & amountminute >= 240,
   // - SHIFT Pagi & amountminute >= 300,

	        if($getJabatan == 62){
				$query
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 63){
				$query
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 64){
				$query
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 65){
				$query
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 66){
				$query
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
            elseif($getJabatan == 23){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 29){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 41){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 42){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 43){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 44){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 45){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 46){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 47){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 86){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });	
			}
			elseif($getJabatan == 148){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
				elseif($getJabatan == 149){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
				elseif($getJabatan == 155){
				$query
				->where('t112_absenlembur.Unit_id',$getUnitID)
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}
			elseif($getJabatan == 1){
				$query
				->where('isApproved','=','1')
				->where(function ($query) {
                $query->where('AmountMinute', '>', 299)
                ->orWhere('shift', '=', 'Malam');
                })
                ->where(function ($query) {
                $query->where('AmountMinute', '>', 239)
                ->orWhere('shift', '=', 'Pagi');
                 });
			}

	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	    
			if($column_index == 8){
				if($column_value == 0 )
				{
					$column_value = 'Tidak Di Setujui';
				}
				else
				{
					
					$column_value = 'Setuju';
				}

			}
			if($column_index == 9){
				if($column_value == 0){
					$column_value ='Blm Dibuat';
				}
				elseif($column_value == 1){
					$column_value = 'Dibuat';
				}
				elseif($column_value == 2){
					$column_value = 'Diajukan';
				}
				elseif($column_value == 3){
					$column_value = 'Dicairkan';
				}
				elseif($column_value == 4){
					$column_value = 'Diterima';
				}
				elseif ($column_value == 0) {
					$column_value = '';
				}
			}
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {       
        


    
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	              
		// $statuslembur=DB::table('t112_absenlembur')
		// 		->where('id',$id)
		// 		->value('isVoucher');
		// $waktulembur=DB::table('t112_absenlembur')
		// 		->where('id',$id)
		// 		->value('AmountMinute');
		
	
	 //        if($statuslembur == 0 && $waktulembur > 299){
		// 	DB::table('t112_absenlembur')->where('id',$id)->update(['isVoucher'=>'1']);
			
		// 	}
		// 	else{
				
		// 	}

        //------CHECK SUPAYA NOMOR VOUCHER TIDAK DOUBLE------------//

            $getvoucher=DB::table('t112_absenlembur')
                        ->where('id','!=',$id)
	   	                ->pluck('NomerVoucher')->toArray();

	   	     $geteditvoucher=DB::table('t112_absenlembur')
	   	                        ->where('id','=',$id)
	   	                        ->value('NomerVoucher');
          
                // dd($getvoucher);

	   	 foreach($getvoucher as $get){
	       if($get == $geteditvoucher){
	       CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Nomor voucher sudah terpakai!","danger");
				return false;
		    }
		    else{

		   }
	   	     }

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }

	
		
    }



	    //By the way, you can still create your own method in here... :) 


	//}