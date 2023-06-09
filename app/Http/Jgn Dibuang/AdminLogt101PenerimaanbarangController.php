<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLogt101PenerimaanbarangController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "logt101_penerimaanbarang";
			# END CONFIGURATION DO NOT REMOVE THIS LINE
			$companyID=CRUDBooster::myCompanyID();
			$getUnitID = CRUDBooster::myUnitIDKeep();
			//dd($getUnitID);
			// $PrivilegeId = CRUDBooster::MyPrivilegeId();
			//----
		//	$getUnitID = CRUDBooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');

			$countNumber = DB::select('select count(*) from logt101_penerimaanbarang');
			$countNumberrec = DB::table('logt101_penerimaanbarang')->count();
			$dataKode = (int) $countNumberrec;
			$numberDocument = $dataKode +1;
			$char = "PB-DG";
			$kodePB = $char."/".date('Y')."/".date('m')."/".$numberDocument;
			//===============
			$empid=crudbooster::myID();
			//---------------
			$id=DB::Table('logt101_penerimaanbarang')
			->where('id', \DB::raw("(select max(`id`) from logt101_penerimaanbarang)"))
			  ->value('id');
		  	$ResultID = $id + 1;

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Purchaseorder Id","name"=>"purchaseorder_id","join"=>"logt301_purchaseorder,NoPO"];
			$this->col[] = ["label"=>"Vendor Id","name"=>"vendor_id","join"=>"logm001_vendor,Nama"];
			$this->col[] = ["label"=>"Employee Id","name"=>"employee_id","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Tanggal","name"=>"Tanggal"];
			$this->col[] = ["label"=>"Gambar","name"=>"gambar","image"=>true];
			$this->col[] = ["label"=>"IsStatus","name"=>"IsStatus"];
			$this->col[] = ["label"=>"IsApproved","name"=>"IsApproved"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ['label'=>'Nomor Penerimaan','name'=>'nopenerimaan','type'=>'text','validation'=>'min:0|max:50','width'=>'col-sm-2','value'=>$kodePB];
			$this->form[] = ['label'=>'Purchase Order','name'=>'purchaseorder_id','type'=>'datamodal','validation'=>'required|min:0','width'=>'col-sm-10','datamodal_table'=>'logt301_purchaseorder','datamodal_columns'=>'NoPO,vendor_ID,namavendor','datamodal_select_to'=>'NoPO:purchaseorder_id,vendor_ID:vendor_id,namavendor:namavendor','datamodal_where'=>'IsApproved=1','datamodal_size'=>'large','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Vendor','name'=>'vendor_id','type'=>'text','validation'=>'required|min:0|max:50','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Vendor','name'=>'namavendor','type'=>'text','width'=>'col-sm-3','datatable'=>'logm001_vendor,Nama'];
			$this->form[] = ['label'=>'Petugas','name'=>'employee_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-2','datatable'=>'cms_users,name','value'=>$EmployeeID,'readonly'=>true];
			$this->form[] = ['label'=>'Tanggal','name'=>'Tanggal','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d', time()),'width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Gambar','name'=>'gambar','type'=>'upload','validation'=>'image|max:3000','width'=>'col-sm-6','help'=>'File types support : JPG, JPEG, PNG, GIF, BMP'];
			$this->form[] = ['name'=>'IsStatus','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-2','value'=>'0'];
			$this->form[] = ['name'=>'IsApproved','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-2','value'=>'0'];
			# END FORM DO NOT REMOVE THIS LINE
			$columns = [];
			$columns[] = ['label'=>'Purchase ID','name'=>'id_purchaseorder','type'=>'datamodal','datamodal_table'=>'logt302_purchaseorderdetail','datamodal_columns'=>'barang_id,kodebarang,namabarang,jumlah_pesan','datamodal_select_to'=>'barang_id:barang_id,kodebarang:kodebarang,namabarang:namabarang,jumlah_pesan:jumlah_pesan','datamodal_where'=>'isstatus=2','datamodal_size'=>'large'];
			$columns[] = ['label'=>'Kode','name'=>'barang_id','type'=>'hidden'];
			$columns[] = ['label'=>'Kode','name'=>'kodebarang','type'=>'hidden','readonly'=>true];
			$columns[] = ['label'=>'Nama Barang','name'=>'namabarang','type'=>'text','readonly'=>true];
			$columns[] = ['label'=>'Jumlah Pesan','name'=>'jumlah_pesan','type'=>'number','width'=>'col-sm-2'];
			$columns[] = ['label'=>'Jumlah Datang','name'=>'jumlah_datang','type'=>'number','width'=>'col-sm-2'];
			$columns[] = ['label'=>'Sisa','name'=>'sisa_pesan','type'=>'number','width'=>'col-sm-2','formula'=>"[jumlah_pesan] - [jumlah_datang]","readonly"=>true,'required'=>true];
			$columns[] = ['label'=>'Harga Hpp','name'=>'barang_hpp','type'=>'number','width'=>'col-sm-2'];
			$columns[] = ['label'=>'Hpp Total','name'=>'barang_hpptotal','type'=>'number','formula'=>"[jumlah_datang] * [barang_hpp]","readonly"=>true,'required'=>true];
					//	$columns[] = ['label'=>'Harga','name'=>'Harga','type'=>'hidden','value'=>'1'];
			$columns[] = ['name'=>'isstatus','type'=>'hidden','value'=>'1'];
			$this ->form[] = ['label'=>'Penerimaan Barang','name'=>'logt102_penerimaanbarangdetail','type'=>'child','columns'=>$columns,'table'=>'logt102_penerimaanbarangdetail','foreign_key'=>'penerimaanbarang_id'];

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Purchaseorder Id","name"=>"purchaseorder_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"purchaseorder,id"];
			//$this->form[] = ["label"=>"Vendor Id","name"=>"vendor_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"vendor,id"];
			//$this->form[] = ["label"=>"Employee Id","name"=>"employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"employee,id"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"Tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Gambar","name"=>"gambar","type"=>"upload","required"=>TRUE,"validation"=>"required|image|max:3000","help"=>"File types support : JPG, JPEG, PNG, GIF, BMP"];
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
			// $id=DB::Table('logt101_penerimaanbarang')
			// ->where('id', \DB::raw("(select max(`id`) from logt101_penerimaanbarang)"))
			//   ->value('id');
			// //cek id purchase order berdasarkan idipenerimaan barang
			// $idpurchase=DB::table('logt101_penerimaanbarang')->where('id',$id)->get('purchaseorder_id');
			// $barang=DB::table('logt302_purchaseorderdetail')->where('purchaseorder_id',$idpurchase)->get('Baranginventory_ID');

			// foreach($barang as $item)
			// {
			// 	$produk=DB::find($item->Baranginventory_ID);
			// 	$produk->Stok = $item;
			// }

			// foreach($idbarang as $updatestok)
			// {
			// 	$newstok= 'jumlah_datang';
			// 	DB::table('logt301_purchaseorderdetail')
			// 		->where('purchaseorder_id',$idpurchase)
			// 		->where('Baranginventory_id',$idbarang)
			// 		->update(['jumlah_data'=> $newstok]);
			// }
			// $baranginvid=DB::table('logm101_baranginventory')->where('id',$idbarang);
			// //->value('Stok');
			// //$idbarang=DB::table('logt301_purchaseorderdetail')->where('purchaseorder_id',)
            
            //Ambil id & purchaseorder_id terkahir yang diinput di penerimaan barang
				$terimaid=DB::Table('logt101_penerimaanbarang')
			   ->where('id', \DB::raw("(select max(`id`) from logt101_penerimaanbarang)"))
			   ->value('id');

			   $terimapurchaseid=DB::Table('logt101_penerimaanbarang')
			   ->where('id', \DB::raw("(select max(`id`) from logt101_penerimaanbarang)"))
			   ->value('purchaseorder_id');

		   //update data di table logt102_penerimaanbarangdetail sesuai data di table logt101_penerimaanbarang
               
               DB::table('logt102_penerimaanbarangdetail')
			 		->where('penerimaanbarang_id',$terimaid)
			 		->update(['id_purchaseorder'=> $terimapurchaseid]);


//update data di table logt302_purchaseorderdetail sesuai data di table logt102_penerimaanbarangdetail
             			 		
DB::table('logt102_penerimaanbarangdetail') ->where('penerimaanbarang_id', \DB::raw("(select max(`id`) from logt101_penerimaanbarang)"))
    ->chunkById(100, function ($penerimaan) {
        foreach ($penerimaan as $terima) {
            DB::table('logt302_purchaseorderdetail')
                ->where('barang_id', $terima->barang_id)
                ->update(['jumlah_pesan' => $terima->jumlah_pesan]);

            DB::table('logt302_purchaseorderdetail')
                ->where('barang_id', $terima->barang_id)
                ->update(['jumlah_datang' => $terima->jumlah_datang]);

            DB::table('logt302_purchaseorderdetail')
                ->where('barang_id', $terima->barang_id)
                ->update(['sisa_pesan' => $terima->sisa_pesan]);
        }
    });


    //update data di table logm101_baranginventory sesuai data di table logt102_penerimaanbarangdetail
             			 		
DB::table('logt102_penerimaanbarangdetail')->where('penerimaanbarang_id', \DB::raw("(select max(`id`) from logt101_penerimaanbarang)"))
    ->chunkById(100, function ($inventory) {
        foreach ($inventory as $p) {
         $stocks = DB::table('logm101_baranginventory')
                ->where('id', $p->barang_id)
                ->get();
                
          foreach($stocks as $stock){
          DB::table('logm101_baranginventory')
          ->where('id', $p->barang_id)
          ->update(['Stok' => $stock->Stok + $p->jumlah_datang]);
}
        }
    });


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

	///titipan source
				//tarik data barang di table purchaseorder detail berdasarkan idpurchaseorder
			// $barang=DB::table('logt102_penerimaanbarangdetail')
			// 	->select(['id',
			// 	'id_purchaseorder',
			// 	//'NoPO',
			// 	'barang_id',
			// 	'kodebarang',
			// 	'namabarang',
			// 	'jumlah_pesan',
			// 	'jumlah_datang',
			// 	'sisa_pesan'])
			// 	->where('id_purchaseorder',$idpurchase)
			// 	->where('penerimaanbarang_id',$id)
			// 	->get();
			// $idbarang=DB::table('logt102_penerimaanbarangdetail')
			// 	->select(['id',
			// 	'id_purchaseorder',
			// 	//'NoPO',
			// 	'barang_id',
			// 	'kodebarang',
			// 	'namabarang',
			// 	'jumlah_pesan',
			// 	'jumlah_datang',
			// 	'sisa_pesan'])
			// 	->where('id_purchaseorder',$idpurchase)
			// 	->where('penerimaanbarang_id',$id)
			// 	->get();
			// $item=DB::table('logm101_baranginventory');
//dd($idbarang);