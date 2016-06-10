$(function () {
    console.log('ajax here');
    $("#btn1").click(function () {
        var z = $("#div1").hasClass("hidden");
        if (z == true) {
            $("#div1").removeClass("hidden")
        } else {
            $("#div1").addClass("hidden")

        }
    });
    $("#btn1").click(function () {
        $("#sp1").addClass("glyphicon-ok");
        return false;
    });
    $("#div1").on("close.bs.alert", function () {
        $("#div1").addClass("hidden")
        return false;
    });
    $("#div2").on("hide.bs.modal", function () {
        $("#divalert").removeClass("hidden")
    });
    $("#divalert").on("close.bs.alert", function () {
        $("#divalert").addClass("hidden");
        return false;});
    $("#cartemp").carousel();
    $('[data-toggle="tooltip"]').tooltip();

    $("body").delegate(".feed",'click',function (e){
        e.preventDefault();
        console.log('zalma');
        var id = $(this).data('rowid');
        console.log(id);
        $(".formdiv"+id).removeClass("hide");
        // $(".formdiv"+id).css('display','block');
        // $(".formdiv"+id).show();

    });

     $("body").delegate('.cancel','click',function (e){
        
        $(".form1").addClass("hide");

    });

    $("body").delegate('.delete','click',function (e){
        
        e.preventDefault();
        console.log("delete action");
        var feedcomment_id = $(this).data('rowid');
        console.log(feedcomment_id);

                $.ajax({
                    url:'/feedcomment/'+feedcomment_id+'/delete',
                    type:'GET',
                    success:function(data)
                    {
                        console.log(data);
                         $("#comment"+feedcomment_id).remove();



                    }
             })
    });



// ajax for add feedback comment

    $("body").delegate('.feedcomment','click',function(e){
                console.log("ajaxcomment");
                e.preventDefault();
                var feedback_id = $(this).data('rowid');
                var _token=$(this).data('rowtok');
                var content = $(this).parent().parent().find("#comment"+feedback_id).val();
                // var content = $("#comment"+feedback_id).innerText;
                var data ={};
                data.id=feedback_id;
                data._token=_token;
                data.content=content;
                
                console.log(data);
                $.ajax({
                    url:'/feedcomment/'+feedback_id+'/add',
                    type:'POST',
                    data:data,
                    success:function(data)
                    {
                        console.log(data);
                      
                        $(".comm"+feedback_id).append('<div class="uname"  id="comment'+data[0]['id']+'" style="min-height: 0px; ">');
                        $(".comm"+feedback_id).append('<img src="' +data[2]+'" id="profile" style="width: 30px; height: 25px ; -webkit-border-radius: 30em;"/> ');
                        $(".comm"+feedback_id).append('<span><i class="fa fa-user" aria-hidden="true"></i></span>  by <a href="">' +data[1]+ '</a> ');
                        $(".comm"+feedback_id).append('<span>' +data[0]['content']+ '</span> ');
                        $(".comm"+feedback_id).append('<span><a  class="glyphicon glyphicon-pencil feed" id="runedit" data-rowid="'+data[0]['id']+'" href="" style="color: #19b5fe;"></a></span> ');
                        $(".comm"+feedback_id).append('<span><a  class="glyphicon glyphicon-trash delete" data-rowid="'+data[0]['id']+'" href="/feedcomment/'+data[0]['id']+'/delete" style="color: #19b5fe;"></a><span>');
                        
                        $(".comm"+feedback_id).append('<form>');
                        $(".comm"+feedback_id).append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                        $(".comm"+feedback_id).append('<input type="hidden" name="comment"  value="'+data[0]['id']+'" />');
                        $(".comm"+feedback_id).append('<br>');
                        $(".comm"+feedback_id).append('<button class="btn btn-default comment_up" data-rowtok="'+_token+'" data-rowid="'+data[0]['id']+'" > <span class="glyphicon glyphicon-thumbs-up" id="data'+data[0]['id']+'" aria-hidden="true">'+data[0]['no_ups']+'</span></button>');                               
                        $(".comm"+feedback_id).append ('</form></div><br><br><hr>'); 
                        $(".comm"+feedback_id).append('<div class="formdiv'+data[0]['id']+' hide form1" ><form > <div class="form-group col-md-4"> <input  class="form-control" type="text" name="content" class="form-control" id="comment'+data[0]['id']+'" value="'+data[0]['content']+'"/> </div> <div  class="form-group "> <input type="submit" class="btn btn-primary feedcommentedit" value="Edit"  data-rowid="'+data[0]['id']+'" data-rowtok="'+_token+'"/> <input type="reset" class="btn btn-danger cancel" value="Cancel"/></div> </form>  </div> ');

                                               
                    }
                });
            });
    
    $("body").delegate(".feedcommentedit",'click',function(e){
                console.log("ajaxcommentedit");
                e.preventDefault();
                var div = $(this).parent().parent();
                var feedcomment_id = $(this).data('rowid');
                var _token=$(this).data('rowtok');
                var content = $(this).parent().parent().find("#comment"+feedcomment_id).val();
                var data ={};
                data.id=feedcomment_id;
                data._token=_token;
                data.content=content;
                
                console.log(data);
                $.ajax({
                    url:'/feedcomment/edit/'+feedcomment_id,
                    type:'post',
                    data:data,
                    success:function(data)
                    {
                        console.log(data);
                        $('.form1').addClass("hidden");
                        $("#comment"+feedcomment_id).html('');
                        $("#comment"+feedcomment_id).append('<div class="uname" style="min-height: 0px; ">');
                        $("#comment"+feedcomment_id).append ('<img src="' +data[2]+'" id="profile" style="width: 30px; height: 25px ; -webkit-border-radius: 30em;"/> ');
                        $("#comment"+feedcomment_id).append ('<span><i class="fa fa-user" aria-hidden="true"></i></span>  by <a href="">' +data[1]+ '</a> ');
                        $("#comment"+feedcomment_id).append ('<span>' +data[0]['content']+ '</span> ');
                        $("#comment"+feedcomment_id).append ('<span><a id="feed" class="glyphicon glyphicon-pencil feed" href="" data-rowid="'+data[0]['id']+'" style="color: #19b5fe;"></a></span> ');
                        $("#comment"+feedcomment_id).append ('<span><a  class="glyphicon glyphicon-trash delete" href="/feedcomment/'+data[0]['id']+'/delete" style="color: #19b5fe;"></a><span>');
                        
                        $("#comment"+feedcomment_id).append ('<form>');
                        // $("#comment"+feedcomment_id).append ('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                        $("#comment"+feedcomment_id).append ('<input type="hidden" name="comment"  value="'+data[0]['id']+'" />');
                        $("#comment"+feedcomment_id).append ('<br>');
                        $("#comment"+feedcomment_id).append ('<button class="btn btn-default comment_up" data-rowtok="'+_token+'" data-rowid="'+data[0]['id']+'" > <span class="glyphicon glyphicon-thumbs-up" id="data'+data[0]['id']+'" aria-hidden="true">'+data[0]['no_ups']+'</span></button>');                               
                        $("#comment"+feedcomment_id).append  ('</form></div><br><br><hr>');            
                        $("#comment"+feedcomment_id).append (''); 
                        
                                               
                    }
                });
            });



    $("body").delegate('.comment_up','click',function(e){
                console.log("ajax");
                e.preventDefault();
                var comment = $(this).data('rowid');
                var _token=$(this).data('rowtok');
                console.log(comment);
                var data ={};
                data.comment=comment;
                data._token=_token;
                // data.append('comment',comment);
                console.log(data);
                $.ajax({
                    url:'/feedcomment/up',
                    type:'POST',
                    data:data,
                    success:function(data)
                    {
                        if(data==1)
                        {
                            
                           span=document.getElementById("data"+comment+"");
                           value=document.getElementById("data"+comment+"").innerText;
                           value=parseInt(value);

                           console.log(value);
                           span.innerHTML=value+1;

                        }
                        else
                        {
                           span=document.getElementById("data"+comment+"");
                           value=document.getElementById("data"+comment+"").innerText;
                           value=parseInt(value);

                           console.log(value);
                           span.innerHTML=value-1;
                        }
                    }
                });
            });


       
})