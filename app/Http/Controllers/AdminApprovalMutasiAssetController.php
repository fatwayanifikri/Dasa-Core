<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminApprovalMutasiAssetController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama";
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
			$this->table = "loga004_mutasiasset";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			$getUnitID=Crudbooster::myUnitId();
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Kode","name"=>"asset_id","join"=>"loga001_asset,kode"];
			$this->col[] = ["label"=>"Nama","name"=>"nama"];
			$this->col[] = ["label"=>"Kategori ","name"=>"kategori_id","join"=>"loga003_kategoriasset,kategori_name"];
			$this->col[] = ["label"=>"Asal Unit ","name"=>"asal_unit","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Unit Baru ","name"=>"unit_tujuan","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Tanggal Mutasi ","name"=>"tgl_mutasi"];
			$this->col[] = ["label"=>"Status Mutasi","name"=>"isApprove"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			// $this->form[] = ['label'=>'Kode','name'=>'kode','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[]= ['label'=>'Kode Asset','name'=>'asset_id','type'=>'datamodal','datamodal_table'=>'loga001_asset','datamodal_columns'=>'kode,nama','datamodal_columns_alias'=>'kode,name','datamodal_select_to'=>'nama:nama,kategori_id:kategori_id','datamodal_size'=>'small','required'=>true];
			$this->form[] = ['label'=>'Nama','name'=>'nama','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-6','readonly'=> true];
			$this->form[] = ['label'=>'Kategori Id','name'=>'kategori_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'loga003_kategoriasset,kategori_name','readonly'=> true];
			$this->form[] = ['label'=>'Asal Unit','name'=>'asal_unit','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID,'readonly'=> true];
			$this->form[] = ['label'=>'Unit Baru','name'=>'unit_tujuan','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Tgl Mutasi','name'=>'tgl_mutasi','type'=>'date'];
			$this->form[] = ['label'=>'Remark','name'=>'remarks','type'=>'textarea'];
			$this->form[] = ['label'=>'Status','name'=>'isApprove','type'=>'hidden','value'=> '0'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Kode","name"=>"kode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nama","name"=>"nama","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"You can only enter the letter only"];
			//$this->form[] = ["label"=>"Kategori Id","name"=>"kategori_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"kategori,id"];
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
      //          $asal=DB::table('loga004_mutasiasset')
					 // ->where('asal_unit','=',$getUnitID)
					 // ->value('asal_unit');

		   //  $baru=DB::table('loga004_mutasiasset')
					// ->where('unit_tujuan','=',$getUnitID)
					// ->value('unit_tujuan');

				

					if ($getJabatan == 1 ){
					$this->addaction[] = ['label'=>'Terima','name'=>'setuju_sm','url'=>('ApproveSMtujuan').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 1"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('Rejectmutasiaset').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 1"];
					
				      }
				elseif ($getJabatan == 12 ){
					$this->addaction[] = ['label'=>'Terima','name'=>'setuju_sm','url'=>('ApproveSMtujuan').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 1"];
					$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('Rejectmutasiaset').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 1"];
					}	
			
				
				      
//dd($asal);

				// if ($getJabatan == 1 ){
				// 	$this->addaction[] = ['label'=>'Terima','name'=>'setuju_sm','url'=>('ApproveSMtujuan').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 1"];
				// 	$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('Rejectmutasiaset').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 1"];
					
				//       }
				// elseif ($getJabatan == 12 ){
				// 	$this->addaction[] = ['label'=>'Terima','name'=>'setuju_sm','url'=>('ApproveSMtujuan').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApprove] == 1"];
				// 	$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('Rejectmutasiaset').'/[id]','icon'=>'fa fa-check','color'=>'danger','showIf'=>"[isApprove] == 1"];
				// 	}
				//       }
				  


					
			

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
	        $EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');
			$getUnitID=CRUDBooster::myUnitIDKeep();
			$getJabatan=CRUDBooster::myPrivilegeId();

			if($getUnitID == 1){
				if($getJabatan == 39)
					$query;
             }
		    elseif ($getUnitID == 2) {
		  	if($getJabatan == 12){
						$query
						->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
					
					}}
		    elseif ($getUnitID == 3) {
		  	if($getJabatan == 12){
						$query
						->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
						
					}}
		    elseif ($getUnitID == 4) {
		  	if($getJabatan == 12){
						$query
						->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
					}}
			elseif ($getUnitID == 5) {
		  	if($getJabatan == 12){
						$query
						->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
					}}
			elseif ($getUnitID == 6) {
		  	if($getJabatan == 12){
						$query
						->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
					}}
			elseif ($getUnitID == 7) {
		  	if($getJabatan == 12){
						$query
					->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
					}}
			elseif ($getUnitID == 8) {
		  	if($getJabatan == 12){
						$query
						->where('loga004_mutasiasset.unit_tujuan','=',$getUnitID);
					}}

}

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	if($column_index == 7){
				if($column_value == 0 )
				{
					$column_value = 'Belum Di Setujui';
				}
				elseif ($column_value == 1) {
					$column_value = 'Disetujui SM Asal';
				}
				elseif ($column_value == 2) {
					$column_value = 'Disetujui SM Tujuan';
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
	     //     $id=DB::Table('loga001_asset')
	     //     ->get();

	     //  $asetkode=DB::Table('loga004_mutasiasset')
	     // ->where('asset_id','=',$id->id)
	     // ->value('kode');

	     // DB::table('loga004_mutasiasset')->where('asset_id','=',$id)->update(['kode'=>$kode]);

       
           

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