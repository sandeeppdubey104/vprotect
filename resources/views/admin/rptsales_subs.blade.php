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
                    <th scope="col">Customer</th>
                    <th scope="col">Product</th>
                    <th scope="col">Billing Cycle</th>                    
                    <th scope="col">Kit Type</th>
                    <th scope="col">Registration From</th>
                    <th scope="col">Valid To</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
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
        ajax: '{!! route('admin.home.getsubs') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'fname', name: 'fname' }, 
            { data: 'product', name: 'product' },        
            { data: 'billing_type', name: 'billing_type' },
            { data: 'kit_type', name: 'kit_type' },
            { data: 'subs_valid_from', name: 'subs_valid_from' },
            { data: 'subs_valid_to', name: 'subs_valid_to' },
            { data: 'price', name: 'price' },
            { data: 'status', name: 'status' }
        ]
    });
});
</script>
@endsection