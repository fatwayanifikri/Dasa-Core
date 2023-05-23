<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;
  

	class AdminAbsensiMonitoringController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "t202_absensi";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"EmployeeName","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Absen Masuk","name"=>"absen_masuk"];
			// $this->col[] = ["label"=>"Absen Istirahat","name"=>"absen_istirahat"];
			$this->col[] = ["label"=>"Absen Pulang","name"=>"absen_pulang"];
			$this->col[] = ["label"=>"Absen Lembur","name"=>"mulai_lembur"];
			$this->col[] = ["label"=>"Selesai Lembur","name"=>"selesai_lembur"];
			# END COLUMNS DO NOT REMOVE THIS LINE

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

			$getNama=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('name');

			$DeptID=DB::table('hrde200_employee')
			->where('id','=',$EmpID)
			->value('Departement_id');

			Carbon::now()->timezone('Asia/Jakarta');
	        $datestart = Carbon::now();
	       

			#tambahan 
			$ResultID = DB::select('select uuid_short() as id');
			$nilai='12500';

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'hidden','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'hrde200_employee,EmployeeName','value'=>$EmpID,'readonly'=>true];
			$this->form[] = ['label'=>'EmployeeName','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>$getNama,'readonly'=>true];
			$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName','value'=>$getUnitID,'readonly'=>true];
			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_privileges,name','value'=>$DeptID,'readonly'=>true];
            

			$this->form[] = ['label'=>'Absen Masuk','name'=>'absen_masuk','type'=>'hidden','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10','value'=>$datestart];
			$this->form[] = ['label'=>'Keterlambatan Masuk','name'=>'keterlambatan_masuk','type'=>'hidden','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Absen Istirahat','name'=>'absen_istirahat','type'=>'hidden','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterlambatan Istirahat','name'=>'keterlambatan_istirahat','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Absen Pulang','name'=>'absen_pulang','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'Employee,id'];
			//$this->form[] = ['label'=>'EmployeeName','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'Unit,id'];
			//$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'Jabatan,id'];
			//$this->form[] = ['label'=>'Absen Masuk','name'=>'absen_masuk','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Keterlambatan Masuk','name'=>'keterlambatan_masuk','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Absen Istirahat','name'=>'absen_istirahat','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Keterlambatan Istirahat','name'=>'keterlambatan_istirahat','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Absen Pulang','name'=>'absen_pulang','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
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
	        // $this->addaction[] = ['label'=>'Absen Istirahat','name'=>'istirahat','url'=>('istirahat').'/[id]','icon'=>'fa fa-check','color'=>'warning'];
	        // $this->addaction[] = ['label'=>'Absen Pulang','name'=>'pulang','url'=>('pulang').'/[id]','icon'=>'fa fa-check','color'=>'success'];


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
	        $this->index_button[] =  ['label'=>'Absen Masuk','name'=>'pulang','url'=>('Absensi_Karyawan'),'icon'=>'fa fa-check','color'=>'success'];



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
	        $this->script_js = array();



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
	        // $this->post_index_html = '<meta http-equiv="refresh" content="5">';
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
			//dd($getJabatan);
			$query
			->where('t202_absensi.mulai_lembur','<>',null);
	            
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

//---------------------------------------------------------------------//
//-----------------------------ABSEN MASUK-----------------------------//
//---------------------------------------------------------------------//

public function masuk($id){

$companyID=CRUDBooster::myCompanyID();
			$getUnitID = CRUDBooster::myUnitIDKeep();
			$ResultID = DB::select('select uuid_short() as id');
			$getJabatan=Crudbooster::myPrivilegeId();
			$EmployeeID=Crudbooster::myId();
			$EmpID=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('Employee_id');

			$getNama=DB::table('cms_users')
					->where('id','=',$EmployeeID)
					->value('name');

			$DeptID=DB::table('hrde200_employee')
			->where('id','=',$EmpID)
			->value('Departement_id');

			Carbon::now()->timezone('Asia/Jakarta');
			$datenow = Carbon::now();
	        $starttime = Carbon::now()->format('H:i:s');
			$ResultID = DB::select('select uuid_short() as id');
		
      //input data ke dalam table absen
          DB::table('t202_absensi')->insert(
          array(
            'Employee_id'   =>  $EmpID,
            'EmployeeName'   =>  $getNama,
            'Unit_id'   =>  $getUnitID,
            'Jabatan_id'   =>  $getJabatan,
            'tanggal_absen'   =>  $datenow,
            'absen_masuk'   =>  $starttime
        )
      );

      //redirect ke fungsi telat_masuk
          redirect('admin/telat_masuk/'.$id)->send();
}

public function telat_masuk($id){

	        $telat_masuk=DB::table('t202_absensi')
					   ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					   ->value('absen_masuk');
					$telat_masukjam=strtotime($telat_masuk);//konversi ke string,data yang dihasilkan berbentuk jumlah detik	

			    $get_jam_masuk=DB::table('t203_jamabsensi')
					     ->where('id', 2)
					     ->value('waktu');
					$get_jam_masukjam=strtotime($get_jam_masuk);//konversi ke string,data yang dihasilkan berbentuk jumlah detik	

           $hitung_telat = $telat_masukjam - $get_jam_masukjam; // jam saat user absen dikurang jadwal absen
           $hitung_menit = floor($hitung_telat / 60 );//floor berfungsi melipatkan angka desimal//konversi kemenit

          DB::table('t202_absensi')
		      ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
          ->update(['keterlambatan_masuk'=>$hitung_menit]);

          CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Absen Masuk Berhasil!","success");
}

//---------------------------------------------------------------------//
//---------------------------ABSEN ISTIRAHAT---------------------------//
//---------------------------------------------------------------------//

 public function istirahat($id){

Carbon::now()->timezone('Asia/Jakarta');
$breaktime = Carbon::now();

          DB::table('t202_absensi')
		      ->where('id','=',$id)
          ->update(['absen_istirahat'=>$breaktime]);
          redirect('admin/telat_istirahat/'.$id)->send();
}

public function telat_istirahat($id){

	        $telat_istirahat=DB::table('t202_absensi')
					   ->where('id', $id)                        //ambil data jam istirahat yang barusan diinput
					   ->value('absen_istirahat');
					$telat_istirahatjam=strtotime($telat_istirahat);	

			    $get_istirahat=DB::table('t203_jamabsensi')
					     ->where('id', 3)                        //ambil data jam dari table jamabsensi
					     ->value('waktu');                
					$get_jam_istirahat=strtotime($get_istirahat);

           $hitung_telat = $telat_istirahatjam - $get_jam_istirahat; // jam saat user absen dikurang jadwal absen
           $hitung_menit = floor($hitung_telat / 60 ); //konversi kemenit

          DB::table('t202_absensi')
		      ->where('id', $id)
          ->update(['keterlambatan_istirahat'=>$hitung_menit]);

          CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Absen Istirahat Berhasil!","success");
}


//---------------------------------------------------------------------//
//-----------------------------ABSEN PULANG----------------------------//
//---------------------------------------------------------------------//

public function pulang($id){

Carbon::now()->timezone('Asia/Jakarta');
$endtime = Carbon::now();

           DB::table('t202_absensi')
		      ->where('id','=',$id)
          ->update(['absen_pulang'=>$endtime]);
          redirect('admin/kecepatan_pulang/'.$id)->send();
}

public function kecepatan_pulang($id){

	        $kecepetan_pulang=DB::table('t202_absensi')
					   ->where('id', $id)                    //ambil data jam pulang yang barusan diinput
					   ->value('absen_pulang');
					$kecepetan_pulang_jam=strtotime($kecepetan_pulang);

			    $get_pulang=DB::table('t203_jamabsensi')
					     ->where('id', 4)                    //ambil data jam dari table jamabsensi
					     ->value('waktu');
					$get_jam_pulang=strtotime($get_pulang);

           $hitung_telat = $get_jam_pulang - $kecepetan_pulang_jam; // jadwal pulang dikurang jam saat user absen pulang
           $hitung_menit = floor($hitung_telat / 60 ); //konversi kemenit

          DB::table('t202_absensi')
		      ->where('id', $id)
          ->update(['kecepatan_pulang'=>$hitung_menit]);

          CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Absen Pulang Berhasil!","success");
}

//--------------------JIKA KECEPATAN PULANG MINUS, MAKA LEMBUR(LEBIH DARI JAM PULANG)-----------------//

	}