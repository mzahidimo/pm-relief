<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Gate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $contacts = Contact::with('user')->paginate(10);
        
        // return dd($contacts);
        return view('contacts.index',['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);


        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'cell' => 'required|integer',
            'cnic' => 'required|unique:contacts|integer',
            'address' => 'required',
            'district' => 'required',
            'tehsil' => 'required',
            'uc' => 'required',
        ]);
        
        $user_id = auth()->user()->id; // get login user id
        $request->request->add(['user_id' => $user_id]);
        //return  dd($request);
        Contact::create($request->all());
   
        return redirect()->route('contact.index')
                        ->with('success','Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
      //return  dd($contact);
      if(Gate::denies('super-admin')){
            return redirect(route('contact.index'));
        }
      
       return view('contacts.edit', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
       // return dd($contact->id);
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'cell' => 'required|integer',
            'cnic' => 'required|integer',
            'address' => 'required',
            'district' => 'required',
            'tehsil' => 'required',
            'uc' => 'required',
        ]);


        $contact->name = $request->name;
        $contact->father_name = $request->father_name;
        $contact->address = $request->address;
        $contact->cell = $request->cell;
        $contact->cnic = $request->cnic;
        $contact->district = $request->district;
        $contact->tehsil = $request->tehsil;
        $contact->uc = $request->uc;
        $contact->save();  // save user
        Alert::success($request->name, 'Updated Successfully');
        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //dd($user);
        if(Gate::denies('super-admin')){
                return redirect(route('contact.index'));
            }
           

            $contact->delete();

            return redirect()->route('contact.index');
        
    }
}
