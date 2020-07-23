
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <script src="{{asset('css/bootstrap.min.js')}}"></script>
    </head>

    <body>
        <div align="left"><p><h6>Xin chào:  <u>{{session('data')['name']}}</u></h6> <a href="{{route('dangnhap')}}">Logout</a></p>  </div>
        <a href="{{route('index')}}">Về danh sách Contract</a>
        <div align="center"><h5> Name Contract: {{$nameContract[0]->name}}</h5></div>
        <a href="{{url('contract/logcontract/create',$idContract[0]->Id)}}">
        <!-- @if($data[0]->user_id==$user_id) 
        Thêm
        @endif -->
        {{ $data[0]->user_id==$user_id ? "Thêm" : "" }}
        </a> 


        <table class="table table-bordered">
            <tr>
            <td><b>Name LogContract</b></td><td><b>Dealsize</b></td>
			<td><b>Cost</b></td>
            @if ($data[0]->user_id==$user_id) <td><b>Sửa/Xóa</b></td>
            @endif
            </tr>
            @if ($data[0]->id!=null)
            @foreach($data as $row)
	           
            <tr>
                <td> {{$row->logName}}</td>
                
    			
                <td>{{$row->dealsize}}</td>
    			
                <td>{{$row->cost}}</td>
            <!--     @if ($data[0]->user_id==$user_id) -->
                <td>
                 
                <a href="{{ URL::route('editLog',[$idContract[0]->Id,$row->id]) }}">Sửa</a>
                <a href="{{ URL::route('deleteLog',[$idContract[0]->Id,$row->id]) }}">Xóa</a>
                </td>
              <!--   @endif -->
            </tr>

            @endforeach
            @endif
             
        </table>

        <h5>Tổng Dealsize: {{$totalDeal}} </h5>
        <h5>Tổng Cost: {{$totalCost}}</h5>
    </body>
</html>
