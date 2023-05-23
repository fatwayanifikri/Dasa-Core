<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPurchaseOrderController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "namavendor";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "logt301_purchaseorder";
			# END CONFIGURATION DO NOT REMOVE THIS LINE
			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nomor PO","name"=>"NoPO"];
			// $this->col[] = ["label"=>"Nomor PR","name"=>"NoPR","join"=>"logt201_purchaserequest,NoPR"];
			// $this->col[] = ["label"=>"Purchaserequest ID","name"=>"purchaserequest_ID"];
			$this->col[] = ["label"=>"Vendor","name"=>"vendor_ID","join"=>"logm001_vendor,Nama"];
			$this->col[] = ["label"=>"Created At","name"=>"tanggal"];
			$this->col[] = ["label"=>"Status PO","name"=>"IsStatus"];
			$this->col[] = ["label"=>"Approval PO","name"=>"IsApproved"];
			// $this->col[] = ["label"=>"Namavendor","name"=>"namavendor"];
			// $this->col[] = ["label"=>"Rekeningvendor","name"=>"rekeningvendor"];
			// $this->col[] = ["label"=>"Norekeningvendor","name"=>"norekeningvendor"];
			# END COLUMNS DO NOT REMOVE THIS LINE
			$id=DB::Table('logt301_purchaseorder')
			->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
			  ->value('id');
		  $ResultID = $id + 1;
	  //==========
	  $countNumber = DB::select('select count(*) from logt301_purchaseorder');
	  $countNumberrec = DB::table('logt301_purchaseorder')->count();
	  $dataKode = (int) $countNumberrec;
	  $numberDocument = $dataKode +1;
	  
	  $char = "PO";
	  
	  $kodePO = $char."/".date('Y')."/".date('m')."/".$numberDocument;
	  $bulan=date('m');
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Purchaseorder id','name'=>'id','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>$ResultID];
			$this->form[] = ['label'=>'NoPO','name'=>'NoPO','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>$kodePO];
			$this->form[] = ['label'=>'NoPR','name'=>'NoPR','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'logt201_purchaserequest,NoPR','datatable_where'=>''];
		//	$this->form[] = ['label'=>'Purchaserequest ID','name'=>'purchaserequest_ID','type'=>'hidden','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Vendor ID','name'=>'vendor_ID','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'logm001_vendor,nama'];
			//$this->form[] = ['label'=>'Namavendor','name'=>'namavendor','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Rekeningvendor','name'=>'rekeningvendor','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Norekeningvendor','name'=>'norekeningvendor','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Alamatvendor','name'=>'alamatvendor','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Vendorbank','name'=>'vendorbank','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'date','validation'=>'date','width'=>'col-sm-10','value'=>date('Y-m-d', time())];
			$this->form[] = ['label'=>'Bulan','name'=>'bulan','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10','value'=>$bulan];
			$this->form[] = ['label'=>'Nomor','name'=>'nomor','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jumlah','name'=>'jumlah','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Gr','name'=>'status_gr','type'=>'hidden','validation'=>'min:1|max:255','width'=>'col-sm-10','value'=>'1'];
			$this->form[] = ['label'=>'Statusfaktur','name'=>'statusfaktur','type'=>'hidden','validation'=>'min:1|max:255','width'=>'col-sm-10','value'=>'1'];
			$this->form[] = ['label'=>'Statusbayar','name'=>'statusbayar','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'1'];
			$this->form[] = ['label'=>'Userinput','name'=>'userinput','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>$EmployeeID];
			$this->form[] = ['label'=>'IsStatus','name'=>'IsStatus','type'=>'hidden','validation'=>'required|integer|min:0','width'=>'col-sm-10','value'=>'1'];
			$this->form[] = ['label'=>'IsApproved','name'=>'IsApproved','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'1'];

			$columns = [];
			$columns[]=['label'=>'ID PR','name'=>'purchaseorder_id','type'=>'hidden','value'=>$ResultID];
			//$columns[]=['label'=>'No PR','name'=>'NoPR','type'=>'hidden','value'=>$kodePR];
			$columns[]=['label'=>'Barang ID','name'=>'barangID','type'=>'datamodal','datamodal_table'=>'logt202_purchaserequestdetail','datamodal_columns'=>'barang_id,kodebarang,namabarang','datamodal_select_to'=>'barang_id:barangID,kodebarang:kodebarang,namabarang:namabarang','datamodal_where'=>'','datamodal_size'=>'large'];
			$columns[]=['label'=>'Kode Barang','name'=>'kodebarang','type'=>'text'];
			$columns[]=['label'=>'Nama Barang','name'=>'namabarang','type'=>'text'];
			// $columns[]=['label'=>'Akun','name'=>'akun_id','type'=>'select2','datatable'=>'logm002_coa,Namacoa','datatable_where'=>''];
			$columns[]=['label'=>'QTY','name'=>'jumlah','type'=>'number','validation'=>'required'];
			$columns[]=['label'=>'Jumlah Kebutuhan','name'=>'jumlahpermintaan','type'=>'number','validation'=>''];
			$columns[]=['label'=>'Jumlah Pesan','name'=>'jumlahpesan','type'=>'number','value'=>'$jumlah'];
			$columns[]=['label'=>'Jumlah Diterima','name'=>'jumlahditerima','type'=>'number'];
			$columns[]=['label'=>'Catatan','name'=>'Keterangan','type'=>'textarea'];
			$columns[]=['label'=>'Status','name'=>'Isstatus','type'=>'hidden','value'=>'1'];
			$this ->form[] = ['label'=>'Purchase Request','name'=>'logt302_purchaseorderdetail','type'=>'child','columns'=>$columns,'table'=>'logt302_purchaseorderdetail','foreign_key'=>'purchaseorder_id'];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"NoPO","name"=>"NoPO","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"NoPR","name"=>"NoPR","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Purchaserequest ID","name"=>"purchaserequest_ID","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Vendor ID","name"=>"vendor_ID","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Namavendor","name"=>"namavendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Rekeningvendor","name"=>"rekeningvendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Norekeningvendor","name"=>"norekeningvendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Alamatvendor","name"=>"alamatvendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Vendorbank","name"=>"vendorbank","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Bulan","name"=>"bulan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nomor","name"=>"nomor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Jumlah","name"=>"jumlah","type"=>"text","required"=>TRUE,"validation"=>"required55"];
			//$this->form[] = ["label"=>"IsStatus","name"=>"IsStatus","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"IsApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:2|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status Gr","name"=>"status_gr","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Statusfaktur","name"=>"statusfaktur","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Statusbayar","name"=>"statusbayar","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Userinput","name"=>"userinput","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
					$this->addaction[]=['label'=>'Setujui','name'=>'setuju_mgrPR','url'=>('ApproveMngPO').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[IsStatus] == 1"];
					$this->addaction[]=['label'=>'Batal','name'=>'batal_mgrPR','url'=>('BatalMngPO').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[IsStatus] == 2"];
				}
				elseif($getJabatan == 1){
					$this->addaction[]=['label'=>'Setujui','name'=>'setuju_mgrPR','url'=>('ApproveMngPO').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[IsStatus] == 1"];
					$this->addaction[]=['label'=>'Batal','name'=>'batal_mgrPR','url'=>('BatalMngP)').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[Isstatus] == 2"];
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
            $this->index_button[] = ['label'=>'Add Data','name'=>'adddata','url'=>('purchase_order_add'),'icon'=>'fa fa-plus','color'=>'success'];



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
			$idpr=DB::table('logt201_purchaserequest')
			->where('NoPR',$NoPR)
			->value('id');
			DB::table('logt301_purchaseorder')->where('NoPR',$NoPR)->update(['purchaserequest_ID'=>'$idpr']);

			$datavendor=DB::table('logm001_vendor')
			->select(['Nama as nama',
			'Namarekening as namarekening',
			'Norek as norek',
			'Alamat as alamat',
			'Bank as bank'])
			->where('vendor_ID',$vendor_ID);

			DB::table('logt301_purchaseorder')->where('NoPR',$NoPR)
			->update(['namavendor'=>'$nama',
					  'norekeningvendor'=>'$norek',
					  'rekeningvendor' => '$namarekening',
					  'alamatvendor' => '$alamat',
					  'vendorbank' => '$bank']);
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



	    //By the way, you can still create your own method in here... :) 


	}