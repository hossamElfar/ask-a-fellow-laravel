@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="{{url('admin/update_component_category/'.$category->id)}}" style="padding: 50px; width: 50%;">
            {{csrf_field()}}
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->name}}">
            </div>
            <button type="submit" class="btn btn-default">Update Category</button>

            <div class="error" style="color:red">
                @include('errors')
            </div>
        </form>
    </div>

@endsection