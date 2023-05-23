<?php namespace App\Http\Controllers;

	use Session;
	use Illuminate\Http\Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;
  
	class AdminNewAbsenKaryawanController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "t112_absenlembur";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Departement Id","name"=>"Departement_id","join"=>"Departement,id"];
			$this->col[] = ["label"=>"Employee Id","name"=>"Employee_id","join"=>"Employee,id"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"Unit,id"];
			$this->col[] = ["label"=>"Company Id","name"=>"Company_id","join"=>"Company,id"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"Jabatan,id"];
			$this->col[] = ["label"=>"EmployeeName","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"StartTime","name"=>"StartTime"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Departement Id','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Departement,id'];
			$this->form[] = ['label'=>'Employee Id','name'=>'Employee_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Employee,id'];
			$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Unit,id'];
			$this->form[] = ['label'=>'Company Id','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Company,id'];
			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jabatan,id'];
			$this->form[] = ['label'=>'EmployeeName','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'StartTime','name'=>'StartTime','type'=>'time','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'EndTime','name'=>'EndTime','type'=>'time','validation'=>'required|date_format:H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'AmountMinute','name'=>'AmountMinute','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NomerVoucher','name'=>'NomerVoucher','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'JumlahVoucher','name'=>'JumlahVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NilaiVoucher','name'=>'NilaiVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Note','name'=>'Note','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsApproved','name'=>'isApproved','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsVoucher','name'=>'isVoucher','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
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
			//$this->form[] = ["label"=>"JumlahVoucher","name"=>"JumlahVoucher","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"NilaiVoucher","name"=>"NilaiVoucher","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Note","name"=>"Note","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"isApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsVoucher","name"=>"isVoucher","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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


//------------------CUSTOM VIEW------------------//
public function getIndex() {

 if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
  
   	
  $query = DB::table('hrde200_employee')
  ->get();
  $query2 = DB::table('t202_absensi')
  ->get();

   $data = [];
   $data['loga002_riwayatasset'] = 'Absen Karyawan';
   $data['result'] = $query;
   $data['value'] = $query2;
  

   $this->cbView('viewindex/custom_add_absensi',$data);
}

//---------------------------------------------------------------------//
//-----------------------------ABSEN MASUK-----------------------------//
//---------------------------------------------------------------------//

//-------INPUT ID KARYAWAN (DI FORM NAMA, ASLINYA ID)-------//

public function tambah()
{ 
	
	return view('masuk');
}

public function masuk(Request $request)
{
	// dd($request->all());
	DB::table('t202_absensi')
	 ->insert(['Employee_id' => $request->Employee_id]);

	 redirect('admin/tambahdatalain')->send();
 
}

//----------INPUT DATA LAIN2 ABSEN MASUK-------------//

public function tambahdatalain(){

	        $getemployeeid=DB::table('t202_absensi')
					     ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					     ->value('Employee_id');

			$getemployeename =DB::table('hrde200_employee')
					     ->where('id', $getemployeeid)
					     ->value('EmployeeName');

		    $getjabatan =DB::table('hrde200_employee')
					     ->where('id', $getemployeeid)
					     ->value('Jabatan_id');

		    $getunit =DB::table('hrde200_employee')
					     ->where('id', $getemployeeid)
					     ->value('Unit_id');

			Carbon::now()->timezone('Asia/Jakarta');
			$datenow = Carbon::now();
	        $starttime = Carbon::now()->format('H:i:s');

	       DB::table('t202_absensi')
	       ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
	       ->update(
          array(
            'EmployeeName'   =>  $getemployeename,
            'Unit_id'   =>  $getunit,
            'Jabatan_id'   =>  $getjabatan,
            'tanggal_absen'   =>  $datenow,
            'absen_masuk'   =>  $starttime
        )
      );
	redirect('admin/telat_masuk')->send();				
}

//-----------HITUNG JAM TELAT (MENIT)------------//

public function telat_masuk(){

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


//--------------------AlUR KERJA COMAND ISTIRAHAT-----------------------------
//- input data ke table absensi seperti input absen masuk
//- mengcopy jam masuk dan telat masuk istirahat dari data baru ke data lama (absen pagi)
//- menghapus data baru (absen istirahat)
//---------------------------------------------------------------------------------


//---------------------------------------------------------------------//
//-------------------------ABSEN KELUAR ISTIRAHAT----------------------//
//---------------------------------------------------------------------//

//----------INPUT DATA ISTIRAHAT------------//

public function keluaristirahat()
{ 
	
	return view('addjamistirahat');
}

public function addjamistirahat(Request $request)
{
	//dd($request->all());
	Carbon::now()->timezone('Asia/Jakarta');
	$datenow = Carbon::now();
    $breaktime = Carbon::now();

	 DB::table('t202_absensi')
	 ->insert(['Employee_id' => $request->Employee_id,
	 	        'tanggal_absen'   =>  $datenow,
	 	        'absen_istirahat' => $breaktime]);

	 redirect('admin/copykeluaristirahat')->send();
}


//----------COPY DATA BARU KE LAMA---------------//

public function copykeluaristirahat(){

	Carbon::now()->timezone('Asia/Jakarta');
	$datenow = Carbon::now();
    $breaktime = Carbon::now();

    $getid=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('Employee_id');

	$gettgl=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('tanggal_absen');

	$getbreak=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('absen_istirahat');

	$getbreaklate=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('keterlambatan_istirahat');

	DB::table('t202_absensi')
		   ->where('Employee_id', $getid)
		   ->where('tanggal_absen', $gettgl)
           ->update([
            'absen_istirahat' =>$getbreak,
           	'keterlambatan_istirahat'=>$getbreaklate
           ]);

redirect('admin/deletekeluaristirahat')->send();
	   
}

//------------DELETE DATA BARU-------------//

public function deletekeluaristirahat()
{
	
	DB::table('t202_absensi')
	->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
	->delete();

	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Absen Istirahat Berhasil!","success");
}


//---------------------------------------------------------------------//
//-------------------------ABSEN MASUK ISTIRAHAT-----------------------//
//---------------------------------------------------------------------//

//-------INPUT DATA ISTIRAHAT--------//

public function tambahistirahat()
{ 
	
	return view('masukistirahat');
}

public function masukistirahat(Request $request)
{
	//dd($request->all());
	Carbon::now()->timezone('Asia/Jakarta');
	$datenow = Carbon::now();
    $breaktime = Carbon::now();

	 DB::table('t202_absensi')
	 ->insert(['Employee_id' => $request->Employee_id,
	 	        'tanggal_absen'   =>  $datenow,
	 	       'masuk_istirahat' => $breaktime]);

	 redirect('admin/telat_istirahat')->send();
}


//---------HITUNG JAM TELAT ISTIRAHAT-----------//
public function telat_istirahat(){

	           $telat_istirahat=DB::table('t202_absensi')
					   ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))//ambil data jam istirahat yang barusan diinput
					   ->value('masuk_istirahat');
					$telat_istirahatjam=strtotime($telat_istirahat);	

			    $get_istirahat=DB::table('t203_jamabsensi')
					     ->where('id', 3)                        //ambil data jam dari table jamabsensi
					     ->value('waktu');                
					$get_jam_istirahat=strtotime($get_istirahat);

           $hitung_telat = $telat_istirahatjam - $get_jam_istirahat; // jam saat user absen dikurang jadwal absen
           $hitung_menit = floor($hitung_telat / 60 ); //konversi kemenit

          DB::table('t202_absensi')
		   ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
          ->update(['keterlambatan_istirahat'=>$hitung_menit]);

redirect('admin/copyistirahat')->send();
        
}

//---------COPY DATA BARU KE LAMA---------//

public function copyistirahat(){

	Carbon::now()->timezone('Asia/Jakarta');
	$datenow = Carbon::now();
    $breaktime = Carbon::now();

    $getid=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('Employee_id');

	$gettgl=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('tanggal_absen');

	$getbreak=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('masuk_istirahat');

	$getbreaklate=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('keterlambatan_istirahat');

	DB::table('t202_absensi')
		   ->where('Employee_id', $getid)
		   ->where('tanggal_absen', $gettgl)
           ->update([
            'masuk_istirahat' =>$getbreak,
           	'keterlambatan_istirahat'=>$getbreaklate
           ]);

redirect('admin/deletemasukistirahat')->send();
}

//------------DELETE DATA BARU-------------//

public function deletemasukistirahat()
{
	
	DB::table('t202_absensi')
	->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
	->delete();

	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Masuk Istirahat Berhasil!","success");
}

//---------------------------------------------------------------------//
//-----------------------------ABSEN PULANG----------------------------//
//---------------------------------------------------------------------//

//-------INPUT DATA PULANG--------//

public function tambahpulang()
{ 
	
	return view('pulang');
}

public function pulang(Request $request)
{
	//dd($request->all());
	Carbon::now()->timezone('Asia/Jakarta');
	$datenow = Carbon::now();
   $endtime = Carbon::now();

	 DB::table('t202_absensi')
	 ->insert(['Employee_id' => $request->Employee_id,
	 	       'tanggal_absen'   =>  $datenow,
	 	       'absen_pulang'=>$endtime]);

	 redirect('admin/kecepatan_pulang')->send();
}


public function kecepatan_pulang(){

	        $kecepetan_pulang=DB::table('t202_absensi')
					   ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))  //ambil data jam pulang yang barusan diinput
					   ->value('absen_pulang');
					$kecepetan_pulang_jam=strtotime($kecepetan_pulang);

			    $get_pulang=DB::table('t203_jamabsensi')
					     ->where('id', 4)                    //ambil data jam dari table jamabsensi
					     ->value('waktu');
					$get_jam_pulang=strtotime($get_pulang);

           $hitung_telat = $get_jam_pulang - $kecepetan_pulang_jam; // jadwal pulang dikurang jam saat user absen pulang
           $hitung_menit = floor($hitung_telat / 60 ); //konversi kemenit

          DB::table('t202_absensi')
		    ->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
           ->update(['kecepatan_pulang'=>$hitung_menit]);

          redirect('admin/copypulang')->send();
}

//---------COPY DATA BARU KE LAMA---------//

public function copypulang(){

	Carbon::now()->timezone('Asia/Jakarta');
	$datenow = Carbon::now();
    $breaktime = Carbon::now();

    $getid=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('Employee_id');

	$gettgl=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('tanggal_absen');

	$getpulang=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('absen_pulang');

	$getkecepatanpulang=DB::table('t202_absensi')
					->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
					->value('kecepatan_pulang');

	DB::table('t202_absensi')
		   ->where('Employee_id', $getid)
		   ->where('tanggal_absen', $gettgl)
           ->update([
            'absen_pulang' =>$getpulang,
           	'kecepatan_pulang'=>$getkecepatanpulang
           ]);
redirect('admin/deletepulang')->send();
}

public function deletepulang()
{
	DB::table('t202_absensi')
	->where('id', \DB::raw("(select max(`id`) from t202_absensi)"))
	->delete();

	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Absen Pulang Berhasil!","success");
}

//--------------------JIKA KECEPATAN PULANG MINUS, MAKA LEMBUR(LEBIH DARI JAM PULANG)-----------------//


	}