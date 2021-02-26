@extends('user.layouts.app')
@section('head')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
<link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">  
          <div class="card-header border-0">
              <h3 class="mb-0">Invoice List</h3>
            </div>
            <div class="table-responsive container">
             
              <table class="table table-bordered " id="invoices">
                <thead>
                   <tr>
                    <th></th>
                    <th scope="col">ID</th>
                    <th scope="col">Invoice No</th>
                    <th scope="col">Invoice Date</th>
                    <th scope="col">Voucher Type</th>
                    <th scope="col">Total amt</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Status</th> 
                    <th scope="col">Action</th>
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
        <div class="label label-info">Customer {{ invoice_number }}'s Invoice</div>
        <table class="table details-table" id="invoices-{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Discount</th> 
                <th>Amount</th>
            </tr>
            </thead>
        </table>
        @endverbatim
    </script>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> 
<script src="{{ asset('public/js/handlebars.js') }}"></script>
<script>
// $(function() {
//     $('#invoices').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: '{!! route('home.getinvoices') !!}',
//         columns: [
//             { data: 'id', name: 'id' },
//             { data: 'invoice_number', name: 'invoice_number' },        
//             { data: 'date', name: 'date' },
//             { data: 'voucher_type', name: 'voucher_type' },
//             { data: 'totalamt', name: 'totalamt' },
//             { data: 'balance', name: 'balance' },
//             { data: 'status', name: 'status' },
//             { data: 'action', name: 'action' }
            
//         ]
//     });
// });
 var template = Handlebars.compile($("#details-template").html());
 var table = $('#invoices').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('home.getinvoices') !!}',
        columns: [
        {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": ''
          },
            { data: 'id', name: 'id' },
            { data: 'invoice_number', name: 'invoice_number' },        
            { data: 'date', name: 'date' },
            { data: 'voucher_type', name: 'voucher_type' },
            { data: 'totalamt', name: 'totalamt' },
            { data: 'balance', name: 'balance' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' }
            
        ],
        order: [[1, 'asc']]
    });

  // Add event listener for opening and closing details
      $('#invoices tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'invoices-' + row.data().id;

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
          tr.next().find('td').addClass('no-padding bg-secondary');
        }
      });

       function initTable(tableId, data) {
        $('#' + tableId).DataTable({
        bLengthChange: false,
        bPaginate: false,
          processing: true,
          serverSide: true,           
          ajax: data.details_url,
          columns: [
            { data: 'id', name: 'id' },
            { data: 'itemname', name: 'itemname' },
            { data: 'qty', name: 'qty' },
            { data: 'rate', name: 'rate' },
            { data: 'discount', name: 'discount' },
            { data: 'amount', name: 'amount' },
           ]
        })
      }
</script> 

@endsection