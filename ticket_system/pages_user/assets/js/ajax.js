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
     *  Create a new ticket
     */

    $("button[name=tcreate]").on('click', function(){
        var sujet = $('input[name=tc_subject]').val();
        var content = $('textarea[name=tc_comment]').val();

        $('#create-ticket').validate({ // initialize the plugin
            debut: true,
            rules: {
                tc_subject : {
                  required: true,
                  minlength: 5,
                  maxlength: 64
                },
                tc_comment: {
                  required: true,
                  minlength: 5,
                  maxlength: 1000
                }
              },
            messages : {
                tc_subject: {
                    required: "Veuillez entrer un sujet",
                    minlength: "Minimum de caractères est de 5",
                    maxlength: "Maximum de caractères autorisé est de 50",
                },
                tc_comment: {
                    required: "Veuillez entrer une description du problème",
                    minlength: "Minimum de caractères est de 5",
                    maxlength: "Maximum de caractères autorisé est de 1000",
                },
            },
            submitHandler: function (form) { // for demo
                ajax_post({
                    action  : 'create_new_ticket_btn',
                    subject : sujet,
                    content : content
                },function(data){
                    if(data){
                        window.location.replace("/?p=support/view&id=" + data.id);
                    }else{
                        alert(data.error);
                    }
                });
            }
        });
    });

    /*
     *  Answer to a ticket
     */

    $("button[name=ticket_comment]").on('click', function(){
        var $msg = $('textarea[name=comment]').val();
        var $tid = $('div[id=conversation]').attr("data-id");
        $('#ticket_msg').validate({
            rules: {
                comment: {
                  required: true,
                  minlength: 1,
                  maxlength: 2056
                }
            },
            messages : {
                comment: {
                    required: "Veuillez composer votre message.",
                    minlength: "Minimum de caractères est de 1",
                    maxlength: "Maximum de caractères autorisé est de 2056",
                },
            },
            submitHandler: function (form) {
                ajax_post({
                        action: 'send_answer_btn',
                        comment   : $msg,
                        ticket_id : $tid
                    },function(data){
                        if(data.success){
                            window.location.replace("?p=support/view&id=" + $tid);
                        }else{
                            console.log(data);
                        }
                });
            } 
        });
    });

    /*
     *  Close a ticket
     */

    $("button[name=ticket_close]").on('click', function(){
        var $tid = $('div[id=conversation]').attr("data-id");
        ajax_post({
                action: 'close_ticket_btn',
                ticket_id : $tid
            },function(data){
                if(data.success){
                    $("div[id=commentaire]").remove();
                    $("span[id=ETA]").removeClass('badge-success').addClass('badge-danger').text('Fermé')
                }else{
                    console.log(data);
                }
        });

    });

    /*
     *  Delete ticket from table and set 0 into DB
     */

    $("button[name=delete_ticket]").on('click', function(){
        var $tid = $(this).parents('tr').attr("data-id");
        ajax_post({
                action: 'delete_ticket_btn',
                ticket_id : $tid
            },function(data){
                if(data.success){
                    $("tr[data-id=" + $tid + "]").remove();
                }else{
                    console.log(data);
                }
        });
    });

});