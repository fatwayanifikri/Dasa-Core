<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PDF;
	use Carbon\Carbon;

	class AdminMaintenanceKendaraanController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_barang";
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
			$this->table = "hgst106_maintenancekendaraan";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

		  $id=DB::Table('hgst106_maintenancekendaraan')
	      ->where('id', \DB::raw("(select max(`id`) from hgst106_maintenancekendaraan)"))
	  	  ->value('id');
	  	  $ResultID = $id + 1;

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nopol","name"=>"nopol","join"=>"hgst103_kendaraan,nomor_kendaraan"];
			$this->col[] = ["label"=>"Employee Name","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Tgl Permintaan","name"=>"tgl_permintaan"];
			// $this->col[] = ["label"=>"Jenis Kendaraan","name"=>"jenis_kendaraan"];
			
			// $this->col[] = ["label"=>"Kilometer","name"=>"kilometer"];
			
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Id','name'=>'id','type'=>'hidden','value'=>$ResultID];

			$this->form[] = ["label"=>"Nopol","name"=>"nopol",'width'=>'col-sm-4',"type"=>"datamodal","datamodal_table"=>"hgst103_kendaraan","datamodal_where"=>"",'datamodal_columns_alias'=>'Nopol',"datamodal_columns"=>'nomor_kendaraan','datamodal_select_to'=>'asset_id:asset_id,Unit_id:Unit_id,EmployeeName:EmployeeName,km_akhir:kilometer,jenis_kendaraan:jenis_kendaraan',"required"=>true];

			$this->form[] = ['label'=>'Asset ID','name'=>'asset_id','type'=>'select','width'=>'col-sm-7','datatable'=>'loga001_asset,kode','readonly'=>true];

			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-7','datatable'=>'hrdm101_unit,UnitName','readonly'=>true];

			 $this->form[] = ['label'=>'Employee Name','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:0','width'=>'col-sm-10','readonly'=>true];

			$this->form[] = ['label'=>'Jenis Kendaraan','name'=>'jenis_kendaraan','type'=>'text','validation'=>'required|min:0','width'=>'col-sm-10','readonly'=>true];
			$this->form[] = ['label'=>'Kilometer','name'=>'kilometer','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10','readonly'=>true];
			

			$columns = [];
			$columns[] = ['label'=>'Request Id','name'=>'maintenance_id','type'=>'hidden','value'=>$ResultID];

			$columns[]  = ['label'=>'Tanggal','name'=>'tgl_permintaan','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d', time()),'width'=>'col-sm-2'];
			// $columns[] = ['label'=>'Tgl Permintaan','name'=>'tgl_permintaan','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$columns[] = ['label'=>'Nama Barang','name'=>'nama_barang','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10',"required"=>true];

			$columns[] = ["label"=>"Photo","name"=>"image","type"=>"upload","help"=>"Recommended resolution is 200x200px",'validation'=>'required|image|max:1000','resize_width'=>90,'resize_height'=>90];	

			$columns[] = ['label'=>'Jumlah','name'=>'jumlah','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10',"required"=>true];
			$columns[] = ['label'=>'Catatan','name'=>'catatan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10',"required"=>true];
			$columns[] = ['label'=>'Nilai','name'=>'nilai','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10',"required"=>true];

			// $columns[] = ['label'=>'Total','name'=>'totalharga','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','readonly'=>true];
			$columns[] = ['label'=>'Status','name'=>'status','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'1'];

			$this ->form[] = ['label'=>'Form Maintenance','name'=>'hgst107_maintenancekendaraandetail','type'=>'child','columns'=>$columns,'table'=>'hgst107_maintenancekendaraandetail','foreign_key'=>'maintenance_id'];
# END FORM DO NOT REMOVE THIS LINE
			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Jenis Kendaraan","name"=>"jenis_kendaraan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nopol","name"=>"nopol","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Kilometer","name"=>"kilometer","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Tgl Permintaan","name"=>"tgl_permintaan","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Nama Barang","name"=>"nama_barang","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Jumlah","name"=>"jumlah","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Catatan","name"=>"catatan","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
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
	        $this->index_button[] = ['label'=>'Export','url'=>('maintenance_kendaraan_print'),'icon'=>'fa fa-download','color'=>'primary'];




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
			var totalharga = 0;	
			var jumlah = $('#jumlah').val();
			var nilai = $('#nilai').val();
			var calculate = Math.abs(jumlah * nilai);
			var hasil = Math.ceil(calculate);
			$('#totalharga').val(hasil);
			}); 
       
			
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

	    $idkendaraan=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', \DB::raw("(select max(`id`) from hgst106_maintenancekendaraan)"))
	    ->value('id');

	    $maintenanceid=DB::Table('hgst107_maintenancekendaraandetail')
	    ->where('id', \DB::raw("(select max(`id`) from hgst107_maintenancekendaraandetail)"))
	    ->value('maintenance_id');

	    $EmpName=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', \DB::raw("(select max(`id`) from hgst106_maintenancekendaraan)"))
	    ->value('EmployeeName');

	     $Unit_id=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', \DB::raw("(select max(`id`) from hgst106_maintenancekendaraan)"))
	    ->value('Unit_id');

	    $date=DB::Table('hgst107_maintenancekendaraandetail')
	    ->where('id', \DB::raw("(select max(`id`) from hgst107_maintenancekendaraandetail)"))
	    ->value('tgl_permintaan');

	    $nopol=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', \DB::raw("(select max(`id`) from hgst106_maintenancekendaraan)"))
	    ->value('nopol');

	    DB::table('hgst107_maintenancekendaraandetail')->where('maintenance_id','=',$idkendaraan)->update(['EmployeeName'=>$EmpName,'Unit_id'=>$Unit_id,'nopol_id'=>$nopol]);

	    DB::table('hgst106_maintenancekendaraan')->where('id','=',$maintenanceid)->update(['tgl_permintaan'=>$date]);

	    redirect('admin/printmainkenpdf?maintenance_id='.$idkendaraan)->send();

	    //----------------------------------------------------------------------//

	   //  $nilai=DB::Table('hgst107_maintenancekendaraandetail')
	   //  ->where('maintenance_id',$idkendaraan)
	   //  ->value('nilai');

	   //  $jumlah=DB::Table('hgst107_maintenancekendaraandetail')
	   //  ->where('maintenance_id',$idkendaraan)
	   //  ->value('jumlah');

	   //  $total = $nilai * $jumlah;

	   // DB::table('hgst107_maintenancekendaraandetail')->where('maintenance_id','=',$idkendaraan)->update(['total'=>$total]);

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
	       	    $idkendaraan=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id',$id)
	    ->value('id');

	    $maintenanceid=DB::Table('hgst107_maintenancekendaraandetail')
	    ->where('id',$id)
	    ->value('maintenance_id');

	    $EmpName=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', $id)
	    ->value('EmployeeName');

	     $Unit_id=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', $id)
	    ->value('Unit_id');

	    $date=DB::Table('hgst107_maintenancekendaraandetail')
	    ->where('id', $id)
	    ->value('tgl_permintaan');

	    $nopol=DB::Table('hgst106_maintenancekendaraan')
	    ->where('id', $id)
	    ->value('nopol');

	    DB::table('hgst107_maintenancekendaraandetail')->where('maintenance_id','=',$idkendaraan)->update(['EmployeeName'=>$EmpName,'Unit_id'=>$Unit_id,'nopol_id'=>$nopol]);

	    DB::table('hgst106_maintenancekendaraan')->where('id','=',$maintenanceid)->update(['tgl_permintaan'=>$date]);

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