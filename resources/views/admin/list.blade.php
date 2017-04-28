@extends('layouts.app')
@section('content')
    <div class="" style="padding: 50px;">
        @if (session('mail'))
            <div class="flash-message">
                <div class="alert alert-info" style="background-color: #FFAF6C; border-color: #FF6B2D; color:#AA5B0B">
                    {{session('mail')}}
                </div>
            </div>
        @endif
        <table class="table table-hover center-block" style="text-align: center; width: 50%;">
            <tr>
                <td>
                    <a href="{{url('admin/add_course')}}">Add Course</a>
                </td>
            </tr>

            <tr>
                <td>
                    <a href="{{url('admin/add_major')}}">Add Major</a>
                </td>
            </tr>

            <tr>
                <td>
                    <a href="{{url('admin/feedbacks')}}">View Feedbacks</a>
                </td>
            </tr>

            <tr>
                <td>
                    <a href="{{url('admin/reports')}}">View Reports</a>
                </td>
            </tr>

            <tr>
                <td>
                    <a href="{{url('admin/mail/many')}}">Mail Users</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('admin/mail/log')}}">Mails Log</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('admin/users')}}">List all users</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('admin/add_badge')}}">Add Verification Badge to the users</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('admin/statistics')}}">Site statistics</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{url('admin/event_requests')}}">Event Requests</a>
                </td>
            </tr>

        </table>
    </div>
@endsection