@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
@foreach($contacts as $contact)
		<div class="col-md-1">{{ $contact->id }}</div>
		<div class="col-md-2"><a href="/contacts/{{ $contact->id }}">{{ $contact->name }}</a></div>
		<div class="col-md-3">{{ $contact->email }}</div>
		<div class="col-md-2">{{ $contact->phone }}</div>
		<div class="col-md-2"><a href="/contacts/{{ $contact->id }}/edit">Edit Contact</a></div>
		<div class="col-md-2"><a href="/contacts/{{ $contact->id }}/delete">Delete Contact</a></div>
@endforeach
	</div>
</div>

@endsection