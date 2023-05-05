<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Cases_details;
use Illuminate\Http\Request;

class Cases_ReportController extends Controller
{
    public function index()
    
      {

        return view('reports.cases_report');
           
       }

       public function Search_cases(Request $request){ 

        $rdio = $request->rdio;  // الخاص بالبحث  key من اجل تحديد  id عبارةعن
            
                                // rdio=1 بحث حسب نوع القضية 
                                // rdio=2 بحث حسب تاريخ القضية
                                //  rdio=3 بحث حسب رقم القضية
                                // rdio=4  بحث حسب العنوان
                                // rdio=5 بحث حسب المحكمة 

        

              //--------في حالة البحث بنوع القضية -------//

             if ($rdio == 1) {
           {
                
               $cases =Cases::select('*')->where('Status','=',$request->type)->get();

               $type = $request->type;    // منشان يثبت نوع البحث ضمن السيرش

               return view('reports.cases_report',compact('type'))->withDetails($cases);
               
            }
            
            // ------في حالة البحث بتاريخ القضية -----//

            if ($rdio == 2) {
               
              $start_at = date($request->start_at);

              $end_at = date($request->end_at);

              $type = $request->type;

              $cases = cases::whereBetween('case_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();

              return view('reports.cases_report',compact('type','start_at','end_at'))->withDetails($cases);
              
             }
        } 
        
  
         
          // -------في البحث برقم القضية---------//

         if ($rdio == 3)
         {
             
            $cases = Cases::select('*')->where('case_number','=',$request->case_number)->get();

            return view('reports.cases_report')->withDetails($cases);
            
        }

        //------ (موضوع الدعوى )البحث حسب العنوان ---------//


        if ($rdio == 4)
        {
            $cases = Cases::select('*')->where('title','=',$request->title)->get();

            return view('reports.cases_report')->withDetails($cases);
        }

        //--------البحث حسب  اسم المحكمة --------//

         if ($rdio == 5)

         {

          $cases=Cases::select('*')->where('court_id','=',$request->court_id)->get();

          return view('reports.cases_report')->withDetails($cases);
            

         }


         
        }
}

