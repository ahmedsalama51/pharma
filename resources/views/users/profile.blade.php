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
                        
                          <img src="{{ Auth::user()->personal->image }}" width="150px" height="150px" class="img-circle"/> 
                        
                            
                             <a id="title" href="#"> {{Auth::user()->name}} </a>
                            
                          
                             <br>
                             <a id="show" href="/users/{{Auth::user()->id}}/profiledetails"> About</a>
                            
                            </div>
                            <br><br><div class='form-group form-group-sm'>
                               <form method="post" action="/posts/add" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                    <div class='col-xs-12 col-md-12' >
                                        <div class='form-control addpost' >
                                            <div class=" btn  col-md-2 col-sm-2 uploadfile ">
                                                
                                                  <i class="fa fa-picture-o" aria-hidden="true"></i> Upload Photo
                                                  <input type="file" name="image" class="upload" />
                                              
                                            </div>
                                            <hr>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                  <textarea  class="col-md-10 col-sm-10 col-xs-7" name='content'  placeholder="add new post"></textarea>
                                            </div>
                                            <hr>   
                                                  <input  class='col-xs-2 pull-right btn btn-sm btn-primary' type='submit' name='Add' value="Publish"/>
                                        </div>                                    
                                   </div>
                                </form>
                                <div class="clearfix"> </div>
                          </div>
                          

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
                                    <li class="post-date"><p><span> {{$post->created_at->format('d')}}</span><label>{{$post->created_at->format('M,Y')}}</label></p></li>
                                    <li class="artlick"><a href="#"><span> </span> <i>90</i></a></li>
                                    <li class="art-comment"><a href="#"><span> </span> <i>50</i></a></li>
                                    <div class="clearfix"> </div>
                                </ul>
                            </div>

                            <div class="blog-artical-info">
                                @if(isset($post->image) && $post->image != '')
                                    <div class="blog-artical-info-img">
                                        <a href="#"><img src="{{ $post->image}}"" title="post-name"></a>
                                    </div>
                                @endif
                                <div class="blog-artical-info-head">
                                    
                                    <ul>
                                        <li><span><i class="fa fa-user" aria-hidden="true"></i></span>by <a href="/users/{{$post->user->id}}">{{ $post->user->name}}</a></li>
                                        @if(Auth::user()->id == $post->user_id && Auth::user()->token == $post->user_token)
                                         <li>
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></span><a href="" data-toggle="modal" data-target=".edit{{$post->id}}">Edit</a>
                                            <div class="modal alert alret-warning fade edit{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Edit post</h4>
                                                  </div>
                                                  <div class="modal-body" style="height:250px">
                                                   <form method="post" action="/edit/{{$post->id}}" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}
                                                    <div class=" btn  col-md-2 col-sm-2 uploadfile ">
                                                        <img src="{{$post->image}}" width="270px" height="150px" />    
                                                        <i class="fa fa-picture-o" aria-hidden="true"></i> <!-- Upload another Photo
                                                        <input type="file" name="image" class="upload" /> -->
                                                    </div>
                                                    <hr> 
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <img class="col-md-2 col-sm-2 col-xs-2 pull-left" src="{{Auth::user()->personal->image }}" alt="">
                                                        <textarea  class="col-md-10 col-sm-10 col-xs-7" name='content'  placeholder="add new post">{{$post->content}}</textarea>
                                                    </div>
                                                    </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                                    
                                                     <input  class='btn btn-sm btn-primary' type='submit' name='Add' value="Update"/>
                                                    </form>
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
                                <div class="blog-artical-info-text">
                                    <p>{{ $post->content}}<a href="#">[...]</a></p>
                                </div>
                                <div class="blog-artical-info-comment">
                                    <div class="alert alert-info">
                                        <p>there is comment</p>
                                    </div>
                                    <div class="alert alert-info">
                                        <p>there is comment</p>
                                    </div>
                                    <div class="alert alert-info">
                                        <p>there is comment</p>
                                    </div>
                                    <div class="col-md-12 pull-left">
                                        <form method="post" action="/comment/add/{{$post->id}}" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                            <div class='col-xs-12 col-md-12' >
                                                <div class='form-control pull-left addcomment' >
                                                    Add comment
                                                    <hr>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <img class="col-md-2 col-sm-2 col-xs-2 pull-left" src="{{Auth::user()->personal->image }}" alt="">
                                                        <textarea  class="col-md-10 col-sm-10 col-xs-7" name='content'  placeholder="add new comment ..."></textarea>
                                                    </div>
                                                    <hr>   
                                                    <input  class='col-xs-2 pull-right btn btn-sm btn-primary' type='submit' name='Add' value="Comment"/>
                                            </div>                                    
                                           </div>
                                        </form>
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
                            
          
                    </div>
                </div>
                    @endif
                  
                  
                    
                </div>
                <!---start-blog-pagenate---->
         
           
@endsection