<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Cases_attachments;
use App\Models\Cases_details;
use App\Models\Desicions;
use App\Models\Enemy_Lawyers;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;

class CasesController extends Controller
{
    

    public function index()

    {
        $cases=Cases::get();
        return view('cases.cases',compact('cases'));

    }

    public function create()
    {
        $cases=Cases::all();
        return view('cases.cases_add',compact('cases'));
    }

    public function store(Request $request)

    {
        $request->validate([
            'court_id' => 'required',
            'case_number'=>'case_number',
            'case_Date' => 'required',
            'title' => 'title',
        ]);
        Cases::create([
            'case_number'=>$request->case_number,
            'case_Date' => $request->case_Date,
            'court_id' => $request->court_id,
            'title' => $request->title,
            
            
        ]);
        //------- القضية لها اكثر من جلسة ---------//
         
        $case_id = Cases::latest()->first()->id;
        $date =  $request->date;
        $description = $request->description;
        $delay_date = $request->delay_date;
        $delay_reasons = $request->delay_reasons;
        
        $sessions = new Sessions();
        $sessions->case_id = $case_id;
        $sessions->date = $date;
        $sessions->description = $description;
        $sessions->delay_date = $delay_date;
        $sessions->delay_reasons = $delay_reasons;
        $sessions->save();

        ///-------  القضية لها اكثر من قرار ---------//

        $desicions = Desicions::find()->all;

        $case = Cases::find()->all;

        $desicions->case()->associate($case)->save();
                   
        // --------- للتجريب  -------//

        // $cases_id=Cases::latest()->first()->id; 
 
        // $desicions = $cases_id->desicions;

        // $desicions->case()->associate($cases_id)->save();


        //---------  تفاصيل القضية --------------//

        
        $cases_id=Cases::latest()->first()->id;

            Cases_details::create([
            'id_cases'=>$cases_id,
            'facts'=>$request->facts,
            'legal_discussion'=>$request->legal_discussion,
            // 'user' => (Auth::user()->name),
            

        ]);
        if ($request->hasFile('pic'))
       {

            $cases_id = Cases::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $cases_Number = $request->cases_Number;
            $attachments = new Cases_attachments();
            $attachments->file_name = $file_name;
            $attachments->cases_Number = $cases_Number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->cases_id = $cases_id;
            $attachments->save();

            //-------- move pic ----------//

            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $cases_Number), $imageName);
        }

          // ------- 📩 اشعار اضافة قضية -----------

        $user = User::get();
        $cases = Cases::latest()->first();
        Notification::send($user, new \App\Notifications\AddCase($cases));

        session()->flash('message', 'This Cases is added');
       
        return back();

   } 

   public function show($id)
   {
       $cases = Cases::where('id', $id)->first();
       return view('cases.status_update', compact('cases'));
   }
    
   public function edit($id)
   {
       $cases = Cases::where('id', $id)->first();
       return view('cases.edit_case', compact('cases'));
   }


   public function update(Request $request)

   {

    $cases=Cases::findorfail($request->cases_id);

    $cases->update([

        'id_cases'=>$cases_id,
        'facts'=>$request->facts,
        'legal_discussion'=>$request->legal_discussion,


    ]);
    session()->flash('edit', 'تم تعديل القضية بنجاح');
    return back();
   }

   public function destroy(Request $request)
   {
      
       $id = $request->case_id;
       $cases = Cases::where('id', $id)->first();
       $Details = Cases_attachments::where('cases_id', $id)->first();

        $id_page =$request->id_page;


       if (!$id_page==2) {

       if (!empty($Details->cases_number)) {

           Storage::disk('public_uploads')->deleteDirectory($Details->cases_number);
       }

       $cases->forceDelete();
       session()->flash('delete_case');
       return redirect('/cases');

       }

       else {

           $cases->delete();
           session()->flash('archive_case');
           return redirect('/Archive');
       }
   }
    

   public function Status_Update($id, Request $request)

    {
        $invoices = Cases::findOrFail($id);

        if ($request->Status === 'رابحة') 
        {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
            ]);

        
         Cases_Details::create([
                'id_Cases' => $request->id_Cases,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'facts' => $request->facts,
                'legal_discussion' => $request->legal_discussion,
                // 'user' => (Auth::user()->name),
                
            ]);
         
        }
         else {

            $cases->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
            ]);
            Cases_Details::create([
                'id_Cases' => $request->id_Cases,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'facts' => $request->facts,
                'legal_discussion' => $request->legal_discussion,
                // 'user' => (Auth::user()->name),
            ]);
        }
          

        
        session()->flash('Status_Update');
        return redirect('/cases');

    }

    public function Case_Winning()
    {
        $cases = Cases::where('Value_Status', 1)->get();
        return view('cases.cases_winning',compact('cases'));
    }

    public function Case_Lost()
    {
        $cases = Cases::where('Value_Status',2)->get();
        return view('cases.cases_lost',compact('cases'));
    }

    public function Case_Partial()
    {
        $cases = Cases::where('Value_Status',3)->get();
        return view('cases.cases_Partial',compact('cases'));
    }

    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {

            $userUnreadNotification->markAsRead();

            $userUnreadNotification->save();

            session()->flash('mark_as_read');

            return back();
        }


    }


 

    }


