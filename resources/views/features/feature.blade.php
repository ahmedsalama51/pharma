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
                            <h2 id="title"> Research and development section </h2>
                            <h3 id="show"> {{$feature->name}}</h3>
                            <br>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                        <div class='form-group form-group-sm feeed'>

                            @if(isset($feedbacks) && sizeof($feedbacks) >0)
                            <h3 id="title">Feedbacks</h3>
                            @foreach($feedbacks as $feedback)
                            <div class="blog-artical">

                                    <div class="alert alert-info feedback{{$feedback->id}}">



                                        <img src="{{$feedback->user->personal->image}}" class="thumbnail" height="70" width="70" style="display: inline;">   
                                        <span><a href="">{{$feedback->user->name}}</a></span>
                                        <span style="margin-left:15px;">{{$feedback->content}}</span>
                                        <div class="pull-right">
                                    <!-- <a href="/feedbacks/delete/{{$feedback->id}}">Delete</a> -->
                            @if(Auth::user()->id == $feedback->user->id)       
                                 <button type="button" class="deletefeed" data-rowid="{{$feedback->id}}" >Delete</button>
                            @endif
                            @if(Auth::user()->id != $feedback->user->id)
                                    <button type="button" class="feedup" data-rowid="{{$feedback->id}}" >Up</button>
<!--                                     <button type="button" class="feeddown" data-rowid="{{$feedback->id}}" >Down</button>
 -->                            @endif            
                                        <span class="ups{{$feedback->id}}">{{$feedback->feedbackups->count()}} ups </span>
                                        </div>

                                        <br>
                                        <hr/>
                                       <div class="comm{{$feedback->id}}"> 
                                            @foreach($feedback->feedcomments as $comment)
                                            <!-- <div class="comment{{$comment->id}}"> -->
                                            <div class="uname" id="comment{{$comment->id}}">
                                                    <img src="{{ $comment->user->personal->image}}" id="profile"/>
                                                    <span><i class="fa fa-user" aria-hidden="true"></i></span>   by <a href="">{{$comment->user->name}}</a>
                                                    <span class="content">{{$comment-> content}}</span>
                                                    @if (Auth::user()->id == $comment->user_id)
                                                    <span><a class="glyphicon glyphicon-pencil feed" data-rowid="{{ $comment->id }}" href=""></a></span>
                                                    <span><a  class="glyphicon glyphicon-trash delete" data-rowid="{{ $comment->id }}" href="/feedcomment/{{$comment->id}}/delete"></a><span>
                                                    @endif
                                                <!-- up -->


                                                <form>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="comment"  value="{{ $comment->id }}" />
                                                    
                                                     <br>
                                                    <button class="btn btn-default comment_up" data-rowtok="{{ csrf_token() }}" data-rowid="{{ $comment->id }}" >
                                                    <span class="glyphicon glyphicon-thumbs-up" id="data{{ $comment->id }}" aria-hidden="true">{{$comment->no_ups}}</span>
                                                        
                                                    </button>
                                               </form>
                                               <br><hr>
                                            </div>
                                           <!--  </div> -->
                                           <!-- edit comment-->
                                            <div class="formdiv{{$comment->id}} hide form1" name="fatma" > 
                                                    <form >
                                                          <!--   <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                                                            <div class='form-group col-md-4'>
                                                                    <input  class='form-control' type='text' name='content' class='form-control' id="comment{{$comment->id}}" value="{{$comment->content}}"/>
                                                            </div>
                                                            
                                                            <div  class='form-group '>
                                                                
                                                                    <input type='submit' class='btn btn-primary feedcommentedit' value='Edit'  data-rowid="{{ $comment->id }}" data-rowtok="{{ csrf_token() }}"/>   
                                                                    <input type='reset' class='btn btn-danger cancel' value="Cancel"/>  
                                                            </div>
                                                    </form>
                                                <br>
                                            </div> 
                                            
                                        
                                        
                                        @endforeach

                                        <!--fatma /feedcomment/{{$feedback->id}}/add-->


                                       


                                         </div>
                                        <form >
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class='form-group col-md-4'>
                                                        <input  class='form-control' type='text' name='content' class='form-control' id="comment{{$feedback->id}}"/>
                                                </div>
                                                
                                                <div  class='form-group '>

                                                        <input type='submit' class='btn btn-primary feedcomment' value='Comment'  data-rowid="{{ $feedback->id }}" data-rowtok="{{ csrf_token() }}"/>   

                                                </div>
                                        </form>



                                 </div>

                            </div>
                                    
                            @endforeach
                            @endif

                            <!--enas-->
                            <div class="col-md-12 pull-left feeds">
                                <form >
                                    {!! csrf_field() !!}
                                    <div class='col-xs-12 col-md-12' >
                                        <div class='form-control pull-left addcomment' >
                                            Add feedback
                                            <hr>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <img src="{{Auth::user()->personal->image }}" class="thumbnail pull-left" height="70" width="70" style="display: inline;">
                                                <textarea  class="col-md-10 col-sm-10 col-xs-7" name='content'  placeholder="add feedback ..."></textarea>
                                                <input type="hidden" name="feature_id" value="{{ $feature->id }}">
                                            </div>
                                            <hr>   
                                            @if(sizeof( $exist)>0)
                                            <input class='col-xs-2 pull-right btn btn-sm btn-primary feed' type='submit' name='Add' value="Add" disabled="true" />
                                            @else
                                            <input class='col-xs-2 pull-right btn btn-sm btn-primary feed' type='submit' name='Add' value="Add" />
                                            @endif
                                        </div> 
                                         @if($errors->any())
                                        <h4>{{$errors->first()}}</h4>
                                        @endif                                   
                                    </div>
                                </form>

                            </div>

                        <div class="clearfix"> </div>


                        </div>

                </div>                     

@endsection
