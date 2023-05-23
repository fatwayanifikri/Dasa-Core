<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Models\PrintGS;
	use PDF;
	use Excel;


	class AdminFacilityControlCustomController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
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
			$this->table = "hgst100_reqmaintenance";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

		  $id=DB::Table('hgst100_reqmaintenance')
	      ->where('id', \DB::raw("(select max(`id`) from hgst100_reqmaintenance)"))
	  	  ->value('id');
	  	  $ResultID = $id + 1;
	  	  

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Tgl Request","name"=>"tgl_request"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] =['label'=>'id','name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ['label'=>'Tgl Request','name'=>'tgl_request','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrdm101_unit,UnitName',"readonly"=>'true'];

		   $columns = [];
			$columns[] = ['label'=>'Request Id','name'=>'requestmaintenance_id','type'=>'hidden','value'=>$ResultID];
			$columns[] = ['label'=>'Defect','name'=>'defect','type'=>'text'];

			$columns[] = ['label'=>'Kategori','name'=>'kategori','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hgst102_reqmaintenancekategori,kategoriname'];
			
			$columns[] = ['label'=>'Lokasi','name'=>'lokasi','type'=>'text'];
			$columns[] = ['label'=>'Kategori Area','name'=>'kategori_area','type'=>'select',"dataenum" => ["Common Area"]];
			$columns[] = ['label'=>'Action Plan','name'=>'actionplan','type'=>'select',"dataenum" => ["Perbaikan
            ","Pengecekan","Penggantian","Pemindahan","Installasi","Uninstall"]];
			$columns[] = ['label'=>'Reasoning','name'=>'reasoning','type'=>'textarea'];
			$columns[] = ['label'=>'Work Status','name'=>'work_status','type'=>'hidden','value'=>'On Progress'];
			$columns[] = ['label'=>'Remarks','name'=>'remarks','type'=>'textarea'];
		
			$this ->form[] = ['label'=>'Request Maintenance','name'=>'hgst101_reqmaintenancedetail','type'=>'child','columns'=>$columns,'table'=>'hgst101_reqmaintenancedetail','foreign_key'=>'requestmaintenance_id'];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Tgl Request","name"=>"tgl_request","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"unit,id"];
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
	       $this->addaction[] = ['label'=>'Lengkapi Data','name'=>'setuju_sm','url'=>('Facility_Control/edit').'/[id]','icon'=>'fa fa-check','color'=>'success'];


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
	      
	        // $this->index_button[] = ['label'=>'Print xlsx','url'=>('downloadExcelGS/xlsx?from={{ request('UnitName') }}'),'icon'=>'fa fa-file-excel-o','color'=>'info'];
         //   $this->index_button[] = ['label'=>'Print pdf','url'=>('PrintGS'),'icon'=>'fa fa-file-pdf-o','color'=>'danger'];


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
	 //        $id=DB::Table('hgst100_reqmaintenance')
	 //      ->where('id', \DB::raw("(select max(`id`) from hgst100_reqmaintenance)"))
	 // 	  ->value('id');
	 
	 // $reqid = DB::table('hgst101_reqmaintenancedetail')->orderBy('id','desc')->first();

	 //   DB::table('hgst101_reqmaintenancedetail')->where->where('id','=',$reqid)->update(['requestmaintenance_id'=>$id]);
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
	      

	    }

/* --------------------------------Costum------------------------------------ */
public function getIndex() {

 if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
   
   $query = \App\Models\hgst101_reqmaintenancedetail::when(request('Unit_id'), function($query){
   $query->whereHas('reqid', function($nested){
   $nested->where('Unit_id', request('Unit_id'));
   	});
   })
    ->when(request('from') && request('until'), function($q){ 
    $q->whereBetween('created_at', [request('from'), request('until')]);
   })
   ->orderBy('id','desc')
   ->paginate(10000)
->appends(request()->query());

  $query2 = DB::table('hrdm101_unit')
  ->get();

   $data = [];
   $data['hgst100_reqmaintenance'] = 'Products Data';
   $data['result'] = $query;
   $data['value'] = $query2;

   $this->cbView('viewindex/custom_facilitycontrol',$data);

}
//-----------------------------------------------------------------------//

	public function PrintGS()
		{
		
	$dataprintgs = \App\Models\hgst101_reqmaintenancedetail::when(request('Unit_id'), function($dataprintgs){
   $dataprintgs->whereHas('reqid', function($nested){
   $nested->where('Unit_id', request('Unit_id'));
   	});
   })
    ->when(request('from') && request('until'), function($q){ 
    $q->whereBetween('created_at', [request('from'), request('until')]);
   })
   ->orderBy('id','desc')
    ->get();
 
			$generatePDF = PDF::loadView('exports.PrintGSpdf',array('dataprintgs'=>$dataprintgs))->setPaper('a4','potrait');
			return $generatePDF->stream();		

}

	    /* --------------------------------EXPORT------------------------------------ */

	    public function importExportGS()
	{
		return view('Facility_Control');

	}
	public function downloadExcelGS($type)
	{

   $query = \App\Models\hgst101_reqmaintenancedetail::when(request('Unit_id'), function($query){
   $query->whereHas('reqid', function($nested){
   $nested->where('Unit_id', request('Unit_id'));
   	});
   })
    ->when(request('from') && request('until'), function($q){ 
    $q->whereBetween('created_at', [request('from'), request('until')]);
   })
   ->orderBy('id','desc')
    ->get();

		return Excel::create('Facility_Control', function($excel) use ($query) {
			$excel->sheet('mySheet', function($sheet) use ($query)
	        {
				$sheet->loadView('exports.PrintGSexcel', array('data' => $query));
	        });
		})->download($type);
		return back();
	}

	}