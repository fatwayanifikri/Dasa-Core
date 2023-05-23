<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminApprovalformcutiController extends \crocodicstudio\crudbooster\controllers\CBController {

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
					->value('Endstock');
			// $sisa_cuti=DB::table('t200_stockcuti')
			// 		->where('Employee_id,$EmpID')
			// 		->value('$')
			//dd($getJabatan);

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Employee Id","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Jeniscuti Id","name"=>"Jeniscuti_id","join"=>"hrdm111_klasifikasicuti,namacuti"];
			$this->col[] = ["label"=>"Tahun Cuti","name"=>"Tahuncuti"];
			$this->col[] = ["label"=>"Tujuan","name"=>"Tujuan"];
			$this->col[] = ["label"=>"Sisa Cuti","name"=>"sisacuti"];
			$this->col[] = ["label"=>"Lama","name"=>"Lama"];
			$this->col[] = ["label"=>"Pelaksanaan","name"=>"Pelaksanaan"];
			$this->col[] = ["label"=>"Approved","name"=>"isApprove"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Karyawan','name'=>'Employee_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'hrde200_employee,EmployeeName','value'=>$EmpID,'readonly'=>true];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cms_privileges,name','value'=>$getJabatan];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID];
			$this->form[] = ['label'=>'Jenis cuti','name'=>'Jeniscuti_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm111_klasifikasicuti,namacuti'];
			$this->form[] = ['label'=>'Tahun cuti','name'=>'Tahuncuti','type'=>'text','validation'=>'required','width'=>'col-sm-2','value'=>$Tahuncuti];
			$this->form[] = ['label'=>'Sisa cuti','name'=>'sisacuti','type'=>'text','validation'=>'required','width'=>'col-sm-9','value'=>$Cuti];
			$this->form[] = ['label'=>'Tujuan','name'=>'Tujuan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Lama','name'=>'Lama','type'=>'number','validation'=>'required|integer|min:1','width'=>'col-sm-2'];
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
				if ($getJabatan == 1 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] < 3"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] < 3"];
				}
				if ($getJabatan == 3 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 4 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];

				}
				elseif ($getJabatan == 5 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];
				}
			//------------------------------ADMIN--------------------------------------------------//
				elseif ($getJabatan == 6) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];
					
				}

		    //----------------------------------------------------------------------------------//

				elseif ($getJabatan == 7) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];
					
				}
				elseif ($getJabatan == 8) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];

				}
				elseif ($getJabatan == 9) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];

				}
				elseif ($getJabatan == 10) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];

				}
				elseif ($getJabatan == 11) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 0"];
				}
			}

			else{

				if ($getJabatan == 13) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				
				elseif ($getJabatan == 16) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				
				elseif ($getJabatan == 20) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 21) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 22) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 23) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 24) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 25) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 26) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 27) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 28) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 29) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 30) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 31) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 32) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 33) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 134) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}
				elseif ($getJabatan == 135) {
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
				}

				elseif($getJabatan == 	12){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 1"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 1"];
					
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
			//=== TAMBAHAN KONDISI YG BLM
			//	->YG SUDAH DI APPROVE TIDAK PERLU DIMUNCULKAN & approve bertingkat dr kabag / spv dan ke SM
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			//dd($getJabatan);
			//dd($getUnitID);
			if($getUnitID == 1){
				//$query1 = $query->where('isapprove','=','0');
				if($getJabatan == 1)
					$query;
				else {
					if($getJabatan == 5){
						$query
						->where('t201_formcuti.isApprove','=','0')
						->Where('t201_formcuti.Jabatan_id','=','6')
						->orWhere('t201_formcuti.Jabatan_id','=','7')
						->orWhere('t201_formcuti.Jabatan_id','=','8')
						->orWhere('t201_formcuti.Jabatan_id','=','9')
						->orWhere('t201_formcuti.Jabatan_id','=','10')
						->orWhere('t201_formcuti.Jabatan_id','=','11')
						->orWhere('t201_formcuti.Jabatan_id','=','12')
						->orderby('id','desc');
					}
				
					elseif($getJabatan == 6){
						$query
						
						->where('t201_formcuti.Jabatan_id','=','36')
						->orWhere('t201_formcuti.Jabatan_id','=','37')
						->orWhere('t201_formcuti.Jabatan_id','=','38')
						->orWhere('t201_formcuti.Jabatan_id','=','39')
						->orWhere('t201_formcuti.Jabatan_id','=','40')
						//->orWhere('t201_formcuti.Jabatan_id','=','41')
						//->orWhere('t201_formcuti.Jabatan_id','=','42')
						->orWhere('t201_formcuti.Jabatan_id','=','43')
						//->orWhere('t201_formcuti.Jabatan_id','=','44')
						//->orWhere('t201_formcuti.Jabatan_id','=','45')
						->orWhere('t201_formcuti.Jabatan_id','=','46')
						->orWhere('t201_formcuti.Jabatan_id','=','47')
						->orWhere('t201_formcuti.Jabatan_id','=','48')
						->orWhere('t201_formcuti.Jabatan_id','=','49')
						->orWhere('t201_formcuti.Jabatan_id','=','50')
						->orWhere('t201_formcuti.Jabatan_id','=','51')
						->orWhere('t201_formcuti.Jabatan_id','=','52')
						->orWhere('t201_formcuti.Jabatan_id','=','14')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');
						
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
						->orWhere('t201_formcuti.Jabatan_id','=','15')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');
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
						->orWhere('t201_formcuti.Jabatan_id','=','65')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');
					}
					elseif ($getJabatan == 9) {
						$query
						
						->where('t201_formcuti.Jabatan_id','=','17')
						->orWhere('t201_formcuti.Jabatan_id','=','67')
						->orWhere('t201_formcuti.Jabatan_id','=','68')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');
						
					}
					elseif ($getJabatan == 10) {
						$query
						
						->where('t201_formcuti.Jabatan_id','=','18')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');

					}
					elseif ($getJabatan == 11) {
						$query
						
						->where('t201_formcuti.Jabatan_id','=','19')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');
										
					}
					elseif ($getJabatan == 4) {
						$query
						
						->where('t201_formcuti.Jabatan_id','=','5')
						->orWhere('t201_formcuti.Jabatan_id','=','6')
						->orWhere('t201_formcuti.Jabatan_id','=','7')
						->orWhere('t201_formcuti.Jabatan_id','=','8')
						->orWhere('t201_formcuti.Jabatan_id','=','9')
						->orWhere('t201_formcuti.Jabatan_id','=','10')
						->orWhere('t201_formcuti.Jabatan_id','=','11')
						->orWhere('t201_formcuti.Jabatan_id','=','12')
						->where('t201_formcuti.isApprove','=','0')
						->orderby('id','desc');	
					}
					else {
						$query
						->where('t201_formcuti.Employee_id',$EmpID)
						->orderby('id','desc');
					}
				}
			}
			elseif ($getUnitID != 1) {
				
				if($getJabatan == 12){
					$query
					->where('t201_formcuti.isApprove','=','1')
						->where('t201_formcuti.Unit_id',$getUnitID)
						->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
			    elseif($getJabatan == 3) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 4) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 5) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 6) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 7) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 8) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 9) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 10) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 11) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 13) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				
				elseif($getJabatan == 16) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID);
				}
				elseif($getJabatan == 20) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 21) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 22) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 23) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 24) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 25) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 26) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
				    ->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
			elseif($getJabatan == 27) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
			         ->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 28) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 29) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 30) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
			        ->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 31) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
			        ->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 32) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
				    ->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 33) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 134) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
				}
				elseif($getJabatan == 135) {
					$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id','<>',$EmpID)
					->Where('t201_formcuti.Jabatan_id','<>','12')
					->Where('t201_formcuti.Jabatan_id','<>','134')
					->Where('t201_formcuti.Jabatan_id','<>','135')
					->Where('t201_formcuti.Jabatan_id','<>','13')
					->Where('t201_formcuti.Jabatan_id','<>','20')
					->Where('t201_formcuti.Jabatan_id','<>','21')
					->Where('t201_formcuti.Jabatan_id','<>','22')
					->Where('t201_formcuti.Jabatan_id','<>','23')	
					->Where('t201_formcuti.Jabatan_id','<>','24')	
					->Where('t201_formcuti.Jabatan_id','<>','25')	
					->Where('t201_formcuti.Jabatan_id','<>','26')	
					->Where('t201_formcuti.Jabatan_id','<>','27')	
					->Where('t201_formcuti.Jabatan_id','<>','28')	
					->Where('t201_formcuti.Jabatan_id','<>','29')	
					->Where('t201_formcuti.Jabatan_id','<>','30')	
					->Where('t201_formcuti.Jabatan_id','<>','31')
					->Where('t201_formcuti.Jabatan_id','<>','32')	
					->Where('t201_formcuti.Jabatan_id','<>','33');
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
			if($column_index == 10){
				if($column_value == 0 )
				{
					$column_value = 'Belum Di Setujui';
				}
				elseif ($column_value == 1) {
					$column_value = 'Disetujui Kabag/SPV';
				}
				elseif ($column_value == 2) {
					$column_value = 'Disetujui';
				}
				elseif ($column_value == 3) {
					$column_value = 'Tidak disetujui';
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

//------------------------Untuk approval SM & Manager----------------/
		public function ApproveSM($id){
			
			$EmpID=DB::table('t201_formcuti')
					->where('id','=',$id)
					->value('Employee_id');
				//dd($EmpID);
			$tahun=date('Y');
			$ambilcuti = DB::table('t201_formcuti')
			->where('id','=',$id)
			->value('Lama');

             $sisacuti=DB::table('t200_stockcuti')
					->where('Employee_id',$EmpID)
					->where('Tahun',$tahun)
					->value('Endstock');
			$jeniscuti=DB::table('t201_formcuti')
					->where('id','=',$id)
					->value('Jeniscuti_id');
			if($jeniscuti == 6) {

				$jmlcuti=$sisacuti - $ambilcuti;
			}
			else {
				$jmlcuti=$sisacuti;
			}

			DB::table('t200_stockcuti')
				->where('Employee_id',$EmpID)
				->where('Tahun',$tahun)
				->update(['Endstock' => $jmlcuti]);

				DB::table('t201_formcuti')
				->where('id','=',$id)
				->update(['isApprove'=>'2']);

				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve !","info");
		}


		public function RejectSM($id){
			
          DB::table('t201_formcuti')
		  ->where('id','=',$id)
          ->update(['isApprove'=>'3']);
          CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Reject!","info");
}


//------------------------Untuk approval kabag & SPV-------------------------//
		public function ApproveMng($id){
			
			DB::table('t201_formcuti')
				->where('id','=',$id)
				->update(['isApprove'=>'2']);

			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve !","info");
		}

		
	    //By the way, you can still create your own method in here... :) 

	}