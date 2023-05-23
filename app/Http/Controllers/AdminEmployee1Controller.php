<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
use App\Exportkaryawan;
use Excel;
	class AdminEmployee1Controller extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->col[] = ["label"=>"NPK","name"=>"NPK"];
			$this->col[] = ["label"=>"Nama Karyawan","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Perusahaan","name"=>"Company_id","join"=>"hrdm100_company,CompanyName"];
			$this->col[] = ["label"=>"Departement","name"=>"Departement_id","join"=>"hrdm102_departement,DepartementName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			$ResultID = DB::select('select uuid_short() as id');
			$dtPelamar = $this->listDataTable();

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'hdfemployeeid','name'=>'id','type'=>'hidden','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Pilih Calon Karyawan','name'=>'Pelamar_id','type'=>'datamodal','width'=>'col-sm-10','datamodal_table'=>'hrde100_pelamar','datamodal_columns'=>'NamaPelamar,TempatLahir,TanggalLahir,Alamat','datamodal_size'=>'large','datamodal_where'=>'FinalApprove=1'];
			$this->form[] = ['label'=>'NPK','name'=>'NPK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			$this->form[] = ['label'=>'Level','name'=>'Level_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm103_level,LevelName'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Perusahaan','name'=>'Company_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm100_company,CompanyName'];
			$this->form[] = ['label'=>'Departemen','name'=>'Departement_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm102_departement,DepartementName'];
			$this->form[] = ['label'=>'Tempat Lahir','name'=>'TempatLahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Lahir','name'=>'TanggalLahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Kelamin','name'=>'JenisKelamin','type'=>'radio','width'=>'col-sm-10','dataenum'=>'1|Laki-laki;0|Perempuan'];
			$this->form[] = ['label'=>'Status Nikah','name'=>'StatusNikah_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm105_statusnikah,StatusNikah'];
			$this->form[] = ['label'=>'Hired Date','name'=>'HiredDate','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Alamat Rumah','name'=>'AlamatRumah','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Telp Rumah','name'=>'TelpRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Telp Handphone','name'=>'TelpHp','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Perjanjian Kerja Waktu Tentu','name'=>'hrde204_employeestatus','type'=>'child','width'=>'col-sm-10','table'=>'hrde204_employeestatus','foreign_key'=>'Employee_id'];
			$this->form[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//
			//$this->form[] = ['label'=>'hdfemployeeid','name'=>'id','type'=>'hidden','value'=>$ResultID[0]->id];
			////$this->form[] = ['label'=>'Cms Users','name'=>'cms_users_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			////dimatiin dulu
			//$this->form[] = ['label'=>'Pilih Calon Karyawan',
			//'name'=>'Pelamar_id',
			//'type'=>'datamodal',
			//'datamodal_table'=>'hrde100_pelamar',
			//'datamodal_where'=>'FinalApprove=1',
			//'datamodal_columns'=>'NamaPelamar,TempatLahir,TanggalLahir,Alamat',
			//'datamodal_select_to'=>'NamaPelamar:EmployeeName,TempatLahir:TempatLahir,TanggalLahir:TanggalLahir,JenisKelamin:JenisKelamin,StatusNikah_id:StatusNikah_id,Alamat:AlamatRumah,TelpRumah:TelpRumah,TelpHp:TelpHp',
			//'datamodal_columns_alias'=>'Nama, Tempat Lahir, Tanggal Lahir, Alamat',
			//'datamodal_size'=>'large'];
			////$this->form[] = [
			////	'label'=>'Pilih Calon Karyawan',
			////	'name'=>'Pelamar_id',
			////	'type'=>'datamodal',
			////	'datamodal_table'=>'v_hrde100_pelamar',
			////	'datamodal_columns'=>'NamaPelamar,TempatLahir,TanggalLahir,Alamat',
			////	'datamodal_columns_alias'=>'Nama, Tempat Lahir, Tanggal Lahir, Alamat',
			////	'datamodal_size'=>'large'
			////];
			//
			//$this->form[] = ['label'=>'NPK','name'=>'NPK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			//$this->form[] = ['label'=>'Level','name'=>'Level_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm103_Level,LevelName'];
			//$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm101_Unit,UnitName'];
			//$this->form[] = ['label'=>'Perusahaan','name'=>'Company_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm100_Company,CompanyName'];
			//$this->form[] = ['label'=>'Departemen','name'=>'Departement_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm102_departement,DepartementName'];
			//$this->form[] = ['label'=>'Tempat Lahir','name'=>'TempatLahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal Lahir','name'=>'TanggalLahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Jenis Kelamin','name'=>'JenisKelamin','type'=>'radio','dataenum'=>'1|Laki-laki;0|Perempuan'];
			//$this->form[] = ['label'=>'Status Nikah','name'=>'StatusNikah_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm105_statusnikah,StatusNikah'];
			//
			//$this->form[] = ['label'=>'Hired Date','name'=>'HiredDate','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Alamat Rumah','name'=>'AlamatRumah','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Telp Rumah','name'=>'TelpRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Telp Handphone','name'=>'TelpHp','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			////sementara dimatiin sampe dapet ide
			////$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			////$this->form[] = ['label'=>'Pilih Karyawan','name'=>'KaryawanID','type'=>'datamodal','datamodal_table'=>'hrde100_pelamar','datamodal_where'=>'','datamodal_columns'=>'NamaPelamar,TempatLahir','datamodal_columns_alias'=>'Nama Pelamar,Tempat Lahir','datamodal_select_to'=>'TempatLahir:TempatLahir,TanggalLahir:TanggalLahir,StatusNikah_id:StatusNikah_id'];
			////$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//
			////child1
			//$columns = [];
			//$columns[] = ['name'=>'Employee_id','visible'=>'false','value'=>$ResultID[0]->id];
			//$columns[] = ['label'=>'Tipe Identitas','name'=>'TipeIdentitas_id','type'=>'select','validation'=>'required|min:1|max:255','datatable'=>'hrdm106_tipeidentitas,NamaID'];
			//$columns[] = ['label'=>'No ID','name'=>'NoID','type'=>'text','required'=>true];
			//$columns[] = ['label'=>'Masa Berlaku','name'=>'MasaBerlaku','type'=>'text','required'=>true];
			//$columns[] = ['label'=>'Photo','name'=>'Photo','type'=>'upload','validation'=>'image|max:1000'];
			//$this ->form[] = ['label'=>'Identitas Diri','name'=>'hrde201_employeeidentity','type'=>'child','columns'=>$columns,'table'=>'hrde201_employeeidentity','foreign_key'=>'Employee_id'];
			//
			////child2
			//$columns2 = [];
			//$columns2[] = ['name'=>'Employee_id','visible'=>'false','value'=>$ResultID[0]->id];
			//$columns2[] = ['label'=>'Tingkat Pendidikan','name'=>'EducationLevel_id','type'=>'select','validation'=>'required|min:1|max:255','datatable'=>'hrdm107_educationlevel,EducationName'];
			//$columns2[] = ['label'=>'Tanggal Mulai','name'=>'Form','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d')];
			//$columns2[] = ['label'=>'Tanggal Selesai','name'=>'To','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d')];
			//$columns2[] = ['label'=>'Nilai Akhir','name'=>'NilaiAkhir','type'=>'number','required'=>true];
			//$this ->form[] = ['label'=>'Pendidikan','name'=>'hrde202_employeeeducation','type'=>'child','columns'=>$columns2,'table'=>'hrde202_employeeeducation','foreign_key'=>'Employee_id'];
			//
			////child3
			//$colomns3 = [];
			//$columns3[] = ['name'=>'Employee_id','visible'=>'false','value'=>$ResultID[0]->id];
			//$columns3[] = ['label'=>'Status Karyawan','name'=>'EmployeeStatus_id','type'=>'select','validation'=>'required|min:1|max:255','datatable'=>'hrdm108_employeestatus,StatusName'];
			//$columns3[] = ['label'=>'Tanggal Awal Masuk','name'=>'Start','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d')];
			//$columns3[] = ['label'=>'Tanggal Selesai','name'=>'End','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d')];
			//$this->form[] = ['label'=>'Perjanjian Kerja Waktu Tentu','name'=>'hrde204_employeestatus','type'=>'child','columns'=>$columns3,'table'=>'hrde204_employeestatus','foreign_key'=>'Employee_id'];
			//
			//$this->form[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			////$this->index_button[] = ["label"=>"Print Report","icon"=>"fa fa-print","url"=>CRUDBooster::mainpath('welcome')];
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
	        $this->index_button [] = ['label'=>'Employee Detail','url'=>CRUDBooster::mainpath("../hrde200_employee"),'icon'=>'fa fa-eye' ,'color' => 'success' ];



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
		public function listDataTable() {
			// $dataPelamar = DB::table('hrde100_pelamar as pel')
			// ->select([
			// 			'pel.id',
			// 			'pel.NamaPelamar',
			// 			'pel.TempatLahir',
			// 			'pel.TanggalLahir',
			// 			'pel.Alamat',
			// 			'pel.Email'


			// ])
			// ->get();

		
			// return $dataPelamar;

			// $datamodal_field = explode(',', $form['datamodal_columns'])[0];
			// $datamodal_value = DB::table($form['datamodal_table'])->where('id', $value)->first()->$datamodal_field;
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
   ->orderby('id','desc')
   ->paginate()
->appends(request()->query());

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
   $this->cbView('viewindex/costum_employee',$data);
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
  $this->cbView('costum_employee',$data);
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