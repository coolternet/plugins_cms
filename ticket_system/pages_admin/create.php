<?php

    $get_rank = \DB::Query("SELECT `id`,`name` FROM {groups} where {groups}.id <= 2");
    $get_users = \DB::Query("SELECT `id`,`username` FROM {users} WHERE {users}.group_id >= 3 AND {users}.id > 0");

    $btn = "
        <a href='?p=ticket_system/home' title='Accueil' class='btn btn-dark'><i class='fas fa-home'></i></a>
        <a href='?p=ticket_system/contact' title='Déclarer un bug' class='btn btn-dark'><i class='fas fa-bug'></i></a>
    ";

    include  __DIR__.'/templates/header_empty.php';
    
    include  __DIR__.'/pages/create.php';