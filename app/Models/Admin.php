<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin';


    public  static  function  getAdminByName($name){

        $model=Admin::where("admin_name",$name)->first();
        if($model){
            return[
                'admin_id'=>$model->admin_id,
                "admin_name"=>$model->admin_name,
                "admin_statu"=>$model->admin_status

            ];
        }
        else{
            return array();
        }
    }

    public  static  function  getAdminById($id){

        return Admin::where("admin_id",$id)->pluck("admin_name");
    }

    public   static  function  getListByMap($map=array()){

        $count=Admin::where($map)->count();

        $data=Admin::where($map)->get();

        return [
            "count"=>$count,
            "data"=>$data
        ];
    }



    public  static  function  adminUpdate($map,$data){
        $rules = array(
            'email' => 'required|email',
            'name' => 'required|between:1,20',
            'password' => 'required|min:8',
        );
        $message = array(
            "required"             => ":attribute 不能为空",
            "between"      => ":attribute 长度必须在 :min 和 :max 之间"
        );
        $attributes = array(
            "email" => '电子邮件',
            'name' => '用户名',
            'password' => '用户密码',
        );
        $validate = Validator::make($data,$rules,$message,$attributes);
        if($validate->fails()){
            $warnings = $validate->messages();
            $show_warning = $warnings->first();
           return false;
        }
        $result=Admin::where($map)->update($data);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }


    public  static function adminCreate($data){
        $rules = array(
            'email' => 'required|email',
            'name' => 'required|between:1,20',
            'password' => 'required|min:8',
        );
        $message = array(
            "required"             => ":attribute 不能为空",
            "between"      => ":attribute 长度必须在 :min 和 :max 之间"
        );
        $attributes = array(
            "email" => '电子邮件',
            'name' => '用户名',
            'password' => '用户密码',
        );
        $validate = Validator::make($data,$rules,$message,$attributes);

        if($validate->fails()){
            $warnings = $validate->messages();
            $show_warning = $warnings->first();
            return false;
        }
        $result=Admin::save($data);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }


    public  static  function adminDelete($id){
        $rules = array(
            'id' => 'required',
        );
        $message = array(
            "required"             => ":attribute 不能为空"
        );
        $attributes = array(
            "id" => '编号'
        );
        $data["id"]=$id;
        $validate = Validator::make($data,$rules,$message,$attributes);
        if($validate->fails()){
            $warnings = $validate->messages();
            $show_warning = $warnings->first();
            return false;
        }

        $map=array();
        $map["id"]=$id;
        $result=Admin::where($map)->delete($data);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }




}
