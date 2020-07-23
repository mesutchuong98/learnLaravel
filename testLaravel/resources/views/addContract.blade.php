<!DOCTYPE html>
<html>
<body>

<h2>Add Contract</h2>
<?php
foreach($result as $item){
     $id=($item->Id);
 }
?>
<form action="{{Route('store')}}" method="post">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
<!-- {{session('data')['username']}} -->
  <label for="fname">Name:</label><br>
  <input type="text" id="" name="Name" value=""><br>
 
  <label for="fname">Status:</label><br>
  <input type="text" id="" name="Status" value=""><br>
  <input type="hidden" id="" name="User_Id" value="{{$id}}"><br><br>
  <input type="submit" value="Submit">
</form> 
<a href="./">Về danh sách</a>
</body>
</html>