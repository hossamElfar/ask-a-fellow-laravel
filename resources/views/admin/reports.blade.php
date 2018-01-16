@extends('layouts.app')
@section('content')
<div class="container" style="width: 90%">
    <h1>Questions Reports</h1>
    <table class="table table-hover">
        <tr>
            <th>Reporter</th>
            <th>Question</th>
            <th>Reason</th>
        </tr>
        @foreach($question_reports as $report)
            <tr href="{{$report->link}}" class="report_row">

                <td>{{$report->reporter->first_name.' '.$report->reporter->last_name}}</td>

                <td>{{$report->question->question}}</td>

                <td>{{$report->report}}</td>

            </tr>
        @endforeach
    </table>

    <h1>Answers Reports</h1>
    <table class="table-hover table">
        <tr>
            <th>Reporter</th>
            <th>Answer</th>
            <th>Reason</th>
        </tr>
        @foreach($answer_reports as $report)
            <tr href="{{$report->link}}" class="report_row">
                <td>{{$report->reporter->first_name.' '.$report->reporter->last_name}}</td>
                <td>{{$report->answer->answer}}</td>
                <td>{{$report->report}}</td>
            </tr>
        @endforeach
    </table>
</div>

    <style>
        .report_row
        {
            cursor: pointer;
        }
    </style>
    <script>
        $('.report_row').click(function(){
            window.location.href = $(this).attr('href');
        });
    </script>
@endsection
