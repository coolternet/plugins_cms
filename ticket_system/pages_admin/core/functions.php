<?php

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
    ini_set('xdebug.var_display_max_depth', '10');
    ini_set('xdebug.var_display_max_children', '256');
    ini_set('xdebug.var_display_max_data', '1024');
    error_reporting(E_ALL);


    /*
     *  Function for listing every tickets
     */

    global $user_session;

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
    
        return \DB::QueryAll("SELECT
                                {tss_ticket}.*,
                                account.username AS account,
                                assignation.username AS assignation,
                                tss_rates.score
                            FROM {tss_ticket}
                            LEFT JOIN {users} as account ON {tss_ticket}.sid = account.id
                            LEFT JOIN {users} AS assignation ON {tss_ticket}.assignation = assignation.id
                            LEFT JOIN tss_rates ON tss_ticket.id = tss_rates.score
                            WHERE $where ORDER BY id ASC LIMIT $start, $count"
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
                        WHERE {tss_ticket}.id = :tid",[':tid' => $id]);
        return $get;
    }

    function ticket_get_content($id){
        $get = \DB::QueryAll("SELECT * FROM {tss_content} WHERE tid = :tid ORDER BY id ASC",[':tid' => $id]);
        return $get;
    }

    /*
     * Retreive Ticket's Counts
     */

    function ticket_count(){
        $count = \DB::Get("SELECT COUNT(id) AS nbr FROM {tss_ticket}");
        return $count;
    }

    function ticket_count_unassigned(){
        $count = \DB::Get("SELECT COUNT(*) AS nbr FROM {tss_ticket} WHERE `assignation` IS NULL");
        return $count;
    }

    function ticket_count_open(){
        $count = \DB::Get("SELECT COUNT(*) AS nbr FROM {tss_ticket} WHERE close_date IS NULL");
        return $count;
    }

    function ticket_count_critical(){
        $count = \DB::Get("SELECT COUNT(*) AS nbr FROM {tss_ticket} WHERE `level` != 0");
        return $count;
    }

    function ticket_count_close(){
        $count = \DB::Get("SELECT COUNT(*) AS nbr FROM {tss_ticket} WHERE close_date IS NOT NULL");
        return $count;
    }

    function ticket_count_scored(){
        $count = \DB::Get("SELECT COUNT(*) AS nbr FROM {tss_ticket} WHERE `score` IS NOT NULL");
        return $count;
    }

    function ticket_get_scored(){
        $get = \DB::QueryAll("SELECT DISTINCT
                                assignation.id AS id,
                                assignation.username AS modo,
                                groups.name AS rank
                            FROM {tss_ticket}
                            LEFT JOIN {users} AS assignation ON {tss_ticket}.assignation = assignation.id
                            LEFT JOIN {groups} AS groups ON assignation.group_id = groups.id
                            LEFT JOIN {tss_rates} AS rates ON tss_ticket.id = rates.tid
                            WHERE `close_date` IS NOT NULL");
        return $get;
    }

    function count_ticket_mod($id){
        $count = \DB::Get("SELECT count(*) FROM {tss_ticket} WHERE {tss_ticket}.assignation = :id",[':id' => $id]);
        return $count;
    }

    function global_score($id){
        $count = \DB::Get("SELECT count(*) FROM {tss_ticket} WHERE {tss_ticket}.assignation = :id",[':id' => $id]);
        $score = \DB::QueryAll("SELECT SUM(score) FROM {tss_rates} WHERE {tss_rates}.sid = :id",[':id' => $id]);

        $value = $score[0]['score'] / $count;
        
        $final = round($value, 0);

        return $final;
    }

    function send_answer_assigned_btn($tid, $msg)
        {
            \DB::Insert('tss_content', [
                'tid' => $tid,
                'sid' => '0',
                'mid' => App::getCurrentUser()->id,
                'msg' => $msg,
                'send_date' => date("Y-m-d H:i:s"),
                'ip' => $_SERVER['REMOTE_ADDR']
            ]);

            return 'success';
        }

    function mark_solved($tid)
        {
            
            $EndDate = date("Y-m-d H:i:s");

            \DB::Insert('tss_rates', [
                'tid' => $tid,
                'sid' => App::getCurrentUser()->id,
                'send_date' => $EndDate,
                'score' => '0',
                'comment' => 'Closed by a moderator'
            ]);

            \DB::Update('tss_ticket', ['close_date' => $EndDate], ['id' => $tid]);

            return 'success';
        }

    function mark_unsolved($tid)
        {            
            \DB::Update('tss_ticket', ['close_date' => NULL], ['id' => $tid]);
            return 'success';
        }

    function ticket_email_user($to, $subject, $message)
        {
            
            $subject = [
                TICKET_CLOSE_USER => 'Votre ticket a été fermé',
                TICKET_CLOSE_MOD => 'Votre ticket a été fermé',
                TICKET_OPEN => 'Votre billet a été ouvert',
                TICKET_CRITICAL => 'Le niveau de votre billet a été changé',
                TICKET_UNASSIGNED => 'Votre billet est en attente d\'assignement',
            ];

            $message = [
                TICKET_CLOSE_USER => 'Vous recevez ce message parce que vous avez fermé le billet intitullé :'. $title .'. Cliquez içi pour visualiser le billet.',
                TICKET_CLOSE_MOD => 'Vous recevez ce message parce que votre billet intitullé :'. $title .'. a été fermé par le modérateur assigné. Cliquez içi pour visualiser le billet.',
                TICKET_OPEN => 'Vous recevez ce message parce que vous avez ouvert un billet intitullé :'. $title .'.  Cliquez içi pour visualiser le billet. ',
                TICKET_CRITICAL => 'Vous recevez ce message parce que le niveau de votre billet est reconnu comme critique. Cliquez içi pour visualiser le billet.',
                TICKET_UNASSIGNED => 'Votre billet est en attente d\'assignement. Cliquez içi pour visualiser le billet.',
            ];

            App::SendPrivateMessage($to, $subject, $message);

            return 'success';
        }

    function ticket_email_staff($to, $subject, $message)
        {
            
            $etat = [
                TICKET_CLOSE => "Un billet vient d'être fermé.",
                TICKET_OPEN => "Un nouveau billet vient d\'être créé.",
                TICKET_CRITICAL => "Le niveau billet intitullé ". $title ." est maintenant : critique",
                TICKET_UNASSIGNED => "Un nouveau billet vient d\'être créé et est en attente d'assignement.",
            ];

            $message = [
                TICKET_CLOSE_MOD => 'Vous recevez ce message parce que votre billet intitullé :'. $title .'. a été fermé par le modérateur assigné. Cliquez içi pour visualiser le billet.',
                TICKET_CLOSE_ADM => 'Vous recevez ce message parce que votre billet intitullé :'. $title .'. a été fermé par l\administrateur. Cliquez içi pour visualiser le billet.',
                TICKET_OPEN => 'Vous recevez ce message parce qu\'un billet intitullé :'. $title .' vient d\'être créé.  Cliquez içi pour visualiser le billet. ',
                TICKET_CRITICAL => 'Vous recevez ce message parce que le niveau de votre billet est reconnu comme critique. Cliquez içi pour visualiser le billet.',
                TICKET_UNASSIGNED => 'Vous recevez ce message parce qu\'un billet est en attente d\'assignement. Cliquez içi pour visualiser le billet.',
            ];


            App::SendPrivateMessage($to, $subject, $message);

            return 'success';
        }

    function ticket_email_notif_user($to, $subject, $message, $title)
        {

            $subject = [
                TICKET_ANSWERED => '[Ticket] Vous avez reçus une réponse !',
            ];

            $message = [
                TICKET_ANSWERED => 'Vous recevez ce message parce que vous avez reçus une répondre sur votre billet intitullé :'. $title .'. Cliquez içi pour visualiser le billet.',
            ];

            App::SendPrivateMessage($to, $subject, $message, $reply_to = 0, $type = 0, $from = null);

            return 'success';
        }
