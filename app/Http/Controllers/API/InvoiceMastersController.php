<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceDetails;
use App\Model\API\InvoiceMasters;
use App\Model\API\Ledgers;
use App\Model\API\Receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 

class InvoiceMastersController extends Controller
{
    public function store (Request $request)
    {
    	ini_set('memory_limit', '-1');
    	$data = json_decode(file_get_contents("php://input"));
         //dd($data); exit;
   //return response()->json($data);exit;

// echo "<pre>";
// print_r($data);exit;
    	$result =1;
		 for ($i=0; $i <count($data) ; $i++) { 
		 	//echo $data[$i]->invoice_number;

	 		// if($data[$i]->partyledgername!=""){echo "partyledgername=>".$i;exit;}
	 		// else
	 		// 	{continue; }
			$inv_no=isset($data[$i]->invoice_number)?$data[$i]->invoice_number:"0";
			if (InvoiceMasters::where('invoice_number', '=',$inv_no)->exists()) {
			continue;
			}
		 	 if(isset($data[$i]->invoice_number))
		 	 { 
		 	 	$invoice = new InvoiceMasters();
		 	 	$san =$invoice->customer;
		 	 	//print_r($data[$i]->partyledgername);exit;()
		 	 	 $CustomerMaster = new CustomerMasterModel();
		 	 	 $userid="00";
                  $userid = isset(CustomerMasterModel::where('fname',$data[$i]->partyledgername)->first()->id)?CustomerMasterModel::where('fname',$data[$i]->partyledgername)->first()->id:"00";
               //if(!$userid){print_r($data[$i]->partyledgername);exit;}
		 	 	$invoice->customer_id=  $userid ;//
				$invoice->invoice_number=$data[$i]->invoice_number;
				$invoice->date=$data[$i]->date;
				$invoice->voucher_type=$data[$i]->voucher_type;
				$invoice->refrence=$data[$i]->refrence;
				$invoice->partyname=$data[$i]->partyname;
				$invoice->partyledgername=$data[$i]->partyledgername;
				$invoice->buyeraddress=$data[$i]->buyeraddress;
				$invoice->salesperson=$data[$i]->salesperson;
				$invoice->total_amount=$data[$i]->total_amount;

				$invoice->delivery_note=$data[$i]->delivery_note;
				$invoice->sales_order=$data[$i]->sales_order;
				$invoice->pay_mode=$data[$i]->pay_mode;
				$invoice->pay_appr_code=$data[$i]->pay_appr_code;
			$invoice->cont_from=$data[$i]->cont_from!=''?$data[$i]->cont_from:date('Y-m-d');
			$invoice->cont_to=$data[$i]->cont_to!=''?$data[$i]->cont_to:date('Y-m-d');
                $invoice->kit_type=$data[$i]->kit_type;
				$result = $invoice->save();
				$identity =$invoice->id; 
				if(!$result)
				{
					$result=0;
				}
				foreach ($data[$i]->ItemList as $items) {
					if(isset($items->ItemName))
					{
					$invdt =new InvoiceDetails();
					$invdt->main_id=$identity;

					$invdt->itemname=$items->ItemName;
					$invdt->qty=$items->ItemQuantity;
					$invdt->rate=$items->RateAmount;
					$invdt->discount=$items->Discount;
					$invdt->amount=$items->Amount;
					 $result = $invdt->save();
					}
				}

	//$tax_type = array('Output CGST' =>9,'Output SGST'=>9,'Output IGST'=> 18);

				foreach ($data[$i]->LedgerEntries as $ledger) {
					if(isset($ledger->LedgerName))
					{
						// $taxrate=$ledger->Rate;
						// if(array_key_exists($ledger->LedgerName,$tax_type))
						// {
						// 	$taxrate=  array_search ($ledger->LedgerName, $tax_type);
						// }
						$ledgers = new Ledgers();
						$ledgers->main_id=$identity;
						$ledgers->type="non";
						$ledgers->ledgername=$ledger->LedgerName;
						$ledgers->amount=str_replace('-', '',$ledger->Amount);
						$ledgers->rate=$ledger->Rate;
						$result = $ledgers->save();

						foreach ($ledger->ReceiptList as $receipt) {
							if(isset($receipt->ReceiptNo)&&$receipt->BillType!="")
							{
							//return response()->json($receipt);
							if($receipt->BillType=="Agst Ref")
							{
						    $receipts = new Receipts();
							$receipts->main_id =$identity;    
							$receipts->inv_id =$identity;
							$receipts->main_voucher_id =$identity;
							$receipts->receiptno =$receipt->ReceiptNo;
							$receipts->billtype =$receipt->BillType;
							$receipts->pay_source ='inv';
							$receipts->amount =str_replace('-', '',$receipt->Amount);
							$result = $receipts->save();
							}

							}
						}


						
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
			      return response()->json(['success'=>$result]);
			     }

    }
}
