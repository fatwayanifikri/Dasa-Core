<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminKendaraanController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_kendaraan";
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
			$this->table = "hgst103_kendaraan";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nomor Kendaraan","name"=>"nomor_kendaraan"];
			$this->col[] = ["label"=>"Nama Pemegang","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Nama Kendaraan","name"=>"merk_kendaraan"];
			$this->col[] = ["label"=>"Kepemilikan","name"=>"Kepemilikan"];
			$this->col[] = ["label"=>"Rasio BBM","name"=>"rasio_perliter"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Nomor Polisi','name'=>'nomor_kendaraan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-8'];
			$this->form[] = ['label'=>'Asset ID','name'=>'asset_id','type'=>'select2','width'=>'col-sm-7','datatable'=>'loga001_asset,kode'];
			$this->form[] = ['label'=>'NIK Karyawan','name'=>'Employee_id','type'=>'datamodal','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_table'=>'hrde200_employee','datamodal_columns'=>'NPK,EmployeeName','datamodal_size'=>'large'];
			$this->form[] = ['label'=>'Nama Pemegang','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-8','readonly'=>'1'];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-8','datatable'=>'cms_privileges,name'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-8','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Merk Kendaraan','name'=>'merk_kendaraan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-8'];
			$this->form[] = ['label'=>'Jenis Kendaraan','name'=>'jenis_kendaraan','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-5','dataenum'=>'Mobil;Motor'];
			$this->form[] = ['label'=>'Tahun Kendaraan','name'=>'tahun_kendaraan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Warna Kendaraan','name'=>'warna_kendaraan','type'=>'text','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Kepemilikan','name'=>'kepemilikan','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Jenis BBM','name'=>'jenis_bbm','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datatable'=>'hgst105_bbm,nama_bbm'];
			$this->form[] = ['label'=>'Rasio Perliter BBM (KM)','name'=>'rasio_perliter','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'KM Akhir','name'=>'km_akhir','type'=>'number','width'=>'col-sm-5'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//
			//$this->form[] = ['label'=>'Nomor Polisi','name'=>'nomor_kendaraan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-8'];
			//
			//$this->form[] = ['label'=>'Asset ID','name'=>'asset_id','type'=>'select2','width'=>'col-sm-7','datatable'=>'loga001_asset,kode','readonly'=>true];
			//
			//$this->form[] = ['label'=>'NIK Karyawan','name'=>'Employee_id','type'=>'datamodal','datamodal_table'=>'hrde200_employee','datamodal_where'=>'','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'NPK,EmployeeName','datamodal_columns_alias'=>'NPK,EmployeeName','datamodal_select_to'=>'EmployeeName:EmployeeName,Unit_id:Unit_id,Jabatan_id:Jabatan_id','datamodal_size'=>'large','required'=>true];
			//
			//$this->form[] = ['label'=>'Nama Pemegang','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-8','readonly'=>true];
			//$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-8','datatable'=>'cms_privileges,name','readonly'=>true];
			//$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-8','datatable'=>'hrdm101_unit,UnitName','readonly'=>true];
			//
			//$this->form[] = ['label'=>'Merk Kendaraan','name'=>'merk_kendaraan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-8'];
			//$this->form[] = ['label'=>'Jenis Kendaraan','name'=>'jenis_kendaraan','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-5','dataenum'=>'Mobil;Motor'];
			//$this->form[] = ['label'=>'Tahun Kendaraan','name'=>'tahun_kendaraan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Warna Kendaraan','name'=>'warna_kendaraan','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Kepemilikan','name'=>'kepemilikan','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-5',"dataenum" => ["Pribadi ","Perusahaan"]];
			//
			//$this->form[] = ['label'=>'Jenis BBM','name'=>'jenis_bbm','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datatable'=>'hgst105_bbm,nama_bbm'];
			//$this->form[] = ['label'=>'Rasio Perliter BBM (KM)','name'=>'rasio_perliter','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'KM Akhir','name'=>'km_akhir','type'=>'number','width'=>'col-sm-5'];
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
	        $this->index_button[] = ['label'=>'Export','url'=>('export_kendaraan'),'icon'=>'fa fa-download','color'=>'primary'];



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

          //ambil id jenis_bbm dari id terbaru  table kendaraan
	       $getidkendaraan=DB::Table('hgst103_kendaraan')
			   ->where('id', \DB::raw("(select max(`id`) from hgst103_kendaraan)"))
			   ->value('jenis_bbm');

	      //ambil harga dari table bbm
	       $getharga=DB::Table('hgst105_bbm')
			   ->where('id',$getidkendaraan)
			   ->value('harga');

	    //ambil id dari table bbm
	       $getidbbm=DB::Table('hgst105_bbm')
			   ->where('id',$getidkendaraan)
			   ->value('id');

		  //input harga bbm di table hgst103_kendaraan
	       DB::table('hgst103_kendaraan')
			 		->where('jenis_bbm',$getidbbm)
			 		->update(['harga_bbm'=> $getharga]);



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