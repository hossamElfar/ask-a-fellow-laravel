@extends('layouts.app')
@section('content')
    <style>
        table td, table th
        {
            border: 1px solid black;
            padding: 7px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/zf/dt-1.10.11/datatables.min.css"/>

    <div class="container">
        <table class="table table-striped table-bordered" style="width:100%;" id="stores_table">
            <thead>
                <tr>
                    <th>Store Name</th>
                    <th>Store Address</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                <tr>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->address }}</td>
                    <td><a onclick="return confirm('Are you sure?');" href="{{url('admin/delete_store/'.$store->id)}}">Delete</a></td>
                    <td><a href="{{url('admin/update_store/'.$store->id)}}">Update</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <form method="POST" action="{{url('admin/add_store')}}" style="padding: 50px; width: 50%;">
            {{csrf_field()}}

            <div class="form-group">
                <label for="store_name">Store Name</label>
                <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Store Name">
            </div>

            <div class="form-group">
                <label for="store_address">Store Address</label>
                <input type="text" class="form-control" id="store_address" name="store_address" placeholder="Store Address">
            </div>

            <button type="submit" class="btn btn-default">Add Course</button>

            <div class="error" style="color:red">
                @include('errors')
            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://cdn.datatables.net/t/zf/dt-1.10.11/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#stores_table').DataTable();
        });
    </script>

    <style>
        #stores_table_wrapper
        {
            width: 70%;
        }

        .odd {
            background-color: #FFECDC !important;
        }

        #stores_table thead tr {
            background-color: #FFCEA5;
        }
    </style>
@endsection