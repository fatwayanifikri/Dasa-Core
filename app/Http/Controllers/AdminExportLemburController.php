<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PHPExcel_IOFactory;
use App\Exportlembur;
use Excel;
use PDF;


	class AdminExportLemburController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,asc";
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
			$this->table = "t112_absenlembur";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Departement Id","name"=>"Departement_id","join"=>"hrdm102_departement,id"];
			$this->col[] = ["label"=>"Employee Id","name"=>"Employee_id","join"=>"hrde200_employee,id"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"hrdm101_unit,id"];
			$this->col[] = ["label"=>"Company Id","name"=>"Company_id","join"=>"hrdm100_company,id"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"cms_privileges,id"];
			$this->col[] = ["label"=>"EmployeeName","name"=>"Employee_id","join"=>"t112_absenlembur,id"];
			$this->col[] = ["label"=>"StartTime","name"=>"StartTime"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Departement Id','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm102_departement,id'];
			$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,id'];
			$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,id'];
			$this->form[] = ['label'=>'Company Id','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm100_company,id'];
			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,id'];
			$this->form[] = ['label'=>'EmployeeName','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Employee_id,EmployeeName'];
			$this->form[] = ['label'=>'StartTime','name'=>'StartTime','type'=>'date','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'EndTime','name'=>'EndTime','type'=>'date','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'AmountMinute','name'=>'AmountMinute','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NomerVoucher','name'=>'NomerVoucher','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'JumlahVoucher','name'=>'JumlahVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NilaiVoucher','name'=>'NilaiVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Note','name'=>'Note','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsApproved','name'=>'isApproved','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Departement Id','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm102_departement,id'];
			//$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,id'];
			//$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,id'];
			//$this->form[] = ['label'=>'Company Id','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm100_company,id'];
			//$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,id'];
			//$this->form[] = ['label'=>'EmployeeName','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName'];
			//$this->form[] = ['label'=>'StartTime','name'=>'StartTime','type'=>'date','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'EndTime','name'=>'EndTime','type'=>'date','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'AmountMinute','name'=>'AmountMinute','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'NomerVoucher','name'=>'NomerVoucher','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'JumlahVoucher','name'=>'JumlahVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'NilaiVoucher','name'=>'NilaiVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Note','name'=>'Note','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'IsApproved','name'=>'isApproved','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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


	    //By the way, you can still create your own method in here... :) 

/*-----------------FUNGSI UNTUK MEMBUAT COSTUM FORM INPUT----------------------*/

/*public function getAdd() {
   $data=[];
  $data['absenlembur'] = "Add new Post";
 $data['result'] = DB::table('t112_absenlembur')->get();
  $this->cbView('costum_add_new',$data);
  }


/*-------------------------------END COSTUM FORM--------------------*/

/*-------------------------------FUNGSI UNTUK MEMBUAT COSTUM VIEW--------------------*/

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

$query = \App\Models\t112_absenlembur::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('StartTime', [request('from'), request('until')]);
})

->where('isApproved','=','1')
->orderby('id','desc')
->paginate()
->appends(request()->query());

}

else{

$query = \App\Models\t112_absenlembur::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('StartTime', [request('from'), request('until')]);
})
->when(request('isVoucher'), function($query){
$query->where('isVoucher', 'LIKE', '%'. request('isVoucher') .'%');
})
->when(request('employee'), function($query){
$query->where('Employee_id', 'LIKE', '%'. request('Employee_id') .'%');/*query untuk search field nonrelasi*/
})
->where('isApproved','=','1')
->where('t112_absenlembur.Unit_id',$getUnitID)
->orderby('id','desc')
->paginate()
->appends(request()->query());
}

$query2 = DB::table('hrdm101_unit')
->get();

$query3 = DB::table('cms_privileges')
   ->where('id','=',$getJabatan)
   ->get();

// $count = $query->count();

//untuk menampilkan data di view
$data = [];
$data['absenlembur'] = 'Products Data';
$data['result'] = $query;
$data['value'] = $query2;
$data['jabatan'] = $query3;
// $data['count'] = $count;


$this->cbView('viewindex/custom_lembur_export',$data);
}
/*-------------------------------EXPORT EXCEL-------------------------*/

public function importExportLembur()
{
return view('custom_lembur_export');
}
public function downloadExcelLembur($type)
{
	
$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t112_absenlembur::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('StartTime', [request('from'), request('until')]);
})

->where('isApproved','=','1')
->orderby('id','desc')
->get();

}

else{

$query = \App\Models\t112_absenlembur::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('StartTime', [request('from'), request('until')]);
})
->when(request('isVoucher'), function($query){
$query->where('isVoucher', 'LIKE', '%'. request('isVoucher') .'%');
})
->when(request('employee'), function($query){
$query->where('Employee_id', 'LIKE', '%'. request('Employee_id') .'%');/*query untuk search field nonrelasi*/
})
->where('isApproved','=','1')
->where('t112_absenlembur.Unit_id',$getUnitID)
->orderby('id','desc')
->get();
}
	
return Excel::create('Monitoring_Lembur', function($excel) use ($query) {
$excel->sheet('mySheet', function($sheet) use ($query)
	        {
$sheet->loadView('exports.PrintLemburexcel', array('data' => $query));
});
})
->download($type);
}

public function importExcellembur()
	{
if(Input::hasFile('import_file')){
$path = Input::file('import_file')->getRealPath();
$data = Excel::load($path, function($reader) {
})
->get();
if(!empty($data) && $data->count()){
foreach ($data as $key => $value) {
$insert[] = ['title' => $value->title, 'description' => $value->description];
}
if(!empty($insert)){
DB::table('t112_absenlembur')->insert($insert);
dd('Insert Record successfully.');
}
}
}
return back();
	}

//----------------------------EXPORT PDF--------------------------//

public function printlemburpdf()
		{

$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t112_absenlembur::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('StartTime', [request('from'), request('until')]);
})

->where('isApproved','=','1')
->orderby('id','desc')
->get();

}

else{

$query = \App\Models\t112_absenlembur::when(request('Unit_id'), function($query){
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', request('Unit_id'));});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('StartTime', [request('from'), request('until')]);
})
->when(request('isVoucher'), function($query){
$query->where('isVoucher', 'LIKE', '%'. request('isVoucher') .'%');
})
->when(request('employee'), function($query){
$query->where('Employee_id', 'LIKE', '%'. request('Employee_id') .'%');/*query untuk search field nonrelasi*/
})
->where('isApproved','=','1')
->where('t112_absenlembur.Unit_id',$getUnitID)
->orderby('id','desc')
->get();
}

$generatePDF = PDF::loadView('exports.PrintLemburpdf',array('query'=>$query))->setPaper('a4','landscape');
return $generatePDF->stream();		

}
	}