<!DOCTYPE html>
<html>
 <head>
 @include('admin/layouts/head')
 </head>
<body>
    @include('admin/layouts/leftnev_bar')
  <!-- Main content -->
  <div class="main-content">
    @include('admin/layouts/header')
    <!-- Page content -->
      <div class="container-fluid mt--7">
          @section('content')
            @show

      
      @include('admin/layouts/footer')
</body>

</html>