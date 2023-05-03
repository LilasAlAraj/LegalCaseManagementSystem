<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Cases_attachments;
use App\Models\Cases_details;
use App\Models\Desicions;
use App\Models\Enemy_Clients;
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

        $cases_attachments=Cases_attachments::all();

        $cases_details=Cases_details::all();

        return view('cases.index',compact('cases','cases_attachments','cases_details'));
        

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
            'judge'=> 'judge',
            'side_judge'=> 'side_judge',
        ]);
        Cases::create([
            'case_number'=>$request->case_number,
            'case_Date' => $request->case_Date,
            'court_id' => $request->court_id,
            'title' => $request->title,
            'enemy_client_name'=>$request->enemy_client_name,
            'side_judge'=>$request->side_judge,
            
            
        ]);
        //-----المحاميين الخصم -------------------//

        $case_id = Cases::latest()->first()->id;

        $enemy_lawyer=new Enemy_Lawyers();          

        $enemy_lawyer->name=$request->enemy_lawyer_name;

        $enemy_lawyer->number_phone=$request->number_phone;

        $case_id->enemy_lawyers()->save($enemy_lawyer);

        // $case_id->enemy_clients()->save($request->enemy_client_name);
        // $case_id->cases()->save($request->case_number);
        // $case_id->save();


        //------------------الخصم-------------------//


        $case_id = Cases::latest()->first()->id;
 
        $enemy_client = new Enemy_Clients();

        
        $enemy_client->name=$request->enemy_client_name;

        $enemy_client->number_phone=$request->number_phone;
 
        $case_id->enemy_clients()->save($enemy_client);


        //------- القضية لها اكثر من جلسة ---------//
         
        $case_id = Cases::latest()->first()->id;

        $sessions = new Sessions();

        $sessions->case_id = $case_id;

        $sessions->date = $request->date;

        $sessions->description = $request->description;

        $sessions->delay_date =$request->delay_date;

        $sessions->delay_reasons =$request->delay_reasons;

        $sessions->save();

        ///-------  القضية لها اكثر من قرار ---------//

          $case_id = Cases::latest()->first()->id;
 
          $desicions = new Desicions();

          $desicions->number =$request->number; 

          $desicions->case_id = $case_id;

          $desicions->description = $request->description;

          $desicions->date = $request->date;


          $desicions->save();

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

        'case_number'=>$request->case_number,

        'case_Date'=>$request->case_Date,

        'court_id'=>$request->court_id,


    ]);
    session()->flash('edit', 'تم تعديل القضية بنجاح');

    return back();
   }

   public function destroy(Request $request)
   {
      
       $id = $request->case_id;

       $cases = Cases::where('id', $id)->first();

       $Details = Cases_attachments::where('cases_id', $id)->first();

        $id_Archive =$request->id_Archive;
       
       
        // اعتبرتا مثبتة  عندك برقم 2 كدليل انو الطلب جاييني كارشيف   id   ليلاس هي ال 

        //input type hidden انو اذا القيمه تساوي 2 معناتو ارشفة ,,,طبعا انا اعتبرت انو في  

        //     //<div class="modal-body">
        //     هل انت متاكد من عملية الارشفة ؟
        //     <input type="hidden" name="case_id" id="case_id" value="">
        //     <input type="hidden" name="id_Archive" id="id_Archive" value="2">
         // </div>

       if (!$id_Archive==2) {

       if (!empty($Details->cases_number)) {

           Storage::disk('public_uploads')->deleteDirectory($Details->cases_number);
       }
      //   يعني رح تحذفها بشكل نهائي forceDelete 
      
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
        $cases = Cases::findOrFail($id);

        if ($request->Status === 'رابحة') 
        {

            $cases->update([
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


