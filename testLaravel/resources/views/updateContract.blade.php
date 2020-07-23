<?php
/* $data=DB::table('contract')->where('Id',$Id) */
// var_dump($contracts);
?>
<!DOCTYPE html>
<html>
<body>

<h1>Update - Contract</h1>

<form action="{{Route('sua')}}" method="post">

<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>

  <input type="hidden" id="" name="Id" value="<?php echo $contracts->Id;?>"><br>
  <label for="fname">Name:</label><br>
  <input type="text" id="" name="Name" value="<?php echo $contracts->name;?>"><br>
  
  <label for="fname">Status:</label><br>
  <input type="text" id="" name="Status" value="<?php echo $contracts->status;?>"><br>
  
  <input type="hidden" id="" name="User_Id" value="<?php echo $contracts->user_id;?>"><br><br>
  <input type="submit" value="Submit">
</form> 
<a href="../">Về danh sách</a>
</body>
</html>