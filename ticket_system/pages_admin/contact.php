<?php

    $title = "Incident report or make a suggestion";

    $agent_check = \DB::Get("SELECT last_user_agent FROM {users} WHERE id = :uid",[':uid' => App::getCurrentUser()->id]);

    $useragent = Evo\Models\File::userAgentIcons($agent_check);

    $phpver = explode('-', phpversion());

    include  __DIR__.'/templates/main.php';
    
    include  __DIR__.'/pages/contact.php';