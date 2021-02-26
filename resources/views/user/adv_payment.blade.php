@extends('user.layouts.app')
@section('head') 
@endsection
@section('content')
<!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <form id="advpay" action="{{ route('pay.advpaymentget') }}" method="POST" >
              @csrf              
           <div class="row container-fluid ">
          <div class="card-header border-0 col-md-4">
            <h3 class="mb-0">Advance Amount Pay</h3>
          </div>
          <div class="card-header border-0 col-md-4" style="display: -webkit-inline-box;"> 
            <input type="text" class="form-control" id="txtamount" name="txtamount"  value="0"> 
        </div>
          <div class="card-header border-0 col-md-4 pull-right">
            <button type="submit"  class="btn btn-primary">Proceed</button>
          </div>
            </div>
            </form>
          </div>
        </div>
      </div>
       
      
@endsection



@section('footer')  
@endsection