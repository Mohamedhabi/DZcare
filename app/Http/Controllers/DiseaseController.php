<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Http\Resources\DiseaseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Diseases management
 *
 * APIs for managing Diseases
 */
class DiseaseController extends Controller
{
    /**
     * Display a listing of the diseases.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DiseaseResource::collection(Disease::all());
    }

    /**
     * Store a newly created disease in storage.
     *
     *
     * @response {
     * "data": {
     *   "id": "Covid_19",
     *   "description": null
     *}
     *}
     *@response 500 {
     * "status": "error",
     * "message": {
     *   "id": [
     *       "The id has already been taken."
     *    ]
     *  }
     *}
     *
     * @bodyParam id string required The id . Example: Covid_19
     * @bodyParam description string a description of the disease. Example: .....

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'id'=>"required|unique:diseases,id",
            ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }
        $disease=new Disease();
        $disease->id= $request->id;
        $disease->description= $request->description;
        $disease->save();
        return new DiseaseResource($disease);
    }

    /**
     * Display the specified disease.
     *
     * @response {
     * "data": {
     *   "id": "Covid_19",
     *   "description": null
     *}
     *}
     *@response 404 {
     *  "status": "error",
     *  "message": "hospital not found"
     * }
     * @param  string  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disease= Disease::find($id);
        if(empty($disease)){
            return response()->json(['status' => 'error','message' => 'disease not found'],404);
        }else{
            return new DiseaseResource($disease);
        }
    }

    /**
     * Remove the specified disease from storage.
     *
     *
     * @response {
     *  "status": "success",
     *  "message": "disease deleted"
     * }
     *@response 404 {
     *  "status": "error",
     *  "message": "disease not found"
     * }
     *@response 500 {
     *  "status": "error",
     *  "message": "Database server error"
     * }
     * @param  int  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease= Disease::find($id);
        if(empty($disease)){
            return response()->json(['status' => 'error','message' => 'disease not found'],404);
        }elseif($disease->delete()){
            return response()->json(['status' => 'success','message' => 'disease deleted'],200);
        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
