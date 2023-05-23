<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminAssetLogistikController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama";
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
			$this->table = "loga001_asset";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

        $id=DB::Table('loga001_asset')
	      ->where('id', \DB::raw("(select max(`id`) from loga001_asset)"))
	  	  ->value('id');
	  	  $ResultID = $id + 1;	

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Kode Asset","name"=>"kode"];
			$this->col[] = ["label"=>"Nama Asset","name"=>"nama"];
			$this->col[] = ["label"=>"Kategori","name"=>"kategori_id","join"=>"loga003_kategoriasset,kategori_name"];
			$this->col[] = ["label"=>"Unit ","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] =['label'=>'id','name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ['label'=>'Kode Asset','name'=>'kode','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Asset','name'=>'nama','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
			$this->form[] = ['label'=>'Kategori','name'=>'Kategori_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'loga003_kategoriasset,kategori_name'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrdm101_unit,UnitName',"readonly"=>'true'];


			$columns = [];
			$columns[] = ['label'=>'Asset Id','name'=>'asset_id','type'=>'hidden','value'=>$ResultID];
			// $columns[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-6','datatable'=>'hrdm101_unit,UnitName',"readonly"=>'true'];
			$columns[] = ['label'=>'Kondisi','name'=>'kondisi','type'=>'text'];
			$columns[] = ['label'=>'Tgl Pemakaian','name'=>'tgl_pemakaian','type'=>'date'];
			$columns[] = ['label'=>'Tgl Pembelian','name'=>'tgl_pembelian','type'=>'date'];
			$columns[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea'];
			$this ->form[] = ['label'=>'Asset Detail','name'=>'loga002_riwayatasset','type'=>'child','columns'=>$columns,'table'=>'loga002_riwayatasset','foreign_key'=>'asset_id'];
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
	       $this->index_button[] = ['label'=>'Export','url'=>('AssetLogistikCustom'),'icon'=>'fa fa-download','color'=>'primary'];
	        



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
		
			if($getUnitID == 1){
		
				if($getJabatan == 1)
					$query
						->orderBy('id','asc');
				else {
					if($getJabatan == 5){
						$query
						->orderBy('id','asc');
					}
				
					elseif($getJabatan == 6){
						$query
						->orderBy('id','asc');
						
					}
					elseif ($getJabatan == 7) {
						$query
						->orderBy('id','asc');
					}
					elseif ($getJabatan == 8) {
						$query
						->orderBy('id','asc');
					}
					elseif ($getJabatan == 9) {
						$query
						->orderBy('id','asc');
						
					}
					elseif ($getJabatan == 10) {
						$query
						->orderBy('id','asc');

					}
					elseif ($getJabatan == 11) {
						$query
						->orderBy('id','asc');
										
					}
					elseif ($getJabatan == 4) {
						$query
						->orderBy('id','asc');
						
					}
					else {
						$query
						->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
					}
				}
			}
			elseif ($getUnitID != 1) {
				
				if($getJabatan == 12){
					$query
						->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
			    elseif($getJabatan == 3) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 135) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 134) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 13) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				
				elseif($getJabatan == 16) {
					$query
					->where('t204_formtidakabsen.Unit_id',$getUnitID)
					->where('t204_formtidakabsen.Employee_id','<>',$EmpID)
					->orderBy('is_approve','asc');
				}
				elseif($getJabatan == 20) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 21) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 22) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 23) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 24) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 25) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 26) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
			elseif($getJabatan == 27) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 28) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 29) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
					}
				elseif($getJabatan == 30) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 31) {
					$query
				    ->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 32) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 33) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 134) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
				}
				elseif($getJabatan == 135) {
					$query
					->where('loga001_asset.Unit_id',$getUnitID)
						->orderBy('id','asc');
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
	     $id=DB::Table('loga001_asset')
	    ->where('id', \DB::raw("(select max(`id`) from loga001_asset)"))
	    ->value('id');

	     $kode=DB::Table('loga001_asset')
	    ->where('id', \DB::raw("(select max(`id`) from loga001_asset)"))
	    ->value('kode');
         
         $unit=DB::Table('loga001_asset')
	    ->where('id', \DB::raw("(select max(`id`) from loga001_asset)"))
	    ->value('Unit_id');

	    DB::table('loga002_riwayatasset')->where('asset_id','=',$id)->update(['kode'=>$kode]);
	    DB::table('loga002_riwayatasset')->where('asset_id','=',$id)->update(['Unit_id'=>$unit]);

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

  public function inputasetid(){
			
		    $id_asset= DB::table('loga001_asset')
		               ->where('id','=','')
		               ->value('id');
				
	        $kode= DB::table('loga001_asset')
	        ->where('id','=','')
				   ->value('kode');

				DB::table('loga002_riwayatasset')
				->where('kode','=',$kode)
				->update(['asset_id'=>$id_asset]);

				CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Mutasi Berhasil di Approve !","info");
		}

	    //By the way, you can still create your own method in here... :) 


	}