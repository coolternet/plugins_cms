<?php 

    include  __DIR__.'/templates/header.php';

    $tid = APP::GET('id');
    $uid = APP::getCurrentUser()->id;

    if(ticket_get_information($tid)['sid'] === $uid){

        $info = ticket_get_information($tid);
        
        $content = ticket_get_content($tid);

        echo '<link rel="stylesheet" type="text/css" href="/modules/ticket_system/pages_user/assets/css/print.css" media="print">';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>';
        echo '<script type="text/javascript" src="/modules/ticket_system/pages_user/assets/js/jquery.validate.min.js"></script>';

        include  __DIR__.'/pages/view.php';

    }else{
            header("Location: ". APP::getUrl('support'));
            die();
    }