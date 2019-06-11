    <?php
        include 'main.php';
        
        $settings = get_eshop_settings();
        
        $currency = get_eshop_currency();
        
        $provider = get_eshop_currency_provider();
        
        include 'templates/settings.php';
    ?>
    

</div> <!-- End of eshop-content div !-->