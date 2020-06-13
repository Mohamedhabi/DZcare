<?php

namespace App\Http\Controllers;

use App\DeseasesHospital;
use App\Http\Resources\DeseasesHospitalResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;

class DeseasesHospitalController extends Controller
{
    /**
     * Display a listing of the DeseasesHospital.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeseasesHospitalResource::collection(DeseasesHospital::all());
    }

    /**
     * Store a newly created DeseasesHospital in storage.
     * @response {"data": {
     *       "id": 1,
     *       "disease_id": "Covid_19",
     *       "patient_id": 3,
     *       "hospital_id": "set@sante.dz",
     *       "cured": 1
     *   }
     *}
     *@response 500 {
     * "status": "error",
     * "message": {
     *   "id": [
     *       "The disease_id is required."
     *    ]
     *  }
     *}
     *
     * @bodyParam disease_id string required disease_id . Example:Covid_19
     * @bodyParam patient_id string required patient_id. Example: 3
     * @bodyParam hospital_id string  required  hospital_id. Example: jcp@sante.dz
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'disease_id'=>"required|exists:diseases,id",
            'patient_id'=>"required|exists:patients,id",
            'hospital_id'=>"required|exists:hospitals,id",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }

        $des=new DeseasesHospital();
        $des->disease_id= $request->disease_id;
        $des->patient_id= $request->patient_id;
        $des->hospital_id= $request->hospital_id;
        try{
            $des->save();
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'already exists'
            ],500);
        }
        return new DeseasesHospitalResource($des);
    }

    /**
     * If someone is cured hhh
     * @bodyParam disease_id string required disease_id . Example: Covid_19
     * @bodyParam patient_id int required patient_id . Example: 3
     * @bodyParam hospital_id string required hospital_id . Example: bacha@sante.dz
     * @bodyParam cured boolean required test cured. Example: 1
     *
     *
     * @response {
     *       "status":"success"
     *}
     *
     * @param  \App\DeseasesHospital  $deseasesHospital
     * @return \Illuminate\Http\Response
     */
    public function cured(Request $request)
    {
        $a=DB::table('deseases_hospitals')
            ->where('disease_id',$request->disease_id)
            ->where('patient_id',$request->patient_id)
            ->where('hospital_id',$request->hospital_id)
            ->update(array('cured' => (Boolean)$request->cured));
        if($a==1){
            return response()->json(['status' => 'success'],200);
        }else{
            return response()->json(['status' => 'success','message'=>'no modification'],200);

        }
    }


    /**
     * true if the perdon is dead
     * @bodyParam disease_id string required disease_id . Example: Covid_19
     * @bodyParam patient_id int required patient_id . Example: 3
     * @bodyParam hospital_id string required hospital_id . Example: bacha@sante.dz
     * @bodyParam dead boolean required dead. Example: 0
     *
     *
     * @response {
     *       "status":"success"
     *}
     *
     * @param  \App\DeseasesHospital  $deseasesHospital
     * @return \Illuminate\Http\Response
     */
    public function dead(Request $request)
    {
        $a=DB::table('deseases_hospitals')
            ->where('disease_id',$request->disease_id)
            ->where('patient_id',$request->patient_id)
            ->where('hospital_id',$request->hospital_id)
            ->update(array('dead' => (Boolean)$request->dead));
        if($a==1){
            return response()->json(['status' => 'success'],200);
        }else{
            return response()->json(['status' => 'success','message'=>'no modification'],200);

        }
    }

    /**
     * Returns the statistics of a wilaya
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function stat_wilaya($id)
    {
        $not_cured=DB::table('deseases_hospitals')
            ->join('hospitals', 'deseases_hospitals.hospital_id', '=', 'hospitals.id')
            ->where('hospitals.wilaya_id',$id)
            ->where('deseases_hospitals.cured',false)
            ->select('deseases_hospitals.disease_id', 'deseases_hospitals.patient_id', 'hospitals.id','hospitals.id','cured')
            ->get();

        $cured=DB::table('deseases_hospitals')
            ->join('hospitals', 'deseases_hospitals.hospital_id', '=', 'hospitals.id')
            ->where('hospitals.wilaya_id',$id)
            ->where('deseases_hospitals.cured',true)
            ->select('deseases_hospitals.disease_id', 'deseases_hospitals.patient_id', 'hospitals.id','hospitals.id','cured')
            ->get();


        return response()->json(['cured' => $cured,'not_cured'=>$not_cured],200);
    }


    /**
     * Returns the statistics of all the contry
     *
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function stat()
    {
        $not_cured=DB::table('deseases_hospitals')
            ->join('hospitals', 'deseases_hospitals.hospital_id', '=', 'hospitals.id')
            ->where('deseases_hospitals.cured',false)
            ->select('hospitals.wilaya_id','deseases_hospitals.disease_id', 'deseases_hospitals.patient_id', 'hospitals.id','hospitals.id','cured')
            ->get();

        $cured=DB::table('deseases_hospitals')
            ->join('hospitals', 'deseases_hospitals.hospital_id', '=', 'hospitals.id')
            ->where('deseases_hospitals.cured',true)
            ->select('hospitals.wilaya_id','deseases_hospitals.disease_id', 'deseases_hospitals.patient_id', 'hospitals.id','hospitals.id','cured')
            ->get();


        return response()->json(['cured' => $cured,'not_cured'=>$not_cured],200);
    }
}
