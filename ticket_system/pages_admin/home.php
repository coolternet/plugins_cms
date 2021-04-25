<?php 

    // Check if some ticket scored exist
    $score = ticket_get_scored();
    
    $count_open = ticket_count_open();

    $get_open = get_tickets(TICKET_OPEN);

    $btn = "
        <a href='?p=ticket_system/create' title='Créer un ticket' class='btn btn-dark'><i class='far fa-edit'></i></a>
        <a href='?p=ticket_system/contact' title='Déclarer un bug' class='btn btn-dark'><i class='fas fa-bug'></i></a>
    ";

    include  __DIR__.'/templates/header_empty.php';
    
    include  __DIR__.'/pages/home.php';