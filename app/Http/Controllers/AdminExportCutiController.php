<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PDF;
	use Excel;

	class AdminExportCutiController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "t201_formcuti";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Employee Id","name"=>"Employee_id","join"=>"Employee,id"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"Jabatan,id"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"Unit,id"];
			$this->col[] = ["label"=>"Jeniscuti Id","name"=>"Jeniscuti_id","join"=>"Jeniscuti,id"];
			$this->col[] = ["label"=>"Tahuncuti","name"=>"Tahuncuti"];
			$this->col[] = ["label"=>"Tujuan","name"=>"Tujuan"];
			$this->col[] = ["label"=>"Sisacuti","name"=>"Sisacuti"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Employee,id'];
			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jabatan,id'];
			$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Unit,id'];
			$this->form[] = ['label'=>'Jeniscuti Id','name'=>'Jeniscuti_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jeniscuti,id'];
			$this->form[] = ['label'=>'Tahuncuti','name'=>'Tahuncuti','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tujuan','name'=>'Tujuan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Sisacuti','name'=>'Sisacuti','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Lama','name'=>'Lama','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Pelaksanaan','name'=>'Pelaksanaan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsApprove','name'=>'isApprove','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Reject Note','name'=>'reject_note','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Jeniscuti Id","name"=>"Jeniscuti_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jeniscuti,id"];
			//$this->form[] = ["label"=>"Tahuncuti","name"=>"Tahuncuti","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tujuan","name"=>"Tujuan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Sisacuti","name"=>"Sisacuti","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Lama","name"=>"Lama","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Pelaksanaan","name"=>"Pelaksanaan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsApprove","name"=>"isApprove","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Reject Note","name"=>"reject_note","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
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


//-----------------INDEX----------------------//

public function getIndex() {
  //First, Add an auth
   if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

   $EmployeeID=Crudbooster::myId();
   $EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
   $getUnitID=CRUDBooster::myUnitIDKeep();
   $getJabatan=CRUDBooster::myPrivilegeId();

 if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

   $query = \App\Models\t201_formcuti::when(request('Unit_id'), function($query){
   $query->whereHas('unit', function($nested){
   $nested->where('Unit_id', request('Unit_id'));
   	}); })
   ->when(request('from') && request('until'), function($q){ 
   $q->whereBetween('created_at', [request('from'), request('until')]);})

   ->when(request('from2') && request('until2'), function($q){ 
   $q->whereBetween('tgl_mulai', [request('from2'), request('until2')]);})

   ->when(request('Employee_id'), function($query){
   $query->where('Employee_id', request('Employee_id'));})

   ->when(request('isApprove'), function($query){
   $query->where('isApprove', request('isApprove'));})

   // ->where('t201_formcuti.Unit_id',$getUnitID)
   ->orderby('id','desc')
   ->paginate()
->appends(request()->query());
}

else{

   $query = \App\Models\t201_formcuti::when(request('Unit_id'), function($query){
   $query->whereHas('unit', function($nested){
   $nested->where('Unit_id', request('Unit_id'));
   	}); })

   ->when(request('from') && request('until'), function($q){ 
   $q->whereBetween('created_at', [request('from'), request('until')]);})
   
   ->when(request('from2') && request('until2'), function($q){ 
   $q->whereBetween('tgl_mulai', [request('from2'), request('until2')]);})

   ->when(request('Employee_id'), function($query){
   $query->where('Employee_id', request('Employee_id'));})

   ->when(request('isApprove'), function($query){
   $query->where('isApprove', request('isApprove'));})

   ->where('t201_formcuti.Unit_id',$getUnitID)
   ->orderby('id','desc')
   ->paginate()
->appends(request()->query());
}

   $query2 = DB::table('hrdm101_unit')
   ->get();

  $query3 = DB::table('cms_privileges')
   ->where('id','=',$getJabatan)
   ->get();

   //untuk menampilkan data di view
   $data = [];
   $data['cuti'] = 'Products Data';
   $data['result'] = $query;
   $data['value'] = $query2;
   $data['jabatan'] = $query3;

   //Create a view. Please use `cbView` method instead of view method from laravel.
   $this->cbView('viewindex/custom_cuti_export',$data);
}

//-------------------------------END INDEX------------------------//


//----------------------------EXPORT PDF--------------------------//

public function printcutipdf()
		{

$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t201_formcuti::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));
}); })
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('created_at', [request('from'), request('until')]);})

->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('tgl_mulai', [request('from2'), request('until2')]);})

->when(request('Employee_id'), function($query){
$query->where('Employee_id', request('Employee_id'));})

->when(request('isApprove'), function($query){
   $query->where('isApprove', request('isApprove'));})

->orderby('id','desc')
->get();

 }

else{

$query = \App\Models\t201_formcuti::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));
}); })

->when(request('from') && request('until'), function($q){ 
$q->whereBetween('created_at', [request('from'), request('until')]);})

->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('tgl_mulai', [request('from2'), request('until2')]);})

->when(request('Employee_id'), function($query){
$query->where('Employee_id', request('Employee_id'));})

->when(request('isApprove'), function($query){
$query->where('isApprove', request('isApprove'));})

->where('t201_formcuti.Unit_id',$getUnitID)
->orderby('id','desc')
->get();

 }

$generatePDF = PDF::loadView('exports.PrintCutipdf',array('query'=>$query))->setPaper('a4','landscape');
return $generatePDF->stream();		

}

/* ------------------------------EXPORT EXCL---------------------------------- */

public function importExportCuti()
{
return view('export_cuti');
}
public function downloadExcelCuti($type)
{

$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t201_formcuti::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));
}); })

->when(request('from') && request('until'), function($q){ 
$q->whereBetween('created_at', [request('from'), request('until')]);})

->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('tgl_mulai', [request('from2'), request('until2')]);})

->when(request('Employee_id'), function($query){
$query->where('Employee_id', request('Employee_id'));})

->when(request('isApprove'), function($query){
   $query->where('isApprove', request('isApprove'));})

->orderby('id','desc')
->get();

}

else{

$query = \App\Models\t201_formcuti::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));
}); })

->when(request('from') && request('until'), function($q){ 
$q->whereBetween('created_at', [request('from'), request('until')]);})

->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('tgl_mulai', [request('from2'), request('until2')]);})

->when(request('Employee_id'), function($query){
$query->where('Employee_id', request('Employee_id'));})

->when(request('isApprove'), function($query){
   $query->where('isApprove', request('isApprove'));})
   
->where('t201_formcuti.Unit_id',$getUnitID)
->orderby('id','desc')
->get();

}

return Excel::create('Data_Cuti', function($excel) use ($query) {
$excel->sheet('mySheet', function($sheet) use ($query)
{
$sheet->loadView('exports.PrintCutiexcel', array('data' => $query));
});
})->download($type);
return back();
}

	}