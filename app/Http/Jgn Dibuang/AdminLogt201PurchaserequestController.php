<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLogt201PurchaserequestController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "logt201_purchaserequest";
			# END CONFIGURATION DO NOT REMOVE THIS LINE
			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"NoPR","name"=>"NoPR"];
			$this->col[] = ["label"=>"Tanggal","name"=>"Tanggal"];
			//$this->col[] = ["label"=>"IsStatus","name"=>"IsStatus"];
			// isstatus => 0=open, 1= close/selesai  saaat barang sudah di terima (perbarang di tabel detail)
			$this->col[] = ["label"=>"Status","name"=>"IsApproved"];
			# END COLUMNS DO NOT REMOVE THIS LINE
			
			$id=DB::Table('logt201_purchaserequest')
	      		->where('id', \DB::raw("(select max(`id`) from logt201_purchaserequest)"))
	  	  		->value('id');
	  	  	$ResultID = $id + 1;
			//==========
			$countNumber = DB::select('select count(*) from logt201_purchaserequest');
			$countNumberrec = DB::table('logt201_purchaserequest')->count();
			$dataKode = (int) $countNumberrec;
			$numberDocument = $dataKode +1;
			
			$char = "PR";
			
			$kodePR = $char."/".date('Y')."/".date('m')."/".$numberDocument;
			//dd($kodePR);
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ['label'=>'NoPR','name'=>'NoPR','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-2','value'=>$kodePR,'readonly'=>true];
			$this->form[] = ['label'=>'Tanggal','name'=>'Tanggal','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d', time()),'width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsStatus','name'=>'IsStatus','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'0'];
			// isstatus => 0=open, 1= close/selesai  saaat barang sudah di terima (perbarang di tabel detail)
			$this->form[] = ['label'=>'IsApproved','name'=>'IsApproved','type'=>'hidden','value'=>'0'];
			// isstatus => 0=belum disetujui. 1=disetujui
			//dd($kodePR);
			$columns = [];
			$columns[] = ['label'=>'ID PR','name'=>'purchaserequest_id','visible'=>'false','value'=>$ResultID];
			$columns[] = ['label'=>'Nomor PR','name'=>'NoPR','type'=>'hidden','value'=>$kodePR];
			$columns[] = ['label'=>'Kode Barang','name'=>'barang_id','type'=>'datamodal','datamodal_table'=>'logm101_baranginventory','datamodal_columns'=>'Kodebarang,NamaBarang','datamodal_select_to'=>'NamaBarang:NamaBarang','datamodal_where'=>'','datamodal_size'=>'large'];
			$columns[] = ['label'=>'Barang','name'=>'NamaBarang','type'=>'text','readonly'=>true];
			$columns[] = ['label'=>'Jumlah','name'=>'jumlah','type'=>'number','width'=>'col-sm-2'];
		    $columns[] = ['label'=>'Status','name'=>'isstatus','type'=>'hidden','value'=>'1'];
			$this ->form[] = ['label'=>'Permintaan Barang','name'=>'logt202_purchaserequestdetail','type'=>'child','columns'=>$columns,'table'=>'logt202_purchaserequestdetail','foreign_key'=>'purchaserequest_id'];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"NoPR","name"=>"NoPR","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"Tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"IsStatus","name"=>"IsStatus","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"IsApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
			$getJabatan=Crudbooster::myPrivilegeId();
			$getUnitID=CRUDBooster::myUnitIDKeep();

			if($getUnitID == 1){
				if($getJabatan == 7){
					$this->addaction[]=['label'=>'Setujui','name'=>'setuju_mgrPR','url'=>('ApproveMngPR').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[IsApproved] == 0"];
					$this->addaction[]=['label'=>'Batal','name'=>'batal_mgrPR','url'=>('BatalMngPR').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[IsApproved] == 1"];
				}
				elseif($getJabatan == 1){
					$this->addaction[]=['label'=>'Setujui','name'=>'setuju_mgrPR','url'=>('ApproveMngPR').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[IsApproved] == 0"];
					$this->addaction[]=['label'=>'Batal','name'=>'batal_mgrPR','url'=>('BatalMngPR').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[IsApproved] == 1"];
				}
			}

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
			$this->table_row_color[] = ['condition'=>"[IsApproved]=='0'","color"=>"danger"];
	        
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
	        $this->script_js = NULL;


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
	        //Your code here
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			
			if($getUnitID == 1){
				if($getJabatan == 1){
					$query;
				}
				elseif ($getJabatan == 2) {
					$query;
				}
				elseif ($getJabatan == 3) {
					$query;
				}
				elseif ($getJabatan == 4) {
					$query;
				}
				elseif ($getJabatan == 5) {
					$query;
				}
				elseif ($getJabatan == 7) {
					$query;
				}
				elseif ($getJabatan == 78) {
					$$query
					->where('IsApproved','=','0');
				}
				elseif ($getJabatan == 79) {
					$$query
					->where('IsApproved','=','0');
				}
				else {
					CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Anda tidak dapat mengakses halaman ini!","info");
					return false;
				}
			}
			else {
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Anda tidak dapat mengakses halaman ini!","info");
					return false;
			}
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	if($column_index == 3){
				if($column_value == 0)
				{
					$column_value = 'Belum disetujui';
				}
				else {
					$column_value = 'Setuju';
				}
			}
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
			$id=DB::Table('logt201_purchaserequest')
			->where('id', \DB::raw("(select max(`id`) from logt201_purchaserequest)"))
			->value('id');
		  $ResultID = $id + 1;
		  //===============
		  $countNumber = DB::select('select count(*) from logt201_purchaserequest');
		  $countNumberrec = DB::table('logt201_purchaserequest')->count();
		  $dataKode = (int) $countNumberrec;
		  $numberDocument = $dataKode + 1;
		  
		  $char = "PR";
		  
		  $kodePR = $char."/".date('Y')."/".date('m')."/".$numberDocument;
		  //============

		 //dd($ResultID);
			$idpr=$ResultID;
	        DB::table('logt202_purchaserequestdetail')
			->where('purchaserequest_id','=',$idpr)
			->update(['NoPR'=>$kodePR]);

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
	       $cekstatus=DB::table('logt201_purchaserequest')
					->where('id',$id)
					->value('IsApproved');
			if($cekstatus == 0){
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Anda tidak dapat merubah ini!","info");
					return false;
			}


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
	        $cekstatus=DB::table('logt201_purchaserequest')
					->where('id',$id)
					->value('IsAproved');
			if($cekstatus == 0){
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Anda tidak dapat merubah ini!","info");
					return false;
			}

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
		// APPROVE PR
		public function ApproveMngPR($id){

			$NoPR = DB::table('logt201_purchaserequest')->where('id',$id)->value('NoPR');
			DB::table('logt201_purchaserequest')
			->where('id',$id)
			->update(['IsApproved'=>'1']);
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Purchase Request dengan Nomor $NoPR Berhasil di Approve","info");	

		}
		// PEMBATALAN PR
		public function BatalMngPR($id){
			$NoPR = DB::table('logt201_purchaserequest')->where('id',$id)->value('NoPR');
			DB::table('logt201_purchaserequest')
			->where('id',$id)
			->update(['IsApproved'=>'0']);
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Purchase Request dengan Nomor $NoPR telah dibatalkan");
		}


	    //By the way, you can still create your own method in here... :) 


	}