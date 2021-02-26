@extends('user.layouts.app')

@section('content')
<!-- Table -->
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="{{ asset('public/user/img/theme/team-4-800x800.jpg') }} " class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              {{-- <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div> --}}
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Invoices</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Paid</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Unpaid</span>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
           <form role="form" action="{{ route('profile.update',$user) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-4">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-left">
                  {{-- <a href="#!" class="btn btn-larg btn-primary">Update</a> --}}
                  <input type="submit" class="btn btn-primary" value="Update">
                </div>
                <div class="col-4 text-right">
                   <input type="file" name="image" id="image">
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label> 
                        <input type="text" class="form-control" id="input-username" class="form-control form-control-alternative" name="user_name" disabled="" placeholder="Username" value="{{ $user->user_name }}">

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label> 
                        <input type="email" class="form-control" id="input-email" class="form-control form-control-alternative" name="email" placeholder="Email" disabled="" value="{{ $user->email }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Name</label> 
                        <input type="text" class="form-control" id="input-name" class="form-control form-control-alternative" name="name" placeholder="Name" disabled="" value="{{ $user->name }}">

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Mobile</label>
                        <input type="text" id="input-mobile" class="form-control form-control-alternative" placeholder="Mobile" name="mobile" disabled="" value="{{ $user->mobile }}">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-password">Password</label> 
                        <input type="password" class="form-control" id="input-name" class="form-control form-control-alternative" name="password"  placeholder="Password">

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Confirmation Password</label>
                        <input type="password" id="password_confirmation" class="form-control form-control-alternative" placeholder="Confirmation Password" name="password_confirmation" >
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" name="address" value="{{ $user->address }}" type="text">
                      </div>
                    </div>
                  </div>
                  {{-- <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="New York">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="United States">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">
                      </div>
                    </div>
                  </div> --}}
                </div> 
              </form>
            </div>
          </div>
          </form>
        </div>
      </div>

      
@endsection

