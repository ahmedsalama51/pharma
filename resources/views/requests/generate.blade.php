@extends('layouts.app')

@section('content')
@if(isset($message))
<div style="text-align:center" class="alert alert-success">
{{$message}}
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Generate Account</div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ Auth::guest() ? url('/request') : url('/admin/users/generate') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(isset($request['id']))
                        <input type="hidden" name="account_id" value="{{ $request['id'] ? $request['id'] : '' }}"></input>
                        @endif
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ isset($request) ? $request['name'] ? $request['name'] : old('name') : old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ isset($request) ? $request['email'] ? $request['email'] : old('email') : old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group {{ $errors->has('id_number') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">ID Number</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="id_number" value="{{ isset($request) ? $request['id_number'] ? $request['id_number'] : old('id_number') : old('id_number') }}">
                                @if ($errors->has('id_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" id="password" class="form-control" name="password" value="{{substr(uniqid(),7,13)}}"><input type="button" id="showPassword" value="show" class="button" />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class=" col-md-4 control-label ">Type </label>
                                  <div class="col-md-6">
                                 @if(isset($request))
                                      @if($request['type'] )
                                        <input type="disabled" value="{{$request['type']}}"></input>
                                      @else
                                        <select  class="form-control" data-style="btn-primary" id="type" name="type">
                                     
                                          <option value="pharmacy-student">pharmacy-student</option>
                                          <option value="medicine-student">medicine-student</option>   
                                          <option selected value="phamacist">Phamacist</option>                              
                                          <option value="doctor">Doctor</option>                              
                                      </select>
                                      @endif
                                      @else
                                    <select  class="form-control" data-style="btn-primary" id="type" name="type">
                                     
                                      <option value="pharmacy-student">pharmacy-student</option>
                                      <option value="medicine-student">medicine-student</option>   
                                      <option selected value="phamacist">Phamacist</option>                              
                                      <option value="doctor">Doctor</option>
                                    </select>
                                  
                                   @endif
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                   
                                  </div>
                         </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Generate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection