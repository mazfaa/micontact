<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin', ['contacts' => Contact::whereUserId(Auth::id())->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $loggedInUserContacts = Contact::whereUserId(Auth::id())->get();
        foreach ($loggedInUserContacts as $loggedInUserContact) {
            $isTaken = 
                Contact::whereEmail($loggedInUserContact->email) ==
                Contact::whereEmail($request->email) || 
                Contact::whereEmail($loggedInUserContact->phone) ==
                Contact::whereEmail($request->phone); 

            if ($isTaken) {
                return back()->with('failed', 'Email or Phone has already been taken.');
            }
        }
        
        $contact = new Contact;
        $contact->user_id = Auth::id();
        $contact->fill($request->all());
        $contact->save();
        return redirect('contact')->with('success', 'Contact Created Successfullly!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());
        return redirect('contact')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('failed', 'Record Deleted Successfully!');
    }
}
