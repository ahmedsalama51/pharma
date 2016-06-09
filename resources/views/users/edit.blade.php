@extends('layouts.app')
@section('content')




 <div id="latest-blog">
    <div class="container">  
        {{-- posts --}}
        <div class="blog-content">
            <div class="wrap">
                <div class="blog-content-left">
                    <div class="blog-articals">
                      

                    <b><a id="show" href="/users/{{Auth::user()->id}}"> My account </a></b>
                   <h3 id="head"> Edit your profile </h3>
                        <form  method='POST' action = "/users/{{Auth::user()->id}}/update" enctype="multipart/form-data">
                         {{method_field('PATCH')}}
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                          <div class='form-group col-md-8'>
                             <div class='form-group col-md-8'>
                             
                              <label class="btn btn-primary btn-file ">
                              <img src="{{ Auth::user()->personal->image }}" width="100px" height="100px" class="img-circle"/>
                                Upload Image <input  type="file" name="image" style="display: none;">
                              </label>

                          </div>

                          </div>
                          <div class='form-group col-md-8'>
                              <label class=" control-label ">Username : </label>
                              <input  class='form-control ' type='text' name='uname' value='{{Auth::user()->name}}'/>
                          </div>
                          <div class='form-group col-md-8'>
                              <label class=" control-label ">Email : </label>
                              <input  class='form-control ' type='text' name='email' value='{{Auth::user()->email}}'/>
                          </div>
                          <div class='form-group col-md-8'>
                              <label class=" control-label ">First_name: </label>
                              <input  class='form-control ' type='text' name='fname' value='{{Auth::user()->personal->first_name}}'/>
                          </div>
                          <div class='form-group col-md-8'>
                              <label class=" control-label ">Last_name: </label>
                              <input  class='form-control ' type='text' name='lname' value='{{Auth::user()->personal->last_name}}'/>
                          </div>
                          <div class='form-group col-md-8'>
                            <label class=" control-label ">Degree: </label>
                                  <div>
                                      <select  class="form-control" data-style="btn-primary" id="degrees" name="degree">
                                      @if(Auth::user()->personal->degree !=='')
                                      <option selected disabled value= "{{Auth::user()->personal->degree}}">{{Auth::user()->personal->degree}}</option>
                                      @else
                                      <option selected disabled>Choose degree</option>
                                      @endif
                                          <option value="Bachelor">Bachelor </option>
                                          <option value="Master"> Master </option>   
                                          <option value="Doctor"> Doctor </option>                              
                                      </select>
                                  </div>
                         </div>

                         



                          
                          <div class='form-group col-md-8'>
                              <label class=" control-label ">Company: </label>
                              <input  class='form-control ' type='text' name='company' value='{{Auth::user()->personal->company}}'/>
                          </div>
                          
                          <div  class='form-group col-md-6 '>
                            
                              <input type='submit' class='btn btn-primary ' value='Update'/> 
                          </div>
                     </form>
                


                    
                    
                   </div>
                <!---start-blog-pagenate---->
         
           
            




@endsection