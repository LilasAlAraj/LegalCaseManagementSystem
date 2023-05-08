<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaseResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Cases;
use Illuminate\Http\Request;

class CasesController extends Controller
{
   
    use ApiResponseTrait;

    public function index(){

        $cases = CaseResource::collection(Cases::get());
        return $this->apiResponse($cases,'ok',200);
    }

    public function show($id){

        $case = Cases::find($id);

        if($case){
            return $this->apiResponse(new CaseResource($case),'ok',200);
        }
        return $this->apiResponse(null,'The case Not Found',404);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'Status' => 'required',
            'case_number'=>'required',
            'enemy_Lawyer_name'=>'required',
            'enemy_Lawyer_phone'=>'required',
            'enemy_Client_name'=>'required',
            'enemy_Client_phone'=>'required',
            'side_judge'=>'required',
            'case_room'=>'required',
            'judge'=>'required',
            'Value_Status'=>'required',
            'case_Date'=>'required',
        ]);

        if ($validator->fails()) {

            return $this->apiResponse(null,$validator->errors(),400);
        }


        $case = Cases::create($request->all());

        if($case){

            return $this->apiResponse(new caseResource($case),'The case Save',201);
        }

        return $this->apiResponse(null,'The case Not Save',400);
    }
}
