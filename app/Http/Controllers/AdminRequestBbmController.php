<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminRequestBbmController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "hgst104_permintaanbbm";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Jenis Permintaan","name"=>"jenis_permintaan"];
			$this->col[] = ["label"=>"Nomor Voucher","name"=>"nomor_voucher"];
			$this->col[] = ["label"=>"Nomor Kendaraan","name"=>"id_kendaraan","join"=>"hgst103_kendaraan,nomor_kendaraan"];
			$this->col[] = ["label"=>"Employee Name","name"=>"EmployeeName"];
			$this->col[] = ["label"=>"Kepemilikan","name"=>"id_kendaraan","join"=>"hgst103_kendaraan,kepemilikan"];
			$this->col[] = ["label"=>"Unit","name"=>"Unit_id","join"=>"hrdm101_unit,UnitName"];
			$this->col[] = ["label"=>"Tanggal Request","name"=>"tgl_permintaan"];
			$this->col[] = ["label"=>"Status Voucher","name"=>"status"];
			# END COLUMNS DO NOT REMOVE THIS LINE
           

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Jenis Permintaan','name'=>'jenis_permintaan','type'=>'radio','validation'=>'required|min:1|max:255','width'=>'col-sm-7',"dataenum" => ["Cash ","Voucher"]];
            $this->form[] = ['label'=>'Nomor Voucher','name'=>'nomor_voucher','type'=>'text','width'=>'col-sm-7','placeholder'=>'*Jika Cash Tidak Perlu Diisi*'];

			$this->form[] = ['label'=>'Nomor Kendaraan','name'=>'id_kendaraan','type'=>'datamodal','datamodal_table'=>'hgst103_kendaraan','datamodal_where'=>'','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datamodal_columns'=>'nomor_kendaraan,merk_kendaraan','datamodal_columns_alias'=>'Nomor Kendaraan,Nama Kendaraan','datamodal_select_to'=>'EmployeeName:EmployeeName,Unit_id:Unit_id,Jabatan_id:Jabatan_id,jenis_bbm:jenis_bbm,rasio_perliter:rasio_perliter,harga_bbm:harga_bbm,km_akhir:km_awal','datamodal_size'=>'large'];
   
			$this->form[] = ['label'=>'Nama Pemegang','name'=>'EmployeeName','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7','readonly'=>true];

            $this->form[] = ['label'=>'Rasio Perliter','name'=>'rasio_perliter','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7','readonly'=>true];

			$this->form[] = ['label'=>'Jabatan','name'=>'Jabatan_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-7','datatable'=>'cms_privileges,name','readonly'=>true];

			$this->form[] = ['label'=>'Unit','name'=>'Unit_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-7','datatable'=>'hrdm101_unit,UnitName','readonly'=>true];

			$this->form[] = ['label'=>'Jenis BBM','name'=>'jenis_bbm','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-7','datatable'=>'hgst105_bbm,nama_bbm','readonly'=>true];

            $this->form[] = ['label'=>'Harga BBM','name'=>'harga_bbm','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7','readonly'=>true];

			//-------------------------------------------------//

            $this->form[] = ['label'=>'Tanggal Request','name'=>'tgl_permintaan','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-7'];
            $this->form[] = ['label'=>'KM Awal (KM)','name'=>'km_awal','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7','readonly'=>true];
            $this->form[] = ['label'=>'KM Akhir (KM)','name'=>'km_akhir','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7'];
            $this->form[] = ['label'=>'Jumlah KM (KM)','name'=>'jumlah_km','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7','readonly'=>true];
            $this->form[] = ['label'=>'Jumlah KM Tujuan (KM)','name'=>'jumlah_kmtujuan','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-7'];
            $this->form[] = ['label'=>'Tujuan','name'=>'tujuan','type'=>'textarea','validation'=>'required|min:0','width'=>'col-sm-7'];
            $this->form[] = ['label'=>'BBM Rekomendasi (Liter)','name'=>'jumlah_disarankan','type'=>'text','validation'=>'required|min:0','width'=>'col-sm-7','readonly'=>true];
            $this->form[] = ['label'=>'Rata-Rata KM Habis (Liter)','name'=>'ratarata_kmhabis','type'=>'text','validation'=>'required|min:0','width'=>'col-sm-7','readonly'=>true];
            $this->form[] = ['label'=>'Total Biaya (RP)','name'=>'total_biaya','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-7'];
            $this->form[] = ['label'=>'Jumlah BBM (Liter)','name'=>'jumlah_bbm','type'=>'text','validation'=>'required|min:0','width'=>'col-sm-7'];
            $this->form[] = ['label'=>'Rata-Rata KM','name'=>'ratarata_km','type'=>'text','validation'=>'required|min:0','width'=>'col-sm-7'];
			 $this->form[] = ['label'=>'Tanggal Pencairan','name'=>'tgl_pencairan','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-7'];	
				
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'hidden','value'=>'1'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Nomor Voucher","name"=>"nomor_voucher","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Tanggal Request","name"=>"tanggal_request","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
			//$this->form[] = ["label"=>"Kendaraan","name"=>"id_kendaraan","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"kendaraan,id"];
			//$this->form[] = ["label"=>"EmployeeName","name"=>"EmployeeName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Jabatan Id","name"=>"Jabatan_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Jabatan,id"];
			//$this->form[] = ["label"=>"Unit Id","name"=>"Unit_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"Unit,id"];
			//$this->form[] = ["label"=>"Jarak Tempuh","name"=>"jarak_tempuh","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Jumlah Disarankan","name"=>"jumlah_disarankan","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Jumlah Liter","name"=>"jumlah_liter","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Tgl Pencairan","name"=>"tgl_pencairan","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
	        $this->addaction[] = ['label'=>'Cairkan Voucher','name'=>'setuju_sm','url'=>('voucherBBM').'/[id]','icon'=>'fa fa-check','color'=>'success','showIf'=>"[status] == 0"];

			//$this->addaction[] = ['label'=>'Tolak','name'=>'tolak_sm','url'=>('rejectcuti/edit/[id]'),'icon'=>'fa fa-check','color'=>'danger'];


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
	       
	        $this->index_button[] = ['label'=>'Export','url'=>('request_bbm_export'),'icon'=>'fa fa-download','color'=>'primary'];



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
			var jumlah_km = 0;	
			var Awal = $('#km_awal').val();
			var Akhir = $('#km_akhir').val();
			var calculate = Math.abs(Akhir - Awal);
			$('#jumlah_km').val(calculate);
			}); 


            setInterval(function(){
			var jumlah_disarankan = 0;	
			var rasio_perliter = $('#rasio_perliter').val();
			var jumlah_kmtujuan = $('#jumlah_kmtujuan').val();
			var calculate = Math.abs(jumlah_kmtujuan / rasio_perliter);
			var hasil = Math.ceil(calculate);
			$('#jumlah_disarankan').val(hasil);
			});


			 setInterval(function(){
			var ratarata_kmhabis = 0;	
			var jumlah_km = $('#jumlah_km').val();
			var jumlah_disarankan = $('#jumlah_disarankan').val();
			var calculate = Math.abs(jumlah_km / jumlah_disarankan);
			var hasil = Math.ceil(calculate);
			$('#ratarata_kmhabis').val(hasil);
			});


        setInterval(function(){
			var jumlah_bbm = 0;	
			var total_biaya = $('#total_biaya').val();
			var harga_bbm = $('#harga_bbm').val();
		    var calculate = Math.abs(total_biaya / harga_bbm);
		    var hasil = calculate.toFixed(2)
			$('#jumlah_bbm').val(hasil);

			});


			 setInterval(function(){
			var ratarata_km = 0;	
			var jumlah_km = $('#jumlah_km').val();
			var jumlah_bbm = $('#jumlah_bbm').val();
		    var calculate = Math.abs(jumlah_km / jumlah_bbm);
		    var hasil = Math.ceil(calculate);
			$('#ratarata_km').val(hasil);
			});
       
			
			});
			";

  // setInterval(function(){
		// 	var jumlah_bbm = 0;	
		// 	var jenis_bbm = $('#jenis_bbm').val();
		// 	var total_biaya = $('#total_biaya').val();
		// 	var harga = $('#harga').val();

		// 	if(jenis_bbm == 1){
		// 		harga = 6000
		// 		}
		//     if(jenis_bbm == 2){
		// 		harga = 7000
		// 		}
		//     else{
		//     	harga = 8000}

		//     var calculate = Math.abs(total_biaya / harga);
		// 	$('#jumlah_bbm').val(calculate);
		// 	});

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
	       
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	 //============= isi status
			if($column_index == 8){
				if($column_value == 1 )
				{
					$column_value = 'Belum Di Cairkan';
				}
				elseif ($column_value == 2) {
					$column_value = 'Sudah Di Cairkan';
				}
				elseif ($column_value == 3) {
					$column_value = 'Tidak disetujui';
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
	        
	  //-------------------Get id & km_akhir dari table requestbbm-------------

	      $getidkendaraan=DB::Table('hgst104_permintaanbbm')
			   ->where('id', \DB::raw("(select max(`id`) from hgst104_permintaanbbm)"))
			   ->value('id_kendaraan');

	       $getkm_akhir=DB::Table('hgst104_permintaanbbm')
			   ->where('id', \DB::raw("(select max(`id`) from hgst104_permintaanbbm)"))
			   ->value('km_akhir');

    //-------------------Update km_akhir di table kendaraan-------------
			DB::table('hgst103_kendaraan')
			 		->where('id',$getidkendaraan)
			 		->update(['km_akhir'=> $getkm_akhir]);




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



	 public function voucherBBM($id){
			
          DB::table('hgst104_permintaanbbm')
		  ->where('id','=',$id)
          ->update(['status'=>'2']);
          CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Voucher Berhasil Di Cairkan!","info");
}



	}