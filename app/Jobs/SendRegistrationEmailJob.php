<?php

namespace App\Jobs;

use App\Mail\SendRegistrationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Support\Facades\Mail;
use Mail;

class SendRegistrationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     protected $userDt;
    /**
     * Create a new job instance.
     *
     * @return void
     *///
    public function __construct($notification)
    {
        //
        $this->userDt=$notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {//
        Mail::to('Sandeeppdubey104@gmail.com')->send(new SendRegistrationEmail($this->userDt));
        //$this->dispatch(new SendRegistrationEmail($userDt));
        $mobile='8750344156';//$this->userDt['mobile'];
        $message="Dear%20".$this->userDt['name'].",%20Welcome%20on%20the%20digital%20self-serve%20platform%20of%20Vprotect.%20Please%20find%20below%20login%20details.%20Customer%20ID:%20".$this->userDt['customer_code']."%20Password:%20".$this->userDt['pass']."%20Please%20click%20on%20the%20link%20https://crm.vprotectindia.com/%20to%20login.%20You%20can%20download%20all%20your%20invoices%20and%20track%20your%20payment%20status%20after%20login.%20Please%20contact%20to%20customer%20care%2011880099%20for%20more%20details.";
        $this->send_sms($mobile,$message);
    }

    function send_sms($mobile,$message)
    {
            $url="http://sms1.infocityhosting.com/WebServiceSMS.aspx?User=vprotect&passwd=98221210i3&mobilenumber=$mobile&message=$message&sid=SISPRO&mtype=N&sid=SISPRO&mtype=N";
            //echo $url;exit;           
            $c=curl_init();
            curl_setopt($c,CURLOPT_RETURNTRANSFER,1);       
            curl_setopt($c,CURLOPT_URL,$url);
            curl_setopt($c,CURLOPT_URL,$url);
            $CONTENT=curl_exec($c);
            curl_close($c); 
            //echo $CONTENT;exit;
    }
    
}
