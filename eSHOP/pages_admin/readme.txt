	/******************** Fonction DB ********************
		
		DB::Query		=> Execute an SQL statement and returns a PDO statement on success
		DB::QueryAll	=> Returns an array of all rows returned by the SQL query
		DB::GetAll		=> Alias for QueryAll
		DB::QuerySingle	=> Returns a single row, or a single column if $entire_row is false
		DB::Get			=> Returns one column if only one column is present in the result. Otherwise it returns the whole row.
		DB::Exec		=> Execute an SQL statement and returns the number of affected rows
		DB::Insert		=> Inserts one or more rows in a table > Insert($table, array $rows, $replace = false)
		DB::Update		=> Updates one or more rows in a table > Update($table, array $fields, $where = ['id' => 0])

	/******************** Fonctions GET ********************

        get_user($id)       => Get User from ID or username (retourne tout ce qui concerne l'user)
        get_group($id)      => Get group from id or username
        get_asset()         => Find an asset file. It will look in the current theme > get_asset($filename, $full_scheme = false)
        get_template()      => Find an template file > Find an template file.

	/******************** Core Functions ********************

        cookie_destroy()        => Destroy current cookie
        reset_password()        => Reset password > reset_password($user_id, $password)
        random_hash()           => Hash random generator
        group_permissions()     => Returns an array of permissions > group_permissions($group_id)
        mk_human_unit()         => Format a size unit into B/KB/MB/GB > mk_human_unit($size, $format = '%1.2f %s')
        human_unit_to_bytes()   => Parses a human readable file size > human_unit_to_bytes($size, $fallback = 'B')

    /******************** Text'n others Functions ********************

        remove_accents()        => Remove all accents > remove_accents($string)
        format_slug()           => Remove all accents, remplace les caractère spéciaux et met en minuscule > format_slug($title)
        safe_filename()         => Rename a file with a safe filename
        short()                 => Shorten a string to length-3 and add an ellipsis if it is too long > short($string, $length)
        html_encode()           => String encoder to HTML UTF-8 > html_encode($string)
        log_event()             => Log all action by Admin and User > log_event($uid, $type, $event = '')
        send_activation_email() => Send an activation email to user > send_activation_email($username)
        Site()                  => Show some CMS value > Site($string) e.g : name,email,description,url,......

    /******************** Template Functions ********************

        create_url()            => ex: create_url('contact')
        translation : __()      => ex: __(page.field) 
