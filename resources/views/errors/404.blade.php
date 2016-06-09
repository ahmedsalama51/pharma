@extends('layouts.app')

@section('content')
<style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            p{
                text-align: center;
                display: inline-block;
            }

            h1 {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
            <div class="main container">
                <div class="error-404 text-center">
                        <h1>404</h1>
                        <p>this link dead link</p>
                        @if(isset($e) || isset($request))
                            {{$e}}
                        @endif
                        @if(isset($errors) && count($errors) > 0)
                        <div class="alert alert-danger" id="validation" style="margin:10px">
                           {{ $errors}}
                               
                            </div>
                        @elseif(isset(session($errors)))
                        <div class="alert alert-danger" id="validation" style="margin:10px">
                           {{ session('errors')}}
                               
                            </div>
                        @endif
                        <a class="b-home" href="/">Back to Home</a>
                    </div>
            </div>
            <!-- 404 -->
       @endsection