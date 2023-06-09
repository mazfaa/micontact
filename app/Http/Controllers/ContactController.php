<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()) {
            return redirect()->route('/login');
        }
        return response()
            ->view('admin', ['contacts' => Contact::whereUserId(Auth::id())->get()])
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
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
        /*
        * Check whether the email or phone has already been taken
        */ 
        $isTaken = Contact::whereUserId(Auth::id())
                    ->emailOrPhoneTaken($request->email, $request->phone)
                    ->exists();

        if ($isTaken) {
            return back()->with('failed', 'Email or Phone has already been taken.');
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
