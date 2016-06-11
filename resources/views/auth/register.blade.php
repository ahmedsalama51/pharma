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
                <div class="panel-heading">Request Account</div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/request') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

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
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

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
                                <input type="text" class="form-control" name="id_number" value="{{ old('id_number') }}">

                                @if ($errors->has('id_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group {{ $errors->has('certificate') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Certificate </label>

                            <div class="col-md-6">
                                <input type="file" class="upload" name="certificate"  value="{{ old('certificate') }}">

                                @if ($errors->has('certificate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('certificate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class=" col-md-4 control-label ">Type: </label>
                                  <div class="col-md-6">
                                      <select  class="form-control" data-style="btn-primary" id="type" name="type">
                                      <option selected disabled>Choose Type</option>
                                          <option value="pharmacy-student">pharmacy-student</option>
                                          <option value="medicine-student">medicine-student</option>   
                                          <option value="phamacist">Phamacist</option>                              
                                          <option value="doctor">Doctor</option>                              
                                      </select>
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
                                    <i class="fa fa-btn fa-user"></i>Request Account
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
