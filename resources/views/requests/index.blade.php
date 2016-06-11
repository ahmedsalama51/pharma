@extends('layouts.app')

@section('content')
@if(isset($message))
<div style="text-align:center" class="alert alert-success">
{{$message}}
</div>
@endif

<div class="container">
    <div class="row col-xs-4 col-sm-10 col-xs-offset-1 custyle">
    <table class="table table-striped custab">
    <thead>
    <a href="/requests/accepted" class="btn btn-sm btn-success">Accepted Requests</a><a href="/requests/rejected" class="btn btn-sm btn-danger  pull-right">Rejected Requests</a>
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
                <td class="text-center"> <a href="/admin/requests/accept/{{$request->id}}" class="btn btn-sm btn-success"><span class='glyphicon glyphicon-ok'></span>Accept</a><a class='btn btn-info btn-sm btn-danger' href="/admin/requests/reject/{{$request->id}}"><span class="glyphicon glyphicon-remove"></span>Reject</a></td>
            </tr>
            {{var_dump($request)}}
    @endforeach
    </table>
    </div>
</div>

@endsection