@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row col-xs-4 col-sm-10 col-xs-offset-1 custyle">
    <table class="table table-striped custab">
    <thead>
    <a href="/requests" class="btn btn-sm btn-primary">All Requests</a><a href="/requests/rejected" class="btn btn-sm btn-danger  pull-right">Rejected Requests</a>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>ID Number</th>
            <th>Type</th>
            <th>Certificate</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    @foreach ($requests as $request)
            <tr>
                <td>{{$request->id}}</td>
                <td>{{$request->email}}</td>
                <td>{{$request->name}}</td>
                <td>{{$request->id_number}}</td>
                <td>{{$request->type}}</td>
                <td>{{$request->certificate}}</td>
                <td class="text-center"> <a href="/users/{{$request->user['id']}}" class="btn btn-sm btn-success"></span>User</a>
            </tr>
    @endforeach
    </table>
    </div>
</div>

@endsection