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
      * @response {
     *  "data": {
     *  "id": "pacha@sante.dz",
     *  "name": "mustapha pacha",
     *  "description": null,
     *  "places": 151,
     *  "lat": 36.762199,
     *  "lng": 3.053796,
     *  "wilaya_id": 16
     *   }
     * }
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
      * @response {
     *  "data": {
     *  "id": "pacha@sante.dz",
     *  "name": "mustapha pacha",
     *  "description": null,
     *  "places": 151,
     *  "lat": 36.762199,
     *  "lng": 3.053796,
     *  "wilaya_id": 16
     *   }
     * }
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
     * @bodyParam lat float latitudes. Example: -33.861034
     * @bodyParam lng float longitudes. Example: 151.171936
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
        $hospital->lat= $request->lat;
        $hospital->lng= $request->lng;

        $hospital->save();

        return new HospitalResource($hospital);
    }

    /**
     * Display the specified resource.
      * @response {
     *  "data": {
     *  "id": "pacha@sante.dz",
     *  "name": "mustapha pacha",
     *  "description": null,
     *  "places": 151,
     *  "lat": 36.762199,
     *  "lng": 3.053796,
     *  "wilaya_id": 16
     *   }
     * }
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
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \Illuminate\Http\Request  $request
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

    /**
     * Set coordinates the specified hospital.
     * @bodyParam id int hospital_id. Example: pacha@sante.dz
     * @bodyParam lat float latitudes. Example: -33.861034
     * @bodyParam lng float longitudes. Example: 151.171936
     *
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set_coordinates(Request $request)
    {
        $id=$request->id;
        $hospital= Hospital::find($id);

        if(empty($hospital)){
            return response()->json(['status' => 'error','message' => 'hospital not found'],404);
        }else{
            $a=DB::table('hospitals')
                ->where('id',$id)
                ->update(array('lat' => $request->lat,'lng'=>$request->lng));
            if($a==1){
                return response()->json(['status' => 'success'],200);
            }else{
                return response()->json(['status' => 'error','message'=>'no modification'],501);
            }
        }
    }

    /**
     * Get the best hospital.
     * @bodyParam wilaya int wilaya id. Example: 19
     * @bodyParam lat float latitudes. Example: -33.861034
     * @bodyParam lng float longitudes. Example: 151.171936
     *
     * @response {
     *  "data": {
     *  "id": "pacha@sante.dz",
     *  "name": "mustapha pacha",
     *  "description": null,
     *  "places": 151,
     *  "lat": 36.762199,
     *  "lng": 3.053796,
     *  "wilaya_id": 16
     *   }
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "no hospital found,full"
     * }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_best_hospital(Request $request)
    {
        $hospitals=Hospital::where('places','>',3)->get();
        if(empty($hospitals)){
            return response()->json(['status' => 'error','message' => 'no hospital found,full'],404);
        }else{
            if($request->lat!=null && $request->lng!=null){
                $best_hospital= $this->get_close($hospitals,$request->lat,$request->lng);
                return new HospitalResource($best_hospital);
            }else{
                $hos= Hospital::where('wilaya_id',$request->wilaya)->where('places',Hospital::where('wilaya_id',$request->wilaya)->max('places'))->get();
                if($hos->count()==0){
                    return new HospitalResource($hospitals->first());
                }else{
                    return new HospitalResource($hos->first());
                }
            }
        }
    }

    protected function get_close($hospitals, $lat, $lng) {
        $best_dist=$this->distance($hospitals->first()->lat,$hospitals->first()->lng, $lat, $lng);
        $best_hospital=$hospitals->first();
        foreach($hospitals as $hospital){
            if($hospital->lat!=null && $hospital->lng!=null){
                $dist=$this->distance($hospital->lat,$hospital->lng, $lat, $lng);
                if($dist<$best_dist){
                    $best_dist=$dist;
                    $best_hospital=$hospital;
                }
            }
        }
        return $best_hospital;
    }

    protected function distance($lat1, $lon1, $lat2, $lon2) {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
        return $km;
    }
}
