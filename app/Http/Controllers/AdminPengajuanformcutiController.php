<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPengajuanformcutiController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t201_formcuti";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			#Tambahan
			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');

			$Tahuncuti=date('Y');
			$Cuti=DB::Table('t200_stockcuti')
					->where('Employee_id',$EmployeeID)
					->where('Tahun',$Tahuncuti)
					->select('Endstock');
			//dd($getJabatan);

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Employee Id","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Jeniscuti Id","name"=>"Jeniscuti_id","join"=>"hrdm111_klasifikasicuti,namacuti"];
			$this->col[] = ["label"=>"Tahun Cuti","name"=>"Tahuncuti"];
			$this->col[] = ["label"=>"Tujuan","name"=>"Tujuan"];
			$this->col[] = ["label"=>"Lama","name"=>"Lama"];
			$this->col[] = ["label"=>"Pelaksanaan","name"=>"Pelaksanaan"];
			$this->col[] = ["label"=>"Approved","name"=>"isApprove"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Karyawan','name'=>'Employee_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'hrde200_Employee,EmployeeName','value'=>$EmpID,'readonly'=>true];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cms_privileges,name','value'=>$getJabatan];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID];
			$this->form[] = ['label'=>'Jenis cuti','name'=>'Jeniscuti_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm111_klasifikasicuti,namacuti'];
			$this->form[] = ['label'=>'Tahun cuti','name'=>'Tahuncuti','type'=>'text','validation'=>'required','width'=>'col-sm-2','value'=>$Tahuncuti];
			//$this->form[] = ['label'=>'Sisa cuti','name'=>'sisacuti','type'=>'text','validation'=>'required','width'=>'col-sm-9','value'=>$Cuti];
			$this->form[] = ['label'=>'Tujuan','name'=>'Tujuan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Lama','name'=>'Lama','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Pelaksanaan','name'=>'Pelaksanaan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			$this->form[] = ['label'=>'Status','name'=>'isApprove','type'=>'hidden','value'=> '0'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_Employee,EmployeeName'];
			//$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			//$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			//$this->form[] = ['label'=>'Jeniscuti Id','name'=>'Jeniscuti_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm111_klasifikasicuti,namacuti'];
			//$this->form[] = ['label'=>'Tahun cuti','name'=>'Tahuncuti','type'=>'text','validation'=>'required','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Tujuan','name'=>'Tujuan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Lama','name'=>'Lama','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Pelaksanaan','name'=>'Pelaksanaan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Status','name'=>'isApprove','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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
			$getJabatan=Crudbooster::myPrivilegeId();
			$getUnitID=CRUDBooster::myUnitIDKeep();

			if($getUnitID == 1){
				if ($getJabatan == 9) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

				}
			}
			else {
				if($getJabatan == '4'){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
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
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			//dd($EmployeeID);
			if($getUnitID == 1){
				if($getJabatan == 125)
					$query->where('isApprove','=','1');
				else {
					if($getJabatan == 6){
						$query
						->where('t201_formcuti.Jabatan_id','=','36')
						->orWhere('t201_formcuti.Jabatan_id','=','37')
						->orWhere('t201_formcuti.Jabatan_id','=','38')
						->orWhere('t201_formcuti.Jabatan_id','=','39')
						->orWhere('t201_formcuti.Jabatan_id','=','40')
						->orWhere('t201_formcuti.Jabatan_id','=','41')
						->orWhere('t201_formcuti.Jabatan_id','=','42')
						->orWhere('t201_formcuti.Jabatan_id','=','43')
						->orWhere('t201_formcuti.Jabatan_id','=','44')
						->orWhere('t201_formcuti.Jabatan_id','=','45')
						->orWhere('t201_formcuti.Jabatan_id','=','46')
						->orWhere('t201_formcuti.Jabatan_id','=','47')
						->orWhere('t201_formcuti.Jabatan_id','=','48')
						->orWhere('t201_formcuti.Jabatan_id','=','49')
						->orWhere('t201_formcuti.Jabatan_id','=','50')
						->orWhere('t201_formcuti.Jabatan_id','=','51')
						->orWhere('t201_formcuti.Jabatan_id','=','52')
						->orWhere('t201_formcuti.Jabatan_id','=','14');
						
					}
					elseif ($getJabatan == 7) {
						$query
						->where('t201_formcuti.Jabatan_id','=','69')
						->orWhere('t201_formcuti.Jabatan_id','=','70')
						->orWhere('t201_formcuti.Jabatan_id','=','71')
						->orWhere('t201_formcuti.Jabatan_id','=','72')
						->orWhere('t201_formcuti.Jabatan_id','=','73')
						->orWhere('t201_formcuti.Jabatan_id','=','74')
						->orWhere('t201_formcuti.Jabatan_id','=','75')
						->orWhere('t201_formcuti.Jabatan_id','=','76')
						->orWhere('t201_formcuti.Jabatan_id','=','77')
						->orWhere('t201_formcuti.Jabatan_id','=','78')
						->orWhere('t201_formcuti.Jabatan_id','=','79')
						->orWhere('t201_formcuti.Jabatan_id','=','15');
					}
					elseif ($getJabatan == 8) {
						$query
						->where('t201_formcuti.Jabatan_id','=','16')
						->orWhere('t201_formcuti.Jabatan_id','=','53')
						->orWhere('t201_formcuti.Jabatan_id','=','54')
						->orWhere('t201_formcuti.Jabatan_id','=','55')
						->orWhere('t201_formcuti.Jabatan_id','=','56')
						->orWhere('t201_formcuti.Jabatan_id','=','57')
						->orWhere('t201_formcuti.Jabatan_id','=','58')
						->orWhere('t201_formcuti.Jabatan_id','=','59')
						->orWhere('t201_formcuti.Jabatan_id','=','60')
						->orWhere('t201_formcuti.Jabatan_id','=','61')
						->orWhere('t201_formcuti.Jabatan_id','=','62')
						->orWhere('t201_formcuti.Jabatan_id','=','63')
						->orWhere('t201_formcuti.Jabatan_id','=','64')
						->orWhere('t201_formcuti.Jabatan_id','=','65');
					}
					elseif ($getJabatan == 9) {
						$query
						->where('t201_formcuti.Jabatan_id','=','17')
						->orWhere('t201_formcuti.Jabatan_id','=','67')
						->orWhere('t201_formcuti.Jabatan_id','=','68');
						
					}
					elseif ($getJabatan == 10) {
						$query
						->where('t201_formcuti.Jabatan_id','=','18');

					}
					elseif ($getJabatan == 11) {
						$query
						->where('t201_formcuti.Jabatan_id','=','19');
										
					}
					elseif ($getJabatan == 8) {
						$query
						->where('t201_formcuti.Jabatan_id','=','5')
						->orWhere('t201_formcuti.Jabatan_id','=','6')
						->orWhere('t201_formcuti.abatan_id','=','7')
						->orWhere('t201_formcuti.Jabatan_id','=','8')
						->orWhere('t201_formcuti.Jabatan_id','=','9')
						->orWhere('t201_formcuti.Jabatan_id','=','10')
						->orWhere('t201_formcuti.Jabatan_id','=','11');	
					}
					else {
						$query
						->where('t201_formcuti.Employee_id',$EmpID);
					}
				}
			}
			elseif ($getUnitID != 1) {
				if($getJabatan == 12){
					$query->where('t201_formcuti.Unit_id',$getUnitID);
				}
				else {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id',$EmpID);
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
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();

			
			//============= isi status
			if($column_index == 9){
				if($column_value == 0 )
				{
					$column_value = 'Belum Di Setujui';
				}
				else
				{
					
					$column_value = 'Setuju';
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
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			$year=date('Y');
			$sisacuti = Request::get('Lama');

			$cekcuti=DB::table('t200_stockcuti')
					->where('Employee_id',$EmpID)
					->where('Tahun',$year)
					->value('Endstock');
			//dd($cekcuti);
			if($cekcuti !=0){
				if ($cekcuti >= $sisacuti) {
					//  $jmlcuti= $cekcuti - $sisacuti;
					//  DB::table('t200_stockcuti')
					//  ->where('Employee_id',$EmpID)
					//  ->where('Tahun',$year)
					//  ->update(['Endstock'=>$jmlcuti]);
				}
				else {
					//pesan kalo sisa cuti tidak ada
					CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Pengajuan cuti lebih besar daripada sisa cuti anda!","info");
					return false;
				}
			}
			else {
				//sisa cuti tidak ada ato habis
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Anda belum dapat cuti atau cuti anda telah habis!","info");
				return false;
			}
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

		public function ApproveSM($id){
			
			$EmpID=DB::table('t201_formcuti')
					->where('id','=',$id)
					->value('Employee_id');
				//dd($EmpID);
			$tahun=date('Y');
			$ambilcuti = Request::get('Lama');

			$sisacuti=DB::table('t200_stockcuti')
					->where('Employee_id',$EmpID)
					->where('Tahun',$tahun)
					->value('Endstock');

			$jmlcuti=$sisacuti - $Lama;

			DB::table('t200_stockcuti')
				->where('Employee_id',$EmpID)
				->where('Tahun',$tahun)
				->update(['Endstock' => $jmlcuti]);

				DB::table('t201_formcuti')
				->where('id','=',$id)
				->update(['isApprove'=>'1']);

				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve Store Manager!","info");
		}

		public function ApproveMng($id){
			$EmpID=DB::table('t201_formcuti')
				->where('id','=',$id)
				->value('Employee_id');
		//dd($EmpID);
			$tahun=date('Y');
			$ambilcuti = Request::get('Lama');

			$sisacuti=DB::table('t200_stockcuti')
				->where('Employee_id',$EmpID)
				->where('Tahun',$tahun)
				->value('Endstock');

			$jmlcuti=$sisacuti - $Lama;

			DB::table('t200_stockcuti')
				->where('Employee_id',$EmpID)
				->where('Tahun',$tahun)
				->update(['Endstock' => $jmlcuti]);

			DB::table('t201_formcuti')
				->where('id','=',$id)
				->update(['isApprove'=>'1']);

			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve Manager!","info");
		}
	    //By the way, you can still create your own method in here... :) 


	}