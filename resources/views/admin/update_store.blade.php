@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="{{url('admin/update_store/'.$store->id)}}" style="padding: 50px; width: 50%;">
            {{csrf_field()}}
            <div class="form-group">
                <label for="store_name">Course Code</label>
                <input type="text" class="form-control" id="store_name" name="store_name" value="{{$store->name}}">
            </div>

            <div class="form-group">
                <label for="store_address">Course Name</label>
                <input type="text" class="form-control" id="store_address" name="store_address" value="{{$store->address}}">
            </div>

            <button type="submit" class="btn btn-default">Update Course</button>

            <div class="error" style="color:red">
                @include('errors')
            </div>
        </form>
    </div>
@endsection