<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminInfostockcutiController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t200_stockcuti";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Karyawan","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			//$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			//$this->col[] = ["label"=>"Perusahaan","name"=>"Company_id","join"=>"hrdm100_company,CompanyName"];
			$this->col[] = ["label"=>"Year","name"=>"Tahun"];
			$this->col[] = ["label"=>"Awal Cuti","name"=>"Starstok"];
			$this->col[] = ["label"=>"Sisa Cuti","name"=>"Endstock"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName'];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			//$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
		//	$this->form[] = ['label'=>'Company','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm100_company,CompanyName'];
			$this->form[] = ['label'=>'Year','name'=>'Tahun','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Starstok','name'=>'Starstok','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Sisa Cuti','name'=>'Endstock','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"Tahun","name"=>"Tahun","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Starstok","name"=>"Starstok","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Endstock","name"=>"Endstock","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
	        
			if (CRUDBooster::MyPrivilegeId() == 12) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 20) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 21) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 22) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 23) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 24) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 25) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 26) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 27) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 28) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 29) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 30) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 31) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 32) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 33) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 13) {
				$$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 43) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 44) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 86) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}
			elseif (CRUDBooster::MyPrivilegeId() == 132) {
				$this->addaction[] = ['label'=>'Detail','url'=>('Infostockcutidetail?q=[Employee_id]'),'icon'=>'fa fa-check','color'=>'success'];
			}

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
			$companyID=CRUDBooster::myCompanyID();
			$getUnitID = CRUDBooster::myUnitIDKeep();
			//dd($getUnitID);
			// $PrivilegeId = CRUDBooster::MyPrivilegeId();
			$ResultID = DB::select('select uuid_short() as id');
			//----
			//$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			
			if ($getJabatan==44){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==12){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==13){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==20){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==21){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==22){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==23){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==24){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==25){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==26){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==27){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==28){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==29){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==30){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==31){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==32){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==33){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==132){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==86){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			elseif ($getJabatan==43){
				$query
				->where ('t200_stockcuti.Unit_id',$getUnitID);
			}
			else {
				$query
				->where('t200_stockcuti.Employee_id',$EmpID);
			}
	            
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


	}