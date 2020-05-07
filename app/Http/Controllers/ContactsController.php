<?php namespace App\Http\Controllers;

use App\Contact;
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
        // dd($contacts);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if (!request('id')) {
            $contact = Contact::create([
                'user_id' => auth()->id(),
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
            ]);

            // $response = Curl::to('https://a.klaviyo.com/api/v2/list/RwbhWB/subscribe')
            //     ->withData(
            //         [
            //             'api_key' => 'pk_dd71845846894d28d91d7d418eb8ae62cc',
            //             'profiles' => [
            //                 'email' => request('email'),
            //                 'phone_number' => request('phone'),
            //                 'name' => request('name'),
            //             ]
            //     ])
            //     ->asJson()
            //     ->post();
        }
        else {
            $affected = \DB::update('update contacts set name = ?, email = ?, phone = ? where id = '.request('id'), [request('name'), request('email'), request('phone')]);
        }

        session()->flash('message', 'Your contact has been saved.');

        return redirect('/contacts');
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
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
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $contact = Contact::where('id', $id)->first();

        return view('contacts.edit', compact('contact'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $contact = Contact::where('id', $id)->first();

        if(auth()->id() == $contact->user_id) {
            session()->flash('message', 'Your contact has been deleted.');
            $contact->delete();
            return redirect('/contacts');
        }
        else {
            session()->flash('error', 'You cannot delete that contact.');
            return redirect()->home();
        }
    }
}
