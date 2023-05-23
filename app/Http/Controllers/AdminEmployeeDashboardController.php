<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;

	class AdminEmployeeDashboardController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = false;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
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
			//$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Employee,id'];
			//$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jabatan,id'];
			//$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Unit,id'];
			//$this->form[] = ['label'=>'Jeniscuti Id','name'=>'Jeniscuti_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jeniscuti,id'];
			//$this->form[] = ['label'=>'Tahuncuti','name'=>'Tahuncuti','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tujuan','name'=>'Tujuan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Sisacuti','name'=>'Sisacuti','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Lama','name'=>'Lama','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Pelaksanaan','name'=>'Pelaksanaan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'IsApprove','name'=>'isApprove','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Reject Note','name'=>'reject_note','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
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



public function getIndex() {

if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

Carbon::now()->timezone('Asia/Jakarta');
$year = Carbon::now();
$year->year;

//data bulan lalu tgl 15
$startDate=Carbon::now()->startOfMonth()->subMonth(1)->addDays(15)->format('Y-m-d');

$dateNOW = Carbon::now()->startOfMonth(); 

   $EmployeeID=Crudbooster::myId();
   $EmpID=DB::table('cms_users')
		  ->where('id','=',$EmployeeID)
		  ->value('Employee_id');
   $getUnitID=CRUDBooster::myUnitIDKeep();
   $getJabatan=CRUDBooster::myPrivilegeId();
   $getName=CRUDBooster::myName();
	$Email=DB::table('cms_users')
			->where('name','=',$getName)
			->value('email');

   $query = DB::table('t200_stockcuti')//stock cuti
   ->where('Employee_id','=',$EmpID)
   ->where('Tahun','=',$year)
   ->get();

    $query2 = DB::table('t201_formcuti')//cuti approved
   ->where('Employee_id','=',$EmpID)
   ->where('isApprove','=',2)
   ->whereBetween('created_at',[$startDate, Carbon::now() ])
   ->select('Employee_id', DB::raw('SUM(lama) as total_cuti'))
   ->groupby('Employee_id')
   ->get();

    $query3 = DB::table('t112_absenlembur')//total menit lembur
   ->where('Employee_id','=',$EmpID)
   // ->whereMonth('StartTime', Carbon::now()->month)
   ->whereBetween('StartTime',[$startDate, Carbon::now() ])
   ->select('Employee_id', DB::raw('SUM(AmountMinute) as total_menit'))
   ->groupby('Employee_id')
   ->where('isApproved','=',1)
   ->get();

   $query4 = DB::table('cms_privileges')
   ->where('id','=',$getJabatan)
   ->get();
   
   $query5 = DB::table('hrde100_pelamar')//total pelamar
   ->select(DB::raw('COUNT(id) as total_pelamar'))
   ->whereBetween('created_at',[$startDate, Carbon::now() ])
   ->get();

    $query6 = DB::table('hrde200_employee')//jumlah karyawan
   ->select(DB::raw('COUNT(id) as total_karyawan'))
   ->get();

   $query7 = DB::table('hrdt100_employeerequest')//jumlah request karyawan
   ->select(DB::raw('COUNT(id) as total_request'))
   ->whereBetween('RequestDate',[$startDate, Carbon::now() ])
   ->get();

   $query8 = DB::table('t112_absenlembur')//total lembur bulan ini
   ->select(DB::raw('COUNT(id) as total_lembur'))
   ->whereBetween('StartTime',[$startDate, Carbon::now() ])
   ->get();

   $query9 = DB::table('mkt002_penawaran')//dashboard customer(total pembayaran)
   ->select(DB::raw('SUM(Grand_Total) as grand_total'))
   ->where('CustomerEmail','=',$Email)
   ->get();

   $query10 = DB::table('mkt002_penawaran')//dashboard customer(total transaksi)
   ->select(DB::raw('COUNT(id) as trans_total'))
   ->where('CustomerEmail','=',$Email)
   ->get();

   //untuk menampilkan data di view
   $data = [];
   $data['cuti'] = 'Products Data';
   $data['value'] = $query; //total stock cuti karyawan
   $data['result'] = $query2; //total cuti per karyawan bulan ini
   $data['total'] = $query3; //total menit lembur per karyawan bulan ini
   $data['jabatan'] = $query4; //get jabatan
   $data['pelamar'] = $query5; //total pelamar kerja bulan ini
   $data['karyawan'] = $query6; //jumlah karyawan
   $data['request'] = $query7; //total req semua karyawan bulan ini 
   $data['lembur'] = $query8; //total lembur semua karyawan bulan ini
   $data['pembayaran'] = $query9; //total pembayaran customer
   $data['transaction'] = $query10; //transaksi customer

   //Create a view. Please use `cbView` method instead of view method from laravel.
   $this->cbView('viewindex/employee_dashboard',$data);
}


	}