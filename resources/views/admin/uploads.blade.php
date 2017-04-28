@extends('layouts.app');

@section('content')

   <div class="container" >
    @foreach($notes as $note)
        <div class="row">
          <div class="col-xs-3">
           <h3> {{$note->title}} </h3>  <br>
          <b>Description: </b>  {{$note->description}} <br>
          <b>Uploaded by: </b>  {{$note->first_name}}  {{$note->last_name}} <br>
          <b>Course: </b>{{$note->course_name}} {{$note->course_code}} <br>



          </div>

          <div class="col-xs-3 button-group">
            <a href="/admin/approve_note/{{$note->id}}" class="upload btn btn-success" id="{{$note->id}}">Upload</a>
            <a href="/admin/delete_note/{{$note->id}}" class="delete btn btn-danger" id="{{$note->id}}">Delete</a>
            <a href="/admin/view_note/{{$note->id}}" class="delete btn btn-primary" id="{{$note->id}}">View</a>

          </div>
        </div>

    @endforeach
   </div>
<style media="screen">
  .padding-group: {
    margin-top: 50px;
    margin-bottom: 50px;
  }
</style>
<!-- <script type="text/javascript">
  alert('yooo');
  $(document).ready(function() {
      $("button").click(function() {
        alert('cliked');
        var id = $(this).attr("id");
        $.get('/admin/upload/' + id, function(data, status) {
            alert(status);
        });
      });
  });
</script> -->
@endsection