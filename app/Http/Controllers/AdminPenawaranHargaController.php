<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Models\mkt004_faktur;
	use PDF;

	class AdminPenawaranHargaController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "mkt002_penawaran";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			// $this->col[] = ["label"=>"Costumer ID","name"=>"Costumer_ID"];
			$this->col[] = ["label"=>"Nomor Dokumen","name"=>"Nomor_Penawaran"];
			$this->col[] = ["label"=>"Unit","name"=>"Sales_Unit","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Sales","name"=>"SalesID","join"=>"hrde200_employee,EmployeeName"];
			$this->col[] = ["label"=>"Tgl Request","name"=>"Tgl_request"];
			$this->col[] = ["label"=>"Company Name","name"=>"CompanyName"];
			$this->col[] = ["label"=>"Status ","name"=>"Status"];
			# END COLUMNS DO NOT REMOVE THIS LINE

          $id=DB::Table('mkt002_penawaran')
	      ->where('id', \DB::raw("(select max(`id`) from mkt002_penawaran)"))
	  	  ->value('id');
	  	  $ResultID = $id + 1;

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			// $this->form[] = ['label'=>'Costumer ID','name'=>'Costumer_ID','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] =['label'=>'id','name'=>'id','type'=>'hidden','value'=>$ResultID];
			$this->form[] = ['label'=>'Sales Name','name'=>'SalesID','type'=>'datamodal','datamodal_table'=>'hrde200_employee','datamodal_where'=>'','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'EmployeeName,NPK','datamodal_columns_alias'=>'EmployeeName,NPK','datamodal_select_to'=>'Unit_id:Sales_Unit','datamodal_size'=>'large','required'=>true];

			$this->form[] = ['label'=>'Sales Unit','name'=>'Sales_Unit','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'hrdm101_unit,UnitName','readonly'=>true];

			$this->form[] = ['label'=>'Nomor Dokumen','name'=>'Nomor_Penawaran','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[]  = ['label'=>'Perihal','name'=>'Perihal','type'=>'select',"dataenum" => ["Penawaran"]];
			
			$this->form[] = ['label'=>'Tgl Request','name'=>'tgl_request','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Company Name','name'=>'CompanyName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Company Address','name'=>'CompanyAddress','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Company Phone','name'=>'CompanyPhoneNumber','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Customer Name','name'=>'CustomerName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Customer Address','name'=>'CustomerAddress','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Customer Phone','name'=>'CustomerPhoneNumber','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Customer Email','name'=>'CustomerEmail','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Pajak','name'=>'Pajak','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Grand Total','name'=>'Grand_Total','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];


			$columns = [];
			$columns[] = ['label'=>'Request Id','name'=>'PenawaranID','type'=>'hidden','value'=>$ResultID];
			$columns[] = ['label'=>'Nama Barang','name'=>'nama_barang','type'=>'text'];
			$columns[] = ['label'=>'Detail Barang','name'=>'detail_barang','type'=>'text'];
            $columns[] = ['label'=>'Jumlah Barang','name'=>'jumlah_barang','type'=>'number'];
            $columns[] = ['label'=>'Harga Barang','name'=>'harga_barang','type'=>'number'];
            $columns[] = ['label'=>'Total Harga','name'=>'total_harga','type'=>'text','readonly'=>true];
			
			
			$this ->form[] = ['label'=>'Detail Barang','name'=>'mkt003_penawarandetail','type'=>'child','columns'=>$columns,'table'=>'mkt003_penawarandetail','foreign_key'=>'PenawaranID'];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Costumer ID","name"=>"Costumer_ID","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nomor","name"=>"Nomor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Perihal","name"=>"Perihal","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tgl Request","name"=>"Tgl_request","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CompanyName","name"=>"CompanyName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CompanyAddress","name"=>"CompanyAddress","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CompanyPhoneNumber","name"=>"CompanyPhoneNumber","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CustomerName","name"=>"CustomerName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CostumerAddress","name"=>"CostumerAddress","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CustomerPhoneNumber","name"=>"CustomerPhoneNumber","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CustomerEmail","name"=>"CustomerEmail","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Barang","name"=>"Barang","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Jumlah","name"=>"Jumlah","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Harga","name"=>"Harga","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Total","name"=>"Total","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Pajak","name"=>"Pajak","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Grand Total","name"=>"Grand_Total","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"SalesID","name"=>"SalesID","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"ManagerID","name"=>"ManagerID","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Status","name"=>"Status","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
	        $this->addaction[] = ['label'=>'Lengkapi Faktur','url'=>('cutoff_faktur').'/[id]','icon'=>'fa fa-plus','color'=>'success','showIf'=>"[Status] == 3"];

	        $this->addaction[] = ['label'=>'Cetak Faktur','url'=>('print_faktur').'/[id]','icon'=>'fa fa-print','color'=>'success','showIf'=>"[Status] == 4"];

	        $this->addaction[] = ['label'=>'Cetak PO','url'=>('print_po').'/[id]','icon'=>'fa fa-print','color'=>'info'];

	        $this->addaction[] = ['url'=>('delete_penawaran').'/[id]','icon'=>'fa fa-trash','color'=>'danger','confirmation' => true];


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
	        
	        $this->index_button[] = ['label'=>'Add Data','url'=>('form_add_penawaran') ,'icon'=>'fa fa-plus','color'=>'success'];
	        $this->index_button[] = ['label'=>'Export','url'=>('penawaran_export') ,'icon'=>'fa fa-download','color'=>'warning'];



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
	        $this->script_js = "
			$(function() {

			setInterval(function(){
			var total_harga = 0;	
			var jumlah = $('#jumlah_barang').val();
			var harga = $('#harga_barang').val();
			var calculate = Math.abs(harga * jumlah);
			var hasil = Math.ceil(calculate);
			$('#total_harga').val(hasil);
			}); 
       
			
			});
			";


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
	    	if($column_index == 6){
				if($column_value == 1){
					$column_value ='Blm Disetujui';
				}
				elseif($column_value == 2){
					$column_value = 'Disetujui SM';
				}
				elseif($column_value == 3){
					$column_value = 'Disetujui Customer';
				}
				elseif($column_value == 4){
					$column_value = 'Faktur Sudah Dibuat';
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


//ADD DATA TO TABLE FAKTUR SESUAI DENGAN DI TBLE PENAWARAN

public function cutoff_faktur($id){

DB::table('mkt002_penawaran')->where('id',$id)->update(['Status'=>'4']);

$query = DB::table('mkt002_penawaran')
         ->select('Nomor_Penawaran','Perihal','tgl_request','CompanyName','CompanyAddress','CompanyPhoneNumber','CustomerName','CustomerAddress','CustomerPhoneNumber','CustomerEmail','Pajak','Grand_Total','SalesID','Sales_Unit')
         ->where('id','=',$id)
         ->get();

$query2 = DB::table('mkt003_penawarandetail')
         ->select('PenawaranID','nama_barang','detail_barang','jumlah_barang','harga_barang','total_harga','is_pajak')
         ->where('PenawaranID','=',$id)
         ->get();

foreach($query as $records)
{
DB::table('mkt004_faktur')->insert(get_object_vars($records)); 
}   
foreach($query2 as $p)
{
DB::table('mkt005_fakturdetail')->insert(get_object_vars($p)); 
}   
redirect('admin/complete_faktur')->send();
}


//LENGKAPI DATA FAKTUR YG KURANG (DI CONTROLLER FAKTUR)

public function complete_faktur(){

$edit_id=DB::table('mkt004_faktur')
			->where('id', \DB::raw("(select max(`id`) from mkt004_faktur)"))
		    ->value('id');//get recent id from faktur table for adding faktur number

redirect('admin/penawaran_faktur/edit/'.$edit_id)->send();

}

//PRINT FAKTUR FINAL

public function print_faktur($id){


   $query = \App\Models\mkt004_faktur::when(request('SalesID'), function($query){
	$query->whereHas('sales', function($nested){
	$nested->where('SalesID', request('SalesID'));
	});
	})
	->where('PenawaranID','=',$id)
    ->get();

   $query2 = \App\Models\mkt005_fakturdetail::when(request('Nomor'), function($query2){
	$query2->whereHas('penawaran', function($nested){
	$nested->where('Nomor', request('Nomor'));
	});
	})
	->where('PenawaranID','=',$id)
	->orderBy('id','desc')
    ->get();
 
$generatePDF = PDF::loadView('exports.PrintPenawaranFakturpdf',array('query'=>$query, 'query2'=>$query2))->setPaper('a5','landscape');
return $generatePDF->stream();		

}

public function delete_penawaran($id)
{

DB::table('mkt002_penawaran')
		   ->where('id','=',$id)
           ->delete();

DB::table('mkt003_penawarandetail')
		   ->where('PenawaranID','=',$id)
         ->delete();

CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Hapus Data Berhasil !","success");
 
}

	}