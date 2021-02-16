<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPelamarController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "hrde100_pelamar";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Pelamar","name"=>"NamaPelamar"];
			$this->col[] = ["label"=>"Tempat Lahir","name"=>"TempatLahir"];
			$this->col[] = ["label"=>"Tanggal Lahir","name"=>"TanggalLahir"];
			$this->col[] = ["label"=>"Posisi dilamar","name"=>"Jabatan_id",'join'=>"hrdm104_jabatan,NamaJabatan"];
			$this->col[] = ["label"=>"Telp Rumah","name"=>"TelpRumah"];
			$this->col[] = ["label"=>"Telp Hp","name"=>"TelpHp"];
			$this->col[] = ["label"=>"Keterangan","name"=>"Keterangan"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			//$id = DB::select(DB::raw('select uuid_short() as id'));
			$ResultID = DB::select('select uuid_short() as id');
			
			
			$this->form = [];
			$this->form[] = ['label'=>'hdfpelamarid','name'=>'id','type'=>'hidden','value'=>$ResultID[0]->id];
			$this->form[] = ['label'=>'Nama Pelamar','name'=>'NamaPelamar','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tempat Lahir','name'=>'TempatLahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Lahir','name'=>'TanggalLahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Kelamin','name'=>'JenisKelamin','type'=>'radio','dataenum'=>'1|Laki-laki;0|Perempuan'];
			$this->form[] = ['label'=>'Status Nikah','name'=>'StatusNikah_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm105_statusnikah,StatusNikah'];
			$this->form[] = ['label'=>'Alamat','name'=>'Alamat','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Telp.Rumah','name'=>'TelpRumah','type'=>'text','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Telp.Hp','name'=>'TelpHp','type'=>'text','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Email','name'=>'Email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Agama','name'=>'Agama','type'=>'select','width'=>'col-sm-10','dataenum'=>'Islam;Kristen;Katolik;Hindu;Buddha;Konghuchu'];
			$this->form[] = ['label'=>'Posisi yang dipilih','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm104_jabatan,NamaJabatan'];
			$this->form[] = ['label'=>'Gaji yang di harapkan','name'=>'Gaji','type'=>'money','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'hdfFinalApprove','name'=>'FinalApprove','type'=>'hidden','value'=>'0'];
			$this->form[] = ['label'=>'hdfFinalApprovePKWT','name'=>'isApprovePKWT','type'=>'hidden','value'=>'0'];
			//$this->form[] = ['label'=>'Tipe identitas','name'=>'tipeidentitas_id','type'=>'select2','datatable'=>'hrdm106_tipeidentitas','relationship_table'=>'hrde101_pelamaridentity'];
			$columns = [];
			$columns[] = ['name'=>'Pelamar_id','visible'=>'false','value'=>$ResultID[0]->id];
			$columns[] = ['label'=>'Tipe Identitas','name'=>'TipeIdentitas_id','type'=>'select','validation'=>'required|min:1|max:255','datatable'=>'hrdm106_tipeidentitas,NamaID'];
			$columns[] = ['label'=>'No ID','name'=>'NoID','type'=>'text','required'=>true];
			$columns[] = ['label'=>'Masa Berlaku','name'=>'MasaBerlaku','type'=>'text','required'=>true];
			$columns[] = ['label'=>'Photo','name'=>'Photo','type'=>'upload','validation'=>'image|max:1000'];
			$this ->form[] = ['label'=>'Identitas','name'=>'hrde101_pelamaridentity','type'=>'child','columns'=>$columns,'table'=>'hrde101_pelamaridentity','foreign_key'=>'Pelamar_id'];

			$columns2 = [];
			$columns2[] = ['name'=>'Pelamar_id','visible'=>'false','value'=>$ResultID[0]->id];
			$columns2[] = ['label'=>'Tingkat Pendidikan','name'=>'EducationLevel_id','type'=>'select','validation'=>'required|min:1|max:255','datatable'=>'hrdm107_educationlevel,EducationName'];
			$columns2[] = ['label'=>'Nama Pendidikan','name'=>'EducationName','type'=>'text','required'=>true];
			$columns2[] = ['label'=>'Tanggal Mulai','name'=>'From','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d')];
			$columns2[] = ['label'=>'Tanggal Selesai','name'=>'To','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d')];
			$columns2[] = ['label'=>'Nilai Akhir','name'=>'NilaiAkhir','type'=>'number','required'=>true];
			$this ->form[] = ['label'=>'Pendidikan','name'=>'hrde102_pelamareducation','type'=>'child','columns'=>$columns2,'table'=>'hrde102_pelamareducation','foreign_key'=>'Pelamar_id'];

			$columns3 = [];
			$columns3[] = ['name'=>'Pelamar_id','visible'=>'false','value'=>$ResultID[0]->id];
			$columns3[] = ['label'=>'Nama Perusahaan','name'=>'CorporateName','type'=>'text','required'=>true];
			$columns3[] = ['label'=>'Jabatan Terakhir','name'=>'JabatanTerakhir','type'=>'text','required'=>true];
			$columns3[] = ['label'=>'Periode Kerja','name'=>'PeriodeKerja','type'=>'text','required'=>true];
			$columns3[] = ['label'=>'Deskripsi Pekerjaan','name'=>'DeskripsiPekerjaan','type'=>'textarea','required'=>true];
			$this ->form[] = ['label'=>'Pengalaman Pekerjaan','name'=>'hrde103_pelamarexperience','type'=>'child','columns'=>$columns3,'table'=>'hrde103_pelamarexperience','foreign_key'=>'Pelamar_id'];
	

			$this->form[] = ['label'=>'Keterangan','name'=>'Keterangan','width'=>'col-sm-10'];
			//$this->addDate("TanggalLahir","TanggalLahir")->format("d/m/Y");
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"NamaPelamar","name"=>"NamaPelamar","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TempatLahir","name"=>"TempatLahir","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalLahir","name"=>"TanggalLahir","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"StatusNikah Id","name"=>"StatusNikah_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"StatusNikah,id"];
			//$this->form[] = ["label"=>"Alamat","name"=>"Alamat","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TelpRumah","name"=>"TelpRumah","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TelpHp","name"=>"TelpHp","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Keterangan","name"=>"Keterangan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
			$this->script_js =NULL;


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
			$postdata['TanggalLahir'] = strtotime($postdata['TanggalLahir']);
			$postdata['TanggalLahir'] = date("Y-m-d", $postdata['TanggalLahir']);

			// $postdata['pendidikanFrom'] = strtotime($postdata['pendidikanFrom']);
			// $postdata['pendidikanFrom'] = date("Y-m-d", $postdata['pendidikanFrom']);

			//$postdata['To'] = strtotime($postdata['To']);
			//$postdata['To'] = date("Y-m-d", $postdata['To']);

			// $id = DB::select('select uuid_short() as id');
			// $convertID = (int)$id;
			// $postdata['id'] = $id;

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
			$postdata['TanggalLahir'] = strtotime($postdata['TanggalLahir']);
			$postdata['TanggalLahir'] = date("Y-m-d", $postdata['TanggalLahir']);

			//$postdata['From'] = strtotime($postdata['From']);
			//$postdata['From'] = date("Y-m-d", $postdata['From']);

			//$postdata['To'] = strtotime($postdata['To']);
			//$postdata['To'] = date("Y-m-d", $postdata['To']);
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