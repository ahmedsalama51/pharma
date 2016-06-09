@extends('layouts.app')

@section('content')
{{ Auth::user()->id }}
{{ Auth::user()->name }}

<p>dashboard</p>
 @endsection