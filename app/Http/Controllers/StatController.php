<?php

namespace App\Http\Controllers;

use App\DeseasesHospital;
use App\Http\Resources\DeseasesHospitalResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @group Statistics management
 *
 * APIs for managing Statistics
 */
class StatController extends Controller
{
    /**
     * Get statistics / dates
     *
     * @response {"result": [
     *   {
     *      "date": "2020-06-15",
     *        "cured": "1",
     *       "sick": "0",
     *      "dead": "1"
     *   }
      *]
     *}

     * @bodyParam date1 date required first date. Example: "2020-06-15"
     * @bodyParam date2 date required 2nd date. Example: "2020-06-16"
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new_cases(Request $request)
    {
        $date1=$request->date1;
        $date2=$request->date2;

        $sql =
        "SELECT DATE(created_at) date,
            sum(case when deseases_hospitals.cured = 1 and dead= false then 1 else 0 end) cured,
            sum(case when deseases_hospitals.cured = 0 and dead= false then 1 else 0 end) sick,
            sum(case when deseases_hospitals.dead= 1 then 1 else 0 end) dead
            FROM deseases_hospitals
            WHERE DATE(created_at) BETWEEN '".$date1."' and '".$date2."'
            GROUP BY  DATE(deseases_hospitals.created_at)
        ";
        $result=DB::select(DB::raw($sql));
        return response()->json(['result' => $result],200);
    }



    /**
     * Get statistics / dates / wilaya
     *
     * @response {"result": [
     *   {
     *      "date": "2020-06-15",
     *        "cured": "1",
     *       "sick": "0",
     *      "dead": "1"
     *   }
      *]
     *}
     * @bodyParam date1 date required first date. Example: "2020-06-15"
     * @bodyParam date2 date required 2nd date. Example: "2020-06-16"
     * @bodyParam date2 id required id wilaya. Example: 16
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new_cases_wilaya(Request $request)
    {

        $date1=$request->date1;
        $date2=$request->date2;

        $sql =
        "SELECT DATE(deseases_hospitals.created_at) date,
            sum(case when deseases_hospitals.cured = 1 and dead= false then 1 else 0 end) cured,
            sum(case when deseases_hospitals.cured = 0 and dead= false then 1 else 0 end) sick,
            sum(case when deseases_hospitals.dead= 1 then 1 else 0 end) dead
            FROM deseases_hospitals
            JOIN hospitals h ON deseases_hospitals.hospital_id= h.id

            WHERE h.wilaya_id=".((string)$request->id)." AND  DATE(deseases_hospitals.created_at) BETWEEN '".$date1."' and '".$date2."'
            GROUP BY  DATE(deseases_hospitals.created_at)
        ";
        $result=DB::select(DB::raw($sql));
        return response()->json(['result' => $result],200);
    }
}
