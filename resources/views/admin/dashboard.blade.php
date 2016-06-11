@extends('layouts.app')

@section('content')
<!-- <div id="wrapper">

        <!-- Sidebar -->
       <!--  <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div> --> 
<div class="container">
    <div class="row col-xs-4 col-sm-10 col-xs-offset-1 custyle">
    <table class="table table-striped custab">
    <thead>
    @if($from == 'all')
    <a href="/admin/users/banned" class="btn btn-danger">Banned Users</a>
    <a href="/admin/users/req" class="btn btn-warning">Users with Req</a>
    @elseif($from == 'banned')
    <a href="/admin" class="btn btn-info">All Users</a>
    <a href="/admin/users/req" class="btn btn-warning pull-right">Users with Req</a>
    @elseif($from == 'req')
    <a href="/admin" class="btn btn-info">All Users</a>
    <a href="/admin/users/banned" class="btn btn-danger pull-right">Banned Users</a>
    @endif
    @if($from=='all')
    <a href="/admin/users/generate" class="btn btn-primary  pull-right"><b>+</b> Add new user</a>
    @endif
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>ID Number</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->id_number}}</td>
                <td class="text-center"><a href="/admin/users/{{$user->trashed() ? 'restore' : 'delete'}}/{{$user->id}}" class="btn btn-sm {{$user->trashed() ? 'btn-success' : 'btn-danger' }}"><span class="glyphicon {{$user->trashed() ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span>{{$user->trashed() ? 'Unban' : 'Ban'}} </a></td>
            </tr>
    @endforeach
    </table>
    </div>
</div>
 @endsection