<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Cases_attachments;
use App\Models\Cases_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'court_Name' => 'required',
            'claimant_Name' => 'required',
            'defendant_Name' => 'required',
            'claimant_Lawyer' => 'required',
            'defendant_Lawyer' => 'required',
            'cases_Date' => 'required',
            'cases_Subject' => 'required',
        ]);
        Cases::create([
            'cases_Number'=>$request->cases_Number,
            'case_Date' => $request->case_Date,
            'Due_date' => $request->Due_date,
            'court_Name' => $request->court_Name,
            'base_Number'=>$request->base_Number,
            'claimant_Name' => $request->claimant_Name,
            'defendant_Name' => $request->defendant_Name,
            'claimant_Lawyer' => $request->claimant_Lawyer,
            'defendant_Lawyer' => $request->defendant_Lawyer,
            'cases_Subject' => $request->cases_Subject,
            'room'=>$request->room,
            
        ]);
        $cases_id=Cases::latest()->first()->id;
        Cases_details::create([

            'case_number'=>$request->cases_Number,
            'Status'=>$request->Status,
            'decision'=>$request->decision,
            'facts'=>$request->facts,
            'legal_discussion'=>$request->legal_discussion,
            'verdict'=>$request->verdict,
            'user' => (Auth::user()->name),
            

        ]);
        if ($request->hasFile('pic')) {

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

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $cases_Number), $imageName);
        }

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

        'cases_Number'=>$request->cases_Number,
        'court_Name' => $request->court_Name,
        'case_Date' => $request->case_Date,
        'Due_date' => $request->Due_date,
        'base_Number'=>$request->base_Number,
        'claimant_Name' => $request->claimant_Name,
        'defendant_Name' => $request->defendant_Name,
        'claimant_Lawyer' => $request->claimant_Lawyer,
        'defendant_Lawyer' => $request->defendant_Lawyer,
        'cases_Subject' => $request->cases_Subject,
        'room'=>$request->room,


    ]);
    session()->flash('edit', 'تم تعديل القضية بنجاح');
    return back();
   }

   public function destroy(Request $request)
   {
      
       $id = $request->invoice_id;
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
                'case_number' => $request->case_number,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'decision' => $request->decision,
                'facts' => $request->facts,
                'legal_discussion' => $request->legal_discussion,
                'verdict' => $request->verdict,
                'user' => (Auth::user()->name),
                
            ]);
         
        }
         else {

            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
            ]);
            Cases_Details::create([
                'id_Cases' => $request->id_Cases,
                'case_number' => $request->case_number,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'decision' => $request->decision,
                'facts' => $request->facts,
                'legal_discussion' => $request->legal_discussion,
                'verdict' => $request->verdict,
                'user' => (Auth::user()->name),
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


 

    }


