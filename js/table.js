$(document).ready(function(){
    $(".delete").click(function(){
        if (confirm("Вы подтверждаете удаление?")) {
            $.ajax({
                type: "post",
                url: '/index.php/student_controller/delete/' + $(this).attr('id'),
                cache: false,
                success: function(json){
                    var obj = jQuery.parseJSON(json);
                    $("#container").html(obj.response_view);
                }
            });
        } else {
            return false;
        }

    });
});

$(document).ready(function(){
    $("#menu").on('click', '.create', function(){
        $.ajax({
            type: "post",
            url: '/index.php/student_controller/create/',
            cache: false,
            success: function(json){
                var obj = jQuery.parseJSON(json);
                if(obj.status)
                    $("#container").html(obj.response_view);
                else
                    $("#add").html(obj.response_view);
            }
        });
    });
    
    $("#add").on('click', '.create', function(){
        var parameters = $("#createForm").serialize();
        $.ajax({
            type: "post",
            url: '/index.php/student_controller/create/',
            cache: false,
            data: parameters,
            success: function(json){
                var obj = jQuery.parseJSON(json);
                if(obj.status)
                    $("#container").html(obj.response_view);
                else
                    $("#add").html(obj.response_view);
            }
        });
    });
});

$(document).ready(function(){
    $("#container").on('click', '.update', function(){     
        var parameters = 'student_old_name='+$(this).attr('student_name')+'&old_class_id='+$(this).attr('class_id');
        $.ajax({
            type: "post",
            url: '/index.php/student_controller/update/' + $(this).attr('id'),
            data: parameters,
            cache: false,
            success: function(json){
                var obj = jQuery.parseJSON(json);
                if(obj.status)
                    $("#container").html(obj.response_view);
                else
                    $("#add").html(obj.response_view);
            }
        });
    });
    $("#add").on('click', '.update', function(){
        var parameters = 'student_old_name='+$(this).attr('student_name')+'&old_class_id='+$(this).attr('class_id') +'&';
        parameters += $("#updateForm").serialize();
        $.ajax({
            type: "post",
            url: '/index.php/student_controller/update/' + $(this).attr('id'),
            data: parameters,
            cache: false,
            success: function(json){
                var obj = jQuery.parseJSON(json);
                if(obj.status)
                    $("#container").html(obj.response_view);
                else
                    $("#add").html(obj.response_view);
            }
        });
    });
});
