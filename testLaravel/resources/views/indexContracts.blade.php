<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <script src="{{asset('css/bootstrap.min.js')}}"></script>
    </head>
    
    <body>
        <p><h3>Xin chào:  <u>{{session('data')['name']}}</u></h3> <a href="{{route('dangnhap')}}">Logout</a></p>
       
        
        <a href="{{route('create')}}">Thêm</a>

        <!-- {{session('data')['username']}} -->
      
        
        <table class="table table-bordered">
            <tr>
                <td>Contract Id</td>
                <td>Contract Name </td>
                <td>Status</td>
			    <td>User_Id</td>
                <td>Level_User</td>
                <td>Sửa/Xóa/Chuyển/Log</td>
            </tr>
            <?php foreach($data as $row){?>
	
            <tr>
                <td> <?php echo $row->Id;?></td>
                
                <td><?php echo $row->name;?></td>
    			
                <td><?php echo $row->status;?></td>
    			
                <td><?php echo $row->user_id;?></td>
                <td><?php echo $row->level;?></td>
                
                <td>
                 <?php   if($id==$row->user_id){?>
                <a href="{{ url('contract/edit', $row->Id) }}">Sửa</a>
                <a href="{{ url('contract/delete', $row->Id) }}">Xóa</a>
                <a href="{{ URL::route('chuyen',[$row->user_id,$row->Id]) }}">Chuyển</a>
                 <?php }?>
                <a href="{{ url('contract/logcontract',$row->Id)}}">Log</a>
                </td>
               
            </tr>

        
             <?php } ?>
        </table>
    </body>
</html>