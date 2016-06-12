@extends('layouts.app')

@section('content')
 <div id="latest-blog">
    <div class="container">  
      <div class="blog-content">
          <div class="wrap">
              <div class="blog-content-left">
                <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">All</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Members</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Posts</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Comments</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                      @if(isset($users) && sizeOf($users)>0)
                        <h3>Members :</h3>
                        @foreach($users as $user)
                          <a href="/users/{{$user->id}}"><h4>{{$user->name}}</h4></a>
                          <hr class="seprate">
                        @endforeach
                      @endif
                      @if(isset($posts) && sizeOf($posts)>0)
                        <h3>Posts :</h3>
                        @foreach($posts as $post)
                          <a href="/posts/{{$post->id}}"><h4>{{$post->content}}</h4></a>
                          <hr class="seprate">
                        @endforeach
                      @endif
                      @if(isset($comments) && sizeOf($comments)>0)
                        <h3>Comments :</h3>
                        @foreach($comments as $comment)
                          <a href="/posts/{{$comment->post->id}}"><h4>{{$comment->content}}</h4></a>
                          <hr class="seprate">
                        @endforeach
                      @endif
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                     @if(isset($users) && sizeOf($users)>0)
                        <h3>Members :</h3>
                        @foreach($users as $user)
                          <a href="/users/{{$user->id}}"><h4>{{$user->name}}</h4></a>
                          <hr class="seprate">
                        @endforeach
                      @else
                        <h4 class="nosearch">sorry no member match your search</h4>

                      @endif
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="messages">
                      @if(isset($posts) && sizeOf($posts)>0)
                        @foreach($posts as $post)
                          <a href="/posts/{{$post->id}}"><h4>{{$post->content}}</h4></a>
                          <hr class="seprate">
                        @endforeach
                      @else
                        <h4 class="nosearch">sorry no post match your search</h4>
                      @endif
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings">
                      @if(isset($comments) && sizeOf($comments)>0)
                        @foreach($comments as $comment)
                          <a href="/posts/{{$comment->post->id}}"><h4>{{$comment->content}}</h4></a>
                          <hr class="seprate">
                        @endforeach
                      @else
                        <h4 class="nosearch">sorry no comment match your search</h4>
                      @endif
                    </div>
                  </div>
                </div>
          </div>

@endsection
