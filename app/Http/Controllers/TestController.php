<?php

namespace App\Http\Controllers;

use App\DeseasesHospital;
use App\Http\Resources\TestResource;
use App\Laboratory;
use App\Test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Tests management
 *
 * APIs for managing Tests
 */
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TestResource::collection(Test::all());
    }

    /**
     * Store a newly created Test in storage.
     * @response {"data": {
     *       "id": 1,
     *       "disease_id": "Covid_19",
     *       "patient_id": 3,
     *       "hospital_id": "set@sante.dz",
     *       "laboratory_id": "pascal@sante.dz",
     *       "positif": 1
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
     * @bodyParam laboratory_id string   required laboratory_id. Example: pascal@sante.dz

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'disease_id'=>"required|exists:diseases,id",
            'patient_id'=>"required|exists:patients,id",
            'hospital_id'=>"required|exists:hospitals,id",
            'laboratory_id'=>"exists:laboratories,id",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }
        if($request->laboratory_id==null){
            $request['laboratory_id']=Laboratory::all()->first()->id;

        }
        $test=new Test();
        $test->disease_id= $request->disease_id;
        $test->patient_id= $request->patient_id;
        $test->hospital_id= $request->hospital_id;
        $test->laboratory_id= $request->laboratory_id;
        $test->save();
        return new TestResource($test);
    }

    /**
     * Display the specified resource.
     * @response {"data": {
     *       "id": 1,
     *      "disease_id": "Covid_19",
     *       "patient_id": 3,
     *       "hospital_id": "set@sante.dz",
     *       "laboratory_id": "pascal@sante.dz",
     *       "positif": 1
     *   }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "test not found"
     * }
     * @param  int $test
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test= Test::find($id);
        if(empty($test)){
            return response()->json(['status' => 'error','message' => 'test not found'],404);
        }else{
            return new TestResource($test);
        }
    }

    /**
     * Test result
     * @bodyParam id int required test_id . Example: 3
     * @bodyParam positif boolean required test result. Example: 0
     *
     *
     * @response {"data": {
     *       "id": 1,
     *      "disease_id": "Covid_19",
     *       "patient_id": 3,
     *       "hospital_id": "set@sante.dz",
     *       "laboratory_id": "pascal@sante.dz",
     *       "positif": 1
     *   }
     *}
     *
     *
     *@response 404 {
     *  "status": "error",
     *  "message": "test not found"
     * }
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function response(Request $request)
    {
        $test= Test::find($request->id);
        if(empty($test)){
            return response()->json(['status' => 'error','message' => 'test not found'],404);
        }else{
            $test->positif=(boolean)$request->positif;
            if($test->positif){
                $des=new DeseasesHospital();
                $des->disease_id= $test->disease_id;
                $des->patient_id= $test->patient_id;
                $des->hospital_id= $test->hospital_id;
                try{
                    $des->save();
                }catch(Exception $e){

                }
            }
            $test->save();
            return new TestResource($test);
        }
    }

    /**
     * Get all tests for a given laboratory
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show_by_laboratory($id)
    {
        return $test= Test::where('laboratory_id',$id)->get();

    }

    /**
     * Get all tests for a given hospital
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show_by_hospital($id)
    {
        return $test= Test::where('hospital_id',$id)->get();

    }

    /**
     * Get all tests for a given patient
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show_by_patient($id)
    {
        return $test= Test::where('patient_id',$id)->get();

    }

    /**
     * Get all tests for a given disease
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show_by_disease($id)
    {
        return $test= Test::where('disease_id',$id)->get();

    }
}
