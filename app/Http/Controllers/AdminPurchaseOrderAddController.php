<?php namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CRUDBooster;
use App\Models\hrde200_employee;
use PDF;

	class AdminPurchaseOrderAddController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "namavendor";
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
			$this->table = "logt301_purchaseorder";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"NoPO","name"=>"NoPO"];
			$this->col[] = ["label"=>"NoPR","name"=>"NoPR"];
			$this->col[] = ["label"=>"Purchaserequest ID","name"=>"purchaserequest_ID"];
			$this->col[] = ["label"=>"Vendor ID","name"=>"vendor_ID"];
			$this->col[] = ["label"=>"Namavendor","name"=>"namavendor"];
			$this->col[] = ["label"=>"Rekeningvendor","name"=>"rekeningvendor"];
			$this->col[] = ["label"=>"Norekeningvendor","name"=>"norekeningvendor"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'NoPO','name'=>'NoPO','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NoPR','name'=>'NoPR','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Purchaserequest ID','name'=>'purchaserequest_ID','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Vendor ID','name'=>'vendor_ID','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Namavendor','name'=>'namavendor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Rekeningvendor','name'=>'rekeningvendor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Norekeningvendor','name'=>'norekeningvendor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Alamatvendor','name'=>'alamatvendor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Vendorbank','name'=>'vendorbank','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal','name'=>'tanggal','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Bulan','name'=>'bulan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nomor','name'=>'nomor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jumlah','name'=>'jumlah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Gr','name'=>'status_gr','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Statusfaktur','name'=>'statusfaktur','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Statusbayar','name'=>'statusbayar','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Userinput','name'=>'userinput','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsStatus','name'=>'IsStatus','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'IsApproved','name'=>'IsApproved','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"NoPO","name"=>"NoPO","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"NoPR","name"=>"NoPR","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Purchaserequest ID","name"=>"purchaserequest_ID","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Vendor ID","name"=>"vendor_ID","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Namavendor","name"=>"namavendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Rekeningvendor","name"=>"rekeningvendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Norekeningvendor","name"=>"norekeningvendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Alamatvendor","name"=>"alamatvendor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Vendorbank","name"=>"vendorbank","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tanggal","name"=>"tanggal","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Bulan","name"=>"bulan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nomor","name"=>"nomor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Jumlah","name"=>"jumlah","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status Gr","name"=>"status_gr","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Statusfaktur","name"=>"statusfaktur","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Statusbayar","name"=>"statusbayar","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Userinput","name"=>"userinput","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"IsStatus","name"=>"IsStatus","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"IsApproved","name"=>"IsApproved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
$id=DB::Table('logt301_purchaseorder')
	 ->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
	 ->value('id');
$ResultID = $id + 1;	

$get_PO_id=DB::Table('logt302_purchaseorderdetail')
	 ->where('id', \DB::raw("(select max(`id`) from logt302_purchaseorderdetail)"))
	 ->where('created_by',$EmployeeID)
	 ->value('prdetail_id');


//---------------------------QUERY UNTUK TABLE PR
   $query = \App\Models\logt303_copypurchaserequest::when(request('unit'), function($query){
	$query->whereHas('unit', function($nested){
	$nested->where('Unit_id', request('Unit_id'));
	});
	})
    ->where('created_by','=',$EmployeeID)
	->where('purchaseorder_id','=',null)
    ->get();

//---------------------------QUERY UNTUK TABLE DETAIL PR 
   $query2 = \App\Models\logt302_purchaseorderdetail::when(request('purchaseorder'), function($query2){
	$query2->whereHas('purchaseorder', function($nested){
	$nested->where('NoPO', request('NoPO'));
	});
	})
	->where('created_by','=',$EmployeeID)
	->where('purchaseorder_id','=',0)
    ->get();

//---------------------------QUERY UNTUK BAGIAN MODAL
   $query3 = \App\Models\logt201_purchaserequest::when(request('unit'), function($query3){
	$query3->whereHas('unit', function($nested){
	$nested->where('UnitID', request('UnitID'));
	});
	})
    ->get();

//---------------------------
   $query4 = DB::table('hrdm101_unit')
   ->get();

//---------------------------

   $query5 = DB::table('logm001_vendor')
   ->get();

//---------------------------

   //untuk menampilkan data di view
   $data = [];
   $total = 0;
   $data['absenlembur'] = 'Products Data';
   $data['child'] = $query;
   $data['detail'] = $query2;
   $data['modals'] = $query3;
   $data['unit'] = $query4;
   $data['vendor'] = $query5;

   
   $this->cbView('viewindex/custom_add_purchaseorder',$data);
}
/*-------------------------------END COSTUM VIEW--------------------*/

/*COPY DATA DARI TBL PURCHASE REQUEST KE COPY REQUEST*/

public function input_copyrequest(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();	

	DB::table('logt303_copypurchaserequest')->insert([ 
		'request_id' => $request->post('request_id'),
		'NoPR' => $request->post('NoPR'),
		'Tanggal' => $request->post('Tanggal'),
		'Unit_id' => $request->post('Unit_id'),
		'IsStatus' => $request->post('IsStatus'),
		'Catatan' => $request->post('Catatan'),
		'created_by'=>$EmployeeID
		
	]);
	redirect('admin/input_podetail/')->send();

}


/*COPY DATA DARI TBL REQUEST DETAIL KE PO DETAIL*/

public function input_podetail(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();
$reqid=DB::Table('logt303_copypurchaserequest')
	 ->where('id', \DB::raw("(select max(`id`) from logt303_copypurchaserequest)"))
	 ->where('created_by',$EmployeeID)
	 ->value('request_id');


$query = DB::table('logt202_purchaserequestdetail')
         ->select('id','barang_id','kodebarang','namabarang','jumlah','Jumlahkebutuhan','PR_id')
          ->where('PR_id','=',$reqid)
          ->get();

         foreach($query as $p)
          {
         
         DB::table('logt302_purchaseorderdetail')->insert([ 
        'prdetail_id' => $p->id,
        'pr_id' => $p->PR_id,
		'barangID' => $p->barang_id,
		'kodebarang' => $p->kodebarang,
		'namabarang' => $p->namabarang,
		'Jumlah' => $p->jumlah,
		'jumlahpermintaan' => $p->Jumlahkebutuhan,
		'created_by'=>$EmployeeID
		
	    ]);

          }   
	redirect('admin/purchase_order_add/')->send();
}

/*INPUT DATA PO*/

public function input_data_po(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();
         
         DB::table('logt301_purchaseorder')->insert([ 
        'NoPO' => $request->post('NoPO'),
		'tanggal' => $request->post('tanggal'),
		'vendor_ID' => $request->post('vendor_ID'),
		'created_by'=>$EmployeeID
	    ]);

	redirect('admin/input_id_po/')->send();
}


/*INPUT ID PO KE PO DETAIL*/

public function input_id_po(Request $request)
{

$getJabatan=Crudbooster::myPrivilegeId();
$EmployeeID=Crudbooster::myId();

$get_po_id = DB::table('logt301_purchaseorder')
         ->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
	     ->where('created_by',$EmployeeID)
	     ->value('id');

$get_vendor_id= DB::table('logt301_purchaseorder')
         ->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
	     ->where('created_by',$EmployeeID)
	     ->value('vendor_ID');

$get_vendor_name= DB::table('logm001_vendor')
	     ->where('id',$get_vendor_id)
	     ->value('Nama');
         

         DB::table('logt302_purchaseorderdetail')
	     ->where('created_by','=',$EmployeeID)
	     ->where('purchaseorder_id','=',0)
         ->update(['purchaseorder_id' => $get_po_id]);

         DB::table('logt303_copypurchaserequest')
	     ->where('created_by','=',$EmployeeID)
	     ->where('purchaseorder_id','=',null)
         ->update(['purchaseorder_id' => $get_po_id]);

         DB::table('logt301_purchaseorder')
         ->where('id', \DB::raw("(select max(`id`) from logt301_purchaseorder)"))
	     ->where('created_by','=',$EmployeeID)
         ->update(['namavendor' => $get_vendor_name]);

	CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Input Data Berhasil !","success");
}


/*DELETE DATA DARI TBL COPY PURCHASE REQUEST*/
public function delete_copyrequest($id)
{

$get_pr_id = DB::table('logt303_copypurchaserequest')
         ->where('id','=',$id)
	     ->value('request_id');

DB::table('logt303_copypurchaserequest')
		   ->where('id','=',$id)
           ->delete();

DB::table('logt302_purchaseorderdetail')
		   ->where('pr_id','=',$get_pr_id)
           ->delete();

CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Hapus Data Berhasil !","success");
 
}

/*DELETE DATA DARI TBL PO DETAIL*/
public function delete_podetail($id)
{

DB::table('logt302_purchaseorderdetail')
		   ->where('id','=',$id)
           ->delete();
CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Hapus Data Berhasil !","success");
 
}

	}