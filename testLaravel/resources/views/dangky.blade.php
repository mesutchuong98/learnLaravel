<head>
          <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <script src="{{asset('css/bootstrap.min.js')}}"></script>
</head>
<form action="{{Route('xulydangky')}}" method="post">
  <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
  <div class="form-row align-items-center">
     
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username</label>
      <input type="text" class="form-control" id="inputEmail4" name="username">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" name="password">
    </div>
  </div>
  <div class="form-row align-items-center">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Họ tên</label>
      <input type="text" class="form-control" id="inputEmail4" name="name">
    </div>
  
  <div class="form-group">
    <label for="inputAddress2">Status</label>
    <input type="text" class="form-control" id="inputAddress2" name="status">
  </div>
</div>
  <button type="submit" class="btn btn-primary">Sign in</button>
  <?php 
  if(isset($message))
  echo $message;?>
</form>