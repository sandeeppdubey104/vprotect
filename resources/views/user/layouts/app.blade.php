<!DOCTYPE html>
<html>
 <head>
 @include('user/layouts/head')
 </head>
<body>
    @include('user/layouts/leftnev_bar')
  <!-- Main content -->
  <div class="main-content">
    @include('user/layouts/header')
    <!-- Page content -->
      <div class="container-fluid mt--7">
          @section('content')
            @show

      
      @include('user/layouts/footer')
</body>

</html>