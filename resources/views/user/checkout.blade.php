@extends('user.layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<!-- Table class="form-control" style="height: -1px;"-->
     <div class="row">
        <div class="col">
          <div class="card shadow">
        <form id="frmcheckout" id="checkout" action="{{ route('pay.invpaymentget') }}" 
        method="POST">
        @csrf        
        <div class="col">
          <div class="card shadow"> 
            
            <div class="row container-fluid ">
          <div class="card-header border-0 col-md-4">
            <h3 class="mb-0">Pending Incoice List</h3>
          </div>
          <div class="card-header border-0 col-md-4" style="display: -webkit-inline-box;"> 
            <input type="text" class="form-control" id="txtamount" readonly name="txtamount"  value="0"> 
        </div>
          <div class="card-header border-0 col-md-4 pull-right">
            <button type="submit"  class="btn btn-primary">Proceed</button>
          </div>
            </div>

            <div class="table-responsive container"> 
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">INVOICE NO.</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">STATUS</th> 
                    <th scope="col">ACTION</th> 
                  </tr>
                </thead>
                <tbody>
                  
                  @for ($i = 0; $i <count($pending_inv) ; $i++)
                    <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
            <input type="hidden" id="invno_{{$i}}" name="rows[{{$i}}][invoice]" value="{{$pending_inv[$i]['invoice']}}">
            <input type="hidden" id="invid_{{$i}}" name="rows[{{$i}}][invoice_id]" value="{{$pending_inv[$i]['id']}}">
                          <span class="mb-0 text-sm">{{$pending_inv[$i]['invoice']}}</span>
                        </div>
                      </div>
                    </th>
                    <td>
                <input type="hidden" id="balance_{{$i}}" name="rows[{{$i}}][balance]" value="{{$pending_inv[$i]['balance']}}">
                      &#8377; {{$pending_inv[$i]['balance']}} INR
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i> pending
                      </span>
                    </td>                    
                    <td>
                      <div class="d-flex align-items-center">
                        {{-- <a href="#" class="btn btn-primary">Add</a> --}}
<input type="checkbox" id="check_{{$i}}" name="rows[{{$i}}][checked]" class="checkbox form-control"checked />
                      </div>
                    </td>
                  </tr> 
                  @endfor
                  
                </tbody>
              </table>
            </div> 
          </div>          
        </div>
 </form>

       </div>
        </div>
      </div>
      

      
@endsection


@section('footer')
{{--  <script type="text/javascript">
   $(".checkbox").change(function() {
    if(this.checked) {
       alert('checked');
    }
    else
    {
       alert('unchecked');
    }
});
 </script> --}}

<script>
var countChecked = function() {
  var n = $( ".checkbox" ).length;  
   var totalamt=0;
   //debugger;
   for (var i = 0; i < n; i++) {
     if($('#check_'+i).prop("checked") == true){
        totalamt+=parseInt($('#balance_'+i).val());
      }
    }
    //console.log(totalamt);
    $('#txtamount').val(totalamt);
};
countChecked(); 
$( "input[type=checkbox]" ).on( "click", countChecked );
</script> 

<script>
 $(document).ready(function(){
$('#frmcheckout').submit(function(event) {
  debugger;
  var numItems = $('.checkbox').length; 
   for(i=0;i< numItems;i++)
   { 
    if(i==0) continue;
    var inc_ind= $('.checkbox')[i-1].checked;
    var act_ind= $('.checkbox')[i].checked;
        if(act_ind && !inc_ind) {
          if(!confirm("Old Invoice id still pending. Do you want to continue ?"))
          {
              event.preventDefault();
          }
      } 
   }
});
 });

</script>

@endsection