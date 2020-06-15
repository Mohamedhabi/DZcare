<?php

namespace App\Http\Controllers;

use App\Http\Resources\HospitalResource;
use App\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * @group Hospital management
 *
 * APIs for managing Hospital
 */
class HospitalController extends Controller
{

    /**
     * Login hospital.
     * @response {"data": {
     *   "id": "bacha@sante.dz",
     *   "name": "bacha",
     *   "description": null,
     *   "wilaya_id": 19
     *  }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "hospital not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Wrong pass word"
     * }
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $hospital= Hospital::find($request->id);
        if(empty($hospital)){
            return response()->json(['status' => 'error','message' => 'hospital not found'],404);
        }else{
            //return Hash::make(($request->password));
            if(Hash::check($request->password,$hospital->password)){
                return new HospitalResource($hospital);
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
        return HospitalResource::collection(Hospital::all());
    }

    /**
    * Store a newly created Hospital in storage.
     * @response {"data": {
     *   "id": "bacha@sante.dz",
     *   "name": "bacha",
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
     * @bodyParam id string required The id . Example:hospital@sante.dz
     * @bodyParam name string required The firt name of the Hospital. Example: hospital
     * @bodyParam wilaya_id int required The wilaya of the Hospital. Example: 16
     * @bodyParam password string required The password. Example: 98776
     * @bodyParam description string  a description of the Hospital. Example: .......................
     * @bodyParam address date address of the Hospital. Example: Alger
     * @bodyParam places int number of free places. Example: 150
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'id'=>"required|unique:hospitals,id|min:2",
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

        $hospital=new Hospital();
        $hospital->id= $request->id;
        $hospital->password=Hash::make($request->password);
        $hospital->name= $request->name;
        $hospital->address= $request->address;
        $hospital->description= $request->description;
        $hospital->wilaya_id= $request->wilaya_id;
        $hospital->places= $request->places;

        $hospital->save();

        return new HospitalResource($hospital);
    }

    /**
     * Display the specified resource.
     * @response {"data": {
     *   "id": "bacha@sante.dz",
     *   "name": "bacha",
     *   "description": null,
     *   "wilaya_id": 19
     *  }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "hospital not found"
     * }
     * @param  string  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital= Hospital::find($id);
        if(empty($hospital)){
            return response()->json(['status' => 'error','message' => 'hospital not found'],404);
        }else{
            return new HospitalResource($hospital);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @response {
     *  "status": "success",
     *  "message": "hospital deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "hospital not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hos= Hospital::find($id);
        if(empty($hos)){
            return response()->json(['status' => 'error','message' => 'hospital not found'],404);
        }elseif($hos->delete()){
            return response()->json(['status' => 'success','message' => 'hospital deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }

    /**
     * Get the best hospital.
     * @bodyParam id int wilaya_id. Example: 19
     * @response {
     *  "data": {
     *  "id": "pacha@sante.dz",
     *  "name": "mustapha pacha",
     *  "description": null,
     *  "places": 150,
     *  "wilaya_id": 16
     *   }
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "no hospital found"
     * }
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_best_hospital($id)
    {
        $hos= Hospital::where('wilaya_id',$id)->where('places',Hospital::where('wilaya_id',$id)->max('places'))->get();

        if($hos->count()==0){
            $hos=Hospital::first();
            if($hos!=null){
                return new HospitalResource($hos->first());
            }
        }else{
            return new HospitalResource($hos->first());
        }
        return response()->json(['status' => 'error','message' => 'no hospital found'],404);
    }

    /**
     * Get a place on the specified hospital.
     * @bodyParam id int hospital_id. Example: pacha@sante.dz
     * @response {
     *   "status":"success"
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "no hospital found"
     * }
     *@response 501 {
     *  "status": "error",
     *  "message": "no modification"
     * }
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function take_aplace(Request $request)
    {
        $id=$request->id;
        $hospital= Hospital::find($id);

        if(empty($hospital)){
            return response()->json(['status' => 'error','message' => 'hospital not found'],404);
        }else{
            $a=DB::table('hospitals')
                ->where('id',$id)
                ->update(array('places' => $hospital->places-1));
            if($a==1){
                return response()->json(['status' => 'success'],200);
            }else{
                return response()->json(['status' => 'error','message'=>'no modification'],501);
            }
        }
    }

     /**
     * free a place on the specified hospital.
     * @bodyParam id int hospital_id. Example: pacha@sante.dz
     * @response {
     *   "status":"success"
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "no hospital found"
     * }
     *@response 501 {
     *  "status": "error",
     *  "message": "no modification"
     * }
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function free_aplace(Request $request)
    {
        $id=$request->id;
        $hospital= Hospital::find($id);

        if(empty($hospital)){
            return response()->json(['status' => 'error','message' => 'hospital not found'],404);
        }else{
            $a=DB::table('hospitals')
                ->where('id',$id)
                ->update(array('places' => $hospital->places+1));
            if($a==1){
                return response()->json(['status' => 'success'],200);
            }else{
                return response()->json(['status' => 'error','message'=>'no modification'],501);
            }
        }
    }
}
