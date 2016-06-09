@extends('layouts.app')
@section('content')




 <div id="latest-blog">
    <div class="container">  
        {{-- posts --}}
        <div class="blog-content">
            <div class="wrap">
                <div class="blog-content-left">
                    <div class="blog-articals">
                        <div class="heading-section">
                          <img src="{{ $profile->image }}" width="150px" height="150px" class="img-circle"/> 
                           
                             <a id="title" href="#"> {{$user->name}} </a>
                             <br><br>
                             <a id="show" href="/users/{{Auth::user()->id}}"> My account</a>
                            
                            </div>
                            
                     </div>
                    
                    
                    <div class="blog-artical">

                       
                    <div class="blog-artical-info">


                       <br><br> <label class="col-md-4 control-label">Username : </label>
                            {{$user->name}}

                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="blog-artical">
                        
                        <div class="blog-artical-info">
                        <label class="col-md-4 control-label">Email : </label>
                            {{$user->email}}
                        </div>
                        
                        <div class="clearfix"> </div>
                    </div>
                    <div class="blog-artical">
                        
                        <div class="blog-artical-info">
                         <label class="col-md-4 control-label">Fullname : </label>
                         @if (isset($profile->first_name) && isset($profile->last_name)) 
                           <a href=""> {{$profile->first_name }} {{$profile->last_name }} </a> 
                          @endif 
                        </div>
                        <div class="clearfix"> </div>
                        
                    </div>
                    <div class="blog-artical">
                        
                        <div class="blog-artical-info">
                         <label class="col-md-4 control-label">Sientific Degree : </label>
                        @if (isset($profile->degree))
                          {{$profile->degree }} 
                        @endif 
                        </div>
                        <div class="clearfix"> </div>
                        
                    </div>
                    <div class="blog-artical">
                        
                        <div class="blog-artical-info">
                         <label class="col-md-4 control-label">Company : </label>
                         @if(isset($profile->company ))
                          {{$profile->company }} 
                          @endif 
                        </div>
                        <div class="clearfix"> </div>
                        
                    </div>
                    
                </div>
                <!---start-blog-pagenate---->
         
           
@endsection