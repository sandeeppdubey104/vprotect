@extends('admin.layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Subscription List</h3>
            </div>
            <div class="table-responsive container">  
              <table class="table table-bordered " id="salesubs">
                <thead>
                    <tr>
                   <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Email</th>                    
                    <th scope="col">Address</th>
                    <th scope="col">Tran Number</th>
                    <th scope="col">Trans Remarks</th>
                    <th scope="col">Bank Ref_no</th>
                    <th scope="col">Date</th>
                    <th scope="col"></th> {{----}}
                  </tr>
                </thead>
            </table>
            </div> 
          </div>
        </div>
      </div>
       

      
@endsection


@section('footer')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> 

<script>
$(function() {
    $('#salesubs').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.home.getunregisterpayments') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'ledger_name', name: 'ledger_name' },
            { data: 'amount', name: 'amount' },
            { data: 'email', name: 'email' },
            { data: 'address', name: 'address' },
            { data: 'tran_number', name: 'tran_number' },
            { data: 'trans_remarks', name: 'trans_remarks' },
            { data: 'bank_ref_no', name: 'bank_ref_no' }, 
            { data: 'date', name: 'date' },  
        ]
    });
});
</script>
@endsection