<?php

namespace App\Http\Controllers;

use App\Jobs\SendRegistrationEmailJob;
use App\Mail\SendRegistrationEmail;
use App\common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }
    public function send()
    {
        Log::info("Request Cycle with Queues Begins");
     $this->dispatch((new SendRegistrationEmailJob())->delay(now()->addMinutes(60*5)));
        //Mail::to('Sandeeppdubey104@gmail.com')->send(new SendRegistrationEmail());
       // $this->send_sms('12345678','345678');
        Log::info("Request Cycle with Queues Ends");
    }

// public function sendMessage($message,$mobileNumber){
//         // send message to mobile number  
//         $url = SMS_PROVIDER_URL;
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, 'username=TEST&message=' . $message . '&sendername=MYNAME&smstype=TRANS&numbers=' . $mobileNumber . '&apikey=111111111111111111');
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         $result = curl_exec($ch);
//     }


    function send_sms($mobile,$message)
    {
            $url="http://sms1.infocityhosting.com/WebServiceSMS.aspx?User=vprotect&passwd=98221210i3&mobilenumber=8750344156&message=Dear%20Sandeep,%20your%20Bill%20is%20due%20for%20payment%20for%20customer%20id%20SAN112%20and%20order%20id%20SANORD1.%20Total%20Amount%20due%20is%20Rs2999.%20To%20pay%20online%20click%20www.crm.vprotectindia.com.%20For%20Queries%20call%20customer%20care%2001244171831%20Please%20ignore%20if%20already%20paid.&sid=SISPRO&mtype=N";
            //echo $url;exit;           
            $c=curl_init();
            curl_setopt($c,CURLOPT_RETURNTRANSFER,1);       
            curl_setopt($c,CURLOPT_URL,$url);
            curl_setopt($c,CURLOPT_URL,$url);
            $CONTENT=curl_exec($c);
            curl_close($c); 
            //echo $CONTENT;exit;
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\common  $common
     * @return \Illuminate\Http\Response
     */
    public function show(common $common)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\common  $common
     * @return \Illuminate\Http\Response
     */
    public function edit(common $common)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\common  $common
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, common $common)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\common  $common
     * @return \Illuminate\Http\Response
     */
    public function destroy(common $common)
    {
        //
    }
}
