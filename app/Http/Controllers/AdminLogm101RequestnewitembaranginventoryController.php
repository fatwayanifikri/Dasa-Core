<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLogm101RequestnewitembaranginventoryController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "logm101_baranginventory";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			#TAMBAHAN
			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Kodebarang","name"=>"Kodebarang"];
			$this->col[] = ["label"=>"NamaBarang","name"=>"NamaBarang"];
			$this->col[] = ["label"=>"Coa","name"=>"Coa_id","join"=>"logm002_coa,Namacoa"];
			$this->col[] = ["label"=>"Kategori","name"=>"Kategori_id","join"=>"logm004_kategoribarang,Namakategori"];
			$this->col[] = ["label"=>"Gudang","name"=>"Gudang_id","join"=>"logm005_gudang,Namagudang"];
			$this->col[] = ["label"=>"Stok","name"=>"Stok"];
			$this->col[] = ["label"=>"Satuan","name"=>"Satuan"];
			$this->col[] = ["label"=>"Status","name"=>"Isstatus"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Kodebarang','name'=>'Kodebarang','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'NamaBarang','name'=>'NamaBarang','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Coa','name'=>'Coa_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-3','datatable'=>'logm002_coa,Namacoa'];
			$this->form[] = ['label'=>'Kategori','name'=>'Kategori_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'logm004_kategoribarang,Namakategori'];
			$this->form[] = ['label'=>'Gudang','name'=>'Gudang_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'logm005_gudang,Namagudang'];
			$this->form[] = ['label'=>'Stok','name'=>'Stok','type'=>'hidden','width'=>'col-sm-2','value'=>'0'];
			$this->form[] = ['label'=>'Satuan','name'=>'Satuan','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Hargajual','name'=>'Hargajual','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Isstatus','name'=>'Isstatus','type'=>'hidden','width'=>'col-sm-10','value'=>'0'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Kodebarang','name'=>'Kodebarang','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'NamaBarang','name'=>'NamaBarang','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Coa','name'=>'Coa_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-3','datatable'=>'logm002_coa,Namacoa'];
			//$this->form[] = ['label'=>'Kategori','name'=>'Kategori_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'logm004_kategoribarang,Namakategori'];
			//$this->form[] = ['label'=>'Gudang','name'=>'Gudang_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'logm005_gudang,Namagudang'];
			//$this->form[] = ['label'=>'Stok','name'=>'Stok','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Satuan','name'=>'Satuan','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Hargajual','name'=>'Hargajual','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Isstatus','name'=>'Isstatus','type'=>'hidden','value'=>'0'];
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
			//dd($getJabatan);
			//dd($getUnitID);
			if($getUnitID == 1){
				if ($getJabatan == 1 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[Isstatus] == 0"];

				}
				else
				{

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
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			// dd($getJabatan);
			if($getUnitID == 1){
				
					$query->where('isstatus','=','0');
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
					$column_value = 'Proses';
				}
				else
				{
					
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

		public function ApproveMng($id){
			

			DB::table('logm101_baranginventory')
				->where('id','=',$id)
				->update(['Isstatus'=>'1']);

			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Penambahan Bahan Baku Berhasil di Approve Manager Purchasing!","info");
		}

	    //By the way, you can still create your own method in here... :) 


	}