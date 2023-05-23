<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminEmployeeDetailController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "hrde200_employee";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Pelamar Id","name"=>"Pelamar_id","join"=>"Pelamar,id"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"Jabatan,id"];
			$this->col[] = ["label"=>"Level Id","name"=>"Level_id","join"=>"Level,id"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"Unit,id"];
			$this->col[] = ["label"=>"Company Id","name"=>"Company_id","join"=>"Company,id"];
			$this->col[] = ["label"=>"Departement Id","name"=>"Departement_id","join"=>"Departement,id"];
			$this->col[] = ["label"=>"NPK","name"=>"NPK"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Pelamar Id','name'=>'Pelamar_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Pelamar,id'];
			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jabatan,id'];
			$this->form[] = ['label'=>'Level Id','name'=>'Level_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Level,id'];
			$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Unit,id'];
			$this->form[] = ['label'=>'Company Id','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Company,id'];
			$this->form[] = ['label'=>'Departement Id','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Departement,id'];
			$this->form[] = ['label'=>'NPK','name'=>'NPK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'EmployeeName','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TempatLahir','name'=>'TempatLahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TanggalLahir','name'=>'TanggalLahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'JenisKelamin','name'=>'JenisKelamin','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'StatusNikah Id','name'=>'StatusNikah_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'StatusNikah,id'];
			$this->form[] = ['label'=>'HiredDate','name'=>'HiredDate','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'AlamatRumah','name'=>'AlamatRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TelpRumah','name'=>'TelpRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TelpHp','name'=>'TelpHp','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Pelamar Id","name"=>"Pelamar_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Pelamar,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Level Id","name"=>"Level_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Level,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"Departement Id","name"=>"Departement_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Departement,id"];
			//$this->form[] = ["label"=>"NPK","name"=>"NPK","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"EmployeeName","name"=>"EmployeeName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TempatLahir","name"=>"TempatLahir","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalLahir","name"=>"TanggalLahir","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"JenisKelamin","name"=>"JenisKelamin","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"StatusNikah Id","name"=>"StatusNikah_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"StatusNikah,id"];
			//$this->form[] = ["label"=>"HiredDate","name"=>"HiredDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"AlamatRumah","name"=>"AlamatRumah","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TelpRumah","name"=>"TelpRumah","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TelpHp","name"=>"TelpHp","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Keterangan","name"=>"Keterangan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
	       $this->index_button [] = ['label'=>'Back Employee','url'=>CRUDBooster::mainpath("../employee"),'icon'=>'fa fa-angle-double-left' ,'color' => 'success' ];



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



/*-------------------------------FUNGSI UNTUK MEMBUAT COSTUM VIEW--------------------*/

public function getIndex() {
  //First, Add an auth
   if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
   
   $query = \App\Models\hrde200_employee::when(request('UnitName'), function($query){
   	/*query untuk search field berelasi*/
   	$query->whereHas('unit', function($nested){
   		$nested->where('UnitName', request('UnitName'));/*query untuk search field berelasi*/
   	});
   })
   /*query untuk search field nonrelasi*/
   ->when(request('EmployeeName'), function($query){
   		$query->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');/*query untuk search field nonrelasi*/
   })
   ->when(request('NPK'), function($query){
   		$query->where('NPK', 'LIKE', '%'. request('NPK') .'%');/*query untuk search field nonrelasi*/
   })
 	
   // ->join('hrdm101_unit', 'hrdm101_unit.id', '=', 'hrde200_employee.Unit_id')
   // ->join('hrdm100_company', 'hrdm100_company.id', '=', 'hrde200_employee.Company_id')
   // ->join('hrdm102_departement', 'hrdm102_departement.id', '=', 'hrde200_employee.Departement_id')
   // ->join('cms_privileges', 'cms_privileges.id', '=', 'hrde200_employee.Jabatan_id')
   // ->select('hrde200_employee.NPK', 'hrde200_employee.EmployeeName', 'hrde200_employee.unit.UnitName')
   // ->orderby('id','desc')
   ->paginate(10000);

//--------------------------------QUERY TABLE hrdm101_unit UNTUK SELECT OPTION------------------------------
$query2 = DB::table('hrdm101_unit')
->get();
$query3 = DB::table('hrde200_employee')
->get();

   //Create your own query 
   $data = [];
   $data['hrde200_employee'] = 'Products Data';
   $data['result'] = $query;
   $data['value'] = $query2;
   $data['bring'] = $query3;
  
   
    
   //Create a view. Please use `cbView` method instead of view method from laravel.
   $this->cbView('employee_detail',$data);
}

/*-------------------------------END COSTUM VIEW--------------------*/

//--------------------------------EDIT DATA--------------------//
public function edituser($id)
{
	// mengambil data ticket berdasarkan id yang dipilih
	$user = \App\Models\hrde200_employee::when(request('UnitName'), function($user){
   })
	->where('id',$id)
    ->get();

	return view('costum_form_edit_user',['user' => $user]);
}

public function getEdit($id) {
  //Create an Auth
  if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
    CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
  }
  
  $data = [];
  $data['page_title'] = 'Edit Data';
  $data['user'] = DB::table('hrde200_employee')->where('id',$id)->first();
  
  //Please use cbView method instead view method from laravel
  $this->cbView('employee_detail',$data);
}


/*-------------------------------EXPORT DATA--------------------*/
public function importExport2()
	{
		return view('costum_employee');
	}
	public function downloadExcel2($type)
	{

		$query = \App\Models\hrde200_employee::when(request('UnitName'), function($query){
		   	$query->whereHas('unit', function($nested){
		   		$nested->where('UnitName', request('UnitName'));/*query untuk export search field berelasi*/
		   	});
		   })
		   ->when(request('EmployeeName'), function($query){
		   		$query->where('EmployeeName', 'LIKE', '%'. request('EmployeeName') .'%');/*query untuk export search field nonrelasi*/
		   })
		   ->when(request('NPK'), function($query){
   		$query->where('NPK', 'LIKE', '%'. request('NPK') .'%');/*query untuk search field nonrelasi*/
   })
		   ->get();

		return Excel::create('data_karyawan', function($excel) use ($query) {
			$excel->sheet('mySheet', function($sheet) use ($query)
	        {
				$sheet->loadView('exports.employee', array('data' => $query));
	        });
		})->download($type);
	}



	public function importExcel2()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = ['title' => $value->title, 'description' => $value->description];
				}
				if(!empty($insert)){
					DB::table('hrde200_employee')->insert($insert);
					dd('Insert Record successfully.');
				}
			}
		}
		return back();
	}

/*-------------------------------END EXPORT DATA--------------------*/

	


	}