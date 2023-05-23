<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminEmployeerequestController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "hrdt100_employeerequest";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nomer Dokumen","name"=>"NomerDokumen"];
			$this->col[] = ["label"=>"Nama Req.","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Unit ","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
		//	$this->col[] = ["label"=>"Jabatan ","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Perusahaan ","name"=>"Company_id","join"=>"hrdm100_company,CompanyName"];
			$this->col[] = ["label"=>"Tanggal Permintaan","name"=>"RequestDate"];
			// $this->col[] = ["label"=>"Request Jabatan","name"=>"(select cms.name from hrdt101_detailrequest join cms_privileges AS cms ON cms.id = hrdt101_detailrequest.Jabatan_id WHERE employeerequest_id = hrdt100_employeerequest.id ) as Jabatan"];
			$this->col[] = ["label"=>"Status","name"=>"isProcess","join"=>"hrdm110_approvalstatus,ApprovalName"];
			


			# END COLUMNS DO NOT REMOVE THIS LINE
			
			$ResultID = DB::select('select uuid_short() as id');
			
			#GENERATE NUMBER DOKUMEN 
			$countNumber = DB::select('select count(*) from hrdt100_employeerequest');
			$countNumberLaravel = DB::table('hrdt100_employeerequest')->count();
			$dataKode = (int) $countNumberLaravel;
			$numberDocument = $dataKode +1;
			
			$char = "KP";
			
			$hasilKode = $char."/".date('ymd')."/".str_pad($numberDocument, 5,"0",STR_PAD_LEFT);
			
			# GET KEBUTUHAN DATA 
			$getUnitID = CRUDBooster::myUnitId();
			$getJabatan = CRUDBooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');

			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
		    $this->form[] = ['label'=>'hdfemployeerequestid','name'=>'id','type'=>'hidden','value'=>$ResultID[0]->id];
			$this->form[] = ['label'=>'Nomer Dokumen','name'=>'NomerDokumen','type'=>'text','width'=>'col-sm-10','value'=>$hasilKode,'readonly'=>true];
			// $this->form[] = ['label'=>'Nama Karyawan Request','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName','datatable_where'=>'Unit_id='.CRUDBooster::myUnitId()];
			$this->form[] = ['label'=>'Nama Peminta Request','name'=>'Employee_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName','value'=>$EmpID,'readonly'=>true];

			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID,'readonly'=>true];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name','value'=>$getJabatan,'readonly'=>true];
			$this->form[] = ['label'=>'Perusahaan ','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm100_company,CompanyName'];
			$this->form[] = ['label'=>'Request Date','name'=>'RequestDate','type'=>'date','validation'=>'required|date','value'=>date('Y-m-d', time()),'width'=>'col-sm-10'];
			$this->form[] = ['label'=>'isProcess','name'=>'isProcess','type'=>'hidden','value'=>'1'];
			# END FORM DO NOT REMOVE THIS LINE

			# CHILD
			$columns = [];
			$columns[] = ['name'=>'EmployeeRequest_id','visible'=>'false','value'=>$ResultID[0]->id];
			$columns[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select','datatable'=>'cms_privileges,name'];
			$columns[] = ['label'=>'Alasan Permintaan','name'=>'AlasanRequest','type'=>'textarea','required'=>true];
			$columns[] = ['label'=>'Ex.Karyawan','name'=>'ExKaryawan','type'=>'text'];
			$columns[] = ['label'=>'Alasan Keluar','name'=>'AlasanKeluar','type'=>'text'];
			$columns[] = ['label'=>'Kualifikasi','name'=>'Kualifikasi','type'=>'textarea'];
			$columns[] = ['label'=>'Jumlah','name'=>'Jumlah','type'=>'number'];
			$columns[] = ['label'=>'Siap Bekerja Tanggal','name'=>'StartDate','type'=>'date'];
			$columns[] = ['label'=>'Nama Rekomendasi','name'=>'NamaEmployee','type'=>'text'];
			$columns[] = ['label'=>'Tanggal Masuk','name'=>'EntryDate','type'=>'date'];
			$columns[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'text'];
			$columns[] = ['label'=>'Status Terpenuhi','name'=>'StatusTerpenuhi','type'=>'radio','dataenum'=>'Terpenuhi;Tidak Terpenuhi'];
			$this ->form[] = ['label'=>'Request Karyawan','name'=>'hrde101_pelamaridentity','type'=>'child','columns'=>$columns,'table'=>'hrdt101_detailrequest','foreign_key'=>'EmployeeRequest_id'];

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"NomerDokumen","name"=>"NomerDokumen","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"RequestDate","name"=>"RequestDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
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
			$this->addaction[] = ['url'=>('hapus_request').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			// $JabatanID = CRUDBooster::myPrivilegeId();
			// //$getPrivilegeID = CRUDBooster::getMyPrivilegeId();
			// //HRDManager
			// if($JabatanID == '12'){
			// 	$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveStoreManager').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isProcess] == 1"];
			// }
			// elseif($JabatanID == '64'){
			// 	$this->addaction[] = ['label'=>'Process','name'=>'setuju_rc','url'=>('ApproveRecruitment').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isProcess] == 2"];
			// }
			// elseif($JabatanID == '8'){
			// 	$this->addaction[] = ['label'=>'Setujui','url'=>CRUDBooster::mainpath('set-status/active/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[isProcess] == 3"];
			// 	$this->addaction[] = ['label'=>'Tidak Setujui','name'=>'tolak_hr','url'=>('HRDManager').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isProcess] == 3",'confirmation' =>true];
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
			
			$this->button_selected[] = ['label'=>'Setujui SM','icon'=>'fa fa-check','name'=>'Setujui_SM'];
			
			
	                
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
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
			$this->table_row_color = array();   
			$this->table_row_color[] = ['condition'=>"[isProcess]=='1'","color"=>"danger"];
			//$this->table_row_color[] = ['condition'=>"[isProcess]=='2'","color"=>"info"];
			//$this->table_row_color[] = ['condition'=>"[isProcess]=='3'","color"=>"default"];
		//	$this->table_row_color[] = ['condition'=>"[isProcess]=='4'","color"=>"success"];
			$this->table_row_color[] = ['condition'=>"[isProcess]=='5'","color"=>"danger"];		  	          

	        
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
			// $(function(){

			// 	$('#table-detailrequest').DataTable({
			// 		'columnDefs': [
			// 			{
			// 				'targets': [0],
			// 				'visible': false
			// 			}

			// 		]

			// 	});


			// });
			
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
			$this->load_js[] = asset("https://unpkg.com/react@16/umd/react.development.js");
			$this->load_js[] = asset("https://unpkg.com/react-dom@16/umd/react-dom.development.js");
			$this->load_js[] = asset("https://unpkg.com/babel-standalone@6.15.0/babel.min.js");
			
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
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
	        //if($button_name == 'setuju_sm') {
				
			//  }
	            
	    }
		

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
    //Your code here
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();

			if($getJabatan == 1){
				$query;
			}
			elseif($getJabatan == 62){
				$query;
			}
			elseif($getJabatan == 63){
				$query;
			}
			elseif($getJabatan == 64){
				$query;
			}
			elseif($getJabatan == 65){
				$query;
			}
			elseif($getJabatan == 66){
				$query;
			}
			elseif($getJabatan == 16){
				$query;
			}
			else{
				$query->where('hrdt100_employeerequest.Employee_id',$EmpID);
			}
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
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
			//merubah jabatan request employee
			 $EmployeeID=Request::get('Employee_id');
			 $Jabatan=DB::table('hrde200_employee')
			 		->where('id',$EmployeeID)
			 		->value('Jabatan_id');
			 DB::table('hrdt100_employeerequest')->where('id',$ResultID)->update(['Jabatan_id'=>$Jabatan]);
			//Notifikasi Dikirim Ke Store Manager untuk di acc 
			//#1
			$getUnitID = CRUDBooster::myUnitIDKeep();
			$storeManager = DB::table('cms_users')
							->where('Unit_id',$getUnitID)
							->where('id_cms_privileges','12')
							->pluck('id');

		
				$config['content'] = "Request Permintaan Karyawan Baru";
				$config['to'] = CRUDBooster::adminPath('employeerequest/');
				$config['id_cms_users'] = $storeManager;
				CRUDBooster::sendNotification($config);
			
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
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

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

		public function getSetStatus($isApproval,$id) {
			//#4
			date_default_timezone_set('Asia/Jakarta');
			$dateNow = date('Y-m-d H:i:s');
			//diProsessSamaHRDManager
			DB::table('hrdt100_employeerequest')->where('id',$id)->update(['isProcess'=>'4','isProcessDate'=>$dateNow]);
			//notifsearchrequest
			$config['content'] = "Telah di Approve Manager HRD";
			$config['to'] = CRUDBooster::adminPath('employeerequest/');
			$config['id_cms_users'] = [64];
			CRUDBooster::sendNotification($config);
			//This will redirect back and gives a message
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve !","info");
		 }

		 
		 public function ApproveStoreManager($id) {
			// #2
			date_default_timezone_set('Asia/Jakarta');
			$dateNow = date('Y-m-d H:i:s');
			//diprosesApproveSM
			DB::table('hrdt100_employeerequest')->where('id',$id)->update(['isProcess'=>'2']);
			//notif Ke recruitment
			$getManagerHRD = DB::table('cms_users')
							->where('Unit_id','1')
							->where('id_cms_privileges','64')
							->pluck('id');

			$config['content'] = "Request Permintaan Karyawan";
			$config['to'] = CRUDBooster::adminPath('employeerequest/');
			//$config['id_cms_users'] = [2];
			$config['id_cms_users']=$getManagerHRD;
			CRUDBooster::sendNotification($config);
			//info Berhasil Masuk 
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve Store Manager/Manager !","info");
		 }

		 public function ApproveRecruitment($id){
			// #3
			//approve StaffRecruitment
			DB::table('hrdt100_employeerequest')->where('id',$id)->update(['isProcess'=>'3']); 
			//notifikasi Ke HRD Manager 
			$recruitment = DB::table('cms_users')
							->where('Unit_id','1')
							->where('id_cms_privileges','8')
							->pluck('id');

			$config['content'] = "Request Permintaan Karyawan";
			$config['to'] = CRUDBooster::adminPath('employeerequest/');
			$config['id_cms_users'] = $recruitment;
			CRUDBooster::sendNotification($config);

			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve Recruitment !","info");
		 }

		 public function RejectedHRDManager($id){
			// #5
			DB::table('hrdt100_employeerequest')->where('id',$id)->update(['isProcess'=>'5']); 

			//arahin ke arah yang ditolak 
			$getUnitID = CRUDBooster::myUnitIDKeep();
			$storeManager = DB::table('cms_users')
							->where('Unit_id',$getUnitID)
							->where('id_cms_privileges','12')
							->pluck('id');
		
			$config['content'] = "Di tolak Manager HRD";
			$config['to'] = CRUDBooster::adminPath('employeerequest/');
			$config['id_cms_users'] = $storeManager;
			CRUDBooster::sendNotification($config);
			//This will redirect back and gives a message
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Ditolak !","warning");
		 }

	    //By the way, you can still create your own method in here... :) 


	    public function hapus_request($id){

	   DB::table('hrdt100_employeerequest')->where('id',$id)->delete();
	   redirect('admin/hapus_request_detail/'.$id)->send();
          }

       public function hapus_request_detail($id){

	   DB::table('hrdt101_detailrequest')->where('EmployeeRequest_id',$id)->delete();
	   CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data Berhasil Dihapus!","success");
          }

	}