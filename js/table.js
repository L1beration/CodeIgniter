$(document).ready(function(){
     $("#container").on('click', '.delete', function(){
        var href = location.href;
        var parameters = 'last_segment=' + href.replace(/.*\//, '');
        if (confirm("Вы подтверждаете удаление?")) {
            $.post('/index.php/student_controller/delete/' + $(this).attr('id'), parameters, function(json){
                    $("#container").html(json.response_view);
                }, 'json');
        } else {
            return false;
        }
    });
});

$(document).ready(function(){
    $("#menu").on('click', '.create', function(){
        $.get( '/index.php/student_controller/create/', function(json){
            if(json.status)
                $("#container").html(json.response_view);
            else {
                $("#add").html(json.response_view);
                $("#container #message").remove();
            }
        }, 'json'); 
    });

    
    $("#add").on('click', '.create', function(){
        var parameters = $("#createForm").serialize();
        $.post( '/index.php/student_controller/create/', parameters, function(json){
            if(json.status) {
                $("#container").html(json.response_view);
                $("#add").html('');
            }
            else 
                $("#add").html(json.response_view);
        },'json'); 
    });
});

$(document).ready(function(){
    $("#container").on('click', '.update', function(){     
        $.get('/index.php/student_controller/update/' + $(this).attr('id'), function(json){
                if(json.status)
                    $("#container").html(json.response_view);
                else {
                    $("#add").html(json.response_view);
                    $("#container #message").remove();
                }
            }, 'json');
    });
    
    $("#add").on('click', '.update', function(){
        var href = location.href;
        var parameters = $("#updateForm").serialize() + '&last_segment=' + href.replace(/.*\//, '');
        $.post('/index.php/student_controller/update/' + $(this).attr('id'), parameters, function(json){
                if(json.status) {
                    $("#container").html(json.response_view);
                    $("#add").html('');
                }
                else
                    $("#add").html(json.response_view);                   
        }, 'json');
    });
});
