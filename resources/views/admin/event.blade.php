@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

              <div class="panel-heading">
              <h1>{{ $event->title</h1>
              <br>
              <h2><i>{{ $event->description }}</h2></i>
              <br>
              <h2><i>{{ $event->place }}</h2></i>
              <br>
              <h2><i>{{ $event->date }}</h2></i>
              <br>
              <h2>Created by</h2>
              <h3><i>{{ $creator->first_name }} {{ $creator->last_name }}</h3></i>
              <br>
              <h3><i>Email: {{ $creator->email }}</h3></i>
              <br>
              <h3><i>Major: {{ $creator->major }}</h3></i>
              <br>
              <h3><i>Semester: {{ $creator->semester }}</h3></i>
              </div>

              <div class="panel-body">
               
                <a href="/admin/accept/{{ $event->id }}" id="accept">Accept Request</a>

				        <br>

				        <a href="/admin/request/{{ $event->id }}" id="reject">Reject Request</a>
                
                  <div id="deleteReq" style="display: none;">
                	<form method="POST" action="/admin/reject/{{ $event->id }}">
                		{{ method_field('DELETE') }}
				    	<div class="form-group">
				    		<h3><b>Are you sure want to delete this review?</b></h3>
				    		<span class="glyphicon glyphicon-trash"></span>
						  	<button type="submit" class="btn">Delete Request</button>
						</div>
					</form>
				  </div>
               
              </div>
                
          </div>
          	
        </div>
    </div>
</div>

@endsection


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $("#reject").click(function () {
       $("#deleteReq").show();  
       return false;           
    });
  });
 </script>
