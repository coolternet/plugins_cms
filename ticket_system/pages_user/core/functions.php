<?php

    /*
     *  Function for listing every tickets
     */

    const TICKET_ALL  = 1;
    const TICKET_OPEN = 2;
    const TICKET_CLOSE = 3;
    const TICKET_CRITICAL = 4;
    const TICKET_UNASSIGNED = 5;

    function get_tickets(int $type = TICKET_ALL, int $start = 0, int $count = 100): array
    {
        $conditions = [
            TICKET_CLOSE => 'close_date IS NOT NULL',
            TICKET_OPEN => 'close_date IS NULL',
            TICKET_CRITICAL => '`level` > 0',
            TICKET_UNASSIGNED => '`assignation` = 0',
        ];
        
        $where = $conditions[$type] ?? '1';

        $uid = APP::getCurrentUser()->id;
    
        return \DB::QueryAll("SELECT
                                {tss_ticket}.*,
                                account.username AS account,
                                assignation.username AS assignation
                            FROM {tss_ticket}
                            LEFT JOIN {users} as account ON {tss_ticket}.sid = account.id
                            LEFT JOIN {users} AS assignation ON {tss_ticket}.assignation = assignation.id
                            WHERE $where AND {tss_ticket}.sid = :userid AND {tss_ticket}.availability = :available ORDER BY id ASC LIMIT $start, $count",[':userid' => $uid, ':available' => '1']
        );
    }

    /*
     * Retreive Ticket's information
     */

    function ticket_get_information($id){
        $get = \DB::Get("SELECT
                                {tss_ticket}.*,
                                account.username AS account,
                                account.email,
                                account.country,
                                account.registered,
                                assignation.username AS assignation
                        FROM {tss_ticket}
                            LEFT JOIN {users} AS account ON {tss_ticket}.sid = account.id
                            LEFT JOIN {users} AS assignation ON {tss_ticket}.assignation = assignation.id
                        WHERE {tss_ticket}.id = :tid",[':tid' => $id]
        );
        return $get;
    }

    function ticket_get_content($id){
        $get = \DB::QueryAll("SELECT
                                {tss_content}.*
                            FROM {tss_content}
                            WHERE tid = :tid ORDER BY send_date ASC",[':tid' => $id]);
        return $get;
    }

    /*
     * Create new Ticket
     */

    function create_new_ticket($sujet,$content){

        if(empty($sujet)){ $sujet = "Untitled"; }
        if(empty($content)){ $content = "No description available"; }

        \DB::Insert('tss_ticket', [
            'sid' => APP::getCurrentUser()->id,
            'subject' => $sujet,
            'short_desc' => $content,
            'assignation' => "1",
            'create_date' => date("Y-m-d H:i:s")
        ]);

        $lastid = \DB::GET('SELECT MAX(id) FROM tss_ticket');

        return $lastid;

    }

    /*
     *  Send an answer to a Ticket
     */

    function send_answer($tid, $msg){
 
        if(empty($msg)){ $msg = "Uncomment"; }

        \DB::Insert('tss_content', [
            'tid' => $tid,
            'sid' => APP::getCurrentUser()->id,
            'mid' => '0',
            'msg' => $msg,
            'send_date' => date("Y-m-d H:i:s"),
            'ip' => $_SERVER['REMOTE_ADDR']
        ]);

        return 'success';
    }
    
    /*
     * Close a Ticket
     */

    function close_ticket($tid){

        \DB::Update('tss_ticket', ['close_date' => date("Y-m-d H:i:s")], ['id' => $tid]);

        \DB::Insert('tss_rates', [
            'tid' => $tid,
            'sid' => APP::getCurrentUser()->id,
            'score' => '0',
            'comment' => 'Closed by the User',
            'send_date' => date("Y-m-d H:i:s")
        ]);

        return 'success';
    }

    /*
     * DELETE TICKET :: Set value 0 for a customer ticket
     */

    function delete_ticket($tid){

        \DB::Update('tss_ticket', ['availability' => '0'], ['id' => $tid]);

        return 'success';
    }