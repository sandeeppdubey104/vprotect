<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceMasters;
use App\Model\API\Receipts;
use App\Model\API\VoucherList;
use App\Model\API\Vouchers;
use App\Model\API\BankAllocation;
use Illuminate\Http\Request;

class VouchersController extends Controller
{ 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      ini_set('memory_limit', '-1');
        $data = json_decode(file_get_contents("php://input"));

         //dd($data); exit;
        // echo "<pre>";
        // print_r($data) ;
// return response()->json($data);
// exit;
        $result =1;
         for ($i=0; $i <count($data) ; $i++) {
             if(isset($data[$i]->invoice_number))
            {
               foreach ($data[$i]->LedgerEntries as   $LedgerEntries) {

                $tally_guid=isset($data[$i]->tally_guid)?$data[$i]->tally_guid:"0";
                if (Vouchers::where('tally_guid', '=',$tally_guid)->exists()) {
                continue;
                }

                 $userid="0";
  $userid = isset(CustomerMasterModel::where('fname',$LedgerEntries->LedgerName)->first()->id)?CustomerMasterModel::where('fname',$LedgerEntries->LedgerName)->first()->id:"0";
                $invoice = new Vouchers();
                 $invoice->tally_guid=$data[$i]->tally_guid;
                $invoice->cust_id=$userid;                
                $invoice->voucher_no=$data[$i]->invoice_number;
                $invoice->date=$data[$i]->date!=''?$data[$i]->date:date('Y-m-d');
                $invoice->trans_ledger=$LedgerEntries->LedgerName;
                $invoice->voucher_type=$data[$i]->voucher_type;     
                $invoice->pay_mode=$LedgerEntries->Amount<0?"Debit" :"Credit"; 
                $invoice->amount=$LedgerEntries->Amount;
                $invoice->created_by=$data[$i]->created_by;
                $result = $invoice->save(); 
                if(!$result)
                {
                $result="Error During Save Voucher Main ";
                return;
                }
                $identity =$invoice->id; 
                  foreach ($LedgerEntries->ReceiptList as $ReceiptList) {
                   $receiptno=isset($ReceiptList->ReceiptNo)?$ReceiptList->ReceiptNo:"";
                  $inv_id = isset(InvoiceMasters::where('invoice_number',$receiptno)->first()->id)?InvoiceMasters::where('invoice_number',$receiptno)->first()->id:"0";
                  $amount=isset($ReceiptList->Amount)?$ReceiptList->Amount:"0";
                  $billtype=isset($ReceiptList->BillType)?$ReceiptList->BillType:"";
                    if($receiptno==""){continue;}

                    $vouchers_list=new VoucherList();
                    $vouchers_list->vouchers_id=$identity;
                    $vouchers_list->inv_id=$inv_id;
                    //VoucherList::where('invoice_number',$data[$i]->LedgerEntries[0]->ReceiptList[$x]->ReceiptNo)->invoice->first()->id;
                    $vouchers_list->receiptno=$receiptno;
                    $vouchers_list->billtype=$billtype;
                    $vouchers_list->amount=$amount;
                    $result =$vouchers_list->save();

                    $receipts = new Receipts();
                    $receipts->main_id =$identity;
                    $receipts->inv_id =$inv_id;
                    $receipts->main_voucher_id =$data[$i]->invoice_number;
                    $receipts->receiptno = $receiptno;
                    $receipts->billtype =$billtype;
                    $receipts->pay_source ='voucher';
                    $receipts->amount =str_replace('-', '',$amount);
                    $result = $receipts->save();
                  }

                  foreach ($LedgerEntries->BankAllocationList as $BankAllocationList) {
                    $bank=new BankAllocation();
                    $bank->main_id =$identity;
                    $bank->main_voucher_id =$data[$i]->invoice_number;                    
                    $bank->bankalocationdate =$BankAllocationList->bankalocationdate!=''?$BankAllocationList->bankalocationdate:date('Y-m-d');
                    $bank->instrumentdate =$BankAllocationList->instrumentdate!=''?$BankAllocationList->instrumentdate:date('Y-m-d');
                    $bank->transactiontype =$BankAllocationList->transactiontype;
                    $bank->bankname =$BankAllocationList->bankname;
                    $bank->paymentfavouring =$BankAllocationList->paymentfavouring;
                    $bank->instrumentnumber =$BankAllocationList->instrumentnumber;
                    $bank->uniquereferencenumber =$BankAllocationList->uniquereferencenumber;
                    $bank->paymentmode =$BankAllocationList->paymentmode;
                    
                    $result = $bank->save();
                  }

               }
            }
                  
            }
          if(!$result)
          {   
          return response()->json(['error'=>'Unauthorised'.$result], 401);      
          }
          else
          {
          return response()->json(['success'=>"Success"]);
          }
        }    
    } 


