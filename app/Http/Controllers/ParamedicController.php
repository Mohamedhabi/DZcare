<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParamedicResource;
use App\Paramedic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * @group Paramedic management
 *
 * APIs for managing Paramedic
 */
class ParamedicController extends Controller
{
    /**
     * Login Paramedic
     *
     * @bodyParam email string required email. Example: abc@sante.dz
     * @bodyParam password string required password . Example: ..............
     *
     * @response {"data":{
     *       "id": 1,
     *       "email": "abc@sante.dz",
     *       "establishment": "pompier alger"
     *   }
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "Paramedic not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Wrong pass word"
     * }
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $paramedic= Paramedic::where('email',$request->email)->first();
        if($paramedic==null){
            return response()->json(['status' => 'error','message' => 'Paramedic not found'],404);
        }else{
            //return Hash::make(($request->password));
            if(Hash::check($request->password,$paramedic->password)){
                return new ParamedicResource($paramedic);
            }
          return response()->json(['status' => 'error','message' => 'Wrong pass word'],500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ParamedicResource::collection(Paramedic::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @bodyParam email string required email. Example: abc@sante.dz
     * @bodyParam password string required password . Example: ..............
     * @bodyParam establishment string password . Example: "pompier alger"
     *
     *
     * @response {"data": {
     *       "id": 1,
     *       "email": "abc@sante.dz",
     *       "establishment": "pompier alger"
     *   }
     *}
     *@response 500 {
     * "status": "error",
     * "message": {
     *   "password": [
     *       "The password is required."
     *    ]
     *  }
     *}
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'password'=>"required|min:2",
            'email'=>"required|unique:paramedics|min:2",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }

        $paramedic=new Paramedic();
        $paramedic->password=Hash::make($request->password);
        $paramedic->email= $request->email;
        $paramedic->establishment= $request->establishment;

        $paramedic->save();

        return new ParamedicResource($paramedic);
    }

    /**
     * Display the specified resource.
     *
     * @response {"data": {
     *       "id": 1,
     *       "email": "abc@sante.dz",
     *       "establishment": "pompier alger"
     *   }
     *}
     *
     *@response 404 {
     *  "status": "error",
     *  "message": "paramedic not found"
     * }
     *
     * @param  int  $paramedic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paramedic= Paramedic::find($id);
        if(empty($paramedic)){
            return response()->json(['status' => 'error','message' => 'paramedic not found'],404);
        }else{
            return new ParamedicResource($paramedic);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @response {
     *  "status": "success",
     *  "message": "paramedic deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "paramedic not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  int $paramedic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paramedic= Paramedic::find($id);
        if(empty($paramedic)){
            return response()->json(['status' => 'error','message' => 'paramedic not found'],404);
        }elseif($paramedic->delete()){
            return response()->json(['status' => 'success','message' => 'paramedic deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
