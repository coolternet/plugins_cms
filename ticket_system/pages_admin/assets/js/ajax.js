$(document).ready(function(){

    function ajax_call(type, data, callback) {
        data.csrf = csrf;
        $.ajax({
            type: type,
            dataType: 'json',
            url: "index.php?p=ticket_system/ajax",
            data: data,
            success: callback,
            error : function(data,status){
                callback({success: false, error: "Network error"});
            }
        });
    }

    function ajax_get(data, callback) {
        ajax_call("GET", data, callback);
    }

    function ajax_post(data, callback) {
        ajax_call("POST", data, callback);
    }

    /*
     *  Ticket View send comment
     */

    $("button[name=ticket_answer_btn]").on('click', function(){
        var tid = $('button[name=ticket_answer_btn]').attr("data-id");
        var msg = $('textarea[name=ticket_answer_msg]').val();
        ajax_post({
                action  : 'send_answer_assigned',
                tid     : tid,
                msg     : msg
            },function(data){
                if(data.success){
                    $("html, body").animate({ scrollTop: $(document).height() });
                    $('textarea[name=ticket_answer_msg]').focus();
                    $('textarea[name=ticket_answer_msg]').val('');
                    $("#converbloc").load(" #converbloc");
                }else{
                    console.log(data);
                }
        });

    });

    $("button[name=mark_solved]").on('click', function(){
        var tid = $('button[name=mark_solved]').attr("data-id");
        ajax_post({
                action  : 'mark_solved',
                tid     : tid
            },function(data){
                if(data.success){
                    location.reload();
                }else{
                    console.log(data.error);
                }
        });

    });

    $("button[name=mark_unsolved]").on('click', function(){
        var tid = $('button[name=mark_unsolved]').attr("data-id");
        ajax_post({
                action  : 'mark_unsolved',
                tid     : tid
            },function(data){
                if(data.success){
                    //$("div.ticket-view").remove();
                    //$(".ticket-view").load(" .ticket-view");
                    location.reload();
                }else{
                    console.log(data.error);
                }
        });

    });

    $("button[name=delete_ticket]").on('click', function(){
        var tid = $('button[name=delete_ticket]').attr("data-id");
        ajax_post({
                action  : 'delete_ticket',
                tid     : tid
            },function(data){
                if(data.success){
                    $('table#tickets_list tr#'+tid).remove();
                    location.reload();
                }else{
                    console.log(data.error);
                }
        });

    });

    $("button[name=solved_ticket]").on('click', function(){
        var tid = $('button[name=solved_ticket]').attr("data-id");
        ajax_post({
                action  : 'solved_ticket',
                tid     : tid
            },function(data){
                if(data.success){
                    $('table#tickets_list tr#'+tid).remove();
                    location.reload();
                }else{
                    console.log(data.error);
                }
        });

    });

});