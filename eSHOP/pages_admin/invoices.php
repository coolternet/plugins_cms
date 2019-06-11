    <?php
        
        include 'main.php';
                    
        if(isset($_GET['state'])) {

            switch ($_GET['state']) {
                case "0":
                    echo '<div id="evo-section-title" class="transition fade in"><div><i class="file alternate outline icon"></i> Invoices : unPaid</div></div>';
                    include 'templates/invoices.php';
                    break;
                case "1":
                    echo '<div id="evo-section-title" class="transition fade in"><div><i class="file alternate outline icon"></i> Invoices : Paid</div></div>';
                    include 'templates/invoices.php';
                    break;
                case "2":
                    echo '<div id="evo-section-title" class="transition fade in"><div><i class="file alternate outline icon"></i> Invoices : Canceled</div></div>';
                    include 'templates/invoices.php';
                    break;
                case "3":
                    echo '<div id="evo-section-title" class="transition fade in"><div><i class="file alternate outline icon"></i> Invoices : Refunded</div></div>';
                    include 'templates/invoices.php';
                    break;
            }
            
        } elseif (isset($_GET['id'])) {
        
                $invoice = get_invoice($_GET['id']);
                
                $astate = array(
                    '0' => '<div id="state_bg" class="ui orange massive basic label">Unpaid</div>',
                    '1' => '<div id="state_bg" class="ui green massive basic label">Paid</div>',
                    '2' => '<div id="state_bg" class="ui violet massive basic label">Refund</div>',
                    '3' => '<div id="state_bg" class="ui red massive basic label">Canceled</div>',
                );
        
                if(!empty($invoice)) {
                    
                    
                    $id = $_GET['id'];
                    
                    function apt(){
                        
                        $apt = $invoice['state'];
                        
                        if(empty($apt)){
                            echo '#'.$apt;
                        }
                    }
        
                    include 'templates/invoice.php';
    
                }else{ 
                    echo '<h3 class="ui header">Facture doesn\'t exist</h3>';
                }

        } else {
        
            $astate = array(
                '0' => '<div class="ui orange basic label">Unpaid</div>',
                '1' => '<div class="ui green basic label">Paid</div>',
                '2' => '<div class="ui violet basic label">Refund</div>',
                '3' => '<div class="ui red basic label">Canceled</div>',
            );
            
        ?>
            
            <div id="evo-section-title"><div><i class="file alternate outline icon"></i> Invoices : Overview</div></div>
            <div id="evo-section">
                <div class="ui placeholder segment">
                    <div class="ui two column stackable center aligned grid">
                        <div class="ui vertical divider">Or</div>
                        <div class="middle aligned row">
                            <div class="column">
                                <div class="ui icon header"><i class="search icon"></i>Find Invoice</div>
                                <div class="field">
                                    <div class="ui search">
                                        <div class="ui icon input">
                                            <input id="filter" class="invoice_search prompt" type="text" placeholder="Search invoices..." <?php echo isset($_REQUEST['filter']) ? html_encode($_REQUEST['filter']) : '';?>>
                                            <i class="search icon"></i>
                                        </div>
                                        <div class="results">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="ui icon header"><i class="file alternate outline icon"></i>Add New Invoice</div>
                                <div class="ui primary button">Create</div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php include 'templates/invoices.php' ?>
            
        <?php } ?>
    
</div> <!-- End of eshop-content div !-->