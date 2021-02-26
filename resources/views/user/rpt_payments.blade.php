@extends('user.layouts.app')
@section('head')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
 --}}<link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
 
@endsection
@section('content')
<!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Payment List</h3>
            </div>
            <div class="table-responsive container">         
              <table class="table table-bordered " id="payments">
                <thead>
                   <tr>
                    <th></th>
                    <th scope="col">ID</th>
                    <th scope="col">Voucher No.</th>
                    <th scope="col">Date</th>
                     <th scope="col">Instrument Date</th> 
                     <th scope="col">Instrument Number</th> 
                     <th scope="col">Transaction Type</th>
                     <th scope="col">Bank Name</th>                     
                    <th scope="col">Amount</th>
                    <th scope="col">Created By</th> 
                  </tr> 
                </thead>
            </table>
            </div>           
          </div>
        </div>
      </div>
       
      
@endsection



@section('footer')

<script id="details-template" type="text/x-handlebars-template">
        @verbatim
        <div class="label label-info">Customer {{ voucher_no }}'s payments</div>
        <table class="table details-table" id="payments-{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Receipt No</th>
                <th>Bill Type</th>
                <th>Amount</th>
            </tr>
            </thead>
        </table>
        @endverbatim
    </script>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> 
<script src="{{ asset('public/js/handlebars.js') }}"></script>

{{-- <script>
$(function() {
    $('#invoices').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('home.getpayments') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'voucher_no', name: 'voucher_no' },        
            { data: 'date', name: 'date' }, 
            { data: 'amount', name: 'amount' },
            { data: 'created_by', name: 'created_by' }
            
        ]
    });
});
</script> --}}

    <script>
      var template = Handlebars.compile($("#details-template").html());
      var table = $('#payments').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('home.getpayments') }}',
        columns: [
          {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": ''
          },
           { data: 'id', name: 'id' },
            { data: 'voucher_no', name: 'voucher_no' },        
            { data: 'date', name: 'date' }, 
            { data: 'bankallocation[0].instrumentdate', name: 'bankallocation[0].instrumentdate' },
             { data: 'bankallocation[0].instrumentnumber', name: 'bankallocation[0].instrumentnumber' },
            { data: 'bankallocation[0].transactiontype', name: 'bankallocation[0].transactiontype' },
             { data: 'bankallocation[0].bankname', name: 'bankallocation[0].bankname' },
            { data: 'amount', name: 'amount' },
            { data: 'created_by', name: 'created_by' },
        ],
        order: [[1, 'asc']]
      });

      // Add event listener for opening and closing details
      $('#payments tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'payments-' + row.data().id;

        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Open this row
          row.child(template(row.data())).show();
          initTable(tableId, row.data());
          console.log(row.data());
          tr.addClass('shown');
          tr.next().find('td').addClass('no-padding bg-info');
        }
      });

      function initTable(tableId, data) {
        $('#' + tableId).DataTable({
          processing: true,
          serverSide: true,
          ajax: data.details_url,
          columns: [
            { data: 'id', name: 'id' },
            { data: 'receiptno', name: 'receiptno' },
            { data: 'billtype', name: 'billtype' },
            { data: 'amount', name: 'amount' },
           ]
        })
      }
    </script>

@endsection