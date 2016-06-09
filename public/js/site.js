$(function () {
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

    $("#feed").click(function (){
        $("#formdiv").removeClass("hidden");

    });


    $("#comment_up").submit(function(e){
                e.preventDefault();
                var comment = $('input[name="comment"]').val();
                var data = new FormData();
                data.append('user',user);
                data.append('comment',comment);
                $.ajax({
                    url:'/feedcomment/up',
                    type:'POST',
                    data:data,
                    contentType:"multipart/form-data",
                    processData:false,
                    success:function(data){alert('Section created :)')},
                    error: function (error) {
                      console.log(error);
                     }
                });
            })
       
})