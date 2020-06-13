<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaboratoryResource;
use App\Laboratory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Laboratories management
 *
 * APIs for managing Laboratories
 */
class LaboratoryController extends Controller
{
    /**
     * Login Laboratory.
     * @response {"data": {
     *   "id": "pascal@sante.dz",
     *   "name": "pascal",
     *   "description": null,
     *   "wilaya_id": 16
     *  }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "laboratory not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Wrong pass word"
     * }
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $laboratory= Laboratory::find($request->id);
        if(empty($laboratory)){
            return response()->json(['status' => 'error','message' => 'laboratory not found'],404);
        }else{
            //return Hash::make(($request->password));
            if(Hash::check($request->password,$laboratory->password)){
                return new LaboratoryResource($laboratory);
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
        return LaboratoryResource::collection(Laboratory::all());
    }

    /**
     * Store a newly created Laboratory in storage.
     *
     * @response {"data": {
     *   "id": "pascal@sante.dz",
     *   "name": "pascal",
     *   "description": null,
     *   "wilaya_id": 16
     *  }
     *}
     *@response 500 {
     * "status": "error",
     * "message": {
     *   "id": [
     *       "The id has already been taken."
     *    ]
     *  }
     *}
     * @bodyParam id string required The id . Example:labo@sante.dz
     * @bodyParam name string required The firt name of the Laboratory. Example: labo
     * @bodyParam wilaya_id int required The wilaya of the Laboratory. Example: 16
     * @bodyParam password string required The password. Example: 98776
     * @bodyParam description string  a description of the Laboratory. Example: .......................
     * @bodyParam address date the address of the laboratory
     * . Example: Alger
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'id'=>"required|unique:laboratories,id|min:2",
            'wilaya_id'=>"required|exists:wilayas,id",
            'password'=>"required|max:40|min:2",
            'name'=>"max:40|min:2",
            'address'=>"min:3",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }

        $laboratory=new Laboratory();
        $laboratory->id= $request->id;
        $laboratory->password=Hash::make($request->password);
        $laboratory->name= $request->name;
        $laboratory->address= $request->address;
        $laboratory->description= $request->description;
        $laboratory->wilaya_id= $request->wilaya_id;

        $laboratory->save();

        return new LaboratoryResource($laboratory);
    }

    /**
     * Display the specified resource.
     * @response {"data": {
     *   "id": "pascal@sante.dz",
     *   "name": "pascal",
     *   "description": null,
     *   "wilaya_id": 16
     *  }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "laboratory not found"
     * }
     * @param  string  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laboratory= Laboratory::find($id);
        if(empty($laboratory)){
            return response()->json(['status' => 'error','message' => 'laboratory not found'],404);
        }else{
            return new LaboratoryResource($laboratory);
        }
    }


    /**
     * Remove the specified resource from storage.
     * @response {
     *  "status": "success",
     *  "message": "laboratory deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "laboratory not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  string  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $labo= Laboratory::find($id);
        if(empty($labo)){
            return response()->json(['status' => 'error','message' => 'laboratory not found'],404);
        }elseif($labo->delete()){
            return response()->json(['status' => 'success','message' => 'laboratory deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
