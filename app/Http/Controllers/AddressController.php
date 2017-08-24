<?php namespace App\Http\Controllers;


use App\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddressController extends Controller {



    public  function  resetDefault(){

        Address::where("admin_id",session("admin_id"))
                ->where("default",1)
                ->update(['dafault'=>1]);
    }
    public  function  setDefault(Request $request){

        $this->resetDefault();
        $address_id=$request->input("address_id");
        $result=Address::where("address_id",session("admin_id"))
                ->where("address_id",$address_id)
                ->update(["default"=>1]);
        if($result){
            return response()->json([
                "status"=>true,
                "tip"=>"ok",
                "data"=>[]
            ]);
        }
        else{
            return response()->json([
                "status"=>false,
                "tip"=>"修改失败",
                "data"=>[]
            ]);
        }

    }

    public  function  index(Request $request){
        $where=array();
        $startTime=$request->get("startTime");
        if($startTime){
            $where[]=["startTime",">=",strtotime($startTime)];
        }
        $endTime=$request->get("endTime");
        if($endTime){
            $where[]=["endTime","<=",strtotime($endTime)];
        }
        $member_name=$request->get("member_name");
        if($member_name){
            $where[]=["member_name","like",$member_name];
        }
        $address=$request->get("address");
        if($address){
            $where[]=["address","like",$address];
        }
        $where[]=["member_id",session("member_id")];
        $addressList= Address::where($where)->sortByDesc("address_id")->paginate(15);
        return view('address.list', ['addressList' => $addressList]);
    }

    public function create(){
        return view("address.create");
    }


    public  function  store(Request $request){
        $rules=array();
        $data=$request->all();

        $validator=Validator::make($data,$rules);
        if($validator->fails()){
            return response()->json([
                "status"=>false,
                "tip"=>"验证出错",
                "data"=>[]
            ]);
        }
        $this->resetDefault();
        $model=new Address();
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->member_id=$data["member_id"];
        $model->default=1;
        $model->save();
        if ($model) {
            returnresponse()->json(
                [
                    "status"=>true,
                    "tip"=>"新增成功!",
                    "data"=>$model->toArray()
                ]
            );
        } else {
            return response()->json(
                [
                    "status"=>false,
                    "tip"=>"新增失败!",
                    "data"=>[]
                ]
            );
        }

    }

    public  function  show($id){

        return;
    }

    public  function  edit($id){

        try{

            $model=Address::find($id);
        }
        catch(ModelNotFoundException $e){
            throw new NotFoundHttpException();
        }
        return view("address.edit",compact('model'));
    }



    public  function  update(Request $request,$id){

        $rules=array();
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){

            return response()->json([

                "status"=>false,
                "tip"=>"验认失败",
                "data"=>[]
            ]);
        }

        $model=Address::find($id);
        $model->fill($request->all());
        $model->save();
        if($model){

            returnresponse()->json(
                [
                    "status"=>true,
                    "tip"=>"新增成功!",
                    "data"=>$model->toArray()
                ]
            );
        }
        else{
            return response()->json(
                [
                    "status"=>false,
                    "tip"=>"新增失败!",
                    "data"=>[]
                ]
            );

        }
    }



    public  function destory(Request $request){

        Address::destroy($request->get("id"));

        return response()->json(
            [
                "status"=>false,
                "tip"=>"新增失败!",
                "data"=>[]
            ]
        );
    }



}
