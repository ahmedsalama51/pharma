$(function () {
    console.log('enas');
    //add feedback
    $('.feeed').on('click',".feed",function(e){
        e.preventDefault();
        var content = $("textarea").val();
        var feature_id = $('input[name="feature_id"]').val();
        var token=$('input[name="_token"]').val();
        var data = {
            'feature_id': feature_id,
            '_token' : $('input[name="_token"]').val(),
            'content' : content
        }
        console.log(data);
        var url = '/feedbacks/'+feature_id;
        $.ajax({
            url: url,
            type:'POST',
            data:data,
            success:function(response){
                console.log(response);
                var array = [];
               array.push('<div class="blog-article ">');
               array.push('<div class="alert alert-info feedback'+response['feedback']['id']+'">');
               array.push('<img src="'+response['image']+'"class="thumbnail" height="70" width="70" style="display: inline;>');
               array.push('<span><a href="">'+response['name']+'</a></span>');
               array.push('<span style="margin-left:15px;">'+response['feedback']['content']+'</span>');
               array.push('<div class="pull-right "><button type="button" class="deletefeed" data-rowid="'+response['feedback']['id']+'" >Delete</button>');
              // array.push('<button type="button" class="feedup" data-rowid="'+response['feedback']['id']+'">Up</button>');
               array.push('<span>'+response['count']+' ups </span></div>');
               array.push('<br><hr/>');
              array.push('<div class="comm'+response['feedback']['id']+'"> </div>');
               //array.push('<form><input type="hidden" name="_token" value="{{ csrf_token() }}"><div class="form-group col-md-4"><input class="form-control" type="text" name="content" class="form-control"/></div><div class="form-group"><input type="submit" class="btn btn-primary" value="add"/></div></form>');
               array.push('<form ><input type="hidden" name="_token" value="'+token+'"><div class="form-group col-md-4"><input class="form-control" type="text" name="content" class="form-control" id="comment'+response['feedback']['id']+'"/></div><div  class="form-group"><input type="submit" class="btn btn-primary feedcomment" value="Comment"  data-rowid="'+response['feedback']['id']+'" data-rowtok="'+token+'"/></div></form>');
               array.push('</div></div>');
               $(array.join('')).insertBefore('.feeds');
               $('.feed').prop('disabled', true);
            },
            error:function(response){
                console.log(response);
            }
        });
    });
    //(up/down)feedback
    $('.feedup').on('click',function(e){
        e.preventDefault();
        var feedback_id=$(this).data('rowid');
        var url = '/feedbacks/up/'+feedback_id;
        var data = {
            'feedback_id': feedback_id,
        }
        console.log(data);
        $.ajax({
            url: url,
            type:'GET',
            data:data,
            success:function(response){
                console.log(response);
                console.log(feedback_id);
                console.log(response['feedback_id']);
                $('.ups'+feedback_id).html(response['count']+'ups');
            },
            error:function(response){
                console.log(response);
            }
        });
    });
        // down feedback:cancelled
/*        $('.feeddown').on('click',function(e){
        e.preventDefault();
        var feedback_id=$(this).data('rowid');
        var url = '/feedbacks/down/'+feedback_id;
        var data = {
            'feedback_id': feedback_id,
        }
        console.log(data);
        $.ajax({
            url: url,
            type:'GET',
            data:data,
            success:function(response){
                console.log(response);
                $('.ups'+feedback_id).html(response['count']+'ups');
            },
            error:function(response){
                console.log(response);
            }
        });
    });*/
    //delete feedback    
    $('.feeed').on('click','.deletefeed',function(e){
        e.preventDefault();
        console.log('delete feed')
        var feedback_id=$(this).data('rowid');
        var url = '/feedbacks/delete/'+feedback_id;
        var data = {
            'feedback_id': feedback_id,
        }
        console.log(data);
        $.ajax({
            url: url,
            type:'GET',
            data:data,
            success:function(response){
                console.log(response);
                $('.feedback'+feedback_id).remove();
                $('.feed').prop('disabled', false);
            },
            error:function(response){
                console.log(response);
            }
        });
    });
});