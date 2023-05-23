<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Storage;
	use Validator;
	use Hash;
	use App\Models\hrde100_Pelamar;
	use App\Models\hrdt200_Interview;
	use App\Models\hrde200_employee;
	use App\Models\hrde201_employeeidentity;
	use App\Models\hrde204_employeestatus;
	use Carbon\Carbon;

	class AdminEmployeeCustomController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "10";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "hrde200_employee";
			# END CONFIGURATION DO NOT REMOVE THIS LINE
            


			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"NPK","name"=>"NPK"];
			$this->col[] = ["label"=>"Nama Karyawan","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Perusahaan","name"=>"Company_id","join"=>"hrdm100_company,CompanyName"];
			// $this->col[] = ["label"=>"Departement","name"=>"Departement_id","join"=>"hrdm102_departement,DepartementName"];
			$this->col[] = ["label"=>"Jabatan","name"=>"Jabatan_id","join"=>"cms_privileges,name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			//$this->form[] = ['label'=>'Pelamar Id','name'=>'Pelamar_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrde100_pelamar,NamaPelamar'];
			//ganti yg atas
			//$this->form[] = ['label'=>'Pelamar Id','name'=>'Pelamar_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable_where'=>'isApproved != 0','datatable'=>'hrde204_employeestatus,EmployeeStatus_id'];
			$this->form[] = ['label'=>'NPK','name'=>'NPK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Karyawan','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			$this->form[] = ['label'=>'Level','name'=>'Level_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm103_level,LevelName'];
			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName'];
			$this->form[] = ['label'=>'Perusahaan','name'=>'Company_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm100_company,CompanyName'];
			$this->form[] = ['label'=>'Departemen','name'=>'Departement_id','type'=>'select2','width'=>'col-sm-10','datatable'=>'hrdm102_departement,DepartementName'];
			$this->form[] = ['label'=>'Tempat Lahir','name'=>'TempatLahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Lahir','name'=>'TanggalLahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Kelamin','name'=>'JenisKelamin','type'=>'radio','dataenum'=>'1|Laki-laki;0|Perempuan'];
			$this->form[] = ['label'=>'Status Nikah','name'=>'StatusNikah_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm105_statusnikah,StatusNikah'];
			
			$this->form[] = ['label'=>'Hired Date','name'=>'HiredDate','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Alamat Rumah','name'=>'AlamatRumah','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Telp Rumah','name'=>'TelpRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Telp Handphone','name'=>'TelpHp','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Pelamar Id","name"=>"Pelamar_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Pelamar,id"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Level Id","name"=>"Level_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Level,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Company Id","name"=>"Company_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Company,id"];
			//$this->form[] = ["label"=>"Departement Id","name"=>"Departement_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"Departement,id"];
			//$this->form[] = ["label"=>"NPK","name"=>"NPK","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"EmployeeName","name"=>"EmployeeName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TempatLahir","name"=>"TempatLahir","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TanggalLahir","name"=>"TanggalLahir","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"JenisKelamin","name"=>"JenisKelamin","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"StatusNikah Id","name"=>"StatusNikah_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"StatusNikah,id"];
			//$this->form[] = ["label"=>"HiredDate","name"=>"HiredDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"AlamatRumah","name"=>"AlamatRumah","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
			$this->addaction[] = ["label" =>"Resign",'url'=>('../admin/p103_resignemployee/add').'/[id]'.'/[Unit_id]'.'/[Jabatan_id]','icon'=>'fa fa-user','color'=>'warning'];
			$this->addaction[] = ["label" =>"Mutasi",'url'=>('../admin/Mutasi%20Karyawan/add').'/[id]'.'/[Unit_id]'.'/[Jabatan_id]','icon'=>'fa fa-user','color'=>'primary'];

			$this->addaction[] = [
				"icon" =>"fa fa-pencil",
				"name" =>"Edit_Karyawan",
				"url" => CRUDBooster::mainpath('step1').'/[id]', 
				"color" => "success"
			];

			$this->addaction[] = ['url'=>('employee_gotodump').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];


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
			$this->script_js = null;


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

		public function getAdd() 
		{
			$module = CRUDBooster::getCurrentModule();

			if (! CRUDBooster::isView() && $this->global_privilege == false) {
				CRUDBooster::insertLog(trans('crudbooster.log_try_view', ['module' => $module->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}

			return redirect()->route("AdminEmployeeCustomControllerGetStep1");
		}

		public function getJabatan()
		{
			$pk = CRUDBooster::findPrimaryKey('cms_privileges');
			$jabatan = DB::table('cms_privileges')
					->select('id','name')
					->orderBy($pk,'ASC')
					->get();
			return $jabatan;
			
		}
		
		
		public function dataModalPelamar()
		{
			//mengunakan metode modeling 
			//  $result = hrde100_pelamar::where('FinalApprove','=','1')
			//  						->orderBy('id','DESC')
			//  						->paginate(10);
			//---
			 $result=DB::table('hrde100_pelamar')
			 ->join('hrde204_employeestatus','hrde100_pelamar.id','=','hrde204_employeestatus.Pelamar_id')
			 ->where('hrde204_employeestatus.isApproved','=','0')
		     ->orderBy('hrde100_pelamar.id','DESC')
			 ->paginate(10);

			if (Request::get('q')){
				$result->where('hrde100_pelamar.NamaPelamar','like','%'.Request::get('q').'%');
			}
			return $result;	
		}
		
		public function getListPelamar()
		{
			    $result = hrde100_pelamar::where('FinalApprove','=','1')
			  							->orderBy('id','DESC')
			   							->get();
			//-----versi 2
		//	   $result=DB::table('hrde100_pelamar')
				// $result=hrde100_pelamar::
			   	// 	join('hrde204_employeestatus','hrde100_pelamar.id','=','hrde204_employeestatus.Pelamar_id')
			   	// 	->where('hrde204_employeestatus.isApproved','=','0')
			  	// 	->orderBy('hrde100_pelamar.id','DESC')
			  	// 	->get();

			foreach($result as $pelamar ){
				$row = array();
				$row[] = $pelamar->id;
				$row[] = $pelamar->NamaPelamar;
				$row[] = $pelamar->TempatLahir;
				$row[] = $pelamar->TanggalLahir;
				$row[] = "<a onclick='getIDPelamar(\"".$pelamar->id."\")' class='btn btn-primary'><i class='fa fa-check-circle'></i>Pilih</a>";
				$data[] = $row;
			}
			$output = array("data" => $data);
			
			return response()->json($output);		
		}

		public function selectPelamar($Pelamar) 
		{
			$dataPelamar = DB::table('hrde100_pelamar as pelamar')
							->select([
										'pelamar.id as id',
										'pelamar.NamaPelamar as NamaPelamar',
										'pelamar.TempatLahir as TempatLahir',
										'pelamar.TanggalLahir as TanggalLahir',
										'pelamar.JenisKelamin as JenisKelamin',
										'pelamar.StatusNikah_id as StatusNikah_id',
										'pelamar.Alamat as Alamat',
										'pelamar.TelpRumah as TelpRumah',
										'pelamar.TelpHP as TelpHp',
										'interview.Unit_id as Unit_id',
										'interview.Jabatan_id as Jabatan_id',
										'interview.Level_id as Level_id',
										'interview.Company_id as Company_id',
										'interview.Departement_id as Departement_id'

							])
							->join('hrdt200_interview as interview','interview.Pelamar_id','=','Pelamar.id')
							->where('pelamar.id','=',$Pelamar)
							->first();
						
			echo json_encode($dataPelamar);
			// $interviewToPelamar = hrdt200_interview::with(['pelamar'])->where('id','=',$id)->first();
			// echo json_encode($interviewToPelamar);
			//percobaan yang belom bisa
			// $dataPelamar = hrde100_pelamar::with('interview')->get();
			// echo json_encode($dataPelamar);
			// //yang bisa
			//   $dataPelamar = hrde100_pelamar::find($id);
			//   echo json_encode($dataPelamar);
		}

	
		public function getStep1($id = 0) 
		{	
			$this->cbLoader();
		 	$url = url()->current();
			
			$row = DB::table('hrde200_employee')->where('id','=',$id)->first();
			
			$columns_alias = explode(',','ID,Nama Pelamar, Tempat Lahir, Tanggal Lahir,Action');
			$jabatan = CRUDBooster::getJabatan();
			$level = CRUDBooster::getLevel();
			$unit = CRUDBooster::getUnit();
			$company = CRUDBooster::getPerusahaan();
			$pelamar = $this->dataModalPelamar();
			$departement = CRUDBooster::getDepartement();
			return view("karyawan.step1",
						['jabatan'=>$jabatan,
						 'level'=>$level,
						 'unit'=>$unit,
						 'company'=>$company,
						 'column'=>$columns_alias,
						 'pelamar'=>$pelamar,
						 'departement'=>$departement,
						 'url'=>$url,
						 'row'=>$row,
						 'id'=>$id,
						 ]);

		}

		public function postStep1(Request $request)
		{
			$this->cbLoader();
			$module = CRUDBooster::getCurrentModule();
			if (! CRUDBooster::isView() && $this->global_privilege == false) {
				CRUDBooster::insertLog(trans('crudbooster.log_try_view', ['module' => $module->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}

			return $this->ProcessSave($request);
			
			
		}

		public function ProcessSave($Request)
		{
			$GenerateUUID = DB::select('select uuid_short() as id');
			$UUID = $GenerateUUID[0]->id;
			
			$id = Request::get('id');
			
			if($id == 0)
			{
				DB::table('hrde200_employee')->insert([
					'id' => $UUID,
					'Pelamar_id' => Request::get('Pelamar_id'),
					'Jabatan_id' => Request::get('Jabatan_id'),
					'Level_id' => Request::get('Level_id'),
					'Unit_id' => Request::get('Unit_id'),
					'Company_id' => Request::get('Company_id'),
					'Departement_id' => Request::get('Departement_id'),
					'NPK' => Request::get('NPK'),
					'EmployeeName' => Request::get('EmployeeName'),
					'TempatLahir' => Request::get('TempatLahir'),
					'TanggalLahir' => Request::get('TanggalLahir'),
					'StatusNikah_id' => Request::get('StatusNikah_id'),
					'JenisKelamin' => Request::get('JenisKelamin'),
					'HiredDate' => Request::get('HiredDate'),
					'AlamatRumah' => Request::get('AlamatRumah'),
					'TelpRumah' => Request::get('TelpRumah'),
					'TelpHp' => Request::get('TelpHp'),
					'Keterangan' => Request::get('Keterangan'),
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => CRUDBooster::myId()
					//

				]);

				//tambahan utk input newcomer
				//$idn = Request::get('id');
					{
					DB::table('p102_newcomer')->insert([
						//'id'=> $id,
						'Employee_id' => $UUID,
						'EmployeeName' => Request::get('EmployeeName'),
						'Privileges_id' => Request::get('Jabatan_id'),
						'Unit_id' => Request::get('Unit_id'),
						'TanggalMasuk' => Request::get('HiredDate'),
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => CRUDBooster::myId()
					]);
				}
				//end new comer
				//update table hrde204_employeestatus
				$Pelamarid = Request::get('Pelamar_id');
				
				{
					DB::table('hrde204_employeestatus')->where('Pelamar_id',$Pelamarid)->update([
						'Employee_id'=>$UUID
					]);
				}
				//CRUDBooster::insertLog(trans("crudbooster.log_add", ['name' =>'Step 1 Berhasil', 'module' => CRUDBooster::getCurrentModule()->name]));
				return redirect(Route("AdminEmployeeCustomControllerGetStep2", ["id" => $UUID]));
			}

			else
			{
				DB::table('hrde200_employee')->where('id',$id)->update([
					'Pelamar_id' => Request::get('Pelamar_id'),
					'Jabatan_id' => Request::get('Jabatan_id'),
					'Level_id' => Request::get('Level_id'),
					'Unit_id' => Request::get('Unit_id'),
					'Company_id' => Request::get('Company_id'),
					'Departement_id' => Request::get('Departement_id'),
					'NPK' => Request::get('NPK'),
					'EmployeeName' => Request::get('EmployeeName'),
					'TempatLahir' => Request::get('TempatLahir'),
					'TanggalLahir' => Request::get('TanggalLahir'),
					'StatusNikah_id' => Request::get('StatusNikah_id'),
					'JenisKelamin' => Request::get('JenisKelamin'),
					'HiredDate' => Request::get('HiredDate'),
					'AlamatRumah' => Request::get('AlamatRumah'),
					'TelpRumah' => Request::get('TelpRumah'),
					'TelpHp' => Request::get('TelpHp'),
					'Keterangan' => Request::get('Keterangan'),
					'updated_at' => date('Y-m-d H:i:s'),
					'updated_by' => CRUDBooster::myId()
					
				]);

				return redirect(Route("AdminEmployeeCustomControllerGetStep2", ["id" => $id]));
			}

		}

		public function dtIdentitas($id)
		{
			$identitas = DB::table('hrde201_employeeidentity as idn')
							->select([
										'idn.id as id',
										'idn.Employee_id as Employee_id',
										'tp.NamaID as NamaIdentitas',
										'idn.NoID',
										'idn.MasaBerlaku as MasaBerlaku'
							])
							->join('hrdm106_tipeidentitas as tp','tp.id','=','idn.TipeIdentitas_id')
							->orderBy('idn.id','ASC')
							->where('Employee_id',$id)->get();
			
			$data = array();
			foreach ($identitas as $idn)
			{
				$row = array();
				$row[] = str_replace(',','',$idn->Employee_id);
				$row[] = $idn->NamaIdentitas;
				$row[] = $idn->NoID;
				$row[] = $idn->MasaBerlaku;
				$row[] = '<a href="#panel-form-identitasdiri" onclick="editIdentitas('.$idn->id.')" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void" onclick="deleteRowidentitasdiri('.$idn->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>';
				$data[] = $row;
			}

			$output = array("data" => $data);
			return response()->json($output);
		}

		public function dtPendidikan($id) 
		{
			$pendidikan = DB::table('hrde202_employeeeducation as a')
						->select([
								'a.id as id',
								'a.Employee_id as Employee_id',
								'b.EducationName as LevelPendidikan',
								'a.EducationName as NamaInstasi',
								'a.Form as From',
								'a.To as To',
								'a.NilaiAkhir as Nilai'

						])
						->join('hrdm107_educationlevel as b','b.id','=','a.EducationLevel_id')
						->orderBy('a.id','ASC')
						->where('a.Employee_id',$id)->get();

			$data = array();
			foreach ($pendidikan as $pd)
			{
				$row = array();
				$row[] = str_replace(',','',$pd->Employee_id);
				$row[] = $pd->LevelPendidikan;
				$row[] = $pd->NamaInstasi;
				$row[] = $pd->From;
				$row[] = $pd->To;
				$row[] = $pd->Nilai;
				$row[] ='<a href="javascript:void" onclick="editPendidikan('.$pd->id.')" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void" onclick="deletePendidikan('.$pd->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>';
				$data[] = $row;
			}
			$hasil = array("data" => $data);
			return response()->json($hasil);
		}
		//lanjutstep2 butuh id $id, kalau mau langsung lewat di matiin dulu idnya
		public function getStep2($id)
		{ 
			
			$this->cbLoader();
			$module = CRUDBooster::getCurrentModule();
			if (! CRUDBooster::isView() && $this->global_privilege == false ){
				CRUDBooster::InsertLog(trans('crudbooster.log_try_view', ['module' => $module->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}

			$columns = explode(',','ID,Tipe Identitas, Nomer Identitas, Masa Berlaku, Action');
			$colPendidikan = explode(',','ID, Level Pendidikan, Nama Instansi,Tanggal Mulai, Tanggal Selesai, Nilai Akhir, Action');
			$identitas = CRUDBooster::getIdentitas();
			$pendidikan = CRUDBooster::getEducation();
			return view('karyawan.step2',[
										 'identitas'=>$identitas,
										 'pendidikan'=>$pendidikan, 
										 'columns'=>$columns,
										 'colPendidikan'=>$colPendidikan,
										 'id'=>$id
			]);
		}
		
		public function saveIdentitas(Request $request)
		{
			$identitas = DB::table('hrde201_employeeidentity')->insert([
					'Employee_id' => Request::get('Employee_id'),
					'TipeIdentitas_id' => Request::get('TipeIdentitas_id'),
					'NoID' => Request::get('NoID'),
					'MasaBerlaku'=> Request::get('MasaBerlaku'),
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => CRUDBooster::myId()
			]);

			return response()->json($identitas);
		}

		public function DeleteIdentitas($id)
		{
			$deleteIdentitas = hrde201_employeeidentity::where('id',$id)->delete();
			return response()->json($deleteIdentitas);

		}
		public function editIdentitas($id)
		{
			$identitas=hrde201_employeeidentity::find($id);
			echo json_encode($identitas);	
		}

		public function updateIdentitas(request $request, $idDetail)
		{
			$identitas = DB::table('hrde201_employeeidentity')->where('id',$idDetail)
			->update([
				'TipeIdentitas_id' => Request::get('TipeIdentitas_id'),
				'NoID' => Request::get('NoID'),
				'MasaBerlaku'=> Request::get('MasaBerlaku'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => CRUDBooster::myId()
				]);

				return response()->json($identitas);
		}

		public function savePendidikan(Request $request)
		{
			$pendidikan = DB::table('hrde202_employeeeducation')->insert([
				'Employee_id' => Request::get('Employee_id_pendidikan'),
				'EducationLevel_id' => Request::get('EducationLevel_id'),
				'EducationName'=> Request::get('EducationName'),
				'Form' => date("Y-m-d", strtotime(Request::get('Form'))),
				'To' => date("Y-m-d", strtotime(Request::get('To'))),
				'NilaiAkhir' => Request::get('NilaiAkhir'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => CRUDBooster::myId()
			]);

			return response()->json($pendidikan);
		}

		public function deletePendidikan($id)
		{
			$deletePendidikan = DB::table('hrde202_employeeeducation')->where('id',$id)->delete();
			return response()->json($deletePendidikan);
		}
		public function editPendidikan($id)
		{
			$pendidikan = DB::table('hrde202_employeeeducation')->find($id);
			echo json_encode($pendidikan);
		}
		public function updatePendidikan(Request $request,$idPendidikan)
		{
			$pendidikan = DB::table('hrde202_employeeeducation')->where('id',$idPendidikan)
			->update([
				'EducationLevel_id' => Request::get('EducationLevel_id'),
				'EducationName'=> Request::get('EducationName'),
				'Form' => date("Y-m-d", strtotime(Request::get('Form'))),
				'To' => date("Y-m-d", strtotime(Request::get('To'))),
				'NilaiAkhir' => Request::get('NilaiAkhir'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => CRUDBooster::myId()
			]);

			return response()->json($pendidikan);
		}
		public function getStep3($id)
		{
			$this->cbLoader();
			$module = CRUDBooster::getCurrentModule();
			if (! CRUDBooster::isView() && $this->global_privilege == false ){
				CRUDBooster::InsertLog(trans('crudbooster.log_try_view', ['module' => $module->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}

			$columns = explode(',','ID, Status Karyawan, Tanggal Awal Masuk, Tanggal Selesai, Status PKWT, Action, Print');
			$statusKaryawan = CRUDBooster::getStatusKaryawan();
			
			return view('karyawan.step3',[
											'id'=>$id,
											'columns'=>$columns,
											'statusKaryawan'=>$statusKaryawan
				]);
		}

		public function dtPkwt($id)
		{
			$pkwt = DB::table('hrde204_employeestatus as es')
					->select([
							'es.id as id',
							'es.Employee_id as Employee_id',
							'esm.StatusName as StatusName',
							'es.Start as Start',
							'es.End as End',
							//'es.isApproved as isApproved',
							DB::raw('(CASE WHEN es.isApproved = 0 THEN "Not Approved" ELSE "Approved" END) as isApproved')

					])
					->join('hrdm108_employeestatus as esm','esm.id','=','es.EmployeeStatus_id')
					->orderBy('es.id','ASC')
					->where('es.Employee_id',$id)->get();
			
			$data = array();
			foreach ($pkwt as $wt)
			{

				$row = array();
				$row[] = str_replace(',','',$wt->Employee_id);
				$row[] = $wt->StatusName;
				$row[] = $wt->Start;
				$row[] = $wt->End;
				$row[] = $wt->isApproved;
				$row[] = '<a href="javascript:void" onclick="editPkwt('.$wt->id.')" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void" onclick="deletePkwt('.$wt->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>';
				$row[] = '<a href="javascript:void" onclick="cetakPkwt('.$wt->Employee_id.')" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a>';
				$data [] = $row;
			}
			
			$hasilAkhir = array("data"=> $data);
			return response()->json($hasilAkhir);
		}

		public function savePkwt(Request $request)
		{
			$pkwt = DB::table('hrde204_employeestatus')->insert([
				'Employee_id' => Request::get('Employee_id'),
				'EmployeeStatus_id' => Request::get('EmployeeStatus_id'),
				'Start' => date("Y-m-d", strtotime(Request::get('Start'))),
				'End' => date("Y-m-d", strtotime(Request::get('End'))),
				'IsApproved' => '0',
				'created_at' => date('y-m-d H:i:s'),
				'created_by' => CRUDBooster::myId()
			]);

			return response()->json($pkwt);
		}

		public function editPkwt($id)
		{
			$pkwt = DB::table('hrde204_employeestatus')->find($id);
			echo json_encode($pkwt);
		}

		public function deletePkwt($id)
		{
			$deletePkwt = DB::table('hrde204_employeestatus')->where('id',$id)->delete();
			return response()->json($deletePkwt);
		}

		public function updatePkwt($idPkwt)
		{
			$pkwt = DB::table('hrde204_employeestatus')->where('id',$idPkwt)
			->update([
				'EmployeeStatus_id' => Request::get('EmployeeStatus_id'),
				'Start' => date("Y-m-d", strtotime(Request::get('Start'))),
				'End' => date("Y-m-d", strtotime(Request::get('End'))),
				'IsApproved' => '0',
				'created_at' => date('y-m-d H:i:s'),
				'created_by' => CRUDBooster::myId()
			]);

			return response()->json($pendidikan);
		}

		public function pkwtPdf($idEmployee)
		{
			$dataPkwt = DB::table('hrde200_employee as emp')
				->select([
					'emp.EmployeeName as EmployeeeName',
					'emp.TempatLahir as TempatLahir',
					'emp.TanggalLahir as TanggalLahir',
					'idn.NoID as NoID',
					'emp.AlamatRumah as AlamatRumah',
					'sts.Start as Start',
					'sts.End as End',
					'pr.Name as NamaJabatan',
					'oo.DepartementName as DepartementName',
					'bb.UnitName as UnitName'
					//'jab.Name as Jabatan'

				])
					->leftjoin('cms_privileges as pr','pr.id','=','emp.Jabatan_id')
					->leftjoin('hrdm102_departement as oo','oo.id','=','emp.Departement_id')
					->leftjoin('hrdm101_unit as bb','bb.id','=','emp.Unit_id')
					->leftjoin('hrde204_employeestatus AS sts','sts.Employee_id','=','sts.id')
					->leftjoin('hrde201_employeeidentity AS idn','idn.Employee_id','=','emp.id')
					//->leftjoin('cms_privileges AS jab','jab.id','=','emp.Jabatan_id')
					->where('emp.id','=',$EmployeeID)
					->take(1)
					->get();

				

				$generatePDF = PDF::loadView('pdf.print_pkwt', array('dataPkwt'=>$dataPkwt,'status'=>$status))->setPaper('a4','potrait');
				return $generatePDF->stream();
				
		}


		public function getStep4($id)
		{
			$this->cbLoader();
			$module = CRUDBooster::getCurrentModule();
			if (! CRUDBooster::isView() && $this->global_privilege == false ){
				CRUDBooster::InsertLog(trans('crudbooster.log_try_view', ['module' => $module->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}
			
			$karyawan = DB::table('hrde200_employee')->where('id','=',$id)->first();
			$idUser = DB::table('cms_users')->select('id')->where('Employee_id','=',$id)->value('id');
			$jabatan = CRUDBooster::getJabatan();
			$unit = CRUDBooster::getUnit();
			return view('karyawan.step4',[
				'id'=>$id,
				'jabatan' => $jabatan,
				'unit' => $unit,
				'karyawan' => $karyawan,
				'idUser' => $idUser
						]);
			
		}

		public function postStep4(Request $request)
		{
			$this->cbLoader();
			$module = CRUDBooster::getCurrentModule();
			if (! CRUDBooster::isView() && $this->global_privilege == false) {
				CRUDBooster::insertLog(trans('crudbooster.log_try_view', ['module' => $module->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}

			return $this->postStepFinish($request);
		}

		public function postStepFinish(Request $request)
		{
			$idUser = Request::get('id');
			$employee_id = Request::get('Employee_id');
			$name = Request::get('name');
			$email = Request::get('email');
			$photo = 'uploads/1/user/user1.jpg';
			$id_cms_privileges = Request::get('id_cms_privileges');
			$unit_id = Request::get('Unit_id');
			//makedefaultpassword
			$password = 'pesona480';
			$passwordHash = Hash::make($password);
			$created_at = date('y-m-d H:i:s');
			$created_by =  CRUDBooster::myId();
			
			//dd($idUser);
			if(is_null($idUser))
			{
				DB::table('cms_users')->insert([
				'name' => $name,
				'photo' => $photo,
				'email' => $email,
				'password'=>$passwordHash,
				'id_cms_privileges' => $id_cms_privileges,
				'Unit_id' => $unit_id,
				'created_at' => $created_at,
				'created_by' => $created_by
				]);	
				CRUDBooster::insertLog('insert data Account Karyawan',$name);
				return redirect(Route("AdminEmployeeCustomControllerGetIndex"))->with(['message' => 'Berhasil Terdaftar Menjadi Karyawan dan Account sudah bisa digunakan','message_type' => 'success']);
			}
			else
			{
				DB::table('cms_user')->where('id','=',$idUser)->update([
					'name'=> $name,
					'email'=>$email,
					'password'=>$passwordHash,
					'id_cms_privileges'=> $id_cms_privileges,
					'Unit_id' => $unit_id,
					'created_at' => $created_at,
					'created_by' => $created_by
				]);
				CRUDBooster::insertLog('Update data Account Karyawan',$name);
				return redirect(Route("AdminEmployeeCustomControllerGetIndex"))->with(['message' =>'Account Berhasil di Update','message_type' => 'success']);
				
			}
			
			
			
		}

		
		public function postStep2()
		{

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

        public function employee_gotodump($id){

	    $query = DB::table('hrde200_employee')
        ->select('Jabatan_id','Level_id','Unit_id','Company_id','Departement_id','NPK','EmployeeName','TempatLahir','TanggalLahir','JenisKelamin','StatusNikah_id','HiredDate','AlamatRumah','TelpRumah','TelpHp','Keterangan')
        ->where('id','=',$id)
        ->get();

        foreach($query as $records){ 

        DB::table('hrde205_employeedump')->insert(get_object_vars($records));}   
        redirect('admin/get_employeeID/'.$id)->send();
        }
        
        public function get_employeeID($id){

	    $getEmployee_id=DB::table('hrde200_employee')
					   ->where('id', $id)                   
					   ->value('id');
        Carbon::now()->timezone('Asia/Jakarta');
        $created_at = Carbon::now();
        
        DB::table('hrde205_employeedump')
		->where('id', \DB::raw("(select max(`id`) from hrde205_employeedump)"))
        ->update(['Employee_id'=>$getEmployee_id, 'created_at'=> $created_at]);
        redirect('admin/hapus_employee/'.$id)->send();
        }

        public function hapus_employee($id){

	    DB::table('hrde200_employee')->where('id','=',$id)->delete();
	    CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Data Berhasil Dihapus!","success");
        }





	}