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
	                        <h3 id="show"> List all system features: </h3>
	                        <br>
	                        <ul class="list-group">
	                        
		                        @foreach($features as $feature)
			                        <li class="list-group-item list-group-item-info ">
			                          <b><a href="features/{{$feature->id}}" > {{$feature->name}} </a></b>

			                        <!--   <a href="/features/{{$feature->id}}/delete"> Delete </a> -->

			                        </li>
		                        @endforeach
		                        
	                        
	                        </ul>
                       
                        
                            <div class="clearfix"> </div>
                        </div>
                       
                    </div>
                    
                    
                <!---start-blog-pagenate---->       
@endsection
