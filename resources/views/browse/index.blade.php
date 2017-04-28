@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: center; width: 100%;">
        <div class="major_and_semester center-block">
            <select id="major" style="" class="form-control">
                @foreach($majors as $major)
                    <option value="{{$major->id}}">{{$major->major}}</option>
                @endforeach
            </select>
            <br>
            <select style="margin-top:30px;" id="semester" class="form-control">
                @foreach($semesters as $semester)
                    <option value="{{$semester}}">{{$semester}}</option>
                @endforeach
            </select>
            <br>
            <a id="show_courses" style="margin-top:20px; margin-bottom:30px;"href="#" class="btn btn-info">Show courses</a>
        </div>

        <div class="courses pull-right">

        </div>
    </div>



    <style>
        .major_and_semester
        {
            width: 30%;
            display:inline-block;
        }
        .courses
        {
            display: inline-block;
            width: 60%;
            margin-left: 50px;
        }

        @media (max-width:800px)
        {
            .major_and_semester
            {
                width: 70%;
                display: block;
            }
            .courses
            {
                display: block;

                width: 80%;
                margin-left: auto;
                margin-right: auto;
                float:none !important;
            }
        }

    </style>
    <script>
        $('#show_courses').click(function(){
            //send ajax request;
            var major = $('#major').val();
            var semester = $('#semester').val();
            var url = "{{ url('/list_courses') }}";
            $.ajax({
                url: url+'/'+major+'/'+semester,
                success: function(data){
                    $('.courses').html(data);

                }

            });
        });
    </script>

@endsection
