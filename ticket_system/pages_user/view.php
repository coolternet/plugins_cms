<?php 

    include  __DIR__.'/templates/header.php';

    $tid = APP::GET('id');
    $uid = APP::getCurrentUser()->id;

    if(ticket_get_information($tid)['sid'] === $uid){

        $info = ticket_get_information($tid);
        
        $content = ticket_get_content($tid);

        include  __DIR__.'/pages/view.php';

    }else{
            header("Location: ". APP::getUrl('support'));
            die();
    }