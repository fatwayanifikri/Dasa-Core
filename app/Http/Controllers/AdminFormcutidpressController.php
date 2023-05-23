<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminFormcutidpressController extends \crocodicstudio\crudbooster\controllers\CBController {

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
					->where('Employee_id',$EmpID)
					->where('Tahun',$Tahuncuti)
					->value('Endstock');
			//dd($getJabatan);

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Employee Id","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Jenis Cuti","name"=>"Jeniscuti_id","join"=>"hrdm111_klasifikasicuti,namacuti"];
			$this->col[] = ["label"=>"Tahun Cuti","name"=>"Tahuncuti"];
			// $this->col[] = ["label"=>"Tujuan","name"=>"Tujuan"];
			// $this->col[] = ["label"=>"Sisa Cuti","name"=>"sisacuti"];
			$this->col[] = ["label"=>"Lama Cuti","name"=>"Lama"];
			$this->col[] = ["label"=>"Tanggal Cuti","name"=>"tgl_mulai"];
			$this->col[] = ["label"=>"Selesai Cuti","name"=>"tgl_selesai"];
			$this->col[] = ["label"=>"Approved","name"=>"isApprove"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			// $this->form[] = ['label'=>'Karyawan','name'=>'Employee_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'hrde200_employee,EmployeeName','datatable_where'=>'Unit_id='.Crudbooster::myUnitID(),'readonly'=>true,'value'=>$EmpID];
            //----------------------------------------------------------------//
			$this->form[] = ['label' => 'Karyawan','name'=>'Employee_id','type'=> 'select','width'=>'col-sm-5','datatable'=>'hrde200_employee,EmployeeName','value' =>$EmpID, 'readonly'=>true, 'disabled'=>true];

			$this->form[] = ['label' => 'Karyawan','name'=>'Employee_id','type'=> 'hidden','width'=>'col-sm-2','datatable'=>'hrde200_employee,EmployeeName','value' =>$EmpID, 'readonly'=>true];
			//----------------------------------------------------------------//

			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datatable'=>'cms_privileges,name','value'=>$getJabatan, 'readonly'=>true, 'disabled'=>true];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cms_privileges,name','value'=>$getJabatan];

			//----------------------------------------------------------------//

			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID, 'readonly'=>true, 'disabled'=>true];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID];
            //----------------------------------------------------------------//

			$this->form[] = ['label'=>'Jenis cuti','name'=>'Jeniscuti_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datatable'=>'hrdm111_klasifikasicuti,namacuti'];
			$this->form[] = ['label'=>'Tahun cuti','name'=>'Tahuncuti','type'=>'text','validation'=>'required','width'=>'col-sm-2','value'=>$Tahuncuti,'readonly'=>true];
			$this->form[] = ['label'=>'Sisa cuti','name'=>'sisacuti','type'=>'number','validation'=>'required','width'=>'col-sm-2','value'=>$Cuti,'readonly'=>true];
			$this->form[] = ['label'=>'Tujuan','name'=>'Tujuan','type'=>'select',"dataenum" => ["Urusan Keluarga","Sakit"]];

		   $this->form[] = ['label'=>'Mulai Cuti','name'=>'tgl_mulai','type'=>'date','validation'=>'required','width'=>'col-sm-5'];
            
      $this->form[] = ['label'=>'Selesai Cuti','name'=>'tgl_selesai','type'=>'date','validation'=>'required','width'=>'col-sm-5'];

			$this->form[] = ['label'=>'Lama Hari','name'=>'Lama','type'=>'number','validation'=>'required|integer|min:1','width'=>'col-sm-2'];
            
      $this->form[] = ['name'=>'isApprove','type'=>'checkbox','label'=> '*Selesai cuti diisi dengan tanggal yang sama dengan mulai cuti jika cuti hanya 1 hari','disabled'=>true];
      $this->form[] = ['name'=>'isApprove','type'=>'checkbox','label'=> '*Tujuan hanya diisi jika jenis cuti yang diambil cuti tahunan','disabled'=>true];
      $this->form[] = ['name'=>'isApprove','type'=>'checkbox','label'=> '*Lama hari dihitung dari tgl MULAI CUTI s/d tgl SELESAI CUTI (jika mulai cuti tgl 4 dan selesai tgl 7, berarti dihitung cuti 4 hari)','disabled'=>true];

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
			// $getJabatan=Crudbooster::myPrivilegeId();
			// $getUnitID=CRUDBooster::myUnitIDKeep();

			// if($getUnitID == 1){
			// 	if ($getJabatan == 4 ){
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 5) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 6) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 7) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 8) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 9) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 10) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// 	elseif ($getJabatan == 11) {
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMng').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];

			// 	}
			// }
			// else {
			// 	if($getJabatan == '12'){
			// 		$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 0"];
			// 	}
			// }
			

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
	        $this->alert    = array();

	        
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
	       	        $this->style_css = "
.wrapper {
  position: relative;
  overflow: auto;
  border: 1px solid black;
  white-space: nowrap;
 
}
td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}

";
	        
	        
	        
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
		// 	//dd($getJabatan);
		// 	//dd($getUnitID);
		
		$query
					->where('t201_formcuti.Unit_id',$getUnitID)
					->where('t201_formcuti.Employee_id',$EmpID);

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
	           
	     $EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			$lamacuti = Request::get('Lama');
			$cekjeniscuti=Request::get('Jeniscuti_id');
			
			if($cekjeniscuti == 1){
				if ($lamacuti > 3) {
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Pengajuan cuti lebih besar daripada batas jenis cuti!","info");
				return false;
				}
				else {	
				}
			}

			if($cekjeniscuti == 2){
				if ($lamacuti > 90) {
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Pengajuan cuti lebih besar daripada batas jenis cuti!","info");
				return false;
				}
				else {
				}
			}

			if($cekjeniscuti == 3){
				if ($lamacuti > 3) {
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Pengajuan cuti lebih besar daripada batas jenis cuti!","info");
				return false;
				}
				else {
				}
			}

			if($cekjeniscuti == 4){
				if ($lamacuti > 2) {
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Pengajuan cuti lebih besar daripada batas jenis cuti!","info");
				return false;
				}
				else {
				}
			}

			if($cekjeniscuti == 5){
				if ($lamacuti > 1) {
				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Pengajuan cuti lebih besar daripada batas jenis cuti!","info");
				return false;
				}
				else {
				}
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
           $EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();  

			$getjeniscuti=DB::table('t201_formcuti')
					    ->where('id', \DB::raw("(select max(`id`) from t201_formcuti)"))
					    ->value('Jeniscuti_id');

			$getnamacuti=DB::table('hrdm111_klasifikasicuti')
					    ->where('id','=',$getjeniscuti)
					    ->value('namacuti');

			if($getjeniscuti == 1 or $getjeniscuti == 2 or $getjeniscuti == 3 or $getjeniscuti == 4 or $getjeniscuti == 5){
					DB::table('t201_formcuti')->where('id',$id)->update(['Tujuan'=>$getnamacuti]);
				}

			else{

			}

      //------------------------------------------------------------------

	        if($getJabatan == 20){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
				elseif($getJabatan == 13){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 21){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 22){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 23){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 24){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 25){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 26){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 27){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 28){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 29){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 30){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 31){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 32){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 33){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
			elseif($getJabatan == 134){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}
				elseif($getJabatan == 135){
					DB::table('t201_formcuti')->where('id',$id)->update(['isApprove'=>'1']);
				}

				else{
					
				}

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
$edit = DB::table('t201_formcuti')->where('id',$id)->first();
if($edit->isApprove != 0){
CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data Yang Sudah Di Approved/Reject Tidak Bisa Diubah !","danger");
}

$data = [];
$data['page_title'] = 'Edit Data';
$data['row'] = DB::table('t201_formcuti')->where('id',$id)->first();

$this->cbView('crudbooster::default.form',$data);
}


	    //By the way, you can still create your own method in here... :) 


	}