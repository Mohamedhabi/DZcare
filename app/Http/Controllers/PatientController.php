<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientResource;
use App\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Patients management
 *
 * APIs for managing Patient
 */
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PatientResource::collection(Patient::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @response {"data": {
     *       "id": 1,
     *       "first_name": "aziz",
     *       "last_name": "boutef",
     *       "phone": "07779261738",
     *       "email": null,
     *       "address": null
     *   }
     *}
     *@response 500 {
     * "status": "error",
     * "message": {
     *   "id": [
     *       "The id has already been taken."
     *    ]
     *  }
     *}
     * @bodyParam first_name string required first_name . Example:mohamed
     * @bodyParam last_name string required last_name. Example: habi
     * @bodyParam phone string  phone number. Example: 16 98 7767 89
     * @bodyParam address string  The address. Example: setif
     * @bodyParam email string  email. Example: ministere@sante.dz
     * @bodyParam password string password of the patient. Example: ..............
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'first_name'=>"required|max:40|min:2",
            'last_name'=>"required|max:40|min:2",
            'password'=>"min:2",
            'email'=>"min:2",
            'address'=>"min:3",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }

        $patient=new Patient();
        $patient->first_name= $request->first_name;
        $patient->last_name= $request->last_name;
        $patient->password=Hash::make($request->password);
        $patient->email= $request->email;
        $patient->address= $request->address;
        $patient->phone= $request->phone;

        $patient->save();

        return new PatientResource($patient);
    }

    /**
     * Display the specified resource.
     *
     * @response {"data": {
     *       "id": 1,
     *       "first_name": "aziz",
     *       "last_name": "boutef",
     *       "phone": "07779261738",
     *       "email": null,
     *       "address": null
     *   }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "patient not found"
     * }
     * @param  int  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient= Patient::find($id);
        if(empty($patient)){
            return response()->json(['status' => 'error','message' => 'patient not found'],404);
        }else{
            return new PatientResource($patient);
        }
    }

    /**
     * Update the specified resource in storage.
     * @response {"data": {
     *       "id": 1,
     *       "first_name": "aziz",
     *       "last_name": "boutef",
     *       "phone": "07779261738",
     *       "email": null,
     *       "address": null
     *   }
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "patient not found"
     * }
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validation =Validator::make($request->all(),[
            'first_name'=>"max:40|min:2",
            'last_name'=>"max:40|min:2",
            'password'=>"min:2",
            'email'=>"min:2",
            'address'=>"min:3",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }

        $patient->update($request->all());
        $patient->save();

        return new PatientResource($patient);

    }

    /**
     * Remove the specified patient from storage.
     *
     * @response {
     *  "status": "success",
     *  "message": "patient deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "patient not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  int  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient= Patient::find($id);
        if(empty($patient)){
            return response()->json(['status' => 'error','message' => 'patient not found'],404);
        }elseif($patient->delete()){
            return response()->json(['status' => 'success','message' => 'patient deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
