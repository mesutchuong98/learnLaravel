<!DOCTYPE html>
<html>
<body>

<h2>Contract</h2>

<form action="{{Route('change',$id)}}" method="post">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>

 <label for="cars">Choose a name:</label>
  <select id="user" name="subscription">
    <?php foreach($UserOther as $user){?>
    <option ><?php echo $user->name?></option>
    <?php }?>
  </select>
  <input type="submit">
</form> 
<a href="{{ route('index') }}">Về danh sách</a>
</body>
</html>