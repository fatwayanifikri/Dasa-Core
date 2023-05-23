<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
    use Carbon\Carbon;
	use PDF;

	class AdminApproveFormtidakabsenController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t204_formtidakabsen";
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

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Employee ","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Tanggal","name"=>"tanggal"];
			$this->col[] = ["label"=>"Jam Pelaksanaan","name"=>"jam_pelaksanaan"];
			$this->col[] = ["label"=>"Status","name"=>"is_approve"];
		
			# END COLUMNS DO NOT REMOVE THIS LINE


			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
		    $this->form[] = ['label' => 'Karyawan','name'=>'Employee_id','type'=> 'select','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName','value' =>$EmpID, 'readonly'=>true];

			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select','width'=>'col-sm-10','datatable'=>'cms_privileges,name','value' =>$getJabatan, 'readonly'=>true];

			$this->form[] = ['label' => 'Unit','name'=>'Unit_id','type'=> 'select','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value' =>$getUnitID, 'readonly'=>true];

			$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jam Pelaksanaan','name'=>'jam_pelaksanaan','validation'=>'required|min:1|max:255','width'=>'col-sm-10','type'=>'select',"dataenum" => ["Jam Masuk Kerja","Jam Pulang Kerja"]];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Is Approve','name'=>'is_approve','type'=>'hidden','validation'=>'required|integer','width'=>'col-sm-10','value'=>'1'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"tanggal","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
			//$this->form[] = ["label"=>"Jam Pelaksanaan","name"=>"jam_pelaksanaan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Keterangan","name"=>"keterangan","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
			//$this->form[] = ["label"=>"Is Approve","name"=>"is_approve","type"=>"radio","required"=>TRUE,"validation"=>"required|integer","dataenum"=>"Array"];
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
	        $this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('Approve_takabsen').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[is_approve] == 1"];
	        $this->addaction[] = ['label'=>'Print','url'=>('print_tidakabsen').'/[id]','icon'=>'fa fa-print','color'=>'info'];


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
	        $this->table_row_color[] = ['condition'=>"[is_approve]=='1'","color"=>"danger"];
			$this->table_row_color[] = ['condition'=>"[is_approve]=='2'","color"=>"success"];	  	          

	        
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
			
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
		
			if($getUnitID == 1){
		
				if($getJabatan == 1)
					$query;
				else {
					if($getJabatan == 5){
						$query
						->where(function($q) {
                        $q->where('t204_formtidakabsen.Jabatan_id','=','5')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','6')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','7')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','8')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','9')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','10')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','11')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','12')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','80')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','81')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','82')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','83')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','84')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','85')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','111')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','158');
					})
						->orderBy('is_approve','asc');
					}
				
					elseif($getJabatan == 6){
						$query
						->where(function($q) {
                        $q->where('t204_formtidakabsen.Jabatan_id','=','36')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','37')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','38')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','39')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','40')
						//->orWhere('t204_formtidakabsen.Jabatan_id','=','41')
						//->orWhere('t204_formtidakabsen.Jabatan_id','=','42')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','43')
						//->orWhere('t204_formtidakabsen.Jabatan_id','=','44')
						//->orWhere('t204_formtidakabsen.Jabatan_id','=','45')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','46')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','47')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','48')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','49')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','50')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','51')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','52')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','14');
					})
						->orderBy('is_approve','asc');
						
						
					}
					elseif ($getJabatan == 7) {
						$query
						->where(function($q) {
                        $q->where('t204_formtidakabsen.Jabatan_id','=','69')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','35')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','70')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','71')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','72')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','73')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','74')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','75')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','76')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','77')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','78')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','79')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','15')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','109')
						// ->orWhere('t204_formtidakabsen.Jabatan_id','=','147')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','149');
					})
						->orderBy('is_approve','asc');
					}
					elseif ($getJabatan == 8) {
						$query
						->where(function($q) {
                        $q->where('t204_formtidakabsen.Jabatan_id','=','16')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','53')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','54')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','55')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','56')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','57')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','58')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','59')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','60')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','61')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','62')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','63')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','64')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','65');
					})
						->orderBy('is_approve','asc');
					}
					elseif ($getJabatan == 9) {
						$query
						->where(function($q) {
                        $q->where('t204_formtidakabsen.Jabatan_id','=','17')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','67')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','68');
					     })
						->orderBy('is_approve','asc');
						
					}
					elseif ($getJabatan == 10) {
						$query
						->where('t204_formtidakabsen.Jabatan_id','=','18')
						->orderBy('is_approve','asc');

					}
					elseif ($getJabatan == 11) {
						$query
						->where('t204_formtidakabsen.Jabatan_id','=','19')
						->orderBy('is_approve','asc');
										
					}
					elseif ($getJabatan == 4) {
						$query
						->where(function($q) {
                        $q->where('t204_formtidakabsen.Jabatan_id','=','5')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','6')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','7')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','8')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','9')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','10')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','11')
						->orWhere('t204_formtidakabsen.Jabatan_id','=','12');
					})
						->orderBy('is_approve','asc');
					}
					else {
						$query
						->where('t204_formtidakabsen.Employee_id',$EmpID);
					}
				}
			}
			elseif ($getUnitID != 1) {
				
				if($getJabatan == 12){
					$query
						->where('t204_formtidakabsen.Unit_id',$getUnitID)
						->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
						->orderBy('is_approve','asc');
				}
			    elseif($getJabatan == 3) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 135) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 134) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->orderBy('is_approve','asc');
				}
				// elseif($getJabatan == 4) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 5) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 6) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 7) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 8) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 9) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 10) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				// elseif($getJabatan == 11) {
				// 	$query
				// 	->where('t204_formtidakabsen.Unit_id',$getUnitID)
				// 	->where('t204_formtidakabsen.Employee_id','<>',$EmpID);
				// }
				elseif($getJabatan == 13) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				
				elseif($getJabatan == 16) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 20) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 21) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 22) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 23) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 24) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 25) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 26) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
				    ->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
			elseif($getJabatan == 27) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
			         ->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 28) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 29) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 30) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
			        ->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 31) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
			        ->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 32) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
				    ->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 33) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->Where('t204_formtidakabsen.Jabatan_id','<>','61')
					->Where('t204_formtidakabsen.Jabatan_id','<>','70')
					->Where('t204_formtidakabsen.Jabatan_id','<>','71')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 134) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 135) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->Where('t204_formtidakabsen.Jabatan_id','<>','12')
					->Where('t204_formtidakabsen.Jabatan_id','<>','134')
					->Where('t204_formtidakabsen.Jabatan_id','<>','135')
					->Where('t204_formtidakabsen.Jabatan_id','<>','13')
					->Where('t204_formtidakabsen.Jabatan_id','<>','20')
					->Where('t204_formtidakabsen.Jabatan_id','<>','21')
					->Where('t204_formtidakabsen.Jabatan_id','<>','22')
					->Where('t204_formtidakabsen.Jabatan_id','<>','23')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','24')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','25')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','26')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','27')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','28')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','29')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','30')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','31')
					->Where('t204_formtidakabsen.Jabatan_id','<>','32')	
					->Where('t204_formtidakabsen.Jabatan_id','<>','33')
					->orderBy('is_approve','asc');
				}
					
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

	    	if($column_index ==6){
				if($column_value == 1 )
				{
					$column_value = 'Belum Di Setujui';
				}
				elseif ($column_value == 2) {
					$column_value = 'Disetujui';
				}
				
			}
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

	   public function Approve_takabsen($id){
			
          DB::table('t204_formtidakabsen')
		  ->where('id','=',$id)
          ->update(['is_approve'=>'2']);
          CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve!","info");
}


	}