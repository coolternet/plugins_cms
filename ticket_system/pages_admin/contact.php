<?php

    $title = "Incident report or make a suggestion";

    $agent_check = \DB::Get("SELECT last_user_agent FROM {users} WHERE id = :uid",[':uid' => App::getCurrentUser()->id]);

    $useragent = Widgets::userAgentIcons($agent_check);

    $phpver = explode('-', phpversion());

    $btn = "<a href='?p=ticket_system/home' title='Accueil' class='btn btn-dark'><i class='fas fa-home'></i></a>";

    include  __DIR__.'/templates/header_empty.php';
    
    include  __DIR__.'/pages/contact.php';