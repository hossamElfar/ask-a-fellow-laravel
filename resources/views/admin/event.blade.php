@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

              <div class="panel-heading">
              <h1>Event: {{ $event->title }}</h1>
              <br>
              <h3><i>Description: {{ $event->description }}</h3></i>
              <br>
              <h3><i>Place: {{ $event->place }}</h3></i>
              <br>
              <h3><i>Date: {{ $event->date }}</h3></i>
              <br>
              <h2>Created by: {{ $creator->first_name }} {{ $creator->last_name }}</h2>
              <br>
              <h3><i>Email: {{ $creator->email }}</h3></i>
              <br>
              <h3><i>Major: {{ $creator->major }}</h3></i>
              <br>
              <h3><i>Semester: {{ $creator->semester }}</h3></i>
              </div>

              <div class="panel-body">
               
                <a href="/admin/accept/{{ $event->id }}">Accept Request</a>
				        <br></br>
                <a onclick="return confirm('Are you sure want to reject this request?');" href="/admin/reject/{{ $event->id }}">Reject Request</a>
               
              </div>
                
          </div>
          	
        </div>
    </div>
</div>

@endsection