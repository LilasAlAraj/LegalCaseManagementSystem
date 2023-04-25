<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;

class Cases_ReportController extends Controller
{
    public function index()
    
      {

        return view('reports.cases_report');
           
       }

       public function Search_cases(Request $request){

        $rdio = $request->rdio;
    
    
     // في حالة البحث بنوع القضية
        
        if ($rdio == 1) {
           
           
     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                
               $cases = Cases::select('*')->where('Status','=',$request->type)->get();
               $type = $request->type;
               return view('reports.cases_report',compact('type'))->withDetails($cases);
               
            }
            
            // // في حالة تحديد تاريخ استحقاق
            // else {
               
            //   $start_at = date($request->start_at);
            //   $end_at = date($request->end_at);
            //   $type = $request->type;
              
            //   $cases = cases::whereBetween('case_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
            //   return view('reports.cases_report',compact('type','start_at','end_at'))->withDetails($cases);
              
            // }

            // في حالة البحث باسم المحامي الموكل
            else {
                
                $cases = Cases::select('*')->where('claimant_Lawyer','=',$request->claimant_Lawyer)->get();
                return view('reports.cases_report')->withDetails($cases);
             }


    
     
            
        } 
        
    //====================================================================
        
    // في البحث برقم القضية
        else {
            
            $cases = Cases::select('*')->where('case_number','=',$request->case_number)->get();
            return view('reports.cases_report')->withDetails($cases);
            

            

        }


    
        
         
        }
}

