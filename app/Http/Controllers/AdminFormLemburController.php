<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminFormLemburController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t112_absenlembur";
			# END CONFIGURATION DO NOT REMOVE THIS LINE
        
			
			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Karyawan","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Shift","name"=>"Shift"];
			$this->col[] = ["label"=>"Start Lembur","name"=>"StartTime"];
			$this->col[] = ["label"=>"Selesai Lembur","name"=>"EndTime"];
			$this->col[] = ["label"=>"Menit Lemburan","name"=>"id","join"=>"t112_absenlembur,AmountMinute"];
			$this->col[] = ["label"=>"Approved","name"=>"isApproved"];
			$this->col[] = ["label"=>"Status Voucher","name"=>"isVoucher"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			#Tambahan 
			
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


			$DeptID=DB::table('hrde200_employee')
			->where('id','=',$EmpID)
			->value('Departement_id');
			//dd($companyID);
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			
	//		$this->form[] = ['label'=>'Nama Karyawan','name'=>'Employee_id','type'=>'datamodal','datamodal_table'=>'hrde200_employee','width'=>'col-sm-4','datamodal_columns'=>'EmployeeName,Departement_id,Jabatan_id,Comany_id','datamodal_select_to'=>'Departement_id:Departement_id,Jabatan_id:Jabatan_id,Company_id:Company_id','datamodal_where'=>'Unit_id='.CRUDBooster::myUnitId(),'datamodel_size'=>'large'];
	//		$dept=DB::table('hrde200_employee')->select('Departement_id')->where('Employee_id',$Employee_id)->value('Departement_id');
	//		dd($dept);
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'Employee_id','type'=>'datamodal','datamodal_table'=>'hrde200_employee','datamodal_where'=>'Unit_id='.Crudbooster::myUnitID(),'validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'EmployeeName,NPK','datamodal_columns_alias'=>'EmployeeName,NPK','datamodal_select_to'=>'Unit_id:Unit_id','datamodal_size'=>'large','required'=>true];
		//	$this->form[] = ['label'=>'Departement','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm102_departement,DepartementName','value'=>$DeptID];
			
			//$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName','value'=>$UnitID];
			$this->form[] = ['label' => 'Unit','name'=>'Unit_id','type'=> 'select','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value' =>$getUnitID, 'readonly'=>true, 'disabled'=>true];

			$this->form[] = ['label' => 'Unit','name'=>'Unit_id','type'=> 'hidden','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value' =>$getUnitID, 'readonly'=>true];

			//$this->form[] = ['label'=>'Perusahaan','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm100_company,CompanyName', 'value'=>$companyID];
		//	$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cms_privileges,Name','value'=>$getJabatan];
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Shift','name'=>'shift','validation'=>'required|min:1|max:255','width'=>'col-sm-2','type'=>'select','dataenum'=>'Pagi;Malam'];

			$this->form[] = ['label'=>'Mulai Lembur','name'=>'StartTime','type'=>'datetime','validation'=>'required','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Selesai Lembur','name'=>'EndTime','type'=>'datetime','validation'=>'required','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Menit Lembur','name'=>'AmountMinute','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-2','readonly'=>'true'];
			$this->form[] = ['label'=>'Nomer Voucher','name'=>'NomerVoucher','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'0'];
			$this->form[] = ['label'=>'Pekerjaan','name'=>'Note','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Persetujuan','name'=>'isApproved','type'=>'hidden','width'=>'col-sm-10','value'=>'0'];
			$this->form[] = ['label'=>'Voucher','name'=>'isVoucher','type'=>'hidden','value'=>'0'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Departement Id","name"=>"Departement_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Departement,id"];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"EmployeeName","name"=>"EmployeeName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"StartTime","name"=>"StartTime","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"EndTime","name"=>"EndTime","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"AmountMinute","name"=>"AmountMinute","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"NomerVoucher","name"=>"NomerVoucher","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Note","name"=>"Note","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"isApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
	  //       $this->addaction = array();
	  //       if(CRUDBooster::MyPrivilegeId()==1){
				
			//     $this->addaction[] = [ 'label' => 'Delete Data', 'url' =>('FormLembur/delete/[id]'),'icon' => 'fa fa-pencil', 'color' => 'success'];
			// }	
			//  elseif(CRUDBooster::MyPrivilegeId()==34){
				
			//     $this->addaction[] = [ 'label' => 'Delete Data', 'url' =>('FormLembur/delete/[id]'),'icon' => 'fa fa-pencil', 'color' => 'success'];
			// }	

			// else{

			// }
			$this->addaction = array();

			if(CRUDBooster::MyPrivilegeId() == 41){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 42){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 43){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 44){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 45){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 46){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 47){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 1){	

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId() == 86){	
                
                $this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
				$this->addaction[] = ['url'=>('hapus_lembur').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];
			}

			elseif(CRUDBooster::MyPrivilegeId()<>12 & CRUDBooster::MyPrivilegeId()<>149){

				$this->addaction[] = ['label'=>'Setujui','url'=>('lembur').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
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
			$this->table_row_color[] = ['condition'=>"[isApproved]=='0'","color"=>"danger"];
			$this->table_row_color[] = ['condition'=>"[isApproved]=='1'","color"=>"success"];	       	          

	        
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
	        $this->script_js = "
			$(function() {
				
			setInterval(function(){
			var AmountTime = 0;	
			var Start = $('#StartTime').val();
			var Finish = $('#EndTime').val();
	
			var calculate = Math.abs(new Date(Finish) - new Date(Start));
			var minutes = Math.floor((calculate/1000)/60);
					
			$('#AmountMinute').val(minutes);
			},500);

			});
			";


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
			//$gettUnitID = CRUDBooster::myUnitIDKeep();

			//if($gettUnitID != 0)
			//{
			//	if($gettUnitID == 1)
			//	{
			//		$query;
			//	}
			//	else
			//	{
			//	   $query->where('t112_absenlembur.Unit_id',$gettUnitID);
			//	}
				
				
			//}
			//====
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			//dd($getJabatan);

			if($getJabatan != 1){
			$query
			->where('t112_absenlembur.Employee_id',$EmpID);
		}
		else{

		}
// 			if($getUnitID == 1){
// 				if($getJabatan == 125)
// 					$query->where('isApprove','=','1');
// 				else {
// 					if($getJabatan == 6){
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','36')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','37')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','38')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','39')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','40')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','41')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','42')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','43')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','44')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','45')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','46')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','47')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','48')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','49')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','50')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','51')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','52')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','14');
						
// 					}
// 					elseif ($getJabatan == 7) {
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','69')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','70')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','71')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','72')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','73')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','74')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','75')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','76')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','77')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','78')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','79')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','15');
// 					}
// 					elseif ($getJabatan == 8) {
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','16')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','53')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','54')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','55')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','56')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','57')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','58')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','59')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','60')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','61')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','62')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','63')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','64')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','65');
// 					}
// 					elseif ($getJabatan == 9) {
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','17')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','67')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','68');
						
// 					}
// 					elseif ($getJabatan == 10) {
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','18');

// 					}
// 					elseif ($getJabatan == 11) {
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','19');
										
// 					}
// 					elseif ($getJabatan == 8) {
// 						$query
// 						->where('t112_absenlembur.Jabatan_id','=','5')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','6')
// 						->orWhere('t112_absenlembur.jabatan_id','=','7')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','8')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','9')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','10')
// 						->orWhere('t112_absenlembur.Jabatan_id','=','11');	
// 					}
// 					else {
// 						$query
// 						->where('t112_absenlembur.Employee_id',$EmpID);
// 					}
// 				}
// 			}

             
                  
					
				
	            
 	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
			//Your code here
			if($column_index == 8){
				if($column_value == 0 )
				{
					$column_value = 'Belum Di Setujui';
				}
				else
				{
					
					$column_value = 'Setuju';
				}

			}

			if($column_index == 9){
				if($column_value == 0){
					$column_value ='Blm Dibuat';
				}
				elseif($column_value == 1){
					$column_value = 'Dibuat';
				}
				elseif($column_value == 2){
					$column_value = 'Diajukan';
				}
				elseif($column_value == 3){
					$column_value = 'Dicairkan';
				}
				elseif($column_value == 4){
					$column_value = 'Diterima';
				}
				elseif ($column_value == 0) {
					$column_value = '';
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

// 	     $Employee_id=request::get('Employee_id');
// 	     $StartTime=request::get('StartTime');
// 	     $checkemployee = DB::table('t112_absenlembur')
// 	                      ->where('Employee_id','=',$Employee_id)
// 	                      ->where('StartTime','=',$StartTime)
// 	                      ->value('Employee_id');

// // 	     $checktime = DB::table('t112_absenlembur')
// // 	                  ->where('StartTime','=',$StartTime)
// // 	                  ->value('StartTime');
// // // dd($checkemployee);

// 	     if($Employee_id == $checkemployee ) {
				
// 				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data yang sama tidak bisa diinput kembali!","info");
// 				return false;
				
// 			}

// 		else {	
// 				}


	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
		     
		   // $shift=DB::table('t112_absenlembur')
			  //     ->where('id', \DB::raw("(select max(`id`) from t112_absenlembur)"))
			  //     ->value('shift');
		 			   
		   // if($shift == 'Pagi' ) {
     //       DB::table('t112_absenlembur')
     //       ->where('id', \DB::raw("(select max(`id`) from t112_absenlembur)"))
     //       ->update(['shift'=>'1']);
     //       }
     //       else{
     //       DB::table('t112_absenlembur')
     //       ->where('id', \DB::raw("(select max(`id`) from t112_absenlembur)"))
     //       ->update(['shift'=>'2']);
     //       }

		     $Employee_id=request::get('Employee_id');
			 $StartTime=request::get('StartTime');

			 $dept= DB::table('hrde200_employee')->where('id','=',$Employee_id)->value('Departement_id');
			 $comp=DB::table('hrde200_employee')->where('id','=', $Employee_id)->value('Company_id');
			 $jabt=DB::table('hrde200_employee')->where('id','=', $Employee_id)->value('Jabatan_id');
			 $empname=DB::table('hrde200_employee')->where('id','=',$Employee_id)->value('EmployeeName');
			// //update data lembur untuk di masukkan id departement
			//$id=Request::get('id');
			//dd($StartTime);
			DB::table('t112_absenlembur')
			->where('Employee_id',$Employee_id)
			->where('StartTime',$StartTime)
			->update([
				'Departement_id'=>$dept,
				'Company_id'=>$comp,
				'Jabatan_id'=>$jabt,
				'EmployeeName'=>$empname
				]);

			$getID = CRUDBooster::myUnitIDKeep();
			$getUserHRD =  DB::table('cms_users')
							->where('Unit_id',$getID)
							->where('id_cms_privileges','4')
							->pluck('id');


			$config['content'] = "Ada Form Lembur Yang Harus diSetujui";
			$config['to'] = CRUDBooster::adminPath('FormLembur/');
			$config['id_cms_users'] = $getUserHRD;
			CRUDBooster::sendNotification($config);
            

            // redirect('admin/management_lembur')->send()->with('success','Data Lembur Berhasil Diinput');
         

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


public function getEdit($id) {
$edit = DB::table('t112_absenlembur')->where('id',$id)->first();
$super = DB::table('cms_privileges')->where('id','=','1');
if($edit->isApproved != 0){
	if($super != 1){
CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data Yang Sudah Di Approved/Reject Tidak Bisa Diubah !","danger");
}
}

$data = [];
$data['page_title'] = 'Edit Data';
$data['row'] = DB::table('t112_absenlembur')->where('id',$id)->first();

$this->cbView('crudbooster::default.form',$data);

}

// ============ update status persetujuan =======
		// public function formlembur($id){
		// 	DB::table('t112_absenlembur')->where('id',$id)->update(['isApproved'=>'1']);
			

		// 	//This will redirect back and gives a message
		// 	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Form Lembur Berhasil di Approve !","info");

		// }
// ===============================================

	    //By the way, you can still create your own method in here... :) 

	}