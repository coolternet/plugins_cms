<?php 

    switch (App::GET('state')) {
        case "completed":
            $get = get_tickets(TICKET_CLOSE);
            $title = "Completed Ticket list";
            $type = "close";
            include  __DIR__.'/templates/main.php';
            include 'pages/tickets.php';
            break;
        case "critical":
            $get = get_tickets(TICKET_CRITICAL);;
            $title = "Critical Ticket list";
            $type = "critical";
            include  __DIR__.'/templates/main.php';
            include 'pages/tickets.php';
            break;
        case "opened":
            $get = get_tickets(TICKET_OPEN);
            $title = "Opened Ticket list";
            $type = "open";
            include  __DIR__.'/templates/main.php';
            include 'pages/tickets.php';
            break;
        case "unassigned":
            $get = get_tickets(TICKET_UNASSIGNED);;
            $title = "Un-Assigned Ticket list";
            $type = "unassigned";
            include  __DIR__.'/templates/main.php';
            include 'pages/tickets.php';
            break;
        default:
            $title = "Un-Assigned Ticket list";
            header("Location: ?p=ticket_system/home");
            exit;
    }