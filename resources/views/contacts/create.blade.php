@extends('layouts.app')

@section('content')

<div class="container">

   <div class="col-sm-8 blog-main">

    <h1>Create Contact</h1>

        <hr>

        <form method="post" action="/contacts">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" class="form-control">
            </div>


            <div class="form-group">
                <button id="add-contact" type="submit" class="btn btn-primary">Save</button>
            </div>

            <input type="hidden" name="syncd" value="0">
        </form>

    </div>


</div>


@endsection
