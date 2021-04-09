<?php 

    include  __DIR__.'/templates/header.php';

    $get_open = get_tickets(TICKET_ALL);
    
    include  __DIR__.'/pages/tickets.php';