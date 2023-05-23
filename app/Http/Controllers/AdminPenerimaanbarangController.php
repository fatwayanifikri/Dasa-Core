<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPenerimaanbarangController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "logt401_penerimaanbarang";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"No Penerimaan","name"=>"nopenerimaan"];
			$this->col[] = ["label"=>"Tanggal","name"=>"tanggal"];
			$this->col[] = ["label"=>"Nomor PO","name"=>"NoPO"];
			$this->col[] = ["label"=>"User Input","name"=>"userinput"];
			$this->col[] = ["label"=>"Vendor ID","name"=>"vendor_ID"];
			$this->col[] = ["label"=>"Nama Vendor","name"=>"namavendor"];
			$this->col[] = ["label"=>"Total","name"=>"total"];
			# END COLUMNS DO NOT REMOVE THIS LINE
           
           $id=DB::Table('logt401_penerimaanbarang')
	      		->where('id', \DB::raw("(select max(`id`) from logt401_penerimaanbarang)"))
	  	  		->value('id');
	  	  	$ResultID = $id+1;

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ['label'=>'Nomor PO','name'=>'PO_ID','type'=>'datamodal','datamodal_table'=>'logt301_purchaseorder','datamodal_columns'=>'NoPO','datamodal_columns_alias'=>'NoPO','datamodal_select_to'=>'NoPO:NoPO','datamodal_where'=>'','datamodal_size'=>'','width'=>'col-sm-7'];

			$this->form[] = ['label'=>'No Penerimaan','name'=>'nopenerimaan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'date','validation'=>'required|date','width'=>'col-sm-7'];

           //NOMOR PO HIDEN BY JAVASCRIPT
           $this->form[] = ['label'=>'','name'=>'NoPO','type'=>'text','value' =>'','width'=>'col-sm-7'];
           //----------------------------

			// $this->form[] = ['label'=>'User Input','name'=>'userinput','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Vendor ID','name'=>'vendor_ID','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Nama Vendor','name'=>'namavendor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Total','name'=>'total','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7'];
			// $this->form[] = ['label'=>'Status Bayar','name'=>'statusbayar','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			// $this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			# END FORM DO NOT REMOVE THIS LINE
             
            $columns = [];
			
			$columns[]=['label'=>'Penerimaan ID','name'=>'penerimaan_id','type'=>'hidden','value'=>$ResultID];

			$columns[]=['label'=>'Kode Barang','name'=>'barangID','type'=>'datamodal','datamodal_table'=>'logm101_baranginventory','datamodal_columns'=>'Kodebarang,NamaBarang','datamodal_columns_alias'=>'Kode Barang,Nama Barang','datamodal_select_to'=>'Kodebarang:kodebarang,NamaBarang:namabarang','datamodal_where'=>'','datamodal_size'=>''];
			$columns[]=['label'=>'Kode Barang','name'=>'kodebarang','type'=>'hidden'];
			$columns[]=['label'=>'Nama Barang','name'=>'namabarang','type'=>'text'];
			$columns[]=['label'=>'Jumlah Datang','name'=>'jumlahditerima','type'=>'number','validation'=>'required'];
			$columns[]=['label'=>'Jumlah Permintaan','name'=>'jumlahpermintaan','type'=>'number','validation'=>'required'];

			$this ->form[] = ['label'=>'Penerimaan Detail','name'=>'logt402_penerimaanbarangdetail','type'=>'child','columns'=>$columns,'table'=>'logt402_penerimaanbarangdetail','foreign_key'=>'penerimaan_id'];

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Nopenerimaan","name"=>"nopenerimaan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"NoPO","name"=>"NoPO","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Userinput","name"=>"userinput","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Vendor ID","name"=>"vendor_ID","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Namavendor","name"=>"namavendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Total","name"=>"total","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Statusbayar","name"=>"statusbayar","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
	        $this->script_js = "
			$(function() {

			setInterval(function(){
			var nopenerimaan = 0;	
			var pr = 'PR/';
			var NoPO = $('#NoPO').val();
			var combine = pr + NoPO ;
			$('#nopenerimaan').val(combine);
			}); 
			
			var form = document.getElementById('NoPO');
            form.style.display = 'none';
			});
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
	        $this->load_js =  array();
	        
	        
	        
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
       




	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	      
	    $po_id=DB::Table('logt401_penerimaanbarang')
	      		->where('id', \DB::raw("(select max(`id`) from logt401_penerimaanbarang)"))
	  	  		->value('PO_ID');
	  	
        //ambil data dari table logt302_purchaseorderdetail
        $query = DB::table('logt302_purchaseorderdetail')
         ->select('barangID','kodebarang','namabarang','jumlahpermintaan','purchaseorder_id','jumlahditerima')
          ->where('purchaseorder_id','=',$po_id)
          ->get();

        
        //salin data dari table logt302_purchaseorderdetail untuk insert ke table logt402_penerimaanbarangdetail
         foreach($query as $p)
          {
         DB::table('logt402_penerimaanbarangdetail')->insert(get_object_vars($p)); 
          }   
         
          redirect('admin/complete_penerimaan_barang')->send();
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
       
       public function complete_penerimaan_barang(){
        
        //ambil id terbaru dari table logt401_penerimaanbarang
	    $penerimaan_id=DB::Table('logt401_penerimaanbarang')
	      		->where('id', \DB::raw("(select max(`id`) from logt401_penerimaanbarang)"))
	  	  		->value('id'); 

        //ambil po id dari table logt401_penerimaanbarang
	  	$PO_ID=DB::Table('logt401_penerimaanbarang')
	      		->where('id', \DB::raw("(select max(`id`) from logt401_penerimaanbarang)"))
	  	  		->value('PO_ID'); 
        
    //     //ambil nomor_po id dari table logt301_purchaseorder
	  	// $NO_PO=DB::Table('logt301_purchaseorder')
	   //    		->where('id','=',$PO_ID)
	  	//   		->value('NoPO'); 
        

    //     //update nomor po di logt401_penerimaanbarang
    //     DB::table('logt401_penerimaanbarang')
    //     ->where('id', \DB::raw("(select max(`id`) from logt401_penerimaanbarang)"))
    //     ->update(['NoPO'=>$NO_PO]); 
        

        //update penerimaan id di logt402_penerimaanbarangdetail 
	  	DB::table('logt402_penerimaanbarangdetail')
	    ->where('purchaseorder_id','=',$PO_ID)
	  	->update(['penerimaan_id'=>$penerimaan_id]); 
        
        redirect('admin/tambah_inventory_stock')->send();

        }


      public function tambah_inventory_stock(){
     
     //update stock di table logm101_baranginventory berdasarkan barang diterima di logt402_penerimaanbarangdetail

       DB::table('logt402_penerimaanbarangdetail')->where('penerimaan_id', \DB::raw("(select max(`id`) from logt401_penerimaanbarang)"))
        ->chunkById(100, function ($penerimaan) {
        foreach ($penerimaan as $p) {
         $stocks = DB::table('logm101_baranginventory')
                ->where('Kodebarang', $p->kodebarang)
                ->get();
                
          foreach($stocks as $stock){
          DB::table('logm101_baranginventory')
          ->where('Kodebarang', $p->kodebarang)
          ->update(['Stok' => $stock->Stok + $p->jumlahditerima]);
        }
        }
        });

        CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Input Data Berhasil !","success");

        }


        // public function view_penerimaan_detail($id){

        
        // redirect('admin/logt401_penerimaanbarang/add/'.$id)->send();

        // }
	}