<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Models\Printpkwt;
	use PDF;

	class AdminPkwtController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "hrde204_employeestatus";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			//$this->col[] = ["label"=>"Nama Karyawan","name"=>"Employee_id","join"=>"hrde200_employee,EmployeeName"];
			//ganti tabel dari employe (spt diatas) ke pelamar
			$this->col[]=["label"=>"Nama Karyawan","name"=>"Pelamar_id","join"=>"hrde100_pelamar,NamaPelamar"];
			$this->col[] = ["label"=>"Status","name"=>"EmployeeStatus_id","join"=>"hrdm108_employeestatus,StatusName"];
			$this->col[] = ["label"=>"Mulai","name"=>"Start"];
			$this->col[] = ["label"=>"Selesai","name"=>"End"];
			$this->col[] = ["label"=>"Approved","name"=>"isApproved"];
			$this->col[] = ["label"=>"Status PKWT","name"=>"isStatus","dataenum"=>'1|PKWT Baru; 2|PKWT Perpanjangan'];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			//$this->form[] = ['label'=>'Cms Users Id','name'=>'cms_users_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'NPK','name'=>'NPK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'EmployeeName','name'=>'Employee_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName'];
			//ganti tabel dari employe (spt diatas) ke pelamar
			$this->form[]=['label'=>'Nama Pelamar','name'=>'Pelamar_id','type'=>'select2','width'=>'col-sm-4','datatable'=>'hrde100_pelamar,NamaPelamar','datatable_where'=>'FinalApprove = 1'];
			$this->form[] = ['label'=>'Status Karyawan','name'=>'EmployeeStatus_id','type'=>'select2','width'=>'col-sm-4','datatable'=>'hrdm108_employeestatus,StatusName'];
			
			$this->form[] = ['label'=>'Start','name'=>'Start','type'=>'date','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			$this->form[] = ['label'=>'End','name'=>'End','type'=>'date','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			$this->form[] = ['label'=>'Persetujuan','name'=>'isApproved','type'=>'hidden','value'=>'0'];
			$this->form[] = ['label'=>'Status','name'=>'isStatus','type'=>'select2','width'=>'col-sm-4','dataenum'=>'1|PKWT Baru; 2|PKWT Perpanjangan'];
			$this->form[] = ['label'=>'No Identitas','name'=>'NoID','type'=>'text','width'=>'col-sm-4'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Employee Id","name"=>"Employee_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Employee,id"];
			//$this->form[] = ["label"=>"EmployeeStatus Id","name"=>"EmployeeStatus_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"EmployeeStatus,id"];
			//$this->form[] = ["label"=>"Start","name"=>"Start","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"End","name"=>"End","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
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
	        $this->addaction = array();
			// if(CRUDBooster::MyPrivilegeId()==4){
			// 	$this->addaction[] = ['label'=>'Process','url'=>CRUDBooster::mainpath('set-status/active/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
			// }
            
   //          elseif(CRUDBooster::MyPrivilegeId()==12){
			// 	$this->addaction[] = ['label'=>'Process','url'=>CRUDBooster::mainpath('set-status/active/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
			// }

			// elseif(CRUDBooster::MyPrivilegeId()==1){
			// 	$this->addaction[] = ['label'=>'Process','url'=>CRUDBooster::mainpath('set-status/active/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[isApproved] == 0"];
			// }

			///ini adalah code print PKWT, yang di munculkan di action
			$this->addaction[] =['label'=>'PKWT','url'=>('print_pkwt').'/[id]','icon'=>'fa fa-print','color'=>'info','showIf'=>"[isStatus] == 1"];

			///ini adalah code print Nota Dinas, yang di munculkan di action
			$this->addaction[] =['label'=>'Nota Dinas','url'=>('print_notadinas').'/[id]','icon'=>'fa fa-print','color'=>'warning','showIf'=>"[isStatus] == 1"];

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
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
			//Your code here
			if($column_index == 5)
			{
				if($column_value == 0 )
				{
					$column_value = 'Belum Di Setujui';
				}
				elseif($column_value == 1 )
				{
					$column_value = 'Setuju';
				}
				else
				{
					$column_value = 'Tidak Di Setujui';
				}

			}
			if($column_index==6)
			{
				if($column_value==1)
				{
					$column_value='PKWT Baru';
				}
				elseif($column_value==2)
				{
					$column_value='PKWT Perpanjangan';
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
			$config['content'] = "Ada PKWT Yang Harus diSetujui";
			$config['to'] = CRUDBooster::adminPath('pkwt/');
			$config['id_cms_users'] = [3];
			CRUDBooster::sendNotification($config);

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
		public function print_pkwt($id){
			
			$dataPkwt = DB::table('hrde100_pelamar as emp')
				->select([
					'emp.NamaPelamar as EmployeeeName',
					'emp.TempatLahir as TempatLahir',
					'emp.TanggalLahir as TanggalLahir',
					'sts.NoID as NoID',
					'jab.Name as Jabatan',
					'sts.Start as Start',
					'sts.End as End'

				])
				    ->leftjoin('hrde204_employeestatus AS sts','sts.Pelamar_id','=','sts.id')
					//->leftjoin('hrde201_employeeidentity AS idn','idn.Employee_id','=','emp.id')
					->leftjoin('cms_privileges AS jab','jab.id','=','emp.Jabatan_id')
					->where('emp.id','=',$id)
					->get();

				$generatePDF = PDF::loadView('pdf.print_pkwt', array('dataPkwt'=>$dataPkwt))->setPaper('a4','potrait');
				return $generatePDF->stream();
		}

		//By the way, you can still create your own method in here... :) 

		//-->code untuk ngeprint PKWT
		public function pkwtPdf($id)
		{
			//$get = DB::table('hrde204_employeestatus')->where('id',$id)->pluck('Employee_id');
				$PelamarID = DB::table('hrde204_employeestatus')->where('id',$id)->pluck('Pelamar_id');
				//dd($PelamarID);
				$status = DB::table('hrde204_employeeStatus as status')
				->select([
							'status.Start',
							'status.End',
							'status.NoID'
				])
				 ->where('status.Pelamar_id','=',$PelamarID)
				 ->latest('id')
				 ->take(1)
				 ->get();
				$dataPkwt = DB::table('hrde100_pelamar as emp')
				->select([
					'emp.NamaPelamar as EmployeeeName',
					'emp.TempatLahir as TempatLahir',
					'emp.TanggalLahir as TanggalLahir',
					'emp.Alamat as AlamatRumah',
					'sts.Start as Start',
					'sts.End as End',
					'sts.NoID as NoID',
					'pr.Name as NamaJabatan',
					'oo.DepartementName as DepartementName',
					'bb.UnitName as UnitName'
					//'jab.Name as Jabatan'

				])
					->leftjoin('cms_privileges as pr','pr.id','=','emp.Jabatan_id')
					->leftjoin('hrdt200_interview as int','int.Pelamar_id','=','emp.id')
					->leftjoin('hrdm102_departement as oo','oo.id','=','int.Departement_id')
					->leftjoin('hrdm101_unit as bb','bb.Company_id','=','int.Unit_id')
				//	->leftjoin('hrdm102_departement as oo','oo.id','=','emp.Departement_id')
				//	->leftjoin('hrdm101_unit as bb','bb.Company_id','=','emp.Unit_id')
					->leftjoin('hrde204_employeestatus AS sts','sts.Pelamar_id','=','sts.id')
				//	->leftjoin('hrde201_employeeidentity AS idn','idn.Employee_id','=','emp.id')
					
					//x->leftjoin('cms_privileges AS jab','jab.id','=','emp.Jabatan_id')
					->where('emp.id','=',$PelamarID)
					->take(1)
					->get();

				$generatePDF = PDF::loadView('pdf.print_pkwt', array('dataPkwt'=>$dataPkwt,'status'=>$status))->setPaper('a4','potrait');
				return $generatePDF->stream();
				
		}
		//akhiran code print PKWT

		//-->code untuk ngeprint Nota Dinas
		public function notadinasPdf($id)
		{
			//$PelamarID = DB::table('hrde204_employeestatus')->where('id',$id)->pluck('Employee_id');
			$PelamarID = DB::table('hrde204_employeestatus')->where('id',$id)->pluck('Pelamar_id');

			$tanggal = DB::table('hrde204_employeeStatus as tanggal')
				->select([
							'tanggal.Start',
							'tanggal.End'
				])
				 ->where('tanggal.Pelamar_id','=',$PelamarID)
				 ->latest('id')
				 ->take(1)
				 ->get();
			$dataNotadinas = DB::table('hrde200_employee as ee')
			->select([
				'ee.EmployeeName as EmployeeName',
				'ee.TempatLahir as TempatLahir',
				'ee.TanggalLahir as TanggalLahir',
				'ed.EducationName as EducationName',
				'ee.AlamatRumah as AlamatRumah',
				'tt.Start as Start',
				'tt.End as End',
				'ss.StatusName as StatusName',
				'jj.Name as name',
				'kk.UnitName as UnitName'
			])
			//tambahan
			->leftjoin('hrde100_pelamar as pl','pl.id','=','ee.Pelamar_id')

			//
			->leftjoin('hrde202_employeeeducation AS en','en.Employee_id','=','ee.id')
			->leftjoin('hrde204_employeestatus AS tt','tt.Pelamar_id','=','pl.id')
			->leftjoin('hrdm107_educationlevel AS ed','ed.id','=','en.EducationLevel_id')
			->leftjoin('hrdm108_employeestatus AS ss','ss.id','=','tt.EmployeeStatus_id')
			->leftjoin('cms_privileges AS jj','jj.id','=','ee.Jabatan_id')
			->leftjoin('hrdm101_unit AS kk','kk.id','=','tt.EmployeeStatus_id')
			->where('ee.Pelamar_id','=',$PelamarID)
			->take(1)
			->get();

			$generatePDF = PDF::loadView('pdf.print_notadinas', array('dataNotadinas'=>$dataNotadinas,'status'=>$status,'dongtai'=>$dongtai))->setPaper('a4','potrait');
			return $generatePDF->stream();

		}


		public function getSetStatus($status,$id) 
		{
			DB::table('hrde204_employeestatus')->where('id',$id)->update(['isApproved'=>'1']);
			
			//update status isApprovePKWT table pelamar (rusdi)
			$getIDPelamar=DB::table('hrde204_employeestatus')
				->select('Pelamar_id')
				->where('id',$id);

			DB::table('hrde100_pelamar')
			->where('id',$getIDPelamar)
			->insert(['isApprovePKWT'=>'1']);

			//This will redirect back and gives a message
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Request Karyawan Berhasil di Approve !","info");
		}


	}