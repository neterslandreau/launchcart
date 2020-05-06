@extends ('layouts.app')
@section ('content')

<div class="container">
	<div>{{ $contact->name }}</div>
	<div>{{ $contact->email }}</div>
	<div>{{ $contact->phone }}</div>
</div>

@endsection
