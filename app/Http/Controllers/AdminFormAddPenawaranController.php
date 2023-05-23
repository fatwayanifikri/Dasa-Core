<?php namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CRUDBooster;
use App\Models\hrde200_employee;
use PDF;

	class AdminFormAddPenawaranController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "hrde200_employee";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Pelamar Id","name"=>"Pelamar_id","join"=>"Pelamar,id"];
			$this->col[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","join"=>"Jabatan,id"];
			$this->col[] = ["label"=>"Level Id","name"=>"Level_id","join"=>"Level,id"];
			$this->col[] = ["label"=>"Unit Id","name"=>"Unit_id","join"=>"Unit,id"];
			$this->col[] = ["label"=>"Company Id","name"=>"Company_id","join"=>"Company,id"];
			$this->col[] = ["label"=>"Departement Id","name"=>"Departement_id","join"=>"Departement,id"];
			$this->col[] = ["label"=>"NPK","name"=>"NPK"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Pelamar Id','name'=>'Pelamar_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Pelamar,id'];
			$this->form[] = ['label'=>'Jabatan Id','name'=>'Jabatan_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Jabatan,id'];
			$this->form[] = ['label'=>'Level Id','name'=>'Level_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Level,id'];
			$this->form[] = ['label'=>'Unit Id','name'=>'Unit_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Unit,id'];
			$this->form[] = ['label'=>'Company Id','name'=>'Company_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Company,id'];
			$this->form[] = ['label'=>'Departement Id','name'=>'Departement_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'Departement,id'];
			$this->form[] = ['label'=>'NPK','name'=>'NPK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'EmployeeName','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TempatLahir','name'=>'TempatLahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TanggalLahir','name'=>'TanggalLahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'JenisKelamin','name'=>'JenisKelamin','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'StatusNikah Id','name'=>'StatusNikah_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'StatusNikah,id'];
			$this->form[] = ['label'=>'HiredDate','name'=>'HiredDate','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'AlamatRumah','name'=>'AlamatRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TelpRumah','name'=>'TelpRumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'TelpHp','name'=>'TelpHp','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan','name'=>'Keterangan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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



/*------------------------FUNGSI UNTUK MEMBUAT COSTUM VIEW--------------------*/

public function getIndex() {

   if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

$EmployeeID=Crudbooster::myId();
$getJabatan=Crudbooster::myPrivilegeId();
$id=DB::Table('mkt002_penawaran')
	 ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
	 ->value('id');
$ResultID = $id + 1;	
//---------------------------
   $query = \App\Models\mkt003_penawarandetail::when(request('Nomor'), function($query){
	$query->whereHas('penawaran', function($nested){
	$nested->where('Nomor', request('Nomor'));
	});
	})
	->where('created_by','=',$EmployeeID)
	->where('PenawaranID','=',$ResultID)
   ->get();

//---------------------------
   $query2 = \App\Models\hrde200_employee::when(request('Jabatan_id'), function($query2){
	$query2->whereHas('jabatan', function($nested){
	$nested->where('Jabatan_id', request('Jabatan_id'));
	});
	})
	->where('Jabatan_id','=', 133)
   ->get();

//---------------------------
   $query3 = DB::table('hrdm101_unit')
   ->get();

//---------------------------
   $query4 = \App\Models\mkt001_customer::when(request('StoreID'), function($query4){
	$query4->whereHas('unit', function($nested){
	$nested->where('StoreID', request('StoreID'));
	});
	})
   ->get();


   //untuk menampilkan data di view
   $data = [];
   $total = 0;
   $data['absenlembur'] = 'Products Data';
   $data['value'] = $query;
   $data['sales'] = $query2;
   $data['unit'] = $query3;
   $data['customer'] = $query4;
   
  
   $this->cbView('viewindex/custom_add_penawaran',$data);
}
/*-------------------------------END COSTUM VIEW--------------------*/


/*INPUT CHILD DATA KE PENAWARAN DETAIL*/

public function input_penawarandetail(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();
$id=DB::Table('mkt002_penawaran')
	 ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
	  ->value('id');
$ResultID = $id + 1;	

// input ke table mkt003_penawarandetail
	DB::table('mkt003_penawarandetail')->insert([ 
		'PenawaranID' => $ResultID,
		'nama_barang' => $request->post('nama_barang'),
		'detail_barang' => $request->post('detail_barang'),
		'jumlah_barang' => $request->post('jumlah_barang'),
		'harga_barang' => $request->post('harga_barang'),
		'total_harga' => $request->post('total_harga'),
		'is_pajak' => $request->post('is_pajak'),
		'created_by'=>$EmployeeID
		
	]);
	redirect('admin/status_pajak/')->send();

}

//update status is_pajak
public function status_pajak(){

$EmployeeID=Crudbooster::myId();
$get_idpenawaran=DB::Table('mkt003_penawarandetail')
	        ->where('id', \DB::raw("(select max(`id`) from mkt003_penawarandetail)"))
	        ->where('created_by','=',$EmployeeID)
	        ->value('PenawaranID');
$get_ispajak=DB::Table('mkt003_penawarandetail')
	        ->where('id', \DB::raw("(select max(`id`) from mkt003_penawarandetail)"))
	        ->where('created_by','=',$EmployeeID)
	        ->value('is_pajak');

DB::table('mkt003_penawarandetail')
	->where('PenawaranID','=',$get_idpenawaran)
   ->update(['is_pajak' => $get_ispajak]);

	// $request->session()->flash('alert-success', 'Status Actualizado Correctamente');
   return redirect()->back();

}


// INPUT DATA KE MAIN TABLE SETELAH KLIK SAVE

public function input_penawaran(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();
$id=DB::Table('mkt002_penawaran')
	 ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
	  ->value('id');
$ResultID = $id + 1;	

// input ke table mkt003_penawarandetail
	DB::table('mkt002_penawaran')->insert([ 
		'id' => $ResultID,
		'Status' => $request->post('Status'),
		// 'Customer_ID' => $request->post('Customer_ID'),
		'SalesID' => $request->post('SalesID'),
		'Sales_Unit' => $request->post('Sales_Unit'),
		'Nomor_Penawaran' => $request->post('Nomor_Penawaran'),
		'Perihal' => $request->post('Perihal'),
		'tgl_request' => $request->post('tgl_request'),
		'CompanyName' => $request->post('CompanyName'),
		'CompanyAddress' => $request->post('CompanyAddress'),
		'CompanyPhoneNumber' => $request->post('CompanyPhoneNumber'),
		'CustomerName' => $request->post('CustomerName'),
		'CustomerAddress' => $request->post('CustomerAddress'),
		'CustomerPhoneNumber' => $request->post('CustomerPhoneNumber'),
		'CustomerEmail' => $request->post('CustomerEmail'),
		'Pajak' => $request->post('Pajak'),
		'NPWP' => $request->post('NPWP'),
		'Grand_Total' => $request->post('Grand_Total'),
		'created_by'=>$EmployeeID
		
	]);

CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Input Data Berhasil !","success");

}


// public function update_detail()
// {

// $EmployeeID=Crudbooster::myId();
// $id=DB::Table('mkt002_penawaran')
// 	  ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
// 	  ->where('created_by','=',$EmployeeID)
// 	  ->value('id');

// $pajak=DB::Table('mkt002_penawaran')
// 	  ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
// 	  ->where('created_by','=',$EmployeeID)
// 	  ->value('Pajak');

// $grandtotal=DB::Table('mkt002_penawaran')
// 	  ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
// 	  ->where('created_by','=',$EmployeeID)
// 	  ->value('Grand_Total');

// DB::table('mkt003_penawarandetail')
// 		   ->where('PenawaranID','=',$id)
//          ->update(['pajak' => $pajak, 'grand_total'=>$grandtotal]);

// CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Input Data Berhasil !","success");
 
// }


// MENU DELETE DATA DI TABLE CHILD

public function delete_child($id)
{

DB::table('mkt003_penawarandetail')
		   ->where('id','=',$id)
         ->delete();
CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Hapus Data Berhasil !","success");
 
}


//PRINT PO

public function print_po($id){

   $query = \App\Models\mkt002_penawaran::when(request('Nomor'), function($query){
	$query->whereHas('penawaran', function($nested){
	$nested->where('Nomor', request('Nomor'));
	});
	})
	->where('id','=',$id)
   ->get();

   $query2 = \App\Models\mkt003_penawarandetail::when(request('Nomor'), function($query2){
	$query2->whereHas('penawaran', function($nested){
	$nested->where('Nomor', request('Nomor'));
	});
	})
	->where('PenawaranID','=',$id)
	->orderBy('id','desc')
   ->get();
 
$generatePDF = PDF::loadView('exports.PrintPenawaranPOpdf',array('query'=>$query, 'query2'=>$query2))->setPaper('a4','portrait');
return $generatePDF->stream();		

}


	}