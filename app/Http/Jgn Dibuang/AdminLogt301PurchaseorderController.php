<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLogt301PurchaseorderController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {
	    	# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->table 			   = "logt301_purchaseorder";	        
			$this->title_field         = "id";
			$this->limit               = 20;
			$this->orderby             = "id,desc";
			$this->show_numbering      = FALSE;
			$this->global_privilege    = FALSE;	        
			$this->button_table_action = TRUE;   
			$this->button_action_style = "button_icon";     
			$this->button_add          = TRUE;
			$this->button_delete       = TRUE;
			$this->button_edit         = TRUE;
			$this->button_detail       = TRUE;
			$this->button_show         = TRUE;
			$this->button_filter       = TRUE;        
			$this->button_export       = FALSE;	        
			$this->button_import       = FALSE;
			$this->button_bulk_action  = TRUE;	
			$this->sidebar_mode		   = "normal"; //normal,mini,collapse,collapse-mini
			# END CONFIGURATION DO NOT REMOVE THIS LINE
			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"NoPO","name"=>"NoPO"];
			$this->col[] = ["label"=>"NoPR","name"=>"NoPR"];
			//$this->col[] = ["label"=>"Purchaserequest ID","name"=>"purchaserequest_ID","join"=>"logt201_purchaserequest,NoPR"];
			$this->col[] = ["label"=>"Vendor","name"=>"vendor_ID","join"=>"logm001_vendor,Nama"];
			$this->col[] = ["label"=>"Tanggal","name"=>"tanggal"];
			$this->col[] = ["label"=>"Status","name"=>"IsApproved"];
			
			# END COLUMNS DO NOT REMOVE THIS LINE
			$id=DB::Table('logt301_purchaseorder')
			->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
			  ->value('id');
		  	$ResultID = $id + 1;
			//-----------------------
			// NOMOR PO
			$countNumber = DB::select('select count(*) from logt301_purchaseorder');
			$countNumberrec = DB::table('logt301_purchaseorder')->count();
			$dataKode = (int) $countNumberrec;
			$numberDocument = $dataKode +1;
			$char = "PO-DP";
			$kodePO = $char."/".date('Y')."/".date('m')."/".$numberDocument;
			//dd($kodePO);
			// NOMOR PR YANG DISETUJUI
			//$statuspr=DB::table('logt201_purchaserequest')->where('IsApproved','=','1')->value('NoPR');
		//	dd($statuspr);
			# START FORM DO NOT REMOVE THIS LINE
			//$this->form[] = ['label'=>'Product Name','name'=>'products_id','type'=>'datamodal','datamodal_table'=>'products','datamodal_where'=>'','datamodal_columns'=>'name,description,price','datamodal_columns_alias'=>'Name,Description,Price','required'=>true];	
			
			$this->form = [];
			$this->form[] = ['name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ["label"=>"NoPO","name"=>"NoPO","type"=>"text","value"=>$kodePO,"validation"=>"required|min:1|max:255",'width'=>'col-sm-2','readonly'=>true];
			$this->form[] = ["label"=>"Daftar NOMOR PR","name"=>"purchaserequest_ID",'width'=>'col-sm-4',"type"=>"datamodal","datamodal_table"=>"logt201_purchaserequest","datamodal_where"=>"IsApproved = 1","datamodal_columns"=>'NoPR','datamodal_select_to'=>'NoPR:NoPR',"datamodal_columns_alias"=>'Nomor PR',"required"=>true];
			$this->form[] = ["label"=>"Purchaserequest","name"=>"NoPR","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255",'width'=>'col-sm-2'];
			$this->form[] = ["label"=>"Vendor","name"=>"vendor_ID","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"logm001_vendor,nama",'width'=>'col-sm-5'];
			$this->form[] = ["label"=>"Tanggal","name"=>"tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date",'width'=>'col-sm-2','value'=>date('Y-m-d', time())];
			$this->form[] = ["label"=>"IsStatus","name"=>"IsStatus","type"=>"hidden","required"=>TRUE,"validation"=>"required|integer|min:0","value"=>'0'];
			$this->form[] = ["label"=>"IsApproved","name"=>"IsApproved","type"=>"hidden","validation"=>"required|min:1|max:255","value"=>'0'];

			$columns = [];
			$columns[] = ['label'=>'Purchase','name'=>'purchaseorder_id','type'=>'hidden','value'=>$ResultID];
			$columns[] = ['label'=>'No PO','name'=>'NoPO','type'=>'hidden','value'=>$kodePO];
			$columns[] = ['label'=>'Kode Barang','name'=>'baranginventory_id','type'=>'datamodal','datamodal_table'=>'logm101_baranginventory','datamodal_columns'=>'Kodebarang,NamaBarang','datamodal_select_to'=>'Kodebarang:kodebarang,NamaBarang:namabarang','datamodal_where'=>'','datamodal_size'=>'large'];
			$columns[] = ['label'=>'Kode','name'=>'kodebarang','type'=>'hidden','readonly'=>true];
			$columns[] = ['label'=>'Nama Barang','name'=>'namabarang','type'=>'text','readonly'=>true];
			$columns[] = ['label'=>'Jumlah Pesan','name'=>'jumlah_pesan','type'=>'number','width'=>'col-sm-2'];
			// $columns[] = ['label'=>'Jumlah Datang','name'=>'jumlah_datang','type'=>'number','value'=>'1'];
			$columns[] = ['label'=>'Sisa','name'=>'sisa_pesan','type'=>'number','width'=>'col-sm-2','formula'=>"[jumlah_pesan] - [0]","readonly"=>true,'required'=>true];
		//	$columns[] = ['label'=>'Harga','name'=>'Harga','type'=>'hidden','value'=>'1'];
			$columns[] = ['label'=>'Status','name'=>'isstatus','type'=>'hidden','value'=>'1'];
			$this ->form[] = ['label'=>'Pembelian Barang','name'=>'logt302_purchaseorderdetail','type'=>'child','columns'=>$columns,'table'=>'logt302_purchaseorderdetail','foreign_key'=>'purchaseorder_id'];

			# END FORM DO NOT REMOVE THIS LINE     

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
			$getUnitID = CRUDBooster::myUnitId();
			$getJabatan = CRUDBooster::myPrivilegeId();

			if($getJabatan == '1'){
				$this->addaction[]=['label'=>'Setuju','name'=>'setuju_mng','url'=>('ApprovalManager').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[IsApproved] == 0"];
				$this->addaction[]=['label'=>'Batal','name'=>'batal_mng','url'=>('BatalApprovalManager').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[IsApproved] == 1"];
			}
			elseif ($getJabatan == '7') {
				$this->addaction[]=['label'=>'Setuju','name'=>'setuju_mng','url'=>('ApprovalManager').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[IsApproved] == 0"];
				$this->addaction[]=['label'=>'Batal','name'=>'batal_mng','url'=>('BatalApprovalManager').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[IsApproved] == 1"];

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
	        $this->load_js = "";
				// $(function(){
				// 	setInterval(function(){
				// 		var pesan=$(jumlah_pesan).val();
				// 		var datang=0 ;
				// 		$('#panel-body child-form-area form .sisa_pesan').each(function(){
				// 			var sisa=parseInt($(this).text());
				// 			sisapesan += sisa;
				// 		})
				// 		var calculate=Math.abs(pesan - datang);
				// 		$('#sisa_pesan').val(calculate);
						
				// 	},500);
				// })
	        
	        
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
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
			if($column_index == 5){
				if($column_value =1){
					$column_value='Belum Disetujui';
				}
				elseif ($column_value=2) {
					$column_value = 'Disetujui';
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
	        //Your code here
			$id=DB::Table('logt301_purchaseorder')
			->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
			  ->value('id');
			$vendorid=request::get('vendor_ID');
			$vendorname=DB::table('logm001_vendor')
						->where('id',$vendorid)
						->value('Nama');
			//dd($id);
			DB::table('logt301_purchaseorder')->where('id',$id)->update(['namavendor'=>$vendorname]);
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

		// APPROVED
		public function ApprovalManager($id){
			$NoPR = DB::table('logt301_purchaseorder')->where('id',$id)->value('NoPO');
			DB::table('logt301_purchaseorder')->where('id',$id)->update(['IsApproved'=>'1']);
			$orderid=DB::table('logt301_purchaseorder')
				->where('id',$id)
				->value('id');
			
				DB::table('logt302_purchaseorderdetail')->where('purchaseorder_id',$orderid)->update(['isstatus'=>'2']);
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Purchase Order dengan Nomor $NoPO Berhasil di Approve","info");
		}

		Public function BatalApprovalManager($id){

		}


	    //By the way, you can still create your own method in here... :) 


	}