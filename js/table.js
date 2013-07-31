$(document).ready(function(){
    $(".delete").click(function(){
        if (confirm("Вы подтверждаете удаление?")) {
            $.post('/index.php/student_controller/delete/' + $(this).attr('id'))
            .success(function(json){
                    var obj = jQuery.parseJSON(json);
                    $("#container").html(obj.response_view);
                });
        } else {
            return false;
        }
    });
});

$(document).ready(function(){
    $("#menu").on('click', '.create', function(){
        $.get( '/index.php/student_controller/create/')
        .success( function(json){
            var obj = jQuery.parseJSON(json);
            if(obj.status)
                $("#container").html(obj.response_view);
            else {
                $("#add").html(obj.response_view);
                $("#container #message").remove();
            }
        }); 
    });

    
    $("#add").on('click', '.create', function(){
        var parameters = $("#createForm").serialize();
        $.post( '/index.php/student_controller/create/', parameters)
        .success( function(json){
            var obj = jQuery.parseJSON(json);
            if(obj.status)
                $("#container").html(obj.response_view);
            else 
                $("#add").html(obj.response_view);
        }); 
    });
});

$(document).ready(function(){
    $("#container").on('click', '.update', function(){     
        $.get('/index.php/student_controller/update/' + $(this).attr('id'))
        .success(function(json){
                var obj = jQuery.parseJSON(json);
                if(obj.status)
                    $("#container").html(obj.response_view);
                else {
                    $("#add").html(obj.response_view);
                    $("#container #message").remove();
                }
            });
    });
    
    $("#add").on('click', '.update', function(){
        var parameters = $("#updateForm").serialize();
        $.post('/index.php/student_controller/update/' + $(this).attr('id'), parameters)
        .success(function(json){
                var obj = jQuery.parseJSON(json);
                if(obj.status) {
                    $("#container").html(obj.response_view);
                    $("#add").html('');
                }
                else
                    $("#add").html(obj.response_view);                   
        });
    });
});
