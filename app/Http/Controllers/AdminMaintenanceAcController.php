<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PDF;
	use Carbon\Carbon;


	class AdminMaintenanceAcController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_ac";
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
			$this->table = "hgst108_maintenance_ac";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Asset ID","name"=>"asset_id","join"=>"loga001_asset,kode"];
			$this->col[] = ["label"=>"Nama AC","name"=>"nama_ac"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Kode MB","name"=>"kode_mb"];
			$this->col[] = ["label"=>"Tipe","name"=>"tipe"];
			$this->col[] = ["label"=>"Periode","name"=>"periode"];
			# END COLUMNS DO NOT REMOVE THIS LINE


		  $id=DB::Table('hgst108_maintenance_ac')
	      ->where('id', \DB::raw("(select max(`id`) from hgst108_maintenance_ac)"))
	  	  ->value('id');
	  	  $ResultID = $id + 1;

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Id','name'=>'id','type'=>'hidden','value'=>$ResultID];
			// $this->form[] = ['label'=>'Asset Id','name'=>'asset_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-7','datatable'=>'loga001_asset,kode'];
			$this->form[] = ['label'=>'Asset ID','name'=>'asset_id','type'=>'datamodal','datamodal_table'=>'loga001_asset','datamodal_where'=>'','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'kode,nama','datamodal_columns_alias'=>'Kode Asset,Nama Asset','datamodal_select_to'=>'nama:nama_ac,Unit_id:Unit_id','datamodal_size'=>'large'];

			$this->form[] = ['label'=>'Nama AC','name'=>'nama_ac','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7','readonly'=>'true'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-7','datatable'=>'hrdm101_unit,UnitName','readonly'=>'true'];

			$this->form[] = ['label'=>'Kode MB','name'=>'kode_mb','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Tipe','name'=>'tipe','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Lokasi','name'=>'lokasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Lantai','name'=>'lantai','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Periode Service','name'=>'periode','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Jadwal Pertama','name'=>'jadwal_pertama','type'=>'datetime','width'=>'col-sm-7'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Asset Id","name"=>"asset_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"asset,id"];
			//$this->form[] = ["label"=>"Nama Ac","name"=>"nama_ac","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Kode Mb","name"=>"kode_mb","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tipe","name"=>"tipe","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Lokasi","name"=>"lokasi","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Lantai","name"=>"lantai","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Periode","name"=>"periode","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
	        $this->addaction[] = ['label'=>'Edit Detail','url'=>('maintenance_ac_detail?filter_column%5Bhgst109_maintenance_ac_detail.maintenance_ac_id%5D%5Btype%5D=%3D&filter_column%5Bhgst109_maintenance_ac_detail.maintenance_ac_id%5D%5Bvalue%5D=').'[id]','color'=>'success'];

	        // $this->addaction[]= ['icon'=>'fa fa-print','label'=>'Print','url'=>('printACdetailpdf/').'[id]','color'=>'info'];


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
	        $this->index_button[]= ['icon'=>'fa fa-download','label'=>'Export','url'=>('maintenance_ac_export'),'color'=>'primary'];



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

	      $id_maintenance=DB::Table('hgst108_maintenance_ac')
	      ->where('id', \DB::raw("(select max(`id`) from hgst108_maintenance_ac)"))
	  	  ->value('id');

	  	  $periode=DB::Table('hgst108_maintenance_ac')
	      ->where('id', \DB::raw("(select max(`id`) from hgst108_maintenance_ac)"))
	  	  ->value('periode');

	  	  $unit=DB::Table('hgst108_maintenance_ac')
	      ->where('id', \DB::raw("(select max(`id`) from hgst108_maintenance_ac)"))
	  	  ->value('Unit_id');

	  	  $jadwal_pertama=DB::Table('hgst108_maintenance_ac')
	      ->where('id', \DB::raw("(select max(`id`) from hgst108_maintenance_ac)"))
	  	  ->value('jadwal_pertama');
         
        $date = $jadwal_pertama;
        $default_date_realisasi = "2021-02-21"; 
        
        for($x = 1; $x <= 12; $x++) {

        //hitung selisih bulan (periode)
        $selisih_bulan = ($x * $periode)-$periode;

        //convert tgl_pertama ke string, lalu bulannya dijumlah selisih_bulan
        $repeat = strtotime("+" .$selisih_bulan. "month",strtotime($date));

	  	DB::table('hgst109_maintenance_ac_detail')->insert([ 
		'maintenance_ac_id' => $id_maintenance,
		'Unit_id' => $unit,
		'jadwal_ke' =>  $x,
		'tgl_maintenance' => $today = date('Y-m-d',$repeat)//convert ke date format
		
	     ]);

        }

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


public function editAC($id)
{

	$edit_master = DB::table('hgst108_maintenance_ac')->where('id',$id)->get();
	// $edit_detail = DB::table('hgst109_maintenance_ac_detail')->where('maintenance_ac_id',$id)->get();

	redirect('admin/maintenance_ac_detail/'.$id)->send();
 
}

public function update_parent(Request $request)
{
	// update data pegawai
	DB::table('hgst108_maintenance_ac')->where('id',$request->id)->update([
		'nama_ac' => $request->nama_ac,
		'Unit_id' => $request->Unit_id,
		'kode_mb' => $request->kode_mb,
		'tipe' => $request->tipe,
		'lokasi' => $request->lokasi,
		'lantai' => $request->lantai,
		'periode' => $request->periode
	]);
	// alihkan halaman ke halaman pegawai
	return redirect('admin/maintenance_ac_detail');
}

// public function printACdetailpdf($id)
// 		{

// $query = \App\Models\hgst109_maintenance_ac_detail::when(request('maintenance'), function($query){
// $query->whereHas('maintenance', function($nested){
// $nested->where('id', request('id'));});
// })

// ->where('maintenance_ac_id','=',$id)
// ->orderby('id','desc')
// ->get();

// $generatePDF = PDF::loadView('exports.PrintMaintenanceACpdf',array('query'=>$query))->setPaper('a4','landscape');
// return $generatePDF->stream();	

// }

	}