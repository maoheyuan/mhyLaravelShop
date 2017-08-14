<?php namespace App\Http\Controllers;


use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{


        Admin::select()->orderBy("admin_id","desc")->get();
		return view('admin/index');
	}

    public  function  edit($id){


        $result=Admin::find($id);

        if(!$result){
            $result=array();
        }

        return view("admin.form",compact("result"));
    }


    public  function  update($id,Request $request){

        $v=Validator::make($request->all(),$this->form_rules);
        if($v->fails()){
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput(\Input::except("default","message"));

        }

    }

}
