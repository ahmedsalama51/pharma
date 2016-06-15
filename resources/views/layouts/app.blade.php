<!DOCTYPE HTML>
<html>
<head>
<title>PHarmaMeter Social Network </title>
        <link href="{{ asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' /><link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css')}}">
        <script src="{{ asset('js/jquery.min.js')}}"></script>
         <!-- Custom Theme files -->
        <link href="{{ asset('css/style.css')}}" rel='stylesheet' type='text/css' />
         <!-- Custom Theme files -->
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <script type="application/x-javascript">
          addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
         </script>
         <!-- webfonts -->
<!--          <link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
 -->          <!-- webfonts -->
</head>
<body>
<header>
<!-- container -->
            <!-- header -->
            <div class="header header-border">
                <div class="container">
                    <!-- logo -->
                    <div class="logo">
                        <a href="{{ url('/') }}">
                        Pharma Medical
                        {{-- <img src="images/logo.png" title="medicalpluse" /> --}}
                        </a>
                    </div>
                    <!-- logo -->
                    <!-- top-nav -->
                    <div class="top-nav">
                        <span class="menu"> </span>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('features') }}">R & D</a></li>
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a>
                            </li>
                            <li><a href="{{ url('/register') }}">Request Account</a></li>
                        @else
                            <li><a href="/users/{{ Auth::user()->id }}" >
                                <img width="30px" height="20px" src="{{ Auth::user()->personal->image }}" alt=""> {{ Auth::user()->name }} </a>
                            @if(Auth::user()->isAdmin())
                            <li><a href="/admin">Dashboard</a>
                            <li><a href="/requests">Requests</a>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                               
                        @endif
                        </ul>
                    </div>
                    <!-- top-nav -->
                        <!-- script-for-nav -->
                    <script>
                        $(document).ready(function(){
                            $("span.menu").click(function(){
                                $(".top-nav ul").slideToggle(300);
                            });
                        });
                    </script>
                    <!-- script-for-nav -->
                    <div class="clearfix"> </div>
                </div>
            </div>
            <!-- /header -->
        </div>
        <!-- /container -->
        </div>
        <!-- Blog -->
        <div class="blog">
            <div class="container-fluied">
            @if (count($errors) > 0)
                        <div class="alert alert-danger error" style="margin:10px">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>
                                    {{ $error}}
                                </li>
                                @endforeach
                            </ul>
                            </div>
                        @elseif(session('errors'))
                        <div class="alert alert-danger error" style="margin:10px">
                            <ul>
                                @foreach(session('errors') as $error)
                                <li>
                                    {{ $error}}
                                </li>
                                @endforeach
                                {{Session::forget('errors')}}
                            </ul>
                            </div>
                        @elseif(session('error'))
                            <div class='alert alert-danger error'>
                                {{ session('error') }}
                                {{ Session::forget('error') }}

                            </div>
                        @elseif(session('done'))
                            <div class='alert alert-success error'>
                                {{session('done')}}
                                {{Session::forget('done')}}

                            </div>

                        @endif

           
<!-- header -->
    @yield('content')
    @if(Auth::user())
     <!---//End-blog-pagenate---->
                </div>
                <div class="twitter-weights">
                    <div class="blog-content-right">
                        <div class="b-search">
                            <form action="/search/" method="post">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <input type="text" name="search" placeholder='Search' data-toggle="tooltip" data-placement="left" title="Serach for any member by his name or email or even his ID or post by it's content or comment by it's content, you can also find your target by it's date ex: 2016-6-1">
                                <input type="submit" value="">

                            </form>
                        </div>                         
                        <div class="blog-post" id="sub">
                            </br>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class= "add ">
                                    <h3> Top following to follow ?  </h3>
                                </div>
                                @if(sizeof(session('top_users_to_follow'))<1)
                                        <p class="p_nopost">
                                        -- no suggestion now --
                                        </p>
                                @else
                                    </br>
                                       @foreach( session('top_users_to_follow') as $follow)
                                       <div class="uname ">
                                           <img src="{{$follow->image}}" id="profile"/>

                                            <span > <a href="/users/{{$follow->user_id}}"> {{$follow->user->name}}</a> </span>
                                            <button  class=" btn btn-xs btn-success follow" value="{{$follow->id}}"> Follow </button>

                                            

                                            <input type="hidden" class="token" value="{{ csrf_token() }}">

                                       </div>
                                       @endforeach
                                @endif
                                <!-- <a class="twittbtn" href="#">See all users</a> -->
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class= "add">
                                     <h3> Top Interactive to follow ?  </h3>
                                </div>
                                @if(sizeof(session('top_interactive_to_follow'))<1)
                                    <p class="p_nopost">-- no suggestion now --</p>
                                @else
                                </br>
                                   @foreach( session('top_interactive_to_follow') as $follow2)
                                   <div class="uname ">
                                       <img src="{{ $follow2->image}}" id="profile"/>

                                        <span > <a href="/users/{{$follow2->user_id}}"> {{$follow2->user->name}}</a> </span>
                                         <button  class=" btn btn-xs btn-success follow" value="{{$follow2->id}}"> Follow </button>

                                        <input type="hidden" class="token" value="{{ csrf_token() }}">

                                   </div>
                                   @endforeach
                               @endif
                               <!--  <a class="twittbtn" href="#">See all users</a> -->
                            </div>
                        </div>
                        <!---//End-twitter-weight---->
                        <!---- start-tag-weight---->
                        <!-- <div class="b-tag-weight">
                            <h3>Tags Weight</h3>
                            <ul>
                                <li><a href="#">Lorem</a></li>
                                <li><a href="#">consectetur</a></li>
                                <li><a href="#">dolore</a></li>
                                <li><a href="#">aliqua</a></li>
                                <li><a href="#">sit amet</a></li>
                                <li><a href="#">ipsum</a></li>
                                <li><a href="#">Lorem</a></li>
                                <li><a href="#">consectetur</a></li>
                                <li><a href="#">dolore</a></li>
                                <li><a href="#">aliqua</a></li>
                                <li><a href="#">sit amet</a></li>
                                <li><a href="#">ipsum</a></li>
                            </ul>
                        </div> -->
                        <!---- //End-tag-weight---->
                </div>
                <div class="clearfix"> </div>
            </div>
            
            </div>
        </div>
        </div>
    @endif
        <!-- /Blog -->
         {{-- end of posts --}}
            
    </div>

<!-- footer sector -->
        </div><!-- /container -->
    </div><!-- /Blog -->        
<!-- team-grids-caption -->
<!-- footer -->
    <div class="footer navbar navbar-default navbar-static-bottom">
            <!-- <div class="col-md-3 foot-1">
                <h4>Latest Posts</h4>
                <ul>
                <li><a href="">||   </a></li>

            
                </ul>
            </div>
            <div class="col-md-3 foot-1">
                <h4>Top viewed</h4>
                <ul>
                <li><a href="">||   </a></li>

                </ul>
            </div>
            <div class="col-md-3 foot-1">
                <h4>Categories</h4>
                <ul>
                    <li><a href="">||  </a></li>
                </ul>
            </div>
            <div class="col-md-3 foot-1">
                <h4>Tags</h4>
                <ul> 
                    <li><a href="">||  </a></li>
                </ul>
            </div> -->
            
            <div class="clearfix"> </div>
            <div class="copyright">
                <div class="bottom-footer">
                        <p>
                            <span>Copyright © 2084 <a href="#">BusinessMonk</a> 
                            | Design: <a rel="nofollow" href="#" target="_parent"><span class="blue">Pharmateam</span><span class="green">ITI</span></a></span>
                        </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    <!-- JavaScripts -->
    <!-- <script src="{{ asset('js/vendor/jquery-1.11.0.min.js')}}"></script> -->
    <script src="{{ asset('js/vendor/jquery.gmap3.min.js')}}"></script>
    <script src="{{ asset('js/plugins.js')}}"></script>
    <script src="{{ asset('js/jquery-1.12.3.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}" ></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jsactions.js')}}"></script>
    <script src="{{asset('js/feedbackup.js')}}"></script>
    <script src="{{ asset('js/site.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/showpassword.js')}}"></script>
