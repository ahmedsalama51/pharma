<script type="text/javascript" src="{{ asset('js/jquery-2.2.1.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(#errors_).hide();
        $(#feedback_up).submit(function(e){
                e.preventDefault();
                var content = $('input[name="content"]').val();
                var feedback_id = $('input[name="feedback_id"]').val();
                var data = new FormData();
                data.append('feedback_id',feedback_id);
                data.append('content',content);
                $.ajax({
                    url:'feedbacks/feedbackUp',
                    type:'POST',
                    data:data,
                    contentType:"multipart/form-data",
                    processData:false,
                    success:function(data){alert('Section created :)')},
                    error:function(data){
                        $(#errors_).show();
                        $(#errors_).html('');
                        var errors = data.responseJSON;
                        $.each(errors,function(k,v){
                            $(#errors_).append(v+'<br>');
                        })
                    }
                });
            }
        })
    })
</script>