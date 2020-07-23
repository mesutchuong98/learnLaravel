<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="../admin/Assets/css/style.css">
<div class="container">
    <div>
      <a href="{{Route('dangky')}}">Đăng ký</a>
    </div>
     
                        <form class="form" action="{{Route('user')}}" method ="POST">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                            <div class="form-group">
                                <label >Username:</label><br>
                                <input type="text" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label >Password:</label><br>
                                <input type="password" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Đăng nhập">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>