<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contracts;
use App\User_Ct;
use App\LogContract;
Use Auth;

class ContractController extends Controller
{
    
    public function index()
    {
        $data=[];
        $session=session('data');
        $level=$session['level'];
        $id= $session['Id'];

        if($level==3){
           $data= Contracts::join('users','contract.user_id','=','users.Id')->where('user_id',$id)
           ->select('contract.Id','contract.name','contract.status','contract.user_id','users.level')->get();
  
        }
        if($level==2){
            $data=Contracts::join('users','contract.user_id','=','users.Id')
                ->where('users.level','3')
                ->orWhere('users.level','2')
                ->where('users.Id',$id)
                ->select('contract.Id','contract.name','contract.status','contract.user_id','users.level')
                ->get();
        }
        else if($level==1){
            // $data=Contracts::all();
            $data=Contracts::join('users','contract.user_id','=','users.Id')->orWhere('users.level','3')
                ->orWhere('users.level','2')->orWhere('users.level','1')->where('users.Id',$id)
                ->select('contract.Id','contract.name','contract.status','contract.user_id','users.level')
                ->get();
                // dd($data);
                      
        }

       
        return view('indexContracts', compact('data', 'id'));
    }

  
    public function create()
    {
        $username=session('data')['username'];
        $result = User_Ct::where('username', $username)->get();
		return view('addContract', compact('result'));
        //
    }

    public function store(Request $request)
    {
        $contract = new Contracts;
        $contract->name = $request->Name;
 
		$contract->status = $request->Status;
		$contract->user_id = $request->User_Id;
        $contract->save();
        return redirect()->route('index');
    }

    public function edit($id)
    {   
       
        $contracts = Contracts::find($id);
        // dd($contracts);
        $pageName = "Contracts - Update";
        return view('updateContract', compact('contracts', 'pageName'));
    }

       public function sua(Request $request)
    {
        
        $contracts = Contracts::find($request->Id);

        $contracts->name = $request->Name;
        $contracts->contractId = $request->ContractId;
		$contracts->status = $request->Status;
       

        $contracts->save();
        
        //dd($contracts);
         
        // dd($contracts->save()); die;
        return redirect()->route('index'); 
    }

    
    public function destroy($id)
    {
        
      Contracts::find($id)->delete();

  
        // dd($contracts);die;
        // dd($contracts);
        
        return redirect()->route('index');
    }

      public function chuyen($user_id,$id){

        // $username=session('data')['username'];
        // $result = User_Ct::where('username', $username)->get();
        // $name= $result[0]->name;
        $UserOther=User_Ct::where('Id','!=',$user_id)->get();
        
        

        // dd($UserOther);
        
        return view('chuyen', compact('id','UserOther'));
    }
    public function change(Request $rq, $id){
        $selectValue = $rq->input('subscription');
        // dd($selectValue);
        $user = User_Ct::where('name',$selectValue)->get();
        $id_user=$user[0]->Id;
        
        $contracts = Contracts::find($id);
        $contracts->user_id=$id_user;
        $contracts->save();
        return redirect()->route('index'); 
        
    }

    public function dangnhap(){
        session()->forget('data');
        return view('dangnhap');
    }

    public function dangky(){
        return view('dangky');
    }

    public function xulydangky(Request $rq){
        $user=new User_Ct;
        $message="Bạn vui lòng nhập đầy đủ thông tin!!!";
        if(!empty($rq->username) && !empty($rq->password) &&!empty($rq->name) &&!empty($rq->status) && !empty($rq->status)){
        $user->username=$rq->username;
        $user->password=$rq->password;
        $user->name=$rq->name;
        $user->status=$rq->status;
        $user->Id=$rq->Id;
        $user->level='3';
        $user->save();
        }
        
        else {
            return view('dangky', compact('message'));
        }

        return view('dangnhap');
    }



    public function kiemtra_user(Request $rq){
        $username = $rq ->username;
        $password = $rq ->password;

        //Kiểm tra xem có khớp với username và password trong hệ thống không?
        $result = User_Ct::where('username', $username)->where('password',$password)->first()->toArray();
        if(!empty($result)){
            $rq->session()->put('data',$result);
            return redirect()->route('index');                                                   

        } else {
            return redirect()->route('dangnhap');
        }
    }

     public function logcontract($id){
       
      
        $level=session('data')['level'];
        
        $user_id=session('data')['Id'];

        if($level==1){

        $data=Contracts::leftjoin('log_contract','contract.Id','=','log_contract.contract_id')
        // ->where('contract.user_id',$user_id)
        ->where('contract.Id',$id)
        ->select('log_contract.name as logName','contract.name as contractName','log_contract.dealsize','log_contract.cost','log_contract.id','contract.user_id')
        ->get();
        }
        if($level==2){
            $data=Contracts::leftjoin('log_contract','contract.Id','=','log_contract.contract_id')
        // ->where('contract.user_id',$user_id)
        ->where('contract.Id',$id)
        ->select('log_contract.name as logName','contract.name as contractName','log_contract.dealsize','log_contract.cost','log_contract.id','contract.user_id')
        ->get();
        }
        if($level==3){
            $data=Contracts::leftjoin('log_contract','contract.Id','=','log_contract.contract_id')
        ->where('contract.user_id',$user_id)
        ->where('contract.Id',$id)
        ->select('log_contract.name as logName','contract.name as contractName','log_contract.dealsize','log_contract.cost','log_contract.id','contract.user_id')
        ->get();
        }
        // dd(session('data'));
        // dd($data); die;
      
        $nameContract=Contracts::where('Id',$id)->select('contract.name')->get();
        $idContract=Contracts::where('Id',$id)->select('contract.Id')->get();
        // if($data->isEmpty()){
        //     $totalDeal=0;
        //     $totalCost=0;
        //     $data=null;
            
        //     return view('logcontract', compact('data','nameContract','idContract','user_id','totalDeal','totalCost'));
        // }
        // else{
            
            // dd($data);
            $totalDeal=0;
            $totalCost=0;
            foreach($data as $value){
                $totalDeal+=$value->dealsize;
                $totalCost+=$value->cost;
            }

            return view('logcontract', compact('data','nameContract','idContract','totalDeal','totalCost','user_id'));
    
      
        
    }

    public function createLog($id){


        return view('createLog', compact('id'));
    }


    public function insert(Request $rq){
        $log = new LogContract;
        $log->name=$rq->name;
        $log->dealsize=$rq->dealsize;
        $log->cost=$rq->cost;
        $log->contract_id=$rq->id;
        $log->save();
        return redirect()->route('logcontract',$log->contract_id);

    }

    public function updateLog(Request $rq){
        $log = LogContract::find($rq->id);
        $log->name=$rq->name;
        $log->dealsize=$rq->dealsize;
        $log->cost=$rq->cost;
        $log->save();
        return redirect()->route('logcontract',$log->contract_id); 
    }

    public function editLog($idContract,$idLog){

        $log=LogContract::where('id',$idLog)->get();

        return view('editLog',compact('log'));

    }
    public function deleteLog($idContract,$idLog){

        // echo "ahii";
        // dd($idLog);
        LogContract::find($idLog)->delete();


        return redirect()->route('logcontract',$idContract); 

    }



    // public function uploadFile(){
    //     return view('uploadfile');
    // }

    // public function postFile(Request $rq){
    //     if($rq->hasFile('myFile')){
    //         $file=$rq->file('myFile');
    //         $file->move('img','myfile.jpg');
    //     }
    //     else echo "Chưa có file";
    // }
}