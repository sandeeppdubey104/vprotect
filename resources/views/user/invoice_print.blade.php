
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Invoice</title>
</head>
<style>
body{
  font-family:Arial;
  font-size: 13 px;
  }
p    {color: red;}
.td{
  font-weight:bold;
  padding:2px;
  }
  
.tdclasshead{
  border-bottom:1px solid;
  border-left:1px solid;
  font-weight:bold;
  }
  
.tdclassleft{
  border-left:1px solid;
  font-weight:normal;
  text-align:left;
  padding:2px;
  }
.tdclasscenter{
  border-left:1px solid;
  font-weight:bold;
  text-align:center;
  padding:2px;
  }
.tdclassright{
  border-left:1px solid;
  font-weight:bold;
  text-align:right;
  padding:2px;
  }
.tdclasstop{
  border-top:1px solid;
  font-weight:bold;
  padding:2px;
  }
.tdclassbottom{
  border-bottom:1px solid;
  border-left:1px solid;
  font-weight:bold;
  padding:2px;
  }

</style>
<body>
<table width="100%" border="1" cellpadding="0" cellspacing="0">

   <tr>
     <td colspan="2" rowspan="2" class="tdclassleft"><strong>SIS Prosegur Alarm Monitoring And Response Services Pvt Ltd</strong><br />      
       4th &amp; 5th Floor, Plot No. 10, GNG Tower, Sector - 44, Gurgaon, Haryana - 122002, GSTIN/UIN: 06AAWCS0189H1ZU, State Name : Haryana, Code : 06, CIN: U74140BR2015PTC024604</td>
       

     <td width="25%" class="tdclassleft" valign="top">Invoice No.<br /><strong>{{$invoice_mast->invoice_number}}</strong></td>
     <td width="26%" class="tdclassleft" valign="top">Dated<br /><strong>{{$invoice_mast->date}}</strong></td> 
   </tr>
   <tr>
     <td class="tdclassleft" valign="top">Delivery Note<br /><strong>{{$invoice_mast->delivery_note}}</strong></td>
     <td class="tdclassleft" valign="top">Mode of Payment<br /><strong>{{$invoice_mast->pay_mode}}</strong></td>
   </tr>
   <tr>
     <td colspan="2" rowspan="3" valign="top" class="tdclassleft" style="height: 100px;"><strong>Bill To</strong><br />
       <strong>{{$invoice_mast->partyledgername}}</strong><br />        
      {{$invoice_mast->buyeraddress}}</td>
     <td class="tdclassleft" valign="top">Buyer's Order No.<br /><strong>{{$invoice_mast->sales_order}}</strong></td>
     <td class="tdclassleft" valign="top">Payment Approval Code<br /><strong>{{$invoice_mast->pay_appr_code}}</strong></td>
   </tr>
   <tr>
     <td class="tdclassleft" valign="top">Sales Person<br /><strong>{{$invoice_mast->salesperson}}</strong></td>
     <td class="tdclassleft" valign="top">Dated<br /><strong>{{$invoice_mast->date}}</strong></td>      
   </tr>
   <tr>
     <td colspan="2">&nbsp;</td>      
   </tr>
   <tr>
    <td colspan="4">
      <table cellpadding="0" cellspacing="0" width="100%" border="0">
        <tr>
             <td width="40%" colspan="2" align="center" class="tdclasscenter"><strong>Contract Validity</strong></td>
             <td width="30%" align="center" class="tdclassbottom"><strong>Payment Terms</strong></td>
             <td width="30%" align="center" class="tdclassbottom"><strong>Type of Premises</strong></td>
         </tr>
        <tr>
             <td width="40%" colspan="2" align="center">
              <table cellpadding="0" cellspacing="0" width="100%" border="0">
                <tr><td class="tdclasstop">Contract Start Date : {{$invoice_mast->cont_from}}</td></tr>
                <tr><td class="tdclasstop">Contract End Date : {{$invoice_mast->cont_to}}</td></tr>
              </table>             
             </td>
             <td width="30%" align="center" rowspan="2" class="tdclassleft">&nbsp;</td>
             <td width="30%" align="center" rowspan="2" class="tdclasscenter"><strong>{{$invoice_mast->kit_type}}</strong></td>
         </tr>
        
      </table>
    </td> 
   </tr>
   <tr>
     <td colspan="4" valign="top">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" width="3%" class="tdclasshead">Sl No.</td>
            <td align="center" width="37%" class="tdclasshead">Description of Goods</td>
            <td align="center" width="10%" class="tdclasshead">HSN/SAC</td>
            <td align="center" width="10%" class="tdclasshead">Quantity</td>
            <td align="center" width="10%" class="tdclasshead">Rate</td>
            <td align="center" width="5%" class="tdclasshead">Per</td>
            <td align="center" width="12%" class="tdclasshead">Gross Amount</td>
            <td align="center" width="13%" class="tdclasshead">Net Amount</td>
          </tr>
          {{-- <tr>
            <td class="tdclasscenter">1</td>
            <td class="tdclassleft">Standard KIT</td>
            <td class="tdclassleft">8531</td>
            <td class="tdclassright">1 Pcs</td>
            <td class="tdclassright">35,585.00</td>
            <td class="tdclasscenter">Pcs</td>
            <td class="tdclassright">35,585.00</td>
            <td class="tdclassright">35,585.00</td>
          </tr>
          <tr>
            <td class="tdclasscenter">2</td>
            <td class="tdclassleft">External Wireless Siren</td>
            <td class="tdclassleft">8531</td>
            <td class="tdclassright">1 Pcs</td>
            <td class="tdclassright">8,042.00</td>
            <td class="tdclasscenter">Pcs</td>
            <td class="tdclassright">8,042.00</td>
            <td class="tdclassright">8,042.00</td>
          </tr>
          <tr>
            <td class="tdclasscenter">3</td>
            <td class="tdclassleft">KeyFob Remote</td>
            <td class="tdclassleft">8531</td>
            <td class="tdclassright">1 Pcs</td>
            <td class="tdclassright">4,229.00</td>
            <td class="tdclasscenter">Pcs</td>
            <td class="tdclassright">4,229.00</td>
            <td class="tdclassright">4,229.00</td>
          </tr> --}}
          
            @php
              $total_qty=0;
              $total_amt=0;
               $total_disc=0;
            @endphp
          @foreach ($invoice_mast->items as $item)
          
             @php
                $total_qty+=substr($item->qty, 0, 2)  ;
                $total_disc=$item->discount;
                $total_amt+=$item->amount  ;
            @endphp
           <tr>
            <td class="tdclasscenter">{{$loop->index+1}}</td>
            <td class="tdclassleft">{{$item->itemname}}</td>
            <td class="tdclassleft">8531</td>
            <td class="tdclassright">{{$item->qty}}</td>
            <td class="tdclassright">{{str_replace('/Pcs', '', $item->rate)}}</td>
            <td class="tdclasscenter">Pcs</td>
            <td class="tdclassright">{{$item->amount}}</td>
            <td class="tdclassright">{{$item->amount}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright" style="padding:2px; font-weight:normal;"><hr />
            {{$total_amt}}</td>
          </tr> 

          @php
                  $center_tax_perc=0;$state_tax_perc=0;
                  $center_tax_amt=0;$state_tax_amt=0;
          @endphp
          @foreach ($invoice_mast->ledgers as $ledger) 
          @if ($loop->index==0 && count($invoice_mast->items)==0)  
                 @php
                   $total_amt+=$ledger->amount
                 @endphp
             @endif   
            @if ($ledger->rate>0&&($ledger->ledgername=="Output IGST"||$ledger->ledgername=="Output CGST"))
               @php
               $center_tax_perc=$ledger->rate;
               $center_tax_amt=$ledger->amount;
               @endphp           
            @elseif ($ledger->rate>0&&$ledger->ledgername=="Output SGST")
              @php
                $state_tax_perc=$ledger->rate;
                 $state_tax_amt=$ledger->amount;
              @endphp
            @endif
            @continue($loop->index==0)            
            <tr>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassright">{{$ledger->ledgername}}</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">{{$ledger->rate}}</td>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">{{$ledger->amount}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
          </tr>
           
          <tr>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassleft">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclasscenter">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
            <td class="tdclassright">&nbsp;</td>
          </tr>
         </table>
    </td>      
   </tr>
   <tr>
    <td colspan="4" valign="top">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" width="3%" class="tdclasscenter">&nbsp;</td>
            <td align="center" width="37%" class="tdclassright"><span style="font-weight:normal">Total</span></td>
            <td align="center" width="10%" class="tdclassleft">&nbsp;</td>
            <td align="center" width="10%" class="tdclassright">{{$total_qty}} Pcs</td>
            <td align="center" width="10%" class="tdclassright">&nbsp;</td>
            <td align="center" width="5%" class="tdclasscenter">&nbsp;</td>
            <td align="center" width="12%" class="tdclassright"><span style="font-weight:normal">{{$total_amt}}</span></td>
            <td align="center" width="13%" class="tdclassright">{{$total_amt}}</td>
          </tr>
         </table>
      </td>
   </tr>
   <tr>
    <td colspan="4" valign="top">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" width="50%" class="tdclassleft" valign="top"><span style="font-weight:normal">Amount Chargeable (in words)</span><br/>INR {{displaywords($total_amt)}}</td>
            <td align="center" class="tdclassright" valign="top"><span style="font-weight:normal">E. &amp; O.E</span></td>
          </tr>
         </table>
      </td>
   </tr>
   <tr>
    <td colspan="4" valign="top">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" width="44%" class="tdclasscenter">HSN/SAC</td>
            <td align="center" width="10%" class="tdclasscenter">Taxable</td>
            <td align="center" width="18%" class="tdclassbottom">Central Tax</td>
            <td align="center" width="18%" class="tdclassbottom">State Tax</td>
            <td align="center" width="10%" class="tdclasscenter">Total</td>
          </tr>
         </table>
      </td>
   </tr>
   <tr>
    <td colspan="4" valign="top">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
           <tr>
            <td align="center" width="44%" class="tdclasscenter">&nbsp;</td>
            <td align="center" width="10%" class="tdclassbottom">Value</td>
            <td align="center" width="8%" class="tdclassbottom">Rate</td>
            <td align="center" width="10%" class="tdclassbottom">Amount</td>
            <td align="center" width="8%" class="tdclassbottom">Rate</td>
            <td align="center" width="10%" class="tdclassbottom">Amount</td>
            <td align="center" width="10%" class="tdclassbottom">Tax Amount</td>
          </tr>
           <tr>
            <td align="left" width="44%" class="tdclasstop">8531</td>
            <td align="center" width="10%" class="tdclassright">{{($total_amt-$total_disc)}}</td>
            <td align="center" width="8%" class="tdclassright">{{$center_tax_perc}}%</td>
            <td align="center" width="10%" class="tdclassright">{{$center_tax_amt}}</td>
            <td align="center" width="8%" class="tdclassright">{{$state_tax_perc}}%</td>
            <td align="center" width="10%" class="tdclassright">{{$state_tax_amt}}</td>
            <td align="center" width="10%" class="tdclassright">{{($center_tax_amt+$state_tax_amt)}}</td>
          </tr>
         </table>
    </td>
   </tr>
   <tr>
     <td colspan="4" class="tdclassleft"><span style="font-weight:normal">Tax Amount (in words) :</span> INR {{displaywords(($center_tax_amt+$state_tax_amt))}}</td>      
   </tr>
   <tr>
     <td colspan="4" class="tdclassleft">&nbsp;</td>      
   </tr>
   <tr>
     <td colspan="4" class="tdclassleft">&nbsp;</td>      
   </tr>
   <tr>
    <td colspan="4" valign="top">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="20%" class="td">Company's PAN</td>
            <td align="left" width="28%" class="td">: AAWCS0189H</td>
            <td align="right" width="52%" class="tdclassright">for SIS Prosegur Alarm Monitoring And Response Services Pvt Ltd</td>
          </tr>
          <tr>
              <td colspan="3" valign="top">
                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" width="48%" class="td"><span style="text-decoration:underline">Declaration</span><br />We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</td>
                      <td align="center" valign="bottom" width="52%" class="tdclassright" style="height:80px;">Authorised Signatory</td>
                    </tr>
                 </table>
              </td>
           </tr>
         </table>
      </td>
   </tr>
  <tr>
     <td colspan="4" class="tdclasscenter">Please refer to Terms &amp; Conditions governing this Invoice/Contract</td>      
  </tr>
  <tr>
     <td colspan="4" class="tdclassleft">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" width="10%" class="td">E-Mail Support </td>
            <td align="left" width="90%" class="td">: customercare@vprotectindia.com</td>
          </tr>
          <tr>
            <td align="left" width="10%" class="td">Call Centre </td>
            <td align="left" width="90%" class="td">: 0124-4171800</td>
          </tr>
        </table>
     </td>      
  </tr>
   
  <table>
</body>
</html>


@php
function displaywords($number){
   $no = (int)floor($number);
   $point = (int)round(($number - $no) * 100);
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;


     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);


  if ($point > 20) {
    $points = ($point) ?
      "" . $words[floor($point / 10) * 10] . " " . 
          $words[$point = $point % 10] : ''; 
  } else {
      $points = $words[$point];
  }
  if($points != ''){        
      echo $result . "Rupees  " . $points . " Paise Only";
  } else {

      echo $result . "Rupees Only";
  }

}
@endphp