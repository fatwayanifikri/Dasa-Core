<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;
	use PDF;
	use Excel;

	class AdminMonitoringTinggalKerjaController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "t205_meninggalkanpekerjaan";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

         $companyID=CRUDBooster::myCompanyID();
			$getUnitID = CRUDBooster::myUnitIDKeep();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$DeptID=DB::table('hrde200_employee')
			->where('id','=',$EmpID)
			->value('Departement_id');
			Carbon::now()->timezone('Asia/Jakarta');
	      $requestdate = Carbon::now();

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Employee","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Tgl Pengajuan","name"=>"tgl_pengajuan"];
			$this->col[] = ["label"=>"Keperluan","name"=>"keperluan"];
			$this->col[] = ["label"=>"Status","name"=>"IsApproved"];

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'Employee_id','type'=>'datamodal','datamodal_table'=>'hrde200_employee','datamodal_where'=>'Unit_id='.Crudbooster::myUnitID(),'validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'EmployeeName,NPK','datamodal_columns_alias'=>'EmployeeName,NPK','datamodal_select_to'=>'Unit_id:Unit_id,Jabatan_id:Jabatan_id,Departement_id:Departement_id','datamodal_size'=>'large','required'=>true];

			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select','width'=>'col-sm-10','datatable'=>'cms_privileges,name','value' =>$getJabatan, 'readonly'=>true];

			$this->form[] = ['label' => 'Unit','name'=>'Unit_id','type'=> 'select','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value' =>$getUnitID, 'readonly'=>true];

			$this->form[] = ['label' => 'Departement','name'=>'Departement_id','type'=> 'select','width'=>'col-sm-2','datatable'=>'hrdm102_departement,DepartementName','value' =>$DeptID, 'readonly'=>true];

			$this->form[] = ['label'=>'Tanggal Pengajuan','name'=>'tgl_pengajuan','type'=>'hidden','width'=>'col-sm-10','value'=>$requestdate];

			$this->form[] = ['label'=>'Tanggal Mulai','name'=>'StartDate','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Tanggal Akhir','name'=>'EndDate','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Keperluan','name'=>'keperluan','validation'=>'required|min:1|max:255','width'=>'col-sm-10','type'=>'select',"dataenum" => ["Sakit","Keperluan Keluarga","Lain-Lain"]];

			$this->form[] = ['label'=>'IsApproved','name'=>'isApproved','type'=>'hidden','value' => 1];
			$this->form[] = ['label'=>'Keterangan (Lain-lain Wajib isi)','name'=>'keterangan','type'=>'textarea','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Departement Id","name"=>"Departement_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Departement,id"];
			//$this->form[] = ["label"=>"Tgl Pengajuan","name"=>"tgl_pengajuan","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
			//$this->form[] = ["label"=>"Jam Pelaksanaan","name"=>"jam_pelaksanaan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Keperluan","name"=>"keperluan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"isApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Keterangan","name"=>"keterangan","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
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


//----------------------INDEX------------------------
public function getIndex() {

if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t205_meninggalkanpekerjaan::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('tgl_pengajuan', [request('from'), request('until')]);
})

->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('StartDate', [request('from2'), request('until2')]);
})
->orderBy('tgl_pengajuan','desc')
->paginate(10)
->appends(request()->query());
}
else{

$query = \App\Models\t205_meninggalkanpekerjaan::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('tgl_pengajuan', [request('from'), request('until')]);
})
->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('StartDate', [request('from2'), request('until2')]);
})
->where('Unit_id','=',$getUnitID)
->orderBy('tgl_pengajuan','desc')
->paginate(10)
->appends(request()->query());
}

$query2 = DB::table('hrdm101_unit')
->get();

$query3 = DB::table('cms_privileges')
   ->where('id','=',$getJabatan)
   ->get();

$data = [];
$data['hgst103_kendaraan'] = 'Products Data';
$data['result'] = $query;
$data['value'] = $query2;
$data['jabatan'] = $query3;

$this->cbView('viewindex/custom_tinggal_kerja',$data);
}

//------------------------------PDF-----------------------
public function print_tinggalkerjaALL(){

$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t205_meninggalkanpekerjaan::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('tgl_pengajuan', [request('from'), request('until')]);
})
->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('StartDate', [request('from2'), request('until2')]);
})
->orderBy('tgl_pengajuan','desc')
->get();
}
else{

$query = \App\Models\t205_meninggalkanpekerjaan::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('tgl_pengajuan', [request('from'), request('until')]);
})
->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('StartDate', [request('from2'), request('until2')]);
})
->where('Unit_id','=',$getUnitID)
->orderBy('tgl_pengajuan','desc')
->get();
}
 
$generatePDF = PDF::loadView('exports.PrintFormTinggalKerjaALLpdf',array('query'=>$query))->setPaper('a4','landscape');
return $generatePDF->stream();		

}

//-------------------------EXCEL------------------------


public function downloadExcelTinggalKerja($type)
{

$EmployeeID=Crudbooster::myId();
$EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
$getUnitID=CRUDBooster::myUnitIDKeep();
$getJabatan=CRUDBooster::myPrivilegeId();

if($getJabatan == 1 || $getJabatan == 62 || $getJabatan == 63 || $getJabatan == 64 || $getJabatan == 65 || $getJabatan == 66){

$query = \App\Models\t205_meninggalkanpekerjaan::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('tgl_pengajuan', [request('from'), request('until')]);
})
->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('StartDate', [request('from2'), request('until2')]);
})
->orderBy('tgl_pengajuan','desc')
->get();
}
else{

$query = \App\Models\t205_meninggalkanpekerjaan::when(request('EmployeeName','Unit_id'), function($query){
$query->whereHas('employee', function($nested){
$nested->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');    
});
$query->whereHas('unit', function($nested){
$nested->where('Unit_id', 'LIKE', '%'. request('Unit_id') .'%');    
});
})
->when(request('from') && request('until'), function($q){ 
$q->whereBetween('tgl_pengajuan', [request('from'), request('until')]);
})
->when(request('from2') && request('until2'), function($q){ 
$q->whereBetween('StartDate', [request('from2'), request('until2')]);
})
->where('Unit_id','=',$getUnitID)
->orderBy('tgl_pengajuan','desc')
->get();
}

return Excel::create('Data_Meninggalkan_Pekerjaan', function($excel) use ($query) {
$excel->sheet('mySheet', function($sheet) use ($query){
$sheet->loadView('exports.PrintFormTinggalKerjaALLexcel', array('data' => $query));
});
})->download($type);
return back();
}

//---------------------MENU DELETE-----------------------

public function delete_form2($id)
{

DB::table('t205_meninggalkanpekerjaan')
		 ->where('id','=',$id)
         ->delete();
CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data Berhasil Dihapus!","success");
 
}


	}