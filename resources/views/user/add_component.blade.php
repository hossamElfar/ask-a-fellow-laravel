@extends('layouts.app') 
@section('content')

        <div class="container" style="padding-left: 100px; padding-right: 100px;">
        <h1>Add Component</h1>
        <br>
        <form class="form-horizontal" style="width: 80%;" method="POST" action="/user/post_component" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="YHgdczFzLi67tiCSC1eWHgyLXNS7Ng0McIt9brWG">
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="description" name="description">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_info" class="col-sm-3 control-label">Contact Info.</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="contact_info" name="contact_info">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="price" name="price">
                </div>
            </div>
            <div class="form-group">
                <label for="category" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-7">
                    <select class="form-control" name="category" id="category">
                        <option value="">Category</option>
                                        @foreach($category as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
                                        </select>
                </div>
            </div>
            <div class="form-group">
                <label for="image_path" class="col-sm-3 control-label">Component Picture</label>
                <div class="col-sm-7">
                    <input name="image_path" id="image_path" type="file" accept="image/*" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-default">Sumbit</button>
                </div>
            </div>
            <div class="errors" style="color:red">
            </div>
        </form>
    </div>
        
@endsection