    <?php
        include 'main.php';
    
        $latest = end(eshop_latest_version()['version']);

        $latest_pv = $latest['plugin_version'];

        $latest_db = $latest['db_version'];

        $latest_lvl = $latest['level'];

        $changelog = $latest['change_log'];

        $plugin_version = get_eshop_settings()['plugin_version'];

        $plugin_db_version = get_eshop_settings()['plugin_db_version'];

        $settings = get_eshop_settings();
        
        $currency = get_eshop_currency();
        
        $provider = get_eshop_currency_provider();
		
		$taxes = eshop_taxes();
        
        include 'templates/settings.php';
    ?>
    
</div> <!-- End of eshop-content div !-->