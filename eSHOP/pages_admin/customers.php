    <?php
        
        include 'main.php'; 
    
        if(isset($_GET['user'])) {

            $customer = get_customer($_GET['user']);
            
            include 'templates/customer_account.php';

        } else {

            include 'templates/customers.php';
            
        }
    ?>

</div> <!-- End of eshop-content div !-->