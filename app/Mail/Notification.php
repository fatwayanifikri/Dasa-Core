<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
 
class Notification extends Mailable
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
       $getID=DB::table('t201_formcuti')
              ->where('id', \DB::raw("(select max(`id`) from t201_formcuti)"))
              ->value('Employee_id');

       $getName=DB::table('hrde200_employee')
              ->where('id',$getID)
              ->value('EmployeeName');

       return $this->from('it.dasagroup@gmail.com')
                   ->view('mail/email_cuti')
                   ->subject('Request Cuti')
                   ->with([
                        'nama' => $getName
                    ]);
    }
}