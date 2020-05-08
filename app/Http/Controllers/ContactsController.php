<?php namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Klaviyo;

class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id', auth()->user()->id)->get();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store/Update a resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $list_id = User::where(['id' => auth()->id()])->value('contact_list');
        if (!request('id')) {
            $contact = Contact::create([
                'user_id' => auth()->id(),
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
            ]);
            $response = Contact::addContact($list_id, $contact);

        }
        // update the contact
        else {
            $id = request('id');
            $affected = \DB::update('update contacts set name = ?, email = ?, phone = ? where id = '.request('id'), [request('name'), request('email'), request('phone')]);
            $contact = Contact::where('id', $id)->first();
            $response = Contact::editContact($list_id, $contact);
        }
        if ($response->status !== 200) {
            session()->flash('error', 'Your contact has been saved in the database. Klavio response : '.$response->content->detail.' response status: '.$response->status);

        }
        else {
            session()->flash('message', 'Your contact has been saved. Please keep an eye out for the email confirmation. The Klavio response status: '.$response->status);


        }

        return redirect('/contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $contact = Contact::where('id', $id)->first();

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $contact = Contact::where('id', $id)->first();

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $contact = Contact::where('id', $id)->first();

        if(auth()->id() == $contact->user_id) {
            $listId = User::where('id', auth()->id())->first();
            $response = Contact::deleteContact($listId->contact_list, $contact);

            if ($response->status === 200) {
                session()->flash('message', 'Your contact has been deleted.');
            }
            else {
                session()->flash('error', 'Known bug: '.$response->content->detail);
            }
            // this soft-deletes the contact but does not affect the syncd status
            $contact->delete();

            return redirect('/contacts');
        }
        else {
            session()->flash('error', 'You cannot delete that contact.');
            return redirect()->home();
        }
    }
}
