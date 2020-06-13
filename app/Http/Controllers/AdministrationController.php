<?php

namespace App\Http\Controllers;

use App\Administration;
use App\Http\Resources\AdministrationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * @group Administration management
 *
 * APIs for managing Administration
 */
class AdministrationController extends Controller
{

    /**
     * Login Admin.
     * @response {"data": {
     *   "id": "ministere@sante.dz",
     *   "name": "ministere",
     *   "description": null,
     *   "wilaya_id": 19
     *  }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "administration not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Wrong pass word"
     * }
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $administration= Administration::find($request->id);
        if(empty($administration)){
            return response()->json(['status' => 'error','message' => 'administration not found'],404);
        }else{
            //return Hash::make(($request->password));
            if(Hash::check($request->password,$administration->password)){
                return new AdministrationResource($administration);
            }
          return response()->json(['status' => 'error','message' => 'Wrong pass word'],500);
        }
    }

    /**
     * Display a listing of Administrations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdministrationResource::collection(Administration::all());
    }

    /**
     * Store a newly created Administration in storage.
     *
     * @response {"data": {
     *   "id": "ministere@sante.dz",
     *   "name": "ministere",
     *   "description": null,
     *   "wilaya_id": 19
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
     * @bodyParam id string required The id . Example:admin@sante.dz
     * @bodyParam name string required The firt name of the administration. Example: admin
     * @bodyParam wilaya_id int required The wilaya of the administration. Example: 16
     * @bodyParam password string required The password. Example: 98776
     * @bodyParam description string  a description of the administration. Example: .......................
     * @bodyParam address date address of the administration. Example: Alger
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'id'=>"required|unique:administrations,id|min:2",
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

        $admin=new Administration();
        $admin->id= $request->id;
        $admin->password=Hash::make($request->password);
        $admin->name= $request->name;
        $admin->address= $request->address;
        $admin->description= $request->description;
        $admin->wilaya_id= $request->wilaya_id;

        $admin->save();

        return new AdministrationResource($admin);
    }

    /**
     * Display the specified Administration.
     * @response {"data": {
     *   "id": "ministere@sante.dz",
     *   "name": "ministere",
     *   "description": null,
     *   "wilaya_id": 19
     *  }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "administration not found"
     * }
     * @param  string  $Administration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $administration= Administration::find($id);
        if(empty($administration)){
            return response()->json(['status' => 'error','message' => 'administration not found'],404);
        }else{
            return new AdministrationResource($administration);
        }
    }

    /**
     * Remove the specified Administration from storage.
     * @response {
     *  "status": "success",
     *  "message": "administration deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "administration not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  string  $administration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hos= Administration::find($id);
        if(empty($hos)){
            return response()->json(['status' => 'error','message' => 'administration not found'],404);
        }elseif($hos->delete()){
            return response()->json(['status' => 'success','message' => 'administration deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
