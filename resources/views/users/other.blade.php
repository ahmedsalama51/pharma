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
                            
                     
                             <br>
                             <a id="show" href="/users/{{$user->id}}/profiledetails"> About</a>
                            
                            </div>
                            <br><br>
                          

                     </div>
                    
                      @if(isset($posts) && sizeof($posts) >0)
                        @foreach($posts as $post)
                            <div class="blog-artical">
                            <div class="blog-artical-basicinfo">
                                <ul>
                                 <li class="categoery">
                                 @if(isset(Auth::user()->personal->image))

                                 <img src="{{$post->user->personal->image}}">   
                                    @endif
                                    </li>
                                    <li class="post-date">
                                        <p>
                                            <span> {{$post->created_at->format('d')}}</span>
                                            <label>{{$post->created_at->format('M,Y')}}</label>
                                            <label>{{$post->created_at->format('H:i A')}}</label>
                                        </p>
                                    </li>
                                    <?php $count = 'no';?>
                                    @foreach (Auth::user()->postups as $key => $postup)
                                       @if($postup['post_id'] == $post->id)
                                           <?php $count = '1';?>
                                       @endif
                                    @endforeach
                                    @if($count == '1' )

                                        <li class="artlick">
                                            <input type="hidden" class="up_token" value="{{ csrf_token() }}">
                                            <a href="" class="postUp" post="{{$post->id}}">
                                                    <span class="dlike"><i class="fa fa-arrow-down ilike" aria-hidden="true"></i></span>
                                                    <i class="count">{{$post->postups->count()}}</i>
                                                </a>
                                        </li>
                                    @else
                                        <li class="artlick">
                                            <input type="hidden" class="up_token" value="{{ csrf_token() }}">
                                            <a href="" class="postUp" post="{{$post->id}}">
                                                    <span class="dlike"><i class="fa fa-arrow-up ilike" aria-hidden="true"></i></span>
                                                    <i class="count">{{$post->postups->count()}}</i>
                                                </a>
                                        </li>
                                    @endif
                                    <li class="art-comment"><a href="/posts/{{$post->id}}"><span> </span> <i class="commentsCount">{{$post->comments->count()}}</i></a></li>
                                    <div class="clearfix"> </div>
                                </ul>
                            </div>
                            <div class="blog-artical-info">
                                @if(isset($post->image) && $post->image != '')
                                    <div class="blog-artical-info-img">
                                        <a href="#"><img src="{{ $post->image}}" title="post-name"></a>
                                    </div>
                                @endif
                                <div class="blog-artical-info-head">
                                    
                                    <ul>
                                        <li><span><i class="fa fa-user" aria-hidden="true"></i></span>by <a href="/users/{{$post->user->id}}">{{ $post->user->name}}</a></li>
                                        @if(Auth::user()->id == $post->user_id && Auth::user()->token == $post->user_token)
                                         <li>
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></span><a href="" data-toggle="modal" data-target=".edit{{$post->id}}">Edit</a>
                                            <div class="modal fade edit{{$post->id}}" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Edit post</h4>
                                                  </div>
                                                  <div class="modal-body" style="height:250px">
                                                   <!-- <img src="{{$post->image}}" width="270px" height="145px" class="pull-left" style="margin-bottom: 5px;"/>  
                                                    <div class=" btn  col-md-2 col-sm-2 uploadfile ">
                                                          
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i> Upload another Photo
                                                        <input type="file" name="image" class="upload pull-right" value="{{$post->image}}"/>

                                                        
                                                    </div>
                                                    <hr>  -->
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <img class="col-md-2 col-sm-2 col-xs-2 pull-left" src="{{Auth::user()->personal->image }}" alt="">
                                                        <input type="hidden" class="edit_token" value="{{ csrf_token() }}">
                                                        <textarea  class="editpost col-md-10 col-sm-10 col-xs-7" post="{{$post->id}}" name='content'  placeholder="add new post">{{$post->content}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                                    
                                                     <input  class='btn btn-sm btn-primary updatepost' type='submit' name='Add' value="Update"/>
                                                    
                                                </div>
                                                </div>
                                              </div>
                                            </div>
                                        </li>
                                         <li>
                                            <span><i class="fa fa-trash" aria-hidden="true"></i></span><a href="" data-toggle="modal" data-target=".delete{{$post->id}}">Delete</a>
                                            <div class="modal alert alret-warning fade delete{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Warrning</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    Are you sure you want delete this post... <br> all comments and activites will be also deleted !!!
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                                    <a class="btn btn-md btn-primary" href="/delete/{{$post->id}}">Delete</a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </li>
                                        @endif
                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                                <div class="blog-artical-info-text box{{$post->id}}">
                                    <p>{{ $post->content}}<a href="/posts/{{$post->id}}">[...]</a></p>
                                </div>
                                <div class="blog-artical-info-comment">
                                    @if(sizeof($post->comments()->orderBy('created_at', 'desc')->take(3)->orderBy('created_at', 'asc')->get())>0)
                                        @foreach($post->comments()->orderBy('created_at', 'desc')->take(3)->orderBy('created_at', 'asc')->get()->reverse() as $comment )
                                            <div class="commentHolder ">
                                                <div class="leftSection pull-left col-md-1">
                                                    <a href="/users/{{$comment->user->id}}">
                                                        <img src="{{$comment->user->personal->image }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="pull-left rightSide col-md-11">
                                                    <a class="col-md-12 pull-left" href="/users/{{$comment->user->id}}"> <p>{{$comment->user->name}}</p>
                                                    </a>
                                                    <p class="col-md-12 pull-left commentcontent">{{$comment->content}}</p>
                                                    <input type="hidden" class="editcomment_token" value="{{ csrf_token() }}">
                                                    <textarea class="editcommentbox hide col-md-10 pull-left commentcontent">{{$comment->content}}</textarea>
                                                    <input type="submit" class=" hide ok pull-right btn btn-sm btn-primary" value="update">
                                                </div>
                                                <div class="commentAction col-md-12">   
                                                    <a href="/posts/{{$post->id}}">
                                                         <label>{{$post->created_at->format('d M,Y')}}</label>
                                                            <label>{{$post->created_at->format('H:i A')}}</label>
                                                    </a>
                                                    
                                                    <span>
                                                    UPS (<i class="commentups" >{{$comment->commentups->count()}} </i>) 
                                                    <?php $ccount = 'no';?>
                                                    @foreach (Auth::user()->commentups as $key => $commentup)
                                                       @if($commentup['comment_id'] == $comment->id)
                                                           <?php $ccount = '1';?>
                                                       @endif
                                                    @endforeach
                                                    @if($ccount == '1' )
                                                            <input type="hidden" class="up_token" value="{{ csrf_token() }}">
                                                            <a href="" class="commentUp " comment="{{$comment->id}}">
                                                            <i class="fa fa-arrow-down clike" aria-hidden="true"></i> 
                                                        </a>
                                                    @else
                                                            <input type="hidden" class="up_token" value="{{ csrf_token() }}">
                                                            <a href="" class="commentUp" comment="{{$comment->id}}">
                                                            <i class="fa fa-arrow-up clike" aria-hidden="true"></i> 
                                                        </a>
                                                    @endif
                                                    </span>
                                                    @if(Auth::user()->id == $comment->user->id)
                                                    <span>
                                                        <i class="fa fa-pencil" aria-hidden="true"></i><a href="" class="editcomment" comment="{{$comment->id}}"> Edit</a>
                                                    </span>
                                                    <span>
                                                         <i class="fa fa-trash" aria-hidden="true"></i><a href="/comment/delete/{{$comment->id}}"> Delete</a>
                                                    </span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="commentHolder empty">-- There is no comments yet, be the first -- </div>
                                        <div></div><div></div>
                                    @endif
                                    <div class="col-md-12 pull-left">
                                       <!--  <form method="post" action="/comment/add/{{$post->id}}" enctype="multipart/form-data">
                                        {!! csrf_field() !!} -->
                                            <div class='col-xs-12 col-md-12' >
                                                <div class='form-control pull-left addcomment' >
                                                    Add comment
                                                    <hr>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <img class="user col-md-2 col-sm-2 col-xs-2 pull-left" src="{{Auth::user()->personal->image }}" user="{{Auth::user()->name }}" id="{{Auth::user()->id }}" alt="">
                                                        <input type="hidden" class="comment_token" value="{{ csrf_token() }}">
                                                        <textarea  class="col-md-10 col-sm-10 col-xs-7 comment_content" name='content' post={{$post->id}} placeholder="add new comment ..."></textarea>
                                                    </div>
                                                    <hr>   
                                                    <input  class='col-xs-2 pull-right btn btn-sm btn-primary comment' type='submit' name='Add' value="Comment"/>
                                            </div>                                    
                                           </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="hr"></div>

                        @endforeach
                    <div class="blog-pagenat">
                        <ul>
                            <li><a class="frist" href="#"> <span> </span></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a class="last" href="#"> <span> </span></a></li>
                            <div class="clearfix"> </div>
                        </ul>
                    </div>
                </div>
                    @else
                    <div class="blog-artical">
                            <h4 class="h_nopost"><i>-- There is no posts yet -- </i></h4>
                            <p class="p_nopost">you need to follow some frinds first , here is suggestion</p>
                    
                       
                       @foreach( session('top_to_follow') as $follow)
                           <div class="uname col-md-3 col-sm-3 col-xs-3">
                               <img src="{{$follow->image}}" id="profile"/>
                                <span > <a href="/users/{{$follow->user_id}}"> {{$follow->user->name}}</a> </span>
                                <button  class=" btn btn-xs btn-success follow" value="{{$follow->user_id}}"> Follow </button>
                                <input type="hidden" class="token" value="{{ csrf_token() }}">

                           </div>
                        @endforeach

                    </div>
                </div>
                    @endif
                    
                <!---start-blog-pagenate---->       
@endsection
