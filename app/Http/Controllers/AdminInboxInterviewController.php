<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PDF;
	use Excel;

	class AdminInboxInterviewController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "hrdt200_interview";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Pelamar","name"=>"Pelamar_id","join"=>"hrde100_pelamar,NamaPelamar"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,Name"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Nama Perusahaan","name"=>"Company_id","join"=>"hrdm100_company,CompanyName"];
			$this->col[] = ["label"=>"Tanggal","name"=>"Tanggal"];
			$this->col[] = ["label"=>"Jam","name"=>"Jam"];
			$this->col[] = ["label"=>"Kesehatan","name"=>"Kesehatan"];
			# END COLUMNS DO NOT REMOVE THIS LINE
			$ResultID = DB::select('select uuid_short() as id');
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'hdfinterviewid','name'=>'id','type'=>'hidden','value'=>$ResultID[0]->id];
			$this->form[] = ['label'=>'Nama Pelamar','name'=>'Pelamar_id','type'=>'datamodal','datamodal_table'=>'hrde100_pelamar','datamodal_where'=>'','datamodal_columns'=>'NamaPelamar,TempatLahir,TelpHp,TelpRumah','datamodal_columns_alias'=>'Nama,Tempat Lahir,TelpHp,TelpRumah','datamodal_size'=>'large','required'=>true];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_privileges,Name'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Company','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm100_company,CompanyName'];
			$this->form[] = ['label'=>'Departement','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm102_departement,DepartementName'];
			$this->form[] = ['label'=>'Tanggal','name'=>'Tanggal','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d', time()),'width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jam','name'=>'Jam','type'=>'time','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Kesehatan','name'=>'Kesehatan','type'=>'select','dataenum'=>'Sehat;Kurang Sehat;Tidak Sehat','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Hadir','name'=>'StatusHadir','type'=>'select','dataenum'=>'Hadir;Tidak Hadir','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Pesikotes','name'=>'TanggalPesikotes','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan Psikotes','name'=>'KeteranganPsikotes','type'=>'select','dataenum'=>'Lulus;Tidak Lulus','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Interview','name'=>'TanggalInterview','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan Interview','name'=>'KeteranganInterview','type'=>'select','dataenum'=>'Lulus; Tidak Lulus','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Praktek','name'=>'TanggalPraktek','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan Praktek','name'=>'KeteranganPraktek','type'=>'select','dataenum'=>'Lulus;Tidak Lulus','width'=>'col-sm-10'];
			//untuk approval
			$columns = [];
			$columns[] = ['name'=>'Interview_id','visible'=>'false','value'=>$ResultID[0]->id];
			$columns[] = ['label'=>'Status Diterima','name'=>'isApproved','type'=>'radio','validation'=>'required','dataenum'=>'Approved|Approved;NotApproved|NotApproved'];
			$columns[] = ['label'=>'Diterima oleh','name'=>'Approvedby','type'=>'select','validation'=>'required|min:1|max:255','datatable'=>'hrdm110_approvalstatus,ApprovalName','datatable_where'=>'id >= 7'];
			$columns[] = ['label'=>'Tanggal','name'=>'ApprovedDate','type'=>'date','validation'=>'required|date_format:Y-m-d','value'=>date('Y-m-d', time())];
			//$columns[] = ['label'=>'Tanggal','name'=>'ApprovedDate','type'=>'date','width'=>'col-sm-10'];
			$columns[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'textarea','required'=>true];
			$this ->form[] = ['label'=>'Approved','name'=>'hrdt201_interviewapproval','type'=>'child','columns'=>$columns,'table'=>'hrdt201_interviewapproval','foreign_key'=>'Interview_id'];



			//Lanjutan yang atas
			$this->form[] = ['label'=>'Tanggal Mulai','name'=>'TanggalMulai','type'=>'date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'textarea','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Pelamar Id","name"=>"Pelamar_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Pelamar,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"Tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Jam","name"=>"Jam","type"=>"time","required"=>TRUE,"validation"=>"required|date_format:H:i:s"];
			//$this->form[] = ["label"=>"Kesehatan","name"=>"Kesehatan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"StatusHadir","name"=>"StatusHadir","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalPesikotes","name"=>"TanggalPesikotes","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"KeteranganPsikotes","name"=>"KeteranganPsikotes","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalInterview","name"=>"TanggalInterview","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"KeteranganInterview","name"=>"KeteranganInterview","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalPraktek","name"=>"TanggalPraktek","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"KeteranganPraktek","name"=>"KeteranganPraktek","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalMulai","name"=>"TanggalMulai","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
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
	         $this->addaction[] = ["label" =>"Penilaian Praktik",'url'=>('penilaian_praktik').'/[id]','icon'=>'fa fa-user','color'=>'success'];
	        $this->addaction[] = ["label" =>"Laporan Inter..",'url'=>('laporan_interview').'/[id]','icon'=>'fa fa-user','color'=>'warning'];
			//$JabatanID=CRUDBooster::myPrivilagesId();

			//if ($JabatanID=='4'){
				
			//}

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
			//control setiap unit
			$getUnitID = CRUDBooster::myUnitIDKeep();

			if($getUnitID != 0)
			{
				if($getUnitID == 1)
				{
					$query
					->join('hrde100_pelamar as pel','pel.id','=','hrdt200_interview.Pelamar_id')
					->where('hrde100_pelamar.FinalApprove','=','0');
				}
				else
				{
					$query
				//	->join('hrdt201_interviewapproval .Interview_id','=','hrdt200_interview.id')
					->join('hrde100_pelamar as pel','pel.id','=','hrdt200_interview.Pelamar_id')
					
				//	->where('hrdt201_interviewapproval.isApproved','=','Approve')
					->where('hrde100_pelamar.FinalApprove','=','0')
					->where('hrdt200_interview.Unit_id',$getUnitID);
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
			$getApprove = DB::table('hrdt201_interviewapproval')
			->select(DB::raw('count(interview_id) as JmlApprove'))
			->where('Interview_id','=',$id)
			->where('isApproved','=','Approved')
			->value('JmlApprove');

//			return $getApprove;

			$getPelamarID = DB::table('hrdt200_interview')
			->select('Pelamar_id')
			->where('id','=',$id)
			->value('Pelamar_id');
//re
//			return $getPelamarID;

				if ($getApprove > '0')
				{
					DB::table('hrde100_pelamar')->where('id',$getPelamarID)->update(['FinalApprove' => '1']);
					//DB::tabel('hrde100_pelamar')
					//->where('Pelamar_id',$getPelamarID)
					//->update(['FinalApprove' => '1']);
					
					CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"karyawan Berhasil disetujui bisa melanjutkan step selanjutnya!","info");
				}
				else
				{
					return false;
				}

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


		public function laporan_interview($id)
		{
			$data= DB::table('hrdt200_interview as interview')
							->select([
								'pelamar1.NamaPelamar as NamaPelamar',
								'pelamar1.TempatLahir as TempatLahir',
								'pelamar1.TanggalLahir as TanggalLahir',
								'pelamar1.Agama as Agama',
								'jabatan.name as name',
								'pelamar1.Alamat as Alamat',
								'pelamar1.TelpHp as TelpHp',
								'Status.StatusNikah as StatusNikah',
								'pelamar1.Email as Email',
								DB::raw('CASE WHEN JenisKelamin = 0 THEN "Perempuan" ELSE "Laki-Laki" END AS JenisKelamin')
								
							])
							->join('hrde100_pelamar AS pelamar1','pelamar1.id','=','interview.Pelamar_id')
							->join('cms_privileges AS jabatan','jabatan.id','=','pelamar1.Jabatan_id')
							->leftjoin('hrdm105_statusnikah as Status','Status.id','=','pelamar1.StatusNikah_id')
							->where('interview.id','=',$id)
							->get();

			  
			$generatePDF = PDF::loadView('exports.PrintLaporanInterview',array('data'=>$data))->setPaper('a4','potrait'); 
			return $generatePDF->stream();

		}

public function penilaian_praktik($id)
		{
			$data2= DB::table('hrdt200_interview as interview')
							->select([
								'pelamar1.NamaPelamar as NamaPelamar',
								'pelamar1.TempatLahir as TempatLahir',
								'pelamar1.TanggalLahir as TanggalLahir',
								'pelamar1.Agama as Agama',
								'jabatan.name as name',
								'pelamar1.Alamat as Alamat',
								'pelamar1.TelpHp as TelpHp',
								'Status.StatusNikah as StatusNikah',
								'pelamar1.Email as Email',
								DB::raw('CASE WHEN JenisKelamin = 0 THEN "Perempuan" ELSE "Laki-Laki" END AS JenisKelamin')
								
							])
							->join('hrde100_pelamar AS pelamar1','pelamar1.id','=','interview.Pelamar_id')
							->join('cms_privileges AS jabatan','jabatan.id','=','pelamar1.Jabatan_id')
							->leftjoin('hrdm105_statusnikah as Status','Status.id','=','pelamar1.StatusNikah_id')
							->where('interview.id','=',$id)
							->get();

			  
			$generatePDF = PDF::loadView('exports.PrintPenilaianPraktik',array('data2'=>$data2))->setPaper('a4','potrait'); 
			return $generatePDF->stream();

		}


	}