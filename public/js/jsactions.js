$(function() {
      $('.error').delay(3000).fadeOut('slow');

  $('.follow').on('click', function(event) {
      // event.preventDefault();
      // console.log('here');
      /* Act on the event */
      div = $(this).parent();
      var follower_id = $(this).val(); 
      var follow_Url = '/follow/'+follower_id;
      var token = $(this).parent().parent().find('.token').val()
      var formData = {
          '_token': token,
          'follower_id':follower_id,
      }
      // console.log(formData)
      $.ajax({
          url: follow_Url,
          type: 'post',
          data: formData,
          success:function(response){
              if(response == 'error')
              {
                  div.fadeOut('slow');
                  div.html('<div class="alert alert-error"><i class="fa fa-frown-o" aria-hidden="true"></i> something went wrong </div>');
                  div.find('.alert').fadeIn('slow').delay(5000).fadeOut(5000);
              }
              else if(response == 'already followed')
              {
                  div.fadeOut('slow');
                  div.html('<div class="alert alert-warning"><i class="fa fa-meh-o" aria-hidden="true"></i> already followed </div>');
                  div.find('.alert').fadeIn('slow').delay(5000).fadeOut(5000);
              }
              else
              {
                  div.fadeOut('slow');
                  div.html('<div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i> followed </div>');
                  div.find('.alert').fadeIn('slow').delay(5000).fadeOut(5000);
              }
              
          },
          error:function(response){
              console.log(response);
          }
      })//end of ajax action
  });//end of follow submit

  // un follow
  $('.unfollow').on('click', function(event) {
      // event.preventDefault();
      // console.log('here');
      /* Act on the event */
      div = $(this).parent();
      var follower_id = $(this).val(); 
      var follow_Url = '/unfollow/'+follower_id;
      var token = $(this).parent().parent().find('.token').val()
      var formData = {
          '_token': token,
          'follower_id':follower_id,
      }
      // console.log(formData)
      $.ajax({
          url: follow_Url,
          type: 'post',
          data: formData,
          success:function(response){
              if(response == 'error')
              {
                  div.fadeOut('slow');
                  div.html('<div class="alert alert-error"><i class="fa fa-frown-o" aria-hidden="true"></i> something went wrong </div>');
                  div.find('.alert').fadeIn('slow').delay(5000).fadeOut(5000);
              }
              else if(response == 'already followed')
              {
                  div.fadeOut('slow');
                  div.html('<div class="alert alert-warning"><i class="fa fa-meh-o" aria-hidden="true"></i> already unfollowed </div>');
                  div.find('.alert').fadeIn('slow').delay(5000).fadeOut(5000);
              }
              else
              {
                  div.fadeOut('slow');
                  div.html('<div class="alert alert-success"><i class="fa fa-check-circle" aria-hidden="true"></i> unfollowed </div>');
                  div.find('.alert').fadeIn('slow').delay(5000).fadeOut(5000);
              }
              
          },
          error:function(response){
              console.log(response);
          }
      })//end of ajax action
  });//end of follow submit
/************************************ comment actions ******************************************/
$('.comment').on('click', function(event) {
      event.preventDefault();
      /* Act on the event */
      div = $(this).parent().parent().parent().prev().prev().prev();
      curruntDiv = $(this).parent().parent().parent().prev();
      // maindiv = $(this).parent().parent().parent().parent()
      var user_name = $(this).parent().find('.user').attr('user');
      var user_image = $(this).parent().find('.user').attr('src');
      var user_id = $(this).parent().find('.user').attr('id');
      var box = $(this).parent().find('.comment_content');
      var post_id = $(this).parent().find('.comment_content').attr('post'); 
      var content = $(this).parent().find('.comment_content').val();
      var comment_Url = '/comment/add/'+post_id;
      var token =  $(this).parent().find('.comment_token').val();
      var formData = {
          '_token': token,
          'post_id':post_id,
          'content':content
      }
      // console.log(formData)
      
      
      $.ajax({
          url: comment_Url,
          type: 'post',
          data: formData,
          success:function(response){
              if(response['created_at'])
              {
                  console.log(response);
                var array = [];
               array.push('<div class="commentHolder ">');
               array.push('<div class="leftSection pull-left col-md-1"><a href="/users/'+user_id+'"><img src="'+user_image+'" alt=""></a></div>');
               array.push('<div class="pull-left rightSide col-md-11"><a class="col-md-12 pull-left" href="'+user_id+'}}"> <p>'+user_name+'</p></a>');
               array.push('<p class="col-md-12 pull-left">'+response['content']+'</p></div>');
               array.push('<div class="commentAction col-md-12"><a href="/posts/'+response['post_id']+'">');
               array.push('<label>'+response['created_at']+'</label></a>');
               array.push('<span><i class="fa fa-heart" aria-hidden="true"></i><a href="" "> Up</a></span>');
               array.push('<span><i class="fa fa-pencil" aria-hidden="true"></i><a href="" "> Edit</a></span>');
               array.push('<span><i class="fa fa-trash" aria-hidden="true"></i><a href="" "> Delete</a></span>');
               array.push('</div></div>');
               div.hide();
               $(array.join('')).insertAfter(curruntDiv);
               box.val('');
              }
              else
              {
                console.log('response');
                box.val('Sorry, '+response['content']);
                box.addClass('alert alert-danger');
                setTimeout(function(){box.removeClass('alert alert-danger').val('');},2000)
                 
              }
              
          },
          error:function(response){
              console.log(response);
          }
      })//end of ajax action
  });//end of comment submit
/************************************ like actions ******************************************/
$('.postUp').on('click', function(event) {
      event.preventDefault();
      /* Act on the event */
      var box = $(this).parent();
      var post_id = $(this).attr('post');
      var count = $(this).find('i').val();
      var up_Url = '/postup/add/'+post_id;
      var token =  $(this).parent().find('.up_token').val();
      var formData = {
          '_token': token,
          'post_id':post_id,
      }
      console.log(formData)
      $.ajax({
          url: up_Url,
          type: 'post',
          data: formData,
          success:function(response){
              if(response['like'] == "liked")
              {
               console.log('ok')
               box.find('.count').html(response['count']);
               box.find('.ilike').removeClass('fa-arrow-up').addClass('fa-arrow-down');
              }
              else if(response['like'] == "duplicate")
              { 
                console.log('nok')
                box.find('.count').html(response['count']);
                box.find('.ilike').removeClass('fa-arrow-down').addClass('fa-arrow-up');
                 
              }              
          },
          error:function(response){
              console.log(response);
          }
      })//end of ajax action
  });//end of comment submit
/************************************ edit post actions ******************************************/
$('.updatepost').on('click', function(event) {
      event.preventDefault();
      /* Act on the event */
      var box = $(this).parent().parent();//modal-content
      var post_id = box.find('.editpost').attr('post');
      var content = box.find('.editpost').val();
      var edit_Url = '/edit/'+post_id;
      var token =  box.find('.edit_token').val();
      var formData = {
          '_token': token,
          'post_id':post_id,
          'content':content,
      }
      $.ajax({
          url: edit_Url,
          type: 'put',
          data: formData,
          success:function(response){
              box.parent().parent().modal('hide');
              console.log(response);
              // $('.box'+post_id).hide();
              $('.box'+post_id).html('<p>'+response['content']+'<a href="/posts/'+response['post->id']+'">[...]</a></p>');
          },
          error:function(response){
              console.log(response);
          }
      })//end of ajax action
  });//end of comment submit

/************************************ edit comment actions ******************************************/
$('.editcomment').on('click', function(event) {
      event.preventDefault();
      /* Act on the event */
      var box = $(this).parent().parent().parent();
      var comment_id = $(this).attr('comment');
      box.find('.commentcontent').addClass('hide');
      box.find('.editcommentbox').removeClass('hide');
      box.find('.ok').removeClass('hide');
      $('.ok').on('click', function(event) {
        var content = box.find('.editcommentbox').val();
        var edit_Url = '/comment/edit/'+comment_id;
        var token =  box.find('.editcomment_token').val();
        var formData = {
            '_token': token,
            'comment_id':comment_id,
            'content':content,
        }
        $.ajax({
            url: edit_Url,
            type: 'put',
            data: formData,
            success:function(response){
              console.log(response);
                box.find('.commentcontent').removeClass('hide');
                box.find('.editcommentbox').addClass('hide');
                box.find('.ok').addClass('hide');
                box.find('.commentcontent').html(response['content']);

            },
            error:function(response){
                console.log(response);
            }
        })//end of ajax action
      });//end of update submit
  });//end of edit submit
});