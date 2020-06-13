<?php

namespace App\Http\Controllers;

use App\Http\Resources\WilayaResource;
use App\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Wilayas management
 *
 * APIs for managing Wilayas
 */
class WilayaController extends Controller
{
    /**
     * Display a listing of the Wilayas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WilayaResource::collection(Wilaya::all());
    }


    /**
    * Store a newly created resource in storage.
     * @response {
     *    "data": {
     *    "id": 19,
     *    "name": "setif"
     *   }
     * }
     *
     *@response 500 {
     *"status": "error",
     *"message": {
     *  "id": [
     *      "The id has already been taken."
     *   ],
     *    "wilaya_name": [
     *         "The wilaya name has already been taken."
     *      ]
     *   }
     *}
     * @bodyParam id int required wilaya id . Example: 19
     * @bodyParam wilaya_name string required wilaya_name. Example: setif
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'id'=>"required|unique:wilayas,id",
            'wilaya_name'=>"required|unique:wilayas,wilaya_name",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }
        $wilaya=new Wilaya();
        $wilaya->id= $request->id;
        $wilaya->wilaya_name= $request->wilaya_name;
        $wilaya->save();
        return new WilayaResource($wilaya);
    }

    /**
     * Display the specified wilaya.
     * @response {
     *    "data": {
     *    "id": 19,
     *    "name": "setif"
     *   }
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "wilaya not found"
     * }
     * @param  int  $wilaya
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wilaya= Wilaya::find($id);
        if(empty($wilaya)){
            return response()->json(['status' => 'error','message' => 'wilaya not found'],404);
        }else{
            return new WilayaResource($wilaya);
        }
    }

    /**
     * Remove the specified wilaya from storage.
     * @response {
     *  "status": "success",
     *  "message": "wilaya deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "wilaya not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  int  $wilaya
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wilaya= Wilaya::find($id);
        if(empty($wilaya)){
            return response()->json(['status' => 'error','message' => 'wilaya not found'],404);
        }elseif($wilaya->delete()){
            return response()->json(['status' => 'success','message' => 'wilaya deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
