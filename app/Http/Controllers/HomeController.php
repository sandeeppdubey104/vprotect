<?php

namespace App\Http\Controllers;

use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceDetails;
use App\Model\API\InvoiceMasters;
use App\Model\API\SaleSubscription;
use App\Model\API\Vouchers;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Softon\Indipay\Facades\Indipay;
use Yajra\Datatables\Datatables; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */   
    public function __construct()
    {
            $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $headData = $this->deshboard_count();
        return view('user.home',compact('headData'));
    }

    public function sale_sub(Request $request)
    {  
         //dd($query);
        $headData = $this->deshboard_count();
        return view('user.rptsales_subs',compact('headData'));
    }
    public function getsubs()
    {
        $id = Auth::user()->user_name; 
        $query= DB::table('sales_subsc_details')->where('customer_code',$id)->get();
        // if(Auth::user()->user_type!="user")
        // {
        // $query= DB::table('sales_subsc_details')->get();
        // }
        
        return Datatables::of($query)->make(true);
    }
    public function invoices()
    { 
        $headData = $this->deshboard_count();
        return view('user.rpt_invoice',compact('headData'));
    }
    public function getinv()
    {
        //$query=InvoiceMasters::query();
        // $ledgers=Ledgers::find(1)->ledgers()-first();
        //InvoiceMasters::find(1)->ledgers()->first()->amount
        // $totalamt=0;
        // $recamt=50;
        $id = Auth::user()->user_name;         
        $cust_id=CustomerMasterModel::where('customer_code',$id)->first()->id; 
        //->value('fname')->get();
       // $query= DB::table('invoice_masters')->where('customer_id',$cust_id)->get();
        $query = InvoiceMasters::where('customer_id',$cust_id)->get();


        return Datatables::of($query)
             //->addColumn('totalamt', $InvoiceMasters) 
             //  ->addColumn('action', 'hello')

             ->addColumn('totalamt', function(InvoiceMasters $invoices) {
                $totalamt=isset(InvoiceMasters::find($invoices->id)->ledgers()->first()->amount)?InvoiceMasters::find($invoices->id)->ledgers()->first()->amount:"0";
                    return $totalamt;
                })
             ->addColumn('balance', function(InvoiceMasters $invoices) {
                $recamt=InvoiceMasters::find($invoices->id)->receipt()->sum('amount');
                //$totalamt=($totalamt-$recamt);
                     return $recamt;
                })

             ->addColumn('status', function(InvoiceMasters $invoices) {
                $totalamt=isset(InvoiceMasters::find($invoices->id)->ledgers()->first()->amount)?InvoiceMasters::find($invoices->id)->ledgers()->first()->amount:"0";
                $recamt=InvoiceMasters::find($invoices->id)->receipt()->sum('amount');
               $status="Pending";
               if($totalamt==$recamt)$status='Completed';
                    return $status;
                })

            ->addColumn('action', function(InvoiceMasters $invoices) {
            $totalamt=isset(InvoiceMasters::find($invoices->id)->ledgers()->first()->amount)?InvoiceMasters::find($invoices->id)->ledgers()->first()->amount:"0";
            $recamt=InvoiceMasters::find($invoices->id)->receipt()->sum('amount');
            $balance=($totalamt-$recamt);
$status='<a class="btn btn-primary btn-sm" target="_blank" href="'.route('home.print_invoice',$invoices->id).'" >Print</a>';
            if($totalamt!=$recamt)$status .='|<a class="btn btn-warning btn-sm btn_pay" 
            href="'.route('pay.paymentget',['id'=>$invoices->id,'balance'=>$balance]).'" >Pay</a>';
            //.route('pay.paymentget',['id'=>$invoices->id,'balance'=>$balance]).
                return $status;
            })->addColumn('details_url', function($invoices) {
                return route('home.item_details', $invoices->id);
            }) 
                // ->addColumn('action', 'user.pay')
                ->rawColumns(['action'])

        ->make(true);
    }
public function getItemDetailsSingleData($id)
    {
        $item_list = InvoiceMasters::findOrFail($id)->items;
        return Datatables::of($item_list)->make(true);
    }



    public function payments(Request $request)
    {  
         //dd($query);
        $headData = $this->deshboard_count();
        return view('user.rpt_payments',compact('headData'));
    }
    public function getpayments()
    {
        $id = Auth::user()->user_name;         
        $cust_id=CustomerMasterModel::where('customer_code',$id)->first()->id;  
        $query = Vouchers::where('cust_id',$cust_id)->with('bankallocation')->get();
        return Datatables::of($query)->addColumn('details_url', function($Vouchers) {
                return route('home.voucher_details', $Vouchers->id);
            })->make(true);
    }

    public function getpendingInvoiceList()
    {
        $Invoicequery = InvoiceMasters::where('customer_id',Auth::user()->id)->get();
        $pending_inv= array();

      
    foreach ($Invoicequery as $row) {
              $totalamt = isset(InvoiceMasters::find($row->id)->ledgers()->first()->amount)?InvoiceMasters::find($row->id)->ledgers()->first()->amount:"0"; 
               $recamt =InvoiceMasters::find($row->id)->receipt()->sum('amount'); 
                if($totalamt > $recamt)
                { 
        $pending_inv []= array(
            'invoice'=>$row->invoice_number,
            'id'=>$row->id,
            'balance'=>($totalamt-$recamt),
            // 'totalamt'=>$totalamt,
            // 'recamt'=>$recamt,
        );
                    //$pending_inv = array_merge($pending_inv, $add_inv);
                } 
            } 
            return $pending_inv;
    }

public function getVoucherDetailsSingleData($id)
    {
        $voucher_list = Vouchers::findOrFail($id)->voucher_list;
        return Datatables::of($voucher_list)->make(true);
    }


    public function print_invoice($id)
    {
        $invoice_mast=InvoiceMasters::where('id',$id)->with('items','ledgers')->first();
        //$invoice_dt=InvoiceDetails::where('main_id',$invoice_mast->id)->get();
        // return view('user.invoice_print',compact('invoice_mast'));
         $pdf = PDF::loadView('user.invoice_print',compact('invoice_mast'));
         return $pdf->stream('invoice.pdf');
    }

    public   function deshboard_count()
    { 
        $paid=0;
        $unpaid=0;
        $totalamt=0;
        $recamt=0;
        $id = Auth::user()->user_name;         

        $cust_id=CustomerMasterModel::where('customer_code',$id)->first()->id;
        $Subscriptionquery = SaleSubscription::where('customer_code',$id)->count();
        $Invoicequery = InvoiceMasters::where('customer_id',$cust_id)->get();
        $balance=0;
        $toal_invamt=0;
        $toaml_maininv=0;
        $total_recamt=Vouchers::where('cust_id',$cust_id)->sum('amount');
        foreach ($Invoicequery as $row) {
          $toaml_maininv+=$totalamt = isset(InvoiceMasters::find($row->id)->ledgers()->first()->amount)?InvoiceMasters::find($row->id)->ledgers()->first()->amount:"0"; 

           $recamt =InvoiceMasters::find($row->id)->receipt()->sum('amount');
           $balance+=($totalamt-$recamt);
            if($totalamt==$recamt)
            {
             $paid++;
            }
            else{
             $unpaid ++;
            }
        }



        return array(
            'subscription' =>$Subscriptionquery,
            'invoice'=>$Invoicequery->count(),
            'paid'=>$paid,
            'unpaid'=>$unpaid,
            'balance'=>($toaml_maininv-$total_recamt)
        );
    }

     
}
   
 