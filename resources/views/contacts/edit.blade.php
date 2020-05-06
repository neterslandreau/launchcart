@extends('layouts.app')

@section('content')

<div class="container">

   <div class="col-sm-8 blog-main">

    <h1>Edit Contact</h1>

        <hr>

        <form method="post" action="/contacts">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" class="form-control" value="{{ $contact->email }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" class="form-control" value="{{ $contact->phone }}">
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="id" value="{{ $contact->id }}">


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>


</div>


@endsection
