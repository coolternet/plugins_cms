<?php 

    // Check if some ticket scored exist
    $score = ticket_get_scored();
    
    $count_open = ticket_count_open();

    $get_open = get_tickets(TICKET_OPEN);

    include  __DIR__.'/templates/header_empty.php';
    
    include  __DIR__.'/pages/home.php';