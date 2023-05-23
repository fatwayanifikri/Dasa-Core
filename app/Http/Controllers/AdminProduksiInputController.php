<?php namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CRUDBooster;
use PDF;
use Carbon\Carbon;
use Validator;
use Redirect;

	class AdminProduksiInputController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_customer";
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
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "t206_produksi";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Kode Produksi","name"=>"kode_produksi"];
			$this->col[] = ["label"=>"Nama Customer","name"=>"nama_customer"];
			$this->col[] = ["label"=>"No Spk","name"=>"no_spk"];
			$this->col[] = ["label"=>"Qty Produksi","name"=>"qty_produksi"];
			$this->col[] = ["label"=>"Mesin","name"=>"id_mesin"];
			$this->col[] = ["label"=>"Tanggal Mulai","name"=>"tanggal_mulai"];
			$this->col[] = ["label"=>"Tanggal Selesai","name"=>"tanggal_selesai"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Kode Produksi','name'=>'kode_produksi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Customer','name'=>'nama_customer','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'No Spk','name'=>'no_spk','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Qty Produksi','name'=>'qty_produksi','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Mesin','name'=>'id_mesin','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'mesin,id'];
			$this->form[] = ['label'=>'Tanggal Mulai','name'=>'tanggal_mulai','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Selesai','name'=>'tanggal_selesai','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Lokasi Produksi','name'=>'lokasi_produksi','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Operator','name'=>'operator','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Produksi','name'=>'status_produksi','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Kode Produksi','name'=>'kode_produksi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Nama Customer','name'=>'nama_customer','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'No Spk','name'=>'no_spk','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Qty Produksi','name'=>'qty_produksi','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Mesin','name'=>'id_mesin','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'mesin,id'];
			//$this->form[] = ['label'=>'Tanggal Mulai','name'=>'tanggal_mulai','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal Selesai','name'=>'tanggal_selesai','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Lokasi Produksi','name'=>'lokasi_produksi','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Operator','name'=>'operator','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Status Produksi','name'=>'status_produksi','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
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



	    //By the way, you can still create your own method in here... :) 

/*------------------------FUNGSI UNTUK MEMBUAT COSTUM VIEW--------------------*/

public function getIndex() {

   if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

$EmployeeID=Crudbooster::myId();
$getJabatan=Crudbooster::myPrivilegeId();
$getlatest_tgl=DB::Table('t208_detailproduksi')
    ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	  ->value('tgl_produksi');
//---------------------------
   $query = \App\Models\t208_detailproduksi::when(request('Unit_id'), function($query){
	$query->whereHas('unit', function($nested){
	$nested->where('Unit_id', request('Unit_id'));
	});
	})
	->where('created_by','=',$EmployeeID)
	->where('produksi_id','=',0)
   ->get();

//---------------------------
   $query2 = DB::table('hrdm101_unit')
   ->where('id','=', 2)
   ->orwhere('id','=', 10)
   ->get();

//---------------------------
   $query3 = \App\Models\hrde200_employee::when(request('Jabatan_id'), function($query2){
	$query2->whereHas('jabatan', function($nested){
	$nested->where('Jabatan_id', request('Jabatan_id'));
	});
	})
   ->whereIn('Jabatan_id',[125,126,127,140,141,145])
   ->get();

//---------------------------
   $query4 = DB::table('t207_mesinproduksi')
   ->get();

//---------------------------
   $query5 = DB::table('t208_detailproduksi')
   // ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
   ->where('Unit_id', '=', 2)
   ->where('tgl_produksi', '=', date('Y-m-d') )
   ->where('mesin_id','=',7) 
   ->get();

//---------------------------
   $query6 = DB::table('t208_detailproduksi')
   // ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
   ->where('Unit_id', '=', 2)
   ->where('tgl_produksi', '=', date('Y-m-d') )
   ->where('mesin_id','=',6) 
   ->get();


   //untuk menampilkan data di view
   $data = [];
   $total = 0;
   $data['absenlembur'] = 'Products Data';
   $data['detailproduksi'] = $query;
   $data['unit'] = $query2;
   $data['employee'] = $query3;
   $data['mesin'] = $query4;
   $data['kapasitasm52'] = $query5;
   $data['kapasitasm74'] = $query6;
   
  
   $this->cbView('viewindex/custom_produksi_input',$data);
}
/*-------------------------------END COSTUM VIEW--------------------*/



/*-------------------INPUT KE TABEL DETAIL PRODUKSI--------------------*/

public function input_mesin(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();

	DB::table('t208_detailproduksi')->insert([ 
		
		'mesin_id' => $request->post('mesin_id'),
		'kategori' => $request->post('kategori'),
		'produksi_id' => 0,
		'qty_produksi' => $request->post('qty_produksi'),
		'qty_produksi_process' => $request->post('qty_produksi'),
		'Unit_id' => $request->post('Unit_id'),
		'kapasitas_terpakai' => $request->post('kapasitas_terpakai'),
		'tgl_produksi' => $request->post('tgl_produksi'),
		'tgl_selesai' => $request->post('tgl_produksi'),
		'status_produksi' => 1,
		'created_by'=>$EmployeeID
		
	]);

redirect('admin/cek_kapasitas/')->send();

}
/*--------------------------------END------------------------------*/    


/*----------------------INPUT KE TABEL PRODUKSI--------------------*/

public function input_produksi(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();

// VALIDATOR

//         $rules = [
//         // 'kode_produksi' => 'required|string|max:255',
//         'nama_customer' => 'required|string|max:255',
//         'no_spk' => 'required|string|max:255',
//         'qty_produksi' =>  'required|integer',
//         'id_mesin' => 'required|integer',
//         'tanggal_mulai' => 'required|date|max:255',
//         'lokasi_produksi' => 'required|integer|max:10',
//         'operator' => 'required|string|max:255',
//         'status_produksi' => 'required|integer|max:5',

//         ];

// $message = [
//             'nama_customer.required'        => 'Nama Customer masih kosong.',
//             'no_spk.required'         => 'Nomor SPK masih kosong.',
//             'qty_produksi.required'     => 'Jumlah Produksi masih kosong.',
//             'id_mesin.required'          => 'Mesin masih kosong.',
//             'tanggal_mulai.required'      => 'Tanggal masih kosong.',
//             'lokasi_produksi.required'      => 'Lokasi Produksi masih kosong.',
//             'operator.required'      => 'Nama Operator masih kosong.',
//             'status_produksi.required'      => 'Status Produksi masih kosong.',
//         ];

// //jalankan validasi
// $validator = Validator::make($request->all(), $rules, $message);
 
// //cek validasi
// if ($validator->fails()) {
// return redirect()->back()->withErrors($validator)->withInput($request->all());
//         }


// input ke table t206_produksi
	DB::table('t206_produksi')->insert([ 

		'kode_produksi' => $request->post('kode_produksi'),
		'nama_customer' => $request->post('nama_customer'),
		'no_spk' => $request->post('no_spk'),
		'operator' => $request->post('operator'),
		'status_produksi' => $request->post('status_produksi'),
		'keterangan' => $request->post('keterangan'),
		'created_by'=>$EmployeeID
		
	]);

redirect('admin/edit_detail/')->send();

}

/*--------------------------------END------------------------------*/   


/*-----------------------UNTUK CEK KAPASITAS MESIN--------------------*/ 
public function cek_kapasitas(Request $request)
{

// FUNGSI SELECT DATA YG BARU MASUK
Carbon::now()->timezone('Asia/Jakarta');
$datenow = Carbon::now();
$starttime = Carbon::now()->format('H:i:s');

$EmployeeID=Crudbooster::myId();
$getlatestid = DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('id');

$getlatestmesin = DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('mesin_id');

$getlatesttgl = DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('tgl_produksi');

$getcabang = DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('Unit_id');

// $getstatus = DB::Table('t208_detailproduksi')
// 	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
// 	 ->where('created_by','=',$EmployeeID)
// 	 ->value('status_produksi');

$getqty=DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('qty_produksi');

$getkapasitas=DB::Table('t207_mesinproduksi')
	 ->where('id','=',$getlatestmesin)
	 ->value('kapasitas_produksi');

// PERHITUNGAN KAPASITAS MESIN

$produksi = DB::Table('t208_detailproduksi')
   ->where('mesin_id','=',$getlatestmesin)
   ->where('tgl_produksi','=',$getlatesttgl)
   ->where('Unit_id','=',$getcabang)
   ->select([DB::raw("SUM(qty_produksi_process) as jumlah")])
   ->groupBy('tgl_produksi')
   ->get();

foreach ($produksi as $p) {
  $total = $p->jumlah;
}
 
DB::table('t208_detailproduksi')
          ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
          ->where('created_by','=',$EmployeeID)
          ->update(['kapasitas_terpakai' => $total]);

// MUNCUL PESAN TERKAIT KAPASITAS MESIN

$getlatestkapasitas=DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('kapasitas_terpakai');


if($getlatestkapasitas > $getkapasitas) {

  
// DB::table('t208_detailproduksi')
// ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
// ->where('created_by','=',$EmployeeID)
// ->delete();
// CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Kapasitas Mesin Penuh !","Danger");


// DB::table('t208_detailproduksi')
// ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
// ->where('created_by','=',$EmployeeID)
// ->update(['kapasitas_terpakai' => 0]);


return redirect()->to('admin/produksi_input_overload/')->with('success', 'Kapasitas Mesin Penuh !')->send();

}

else {
	redirect('admin/produksi_input/')->send();
}

}

/*--------------------------------END------------------------------*/   


/*-------------------EDIT TABLE SETELAH SUBMIT PRODUKSI-------------*/  

public function edit_detail()
{

$EmployeeID=Crudbooster::myId();
$getproduksiID = DB::Table('t206_produksi')
	 ->where('id', \DB::raw("(select max(`id`) from t206_produksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('id');

DB::table('t208_detailproduksi')
->where('produksi_id','=',0)
->where('created_by','=',$EmployeeID)
->update(['produksi_id' => $getproduksiID]);


redirect('admin/add_unit/')->send();

}

public function add_unit()
{
$EmployeeID=Crudbooster::myId();
$getproduksiID = DB::Table('t206_produksi')
	 ->where('id', \DB::raw("(select max(`id`) from t206_produksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->value('id');
$getunit = DB::Table('t208_detailproduksi')
	 ->where('id', \DB::raw("(select max(`id`) from t208_detailproduksi)"))
	 ->where('created_by','=',$EmployeeID)
	 ->where('produksi_id','=',$getproduksiID)
	 ->value('Unit_id');

DB::table('t206_produksi')
->where('id', \DB::raw("(select max(`id`) from t206_produksi)"))
->where('created_by','=',$EmployeeID)
->update(['lokasi_produksi' => $getunit]);


CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Input Data Berhasil !","success");
}

/*--------------------------------END------------------------------*/   

public function delete_mesin($id)
{

DB::table('t208_detailproduksi')
->where('id','=',$id)
->delete();
return redirect()->back();
}

/*--------------TOMBOL BACK----------------------*/   

public function back_button()
{

DB::table('t208_detailproduksi')
->where('produksi_id','=',0)
->delete();
redirect('admin/produksi_view/')->send();
}
	}