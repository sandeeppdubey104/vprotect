<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceMasters;
use App\Model\API\SaleSubscription;
use App\Model\API\Vouchers;
use App\Model\UnRegisterPayment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
       $this->middleware('auth:admin');

        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:writer')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $headData = $this->deshboard_count();
        // echo "<pre>";
        // print_r($headData);exit;
            return view('admin.home',compact('headData'));
    }

    public function sale_sub(Request $request)
    {   
        $headData = $this->deshboard_count();
        return view('admin.rptsales_subs',compact('headData'));
    }
    public function getsubs()
    {
        // $query= SaleSubscription::with('customer')->get();
        // $query=SaleSubscription::with(array('customer'=>function($query){
        //           $query->select('id','fname');
        // }))->get();
        $is_super = Auth::user()->is_super; 
        $user_name = Auth::user()->name; 
        $query=  DB::table('sales_subsc_details AS subsc')
            ->select('subsc.id','subsc.product','subsc.billing_type','subsc.kit_type','subsc.subs_valid_from','subsc.subs_valid_to','subsc.price','subsc.status','customer_master.fname')
        ->join('customer_master','customer_master.id','=','subsc.user_id');
        if($is_super!=1)
        { 
           $query->where('customer_master.created_by',$user_name);
        } 
        $query = $query->get();
        return Datatables::of($query)->make(true);
    }
    public function invoices()
    { 
        $headData = $this->deshboard_count();
        return view('admin.rpt_invoice',compact('headData'));
    }
    public function getinv()
    {
        $is_super = Auth::user()->is_super; 
        $user_name = Auth::user()->name;
        if($is_super==1)
        {
          $query=InvoiceMasters::query()->with('customer')->get();
        }
        else
        {
            $query=InvoiceMasters::where('salesperson',$user_name)->with('customer')->get();
        } 

        return Datatables::of($query)
             //->addColumn('totalamt', $InvoiceMasters) 
             //  ->addColumn('action', 'hello')

             ->addColumn('totalamt', function(InvoiceMasters $invoices) {
                $totalamt=isset(InvoiceMasters::find($invoices->id)->ledgers()->first()->amount)?InvoiceMasters::find($invoices->id)->ledgers()->first()->amount:"0";
                    return $totalamt;
                })
             ->addColumn('balance', function(InvoiceMasters $invoices) {
                $recamt=InvoiceMasters::find($invoices->id)->receipt()->sum('amount');
               // $totalamt=($totalamt-$recamt);
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
$status='<a class="btn btn-primary btn-sm" target="_blank" href="'.route('admin.home.print_invoice',$invoices->id).'" >Print</a>';
            if($totalamt!=$recamt)$status .='|<a class="btn btn-warning btn-sm" href="#">Pay</a>';
                return $status;
return '<a class="btn btn-primary btn-sm" target="_blank" href="'.route('admin.home.print_invoice',$invoices->id).'" >Print</a>';
            })->addColumn('details_url', function($invoices) {
                return route('admin.home.item_details', $invoices->id);
            }) 
                // ->addColumn('action', 'admin.pay')
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
        return view('admin.rpt_payments',compact('headData'));
    }
    public function getpayments()
    {
        //$id = Auth::user()->user_name;         
        //$cust_id=CustomerMasterModel::where('customer_code',$id)->first()->id;  
       
        $is_super = Auth::user()->is_super; 
        $user_name = Auth::user()->name; 
        if($is_super==1)
        {

          $query = Vouchers::with(['bankallocation'])->get(); 
        }
        else
        {
         $query = Vouchers::where('created_by',$user_name)->with(['bankallocation'])->get();
        }

        return Datatables::of($query)->addColumn('details_url', function($Vouchers) {
                return route('admin.home.voucher_details', $Vouchers->id);
            })->make(true);
    }
public function getVoucherDetailsSingleData($id)
    {
        $voucher_list = Vouchers::findOrFail($id)->voucher_list;
        return Datatables::of($voucher_list)->make(true);
    }



    public function print_invoice($id)
    {
         
        $invoice_mast=InvoiceMasters::where('id',$id)->with('items','ledgers')->first(); 
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
        //$id = Auth::user()->user_name;         
        //$cust_id=CustomerMasterModel::where('customer_code',$id)->first()->id;
        $Subscriptionquery = SaleSubscription::count();
        $Invoicequery = InvoiceMasters::get(['id']);

        foreach ($Invoicequery as $row) {
         $totalamt = isset(InvoiceMasters::find($row->id)->ledgers()->first()->amount)?InvoiceMasters::find($row->id)->ledgers()->first()->amount:"0";
           $recamt =InvoiceMasters::find($row->id)->receipt()->sum('amount');
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
            'unpaid'=>$unpaid
        );
    }
 
    public function show()
    {
        $headData = $this->deshboard_count();
        return view('admin.rpt_unregister_payments',compact('headData'));
    }
    public function getunregisterpayments()
    {
        return Datatables::of(UnRegisterPayment::query()->orderBy('id', 'DESC'))->make(true);
    }

     
}
   
 