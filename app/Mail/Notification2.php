<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
 
class Notification2 extends Mailable
{
    use Queueable, SerializesModels;
 
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

       // $getInputUnit=DB::table('t201_formcuti')
       //                  ->where('id', \DB::raw("(select max(`id`) from t201_formcuti)"))
       //                  ->value('Unit_id');

       // $getEmail=DB::table('t202_email')
       //              ->where('Unit_id','=',$getInputUnit)
       //              ->value('EmployeeName');


        $getEmployee_id=DB::table('t201_formcuti')
                        ->where('id', \DB::raw("(select max(`id`) from t201_formcuti)"))
                        ->value('Employee_id');

        $getEmployee=DB::table('hrde200_employee')
                        ->where('id',$getEmployee_id)
                        ->value('EmployeeName');

       return $this->from('fatwayanifikritmv@gmail.com')
                   ->view('emailku')
                   ->subject('Pengajuan Cuti')
                   ->with(
                    [
                        'nama' => $getEmployee,
                        // 'boss' => $getEmail
                  
                    ]);
    }
}