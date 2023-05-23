<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
    use App\Exportmutasi;
	use crocodicstudio\crudbooster\controllers\partials\ButtonColor;
    use Excel;
	class AdminMutasiKaryawanController extends \crocodicstudio\crudbooster\controllers\CBController {


//MUTASI KARYAWAN VIA MENU EMPLOYEE
		
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
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "p101_mutation";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

            $companyID=CRUDBooster::myCompanyID();
			$ResultID = DB::select('select uuid_short() as id');
            $getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');


			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Karyawan","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Tanggal Mutasi","name"=>"TanggalMutasi"];
			$this->col[] = ["label"=>"AsalUnit","name"=>"AsalUnit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Jabatan Awal","name"=>"AsalPrivileges_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Jabatan Baru","name"=>"Privileges_id","join"=>"cms_privileges,name"];
			$this->col[] = ["label"=>"Note","name"=>"Note"];
			$this->col[] = ["label"=>"Approval","name"=>"isApproved"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			// $this->form[] = ['label'=>'Nama Karyawan','name'=>'Employee_id','type'=>'datamodal','datamodal_table'=>'hrde200_employee','datamodal_where'=>'','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'EmployeeName,NPK','datamodal_columns_alias'=>'EmployeeName,NPK','datamodal_select_to'=>'Unit_id:AsalUnit_id,Jabatan_id:AsalPrivileges_id','datamodal_size'=>'large','required'=>true,'value'=>$emplid];
			
			// $this->form[] = ['label'=>'Nama','name'=>'Employee_id','type'=>'text'];
			$this->form[] = ['label'=>'Employee Name','name'=>'Employee_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName'];

			
			$this->form[] = ['label'=>'Unit Asal','name'=>'AsalUnit_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Jabatan Awal','name'=>'AsalPrivileges_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];

			$this->form[] = ['label'=>'Tanggal Mutasi','name'=>'TanggalMutasi','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Unit Baru','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Jabatan Baru','name'=>'Privileges_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			$this->form[] = ['label'=>'Note','name'=>'Note','type'=>'textarea','validation'=>'string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'isApproved','type'=>'hidden','value'=> '0'];
			$this->form[] = ['label'=>'Alasan Reject','name'=>'reject_note','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde200_Employee,EmployeeName'];
			//$this->form[] = ['label'=>'TanggalMutasi','name'=>'TanggalMutasi','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'AsalUnit Id','name'=>'AsalUnit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			//$this->form[] = ['label'=>'AsalPrivileges Id','name'=>'AsalPrivileges_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			//$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			//$this->form[] = ['label'=>'Privileges Id','name'=>'Privileges_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			//$this->form[] = ['label'=>'Note','name'=>'Note','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
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
	        
			$getJabatan=Crudbooster::myPrivilegeId();
			$getUnitID=CRUDBooster::myUnitIDKeep();
           // if($getUnitID == 1){
				if($getJabatan == 8 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMNG').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectmutasi/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApproved] == 0"];
					$this->addaction[] = ['url'=>('delete_mutasi_karyawan').'/[id]','icon'=>'fa fa-trash','color'=>'warning','confirmation' => true];
				}

				elseif($getJabatan == 1 ){
					$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveMNG').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectmutasi/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApproved] == 0"];
					$this->addaction[] = ['url'=>('delete_mutasi_karyawan').'/[id]','icon'=>'fa fa-trash','color'=>'warning','confirmation' => true];
				}

				else{
					$this->addaction[] = ['url'=>('delete_mutasi_karyawan').'/[id]','icon'=>'fa fa-trash','color'=>'warning','confirmation' => true];
				}

	 //      }
	 // else{
		// 		if($getJabatan == 12){
		// 			$this->addaction[] = ['label'=>'Setujui','name'=>'setuju_sm','url'=>('ApproveSM2').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
		// 			$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectmutasi/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApproved] == 0"];
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
	        
	         $this->index_button[] = ['label'=>'Export','url'=>CRUDBooster::mainpath("../p101_mutation"),"icon"=>"fa fa-download"];



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
			$this->table_row_color[] = ['condition'=>"[isApproved]=='2'","color"=>"success"];	   	          

	        
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
var Employee_id = 0; 
var full_url = document.URL; // Get current url	
var url_array = full_url.split('/') //split string into array
var third_segment = url_array[url_array.length-3];  // Get the last part of the array (-3)

$('#Employee_id').val(third_segment);

}); 


setInterval(function(){
var AsalUnit_id = 0; 
var full_url = document.URL; // Get current url	
var url_array = full_url.split('/') //split string into array
var second_url = url_array[url_array.length-2];  // Get the last part of the array (-2)

$('#AsalUnit_id').val(second_url);

}); 

setInterval(function(){
var AsalPrivileges_id = 0; 
var full_url = document.URL; // Get current url	
var url_array = full_url.split('/') //split string into array
var first_url = url_array[url_array.length-1];  // Get the last part of the array (-3)

$('#AsalPrivileges_id').val(first_url);

}); 
       
			
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
	  		 $EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();
			
	
				if($getJabatan == 1){
				 $query;
				}

				elseif($getJabatan == 8){
				 $query;
				}

				elseif($getJabatan == 12){
					$query
					->where('p101_mutation.AsalUnit_id',$getUnitID);
				}
		}
	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */        
	    public function hook_row_index($column_index,&$column_value) {

	    	$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();

			
			//============= isi status
			if($column_index == 8){
				if($column_value == 0 )
				{
					$column_value = 'Belum Di Setujui';
				}
				elseif ($column_value == 1) {
					$column_value = 'Disetujui SM';
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
			 // $EmployeeID = Request::get('Employee_id');
			 // $JabatanBaru= Request::get('Privileges_id');
			 // $UnitBaru= Request::get('Unit_id');

			 // DB::table('hrde200_employee')->where('id',$EmployeeID)->update(['Jabatan_id' => $JabatanBaru, 'Unit_id'=>$UnitBaru]);
			 // DB::table('cms_users')->where('Employee_id',$EmployeeID)->update(['id_cms_privileges' => $JabatanBaru, 'Unit_id'=>$UnitBaru]);

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



public function ApproveSM2($id){
			
       DB::table('p101_mutation')
		->where('id','=',$id)
        ->update(['isApproved'=>'1']);
       CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Mutasi Berhasil di Approve!","info");
}

public function ApproveMNG($id){

	  $EmployeeID = DB::table('p101_mutation')
					->where('id','=',$id)
					->value('Employee_id');  

	  $JabatanBaru= DB::table('p101_mutation')
					->where('id','=',$id)
					->value('Privileges_id'); 
					
	  $UnitBaru= DB::table('p101_mutation')
					->where('id','=',$id)
					->value('Unit_id'); 

	  DB::table('hrde200_employee')->where('id',$EmployeeID)->update(['Jabatan_id' => $JabatanBaru, 'Unit_id'=>$UnitBaru]);
	 DB::table('cms_users')->where('Employee_id',$EmployeeID)->update(['id_cms_privileges' => $JabatanBaru, 'Unit_id'=>$UnitBaru]);
			
       DB::table('p101_mutation')
		->where('id','=',$id)
        ->update(['isApproved'=>'2']);
       CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Mutasi Berhasil di Approve!","info");
}

 public function RejectSM2($id){
			
       DB::table('p101_mutation')
		->where('id','=',$id)
        ->update(['isApproved'=>'3']);
       CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Mutasi Berhasil di Reject!","danger");
}


public function delete_mutasi_karyawan($id)
{

DB::table('p101_mutation')
		 ->where('id','=',$id)
         ->delete();
CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data Berhasil Dihapus!","success");
 
}
	 


	}